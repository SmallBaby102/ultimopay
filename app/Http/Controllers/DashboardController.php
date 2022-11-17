<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\DepositAddress;

class DashboardController extends Controller
{
    // Dashboard - Analytics
    public function home(Request $request) {
        return view('/pages/home', [
            'balance' => 0,
            // // 'breadcrumbs' => $breadcrumbs,
            // 'products' => $files,
            // 'merchants' => $merchants

        ]);
    }
    public function depositPage(Request $request) {

        return view('/pages/deposit', [
            'balance' => 0,
            // // 'breadcrumbs' => $breadcrumbs,
            // 'products' => $files,
            // 'merchants' => $merchants

        ]);
    }
    public function withdrawPage(Request $request) {

        return view('/pages/withdraw', [
            'balance' => 0,
            // // 'breadcrumbs' => $breadcrumbs,
            // 'products' => $files,
            // 'merchants' => $merchants

        ]);
    }
    public function getDepositAddress(Request $request , $network, $email) {
        $deposit_address = DepositAddress::where("email", $email)->where('network', $network)->first();
        if(!$deposit_address || !$deposit_address["address"]){
            $authorization_value = "Bearer " . "eyJraWQiOiJsMHQ0V0RrSVNOenJwYnRqQlZVR0tRVVE4N0c4aTQ1RlVnK2luT0FBOXhNPSIsImFsZyI6IlJTMjU2In0.eyJzdWIiOiI3ODgxODU0MS1jMWU1LTQ2YmMtYjQ0MS0yMjcwNGY0ZGU4MzAiLCJpc3MiOiJodHRwczpcL1wvY29nbml0by1pZHAudXMtZWFzdC0xLmFtYXpvbmF3cy5jb21cL3VzLWVhc3QtMV9HTU83QnRGSlYiLCJ2ZXJzaW9uIjoyLCJjbGllbnRfaWQiOiI2YjduYTI2NGF1b2tpOHY5dGZyZzFiZTkxbiIsImV2ZW50X2lkIjoiMDU4ZTdhOTUtYjE2Ni00ZDM0LTlhZTctYTE3ZjJmMmEwNWRjIiwidG9rZW5fdXNlIjoiYWNjZXNzIiwic2NvcGUiOiJhd3MuY29nbml0by5zaWduaW4udXNlci5hZG1pbiBvcGVuaWQgcHJvZmlsZSBlbWFpbCIsImF1dGhfdGltZSI6MTY2ODUwMTAzNCwiZXhwIjoxNjY4NTA0NjM0LCJpYXQiOjE2Njg1MDEwMzQsImp0aSI6IjA1NDk0ZGQzLTNiNGEtNDUwZS1iMzVhLWViMjM1MjQ5YTNkZiIsInVzZXJuYW1lIjoiNzg4MTg1NDEtYzFlNS00NmJjLWI0NDEtMjI3MDRmNGRlODMwIn0.KgxIvm5sD1B38FxenzCc7Z8UMVHs7AaYJW7mvw-jgUcSGFJIuLyColVIqzEsq8w0dKFVR_VxZvRrypI57qkIL5pfqVYFKB5i1Njnsu4MsJhOmP1dvS-82tqsXMwU82mfnUmSzFjo69M6H1pGORdadpoU8EJLg0zkRddy7osQwWS--wokIUqNLynr9_cL02qxfwYP0uQk3_hApPnlD0b4ZPpL7QdiWBbh25GmHP86P-gOkqlFBkBcxTJfmHVrrIrIvNThqpxL7IctggeHT93KIQwwz6QYWMR1V2HjmvCkNLbGMbeeWYr06OaW3zAVAh48xGSI0UNJoMvBhKxpr7tz4w";
            $flag = true;
            // while ($flag) {
            //     # code...
            //     $response = Http::withHeaders([
            //         'Content-Type' => 'application/json',
            //         'Authorization' => $authorization_value
            //     ])->post('https://api.cryptosrvc.com/wallet/deposit/create', [
            //         "exchange" => "PLUSQO",
            //         "network" => $network,
            //         "product" => "USDT"
            //     ]);
            //     if($response["success"]) {
            //         # code...
            //         $txid = $response['txid'];
            //         $state_hash = $response['state_hash'];
            //         $response2 = Http::withHeaders([
            //             'Authorization' => $authorization_value
            //         ])->get("https://api.cryptosrvc.com/wallet/transaction/status?txid={$txid}&state_hash={$state_hash}&timeout=10000");
            //         if ($response2["address"]) {
            //             # code...
            //             if(!$deposit_address)                
            //             $deposit_address = new DepositAddress;
            //             $deposit_address->email = $email;
            //             $deposit_address->network = $network;
            //             $deposit_address->address = $response2["address"];
            //             $deposit_address->save();
            //             return $response2["address"];
            //         }
            //     } 
            // }
        }
        return $deposit_address['address'];
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

