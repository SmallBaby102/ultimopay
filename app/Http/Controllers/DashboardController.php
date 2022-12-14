<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\DepositAddress;
use GuzzleHttp\Exception\GuzzleException;
use Session;
require_once (app_path().'/includes/api/Payment.php');
require_once (app_path().'/includes/api/Inquiry.php');
require_once (app_path().'/includes/api/VoidRequest.php');
require_once (app_path().'/includes/api/Settlement.php');
require_once (app_path().'/includes/api/Refund.php');
require_once (app_path().'/includes/PHPGangsta/GoogleAuthenticator.php');
$CONFIGURATOR_USERNAME = "PlusqoAdmin2";
$CONFIGURATOR_PASSWORD = "fY2ADeHDFkpVq%J18gaq";

class DashboardController extends Controller
{
    // Dashboard - Analytics
    public function home(Request $request) {
        // $accounts = [
        //    0 => [
        //     "account_id"=> "630F3ADF-A1FD-4EA5-A423-01D4499FD796",
        //     "currency"=> "USDT"
        //    ],
        //     1=>[
        //     "account_id"=> "82E6F313-AA04-4A47-984C-F1E48D8DE962",
        //     "currency"=> "USD"
        //     ],
        // ];
        // $request->session()->put('accounts',$accounts);
        // return view('/pages/home', [
        //     'balance' =>1,
        //     'email' =>  $request->session()->get("email"),
        //     'merchant' => $request->session()->get("merchant"),

        // ]);
        $email = $request->query('email');
        $merchant = $request->query('merchant', env("MERCHANT"));
        $request->session()->put('email',  $email);
        $request->session()->put('merchant',$merchant);
        $api_key = 'Bearer ' . env("API_KEY");
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => $api_key
        ])->post("https://api.ultimopay.io/v1/getAuthToken/",  [
            'email_address' => $email,
            'merchant' => $merchant
         ]);
        if ($response["result"] === "success") {
            # code...
            $request->session()->put('auth_token', $response['authResponse']['auth_token']);
            $request->session()->put('user_id',$response['authResponse']['user_id']);
            $request->session()->put('accounts',$response['authResponse']['accounts']);
            $response1 = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => $api_key
            ])->post("https://api.ultimopay.io/v1/walletBalance/",  [
                'email_address' => $email,
                'auth_token' =>$request->session()->get("auth_token"),
                'currency' => "USDT"
             ]);
             if ($response1["result"] === "success") {
                return view('/pages/home', [
                    'balance' => $response1['wallet'][0]['balance'],
                    'email' =>  $request->session()->get("email"),
                    'merchant' => $request->session()->get("merchant"),
        
                ]);
             } else {
                $response2 = Http::withHeaders([
                    'Content-Type' => 'application/json',
                    'Authorization' => $api_key
                ])->post("https://api.ultimopay.io/v1/walletBalance/",  [
                    'email_address' => $email,
                    'auth_token' =>$request->session()->get("auth_token"),
                    'currency' => "USDT"
                 ]);
                 if ($response2["result"] === "success") {
                    return view('/pages/home', [
                        'balance' => $response2['wallet'][0]['balance'],
                        'email' =>  $request->session()->get("email"),
                        'merchant' => $request->session()->get("merchant"),
            
                    ]);
                 } else {
                    return view('/pages/home', [
                         'error' => "Your session was expired. Please re-login UltimoCasino and try again.",
                         'email' =>  $request->session()->get("email"),
                        'merchant' => $request->session()->get("merchant"),
            
                    ]);
                   
                 }
             }
            
        } else {
            return view('/pages/home', [
                 'error' =>  $response["error"]["errorMessage"],
                 'email' =>  $request->session()->get("email"),
                 'merchant' => $request->session()->get("merchant"),
    
            ]);
        }
    }
    public function depositPage(Request $request) {
        try
        {
            $api_key = 'Bearer ' . env("API_KEY");
            $response1 = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => $api_key
            ])->post("https://api.ultimopay.io/v1/walletBalance/",  [
                'email_address' => $request->session()->get("email"),
                'auth_token' =>$request->session()->get("auth_token"),
                'currency' => "USDT"
            ]);
            if ($response1["result"] === "success") {
                return view('/pages/deposit', [
                    'balance' => $response1['wallet'][0]['balance'],
                    'email' => $request->session()->get("email"),
                    'merchant' => $request->session()->get("merchant"),
        
                ]);
            } else {
                return view('/pages/deposit', [
                    'error' => "Your session was expired. Please re-login UltimoCasino and try again.",
                    'email' =>  $request->session()->get("email"),
                    'merchant' => $request->session()->get("merchant"),
        
                ]);
            }
        } catch (\Throwable $th) {
            //throw $th;
            return view('/pages/withdraw', [
                'error' => "Network problem.",
               'email' =>  $request->session()->get("email"),
               'merchant' => $request->session()->get("merchant"),
           ]);
        }
    }
    public function withdrawPage(Request $request) {
        // return view('/pages/withdraw', [
        //     'balance' => 123,
        //     'email' =>  $request->session()->get("email"),
        //     'merchant' => $request->session()->get("merchant"),
        //     'tfaStatus' => "disabled",
        //    ]);
        $api_key = 'Bearer ' . env("API_KEY");
        try {
            //code...
            $response1 = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => $api_key
            ])->post("https://api.ultimopay.io/v1/walletBalance/",  [
                'email_address' => $request->session()->get("email"),
                'auth_token' =>$request->session()->get("auth_token"),
                'currency' => "USDT"
             ]);
             if ($response1["result"] === "success") {
                $tfaStatus = $this->check2FA();
                return view('/pages/withdraw', [
                    'balance' => $response1['wallet'][0]['balance'],
                    'email' =>  $request->session()->get("email"),
                    'merchant' => $request->session()->get("merchant"),
                    'tfaStatus' => $tfaStatus,
                   ]);
             } else {
                return view('/pages/withdraw', [
                     'error' => "Your session was expired. Please re-login UltimoCasino and try again.",
                    'email' =>  $request->session()->get("email"),
                    'merchant' => $request->session()->get("merchant"),
                ]);
             }
        } catch (\Throwable $th) {
            //throw $th;
            $tfaStatus = $this->check2FA();

            return view('/pages/withdraw', [
                'error' => "Network problem.",
               'email' =>  $request->session()->get("email"),
               'merchant' => $request->session()->get("merchant"),
           ]);
        }
      
    }
    public function withdraw(Request $request) {
        $api_key = 'Bearer ' . env("API_KEY");
        try {
            //code...
            $amount = $request->input("amount");
            $address = $request->input("address");
            $network = $request->input("network");
            $code = $request->input("code");
            $password = $request->input("password");
            $response1 = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => $api_key
            ])->post("https://api.ultimopay.io/v1/withdraw/",  [
                'email_address' => $request->session()->get("email"),
                'auth_token' =>$request->session()->get("auth_token"),
                'amount' =>$amount,
                'address' =>$address,
                'network' =>$network,
                'two_fa_code' =>$code,
                'password' =>$password,
                'currency' => "USDT"
             ]);
            return $response1;
        } catch (\Throwable $th) {
            //throw $th;
            $result = [];
            $result["result"] = "Network problem";
            return $result;
        }
      
    }
    public function buyPage(Request $request) {
        $api_key = 'Bearer ' . env("API_KEY");
        $response1 = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => $api_key
        ])->post("https://api.ultimopay.io/v1/walletBalance/",  [
            'email_address' => $request->session()->get("email"),
            'auth_token' =>$request->session()->get("auth_token"),
            'currency' => "USDT"
         ]);
         if ($response1["result"] === "success") {
            return view('/pages/buy', [
                'balance' => $response1['wallet'][0]['balance'],
                'email' =>  $request->session()->get("email"),
                'merchant' => $request->session()->get("merchant"),
               ]);
         } else {
            return view('/pages/buy', [
                'error' => "Your session was expired. Please re-login UltimoCasino and try again.",
                'email' =>  $request->session()->get("email"),
                'merchant' => $request->session()->get("merchant"),
            ]);
         }
       
    }
    public function buyWithCard(Request $request) {
         try {
                $amount = $request->input("amount");
                $request->session()->put('currency', $request->input("currency"));
                $payment = new \Payment();
                $response = $payment->Execute($amount);
                $request->session()->put('amount',$amount);
                return $response;

            } catch (GuzzleException $e) {
                echo '\n Message: ' . $e->getMessage();
                return "failed";
            } catch (Exception $e) {
                echo '\n Message: ' . $e->getMessage();
                return "failed";
            }
    }
    public function paymentConfirmation(Request $request) {
        $pay_amount = $request->session()->get('amount');
        $userId = $request->session()->get('user_id');
        $accounts = $request->session()->get('accounts');
        $currency = $request->session()->get('currency');
        $account = array_filter( $accounts, function( $v ) { return ( $v["currency"] === $currency ); } );
        $account_id = $account[0]["account_id"];
        $crypto_amount = $pay_amount * 0.95;
        $response1 = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post("https://authentication.cryptosrvc.com/api/configurator_authentication/configuratorToken/",  [
            'exchange' => "CONFIGURATOR_PLUSQO",
            'username' => $CONFIGURATOR_USERNAME,
            'password' => $CONFIGURATOR_PASSWORD
         ]);
         $configurator_access_token = $response1["configurator_access_token"];
         $response2 = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization'=> `Bearer {$configurator_access_token}`,
        ])->put("https://config.plusqo.shiftmarketsdev.com/api/users/{$userId}/accounts/{$account_id}/balancecorrection",  [
              "userId"=> $user_id, 
              "accountId"=> $account_id, 
              "type"=> 5, 
              "amount"=>  $crypto_amount, 
              "comment"=>  `USDT BUY`, 
              "currency"=>  "USDT"
         ]);

         if($response2->successful()){
            $api_key = 'Bearer ' . env("API_KEY");
            $response1 = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => $api_key
            ])->post("https://api.ultimopay.io/v1/walletBalance/",  [
                'email_address' => $request->session()->get("email"),
                'auth_token' =>$request->session()->get("auth_token"),
                'currency' => "USDT"
             ]);
             if ($response1["result"] === "success") {
                return view('/pages/buy', [
                    "paymentConfirm" => "You bought {$crypto_amount}USDT successfully!",
                    'balance' => $response1['wallet'][0]['balance'],
                    'email' =>  $request->session()->get("email"),
                    'merchant' => $request->session()->get("merchant"),
                   ]);
             } else {
                return view('/pages/buy', [
                    'error' => "Your session was expired. Please re-login UltimoCasino and try again.",
                    'email' =>  $request->session()->get("email"),
                    'merchant' => $request->session()->get("merchant"),
                ]);
             }
         } else {
            $api_key = 'Bearer ' . env("API_KEY");
            $response1 = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => $api_key
            ])->post("https://api.ultimopay.io/v1/walletBalance/",  [
                'email_address' => $request->session()->get("email"),
                'auth_token' =>$request->session()->get("auth_token"),
                'currency' => "USDT"
             ]);
             if ($response1["result"] === "success") {
                return view('/pages/buy', [
                    "paymentConfirm" => "You failed in buying {$crypto_amount}USDT!",
                    'balance' => $response1['wallet'][0]['balance'],
                    'email' =>  $request->session()->get("email"),
                    'merchant' => $request->session()->get("merchant"),
                   ]);
             } else {
                return view('/pages/buy', [
                     'error' => "Your session was expired. Please re-login UltimoCasino and try again.",
                    'email' =>  $request->session()->get("email"),
                    'merchant' => $request->session()->get("merchant"),
                ]);
             }
         }
        
    }
    public function twoFa(Request $request) {
        if($this->check2FA()) {
            return view('/pages/2fa', [
                'status' => true,
                'email' => $request->session()->get("email"),
                'merchant' =>  $request->session()->get("merchant"),

               ]);
        }
        $api_key = 'Bearer ' . env("API_KEY");
        $response1 = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => $api_key
        ])->post("https://api.ultimopay.io/v1/get2FASecretKey/",  [
            'email_address' => $request->session()->get("email"),
            'auth_token' =>$request->session()->get("auth_token"),
         ]);
         if ($response1["result"] === "success") {
            $ga = new \PHPGangsta_GoogleAuthenticator();
            $fixedcode = $response1['two_fa_secret_key'];
            $qrCodeUrl = $ga->getQRCodeGoogleUrl("2FA for Ultimopay", $fixedcode, 'ULTIMOPAY.IO');
            return view('/pages/2fa', [
                'qrCodeUrl' => $qrCodeUrl,
                'secret' => $fixedcode,
                'email' => $request->session()->get("email"),
                'merchant' =>  $request->session()->get("merchant"),

               ]);
         } else {
            return view('/pages/2fa', [
                 'error' => "Your session was expired. Please re-login UltimoCasino and try again.",
                'email' =>  $request->session()->get("email"),
                'merchant' => $request->session()->get("merchant"),
            ]);
         }
         
    }
    public function setTwoFa(Request $request) {
        $api_key = 'Bearer ' . env("API_KEY");
        $code = $request->input("code");
        $password = $request->input("password");
        $response1 = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => $api_key
        ])->post("https://api.ultimopay.io/v1/set2FA/",  [
            'email_address' => $request->session()->get("email"),
            'auth_token' =>$request->session()->get("auth_token"),
            'two_fa_code' =>$code,
            'password' =>$password,
            'type' => 1
         ]);
         if ($response1["result"] === "success") {
            return "success";
         } else {
            return "failed";
         }
         
    }
    public function disableTwoFa(Request $request) {
        $api_key = 'Bearer ' . env("API_KEY");
        $code = $request->input("code");
        $password = $request->input("password");
        $response1 = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => $api_key
        ])->post("https://api.ultimopay.io/v1/set2FA/",  [
            'email_address' => $request->session()->get("email"),
            'auth_token' =>$request->session()->get("auth_token"),
            'two_fa_code' =>$code,
            'password' =>$password,
            'type' => 0
         ]);
         if ($response1["result"] === "success") {
            return "success";
         } else {
            return "failed";
         }
         
    }
    public function check2FA() {
        $api_key = 'Bearer ' . env("API_KEY");
        $response1 = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => $api_key
        ])->post("https://api.ultimopay.io/v1/check2FA/",  [
            'email_address' => Session::get("email"),
            'auth_token' =>Session::get("auth_token"),
         ]);
         if ($response1["result"] === "success") {
            return $response1["2FAStatus"]["status"] ;
         } else {
            return "failed";
         }
         
    }
    public function getDepositAddress(Request $request , $network, $email) {
        $api_key = 'Bearer ' . env("API_KEY");
        $response1 = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => $api_key
        ])->post("https://api.ultimopay.io/v1/deposit/",  [
            'email_address' => $request->session()->get("email"),
            'auth_token' =>$request->session()->get("auth_token"),
            'currency' => "USDT",
            'network' => $network,
         ]);
         if ($response1["result"] === "success") {
            return $response1["depositResponse"]["address"];
         } else {
            return json_encode($response1["error"]["errorMessage"]);

         }
    }
    public function login(Request $request){

        $api_host = 'https://api.cryptosrvc.com';
        $nonce = time();

        $api_url = $api_host . "/authentication/user_authentication/exchangeToken";
        $post_data = array();
		$post_data['username'] = $request->input("username");
		$post_data['password'] = $request->input("password");
		$post_data['exchange'] = "PLUSQO";
		$post_data['twoFACode'] = "";

		$postdata = json_encode( $post_data );
        $ch = curl_init();		
		curl_setopt($ch, CURLOPT_URL, $api_url);
		curl_setopt($ch, CURLOPT_POST, 1);
		//curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; PHP client; ' . php_uname('s') . '; PHP/' . phpversion() . ')');
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.34 Safari/537.36');
		//curl_setopt($ch, CURLOPT_HTTPHEADER, array('authorization: Basic d2ViOg==','Content-Type: application/x-www-form-urlencoded'));
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));   
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        $result = curl_exec($ch);
        $rs['http_code']  = curl_getinfo($ch, CURLINFO_HTTP_CODE);
      
        if ($result === false) { //CURL call failed
            //throw new Exception('Could not get reply: ' . curl_error($ch));
            $rs['error'] = 'could not get reply with error : ' . curl_error($ch);
            //return $rs;
        } else {
            $result_decode = json_decode($result, true );
            if (!($result_decode)) {
                switch (json_last_error()) {
                    case JSON_ERROR_DEPTH:
                        $rs['error'] = 'Reached the maximum stack depth';
                        break;
                    case JSON_ERROR_STATE_MISMATCH:
                        $rs['error'] = 'Incorrect discharges or mismatch mode';
                        break;
                    case JSON_ERROR_CTRL_CHAR:
                        $rs['error'] = 'Incorrect control character';
                        break;
                    case JSON_ERROR_SYNTAX:
                        $rs['error'] = 'Syntax error or JSON invalid';
                        break;
                    case JSON_ERROR_UTF8:
                        $rs['error'] = 'Invalid UTF-8 characters, possibly invalid encoding';
                        break;
                    default:
                        $rs['error'] = 'Unknown error';
                }

                //throw new Exception($error);
                
            } else {
                
                $rs['result'] = $result_decode;
            }
        }
    
        $login_res = $rs;
        if ($login_res['result'] && $login_res['result']['result'] == 'success') {
            $agent = Agent::where("email", $post_data['username'])->first();
            if($agent === null){
                $data["msg_ex"] = "You are not an agent. Please try another one.";
                $pageConfigs = [
                    'pageHeader' => false
                ];
    
                $pageConfigs = [
                    'bodyClass' => "bg-full-screen-image",
                    'blankPage' => true
                ];
                return view('/pages/auth-login', [
                    'pageConfigs' => $pageConfigs,
                    'data' => $data
                ]);
            }
            $request->session()->put('cryptocash_exchange_access_token', $login_res['result']['exchange_access_token']);
            $request->session()->put('cryptocash_client_access_token', $login_res['result']['client_access_token']);
            $api_host2 = 'https://api.plusqo.io';
            // $api_url = $api_host2 . "/api/v1/accounts/";
            $api_url = $api_host . "/trade/accounts/";
            $authorization_value = "Bearer " . $request->session()->get("cryptocash_exchange_access_token");
            $headers = array("Accept: application/json", "Content-Type: application/json", "x-deltix-nonce: $nonce", "Authorization: $authorization_value");
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $api_url);
            //curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; PHP client; ' . php_uname('s') . '; PHP/' . phpversion() . ')');
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.34 Safari/537.36');
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);  
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            $result = curl_exec($ch);
            $rs['http_code']  = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if ($result === false) { //CURL call failed
                //throw new Exception('Could not get reply: ' . curl_error($ch));
                $rs['error'] = 'could not get reply with error : ' . curl_error($ch);
                //return $rs;
            } else {
                $result_decode = json_decode($result, true );
                if (!($result_decode)) {
                    switch (json_last_error()) {
                        case JSON_ERROR_DEPTH:
                            $rs['error'] = 'Reached the maximum stack depth';
                            break;
                        case JSON_ERROR_STATE_MISMATCH:
                            $rs['error'] = 'Incorrect discharges or mismatch mode';
                            break;
                        case JSON_ERROR_CTRL_CHAR:
                            $rs['error'] = 'Incorrect control character';
                            break;
                        case JSON_ERROR_SYNTAX:
                            $rs['error'] = 'Syntax error or JSON invalid';
                            break;
                        case JSON_ERROR_UTF8:
                            $rs['error'] = 'Invalid UTF-8 characters, possibly invalid encoding';
                            break;
                        default:
                            $rs['error'] = 'Unknown error';
                    }
    
                    //throw new Exception($error);
                    
                } else {
                    
                    $rs['result'] = $result_decode;
                }
            }
            $balance = 0;
            foreach ($rs['result'] as $key => $value) {
                # code...
                if($value['product'] === "USDT"){
                    $balance = $value['balance']['active_balance'];
                }
            }
            if (!Auth::user()) {
                # code...
                $user = new User;
                $user->name =  $post_data['username'];
                $user->email =  $post_data['username'];
                $user->password =  $post_data['password'];
                Auth::login($user, true);
            }

            // View all the items
            $files = File::where("agent_id", $post_data['username'])->get();
            foreach ($files as $key => $value) {
                $files[$key]["detail"] = $value->file_details;
                # code...
            }
            $breadcrumbs = [
                ['link'=>"dashboard-analytics",'name'=>"Home"],['link'=>"dashboard-analytics",'name'=>"Data List"], ['name'=>"List View"]
            ];
            curl_close($ch);
            $merchants = Merchant::where('agent_id', $post_data['username'])->get();
            return view('/pages/data-list-view', [
                'balance' => $balance,
                // 'breadcrumbs' => $breadcrumbs,
                'products' => $files,
                'merchants' => $merchants

            ]);
        } else {
            if ( strpos(strtolower($login_res['result']['message']), "incorrect username or password") !== false ) {
                $data['msg'] = 'proc_ng_shift';
                $data['type'] = '2';
                $data['msg_ex'] = "Incorrect login email or password";
            } else if ( strpos(strtolower($login_res['result']['message']), "user does not exist") !== false ) {
                $data['msg'] = 'proc_ng_shift';
                $data['type'] = '2';
                $data['msg_ex'] = "User does not exist";
            } else if ( strpos(strtolower($login_res['result']['message']), "invalid credentials") !== false ) {
                $data['msg'] = 'proc_ng_shift';
                $data['type'] = '2';
                $data['msg_ex'] = "Incorrect login email or password";
            } else if ( strpos(strtolower($login_res['result']['message']), "could not connect to PLUSQO") !== false ) {
                $data['msg'] = 'proc_ng_shift';
                $data['type'] = '2';
                $data['msg_ex'] = "Cannot login now, please try again later !";
            } else if ( strpos(strtolower($login_res['result']['message']), "2fa required") !== false ) {
                $data['msg'] = 'proc_ng_shift';
                $data['type'] = '2';
                $data['msg_ex'] = "need_2fa_shift";			
            } else if ( strpos(strtolower($login_res['result']['message']), "2fa code invalid") !== false ) {
                $data['msg'] = 'proc_ng_shift';
                $data['type'] = '2';
                $data['msg_ex'] = "Invalid 2FA Code";
            } else if ( strpos(strtolower($login_res['result']['message']), "user is not confirmed") !== false ) {
                $data['msg'] = 'proc_ng_not_completed';
                $data['type'] = '2';
                $data['msg_ex'] = "user is not confirmed";			
                $_SESSION['temp_email'] = $post_data['username'];
                $_SESSION['signup_count'] = 0;
            } else {
                $data['msg'] = 'proc_ng_shift';
                $data['type'] = '2';
                $data['msg_ex'] = "Cannot login now due to system error, please try again later";
            }
            
            curl_close($ch);
            $pageConfigs = [
                'pageHeader' => false
            ];

            $pageConfigs = [
                'bodyClass' => "bg-full-screen-image",
                'blankPage' => true
            ];
            return view('/pages/auth-login', [
                'pageConfigs' => $pageConfigs,
                'data' => $data
            ]);
        }

     
    }

    public function upload(Request $request){
        if($files=$request->file('csvFile')){  
            $name = $files->getClientOriginalName();  
            $files->move(public_path('uploads'), $name);

            $newFile = new File;
            $newFile->agent_id = Auth::user()->email;
            $newFile->file_name = $name;
            $newFile->date = date("Y-m-d");
            $newFile->save();

            $contents = [];
            $totalAmount = 0;
            if (($open = fopen(public_path() . "/uploads/" . $name, "r")) !== FALSE) {
                $index=0;
                while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {

                    $contents[] = $data;
                    if($index != 0) $totalAmount += $data[1];

                    $index++;
                }

                fclose($open);
            }
            
            return 1;
        }
    }

}

