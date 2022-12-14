
@extends('layouts/contentLayoutMaster')

@section('title', 'Payment.Ultimopay')

@section('vendor-style')
        {{-- vendor files --}}
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/datatables.min.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/extensions/dataTables.checkboxes.css')) }}">
@endsection
@section('page-style')
        {{-- Page css files --}}
        {{-- <link rel="stylesheet" href="{{ asset(mix('css/pages/data-list-view.css')) }}"> --}}
@endsection

@section('content')
 <style>

   .main {
    color: black;
   }
   .crypto_content {
    padding: 10px;
    background-color: rgb(250, 200, 10);
    justify-content: space-between;
    min-height: 50px;
   }
   .title {
    font-size: 30px;
    color: black;
    align-items: center;
    font-weight: bold;
    padding: 0px;
    padding-left: 10px;
    padding-top: 30px;
   }
   .menu {
    align-items: center;
    justify-content: center;
    flex-direction: column;
   }
   .content {
    margin-left: 0 !important;
   }
   .menu_btn {
    width: 100px;
    padding: 10px;
    margin-top: 10px;
    background-color: white;
    font-weight: 700;
   }
   .menu_btn:hover {
    background-color: black;
    color: white;
   }
   .menu .active {
    background-color: black;
    color: white;
   }
   .withdraw_content {
    padding: 40px;
   }
   .content_title {
    font-size: 1.1rem;
    font-weight: bold;
   }
   .content_btn {
    background-color: rgb(250, 200, 10);
    font-weight: bold;
    border: none;
    color: black;
   }
   .amount_input {
    width: 100%;
    border: none;
    border-radius: 10px;
    background: rgb(250, 200, 10);
    padding: 10px;
    font-size: 1rem;
    color: black;
    font-weight: bold;
   }
   .address_input {
    width: 100%;
    border: none;
    border-bottom: 1px solid rgb(250, 200, 10);
    padding: 10px;
    font-size: 1rem;
    color: black;
   }
   .address_input:focus-visible, .amount_input:focus-visible {
      outline: none;
   }
   .left_side {
     width: 60%;
     padding: 5px;
     border-right: 1px solid rgb(119, 117, 117);
     
   }
   .right_side {
     width: 40%;
     padding: 5px;
     padding-left: 20px;
   }
   .notice_item {
    border-bottom: 1px solid rgb(119, 117, 117);
   }
   .form-control:focus {
    border: 1px solid rgb(250, 200, 10);
   }
   #btn-copy, #btn-enable {
    background: rgb(250, 200, 10);
    color: black;
    margin-left: 10px;
   }
   .deposit_address {
   }
   .coin_icon {
    width: 50px;
    height: 50px;
    margin-right: 10px;
   }
   .fonticon-wrap {
    margin: 5px;
    position: absolute;
    font-size: 25px;
    left: 5px;
    color: black;
   }
   .error {
        font-size: 1.5rem;
        text-align: center;
        margin: 20px;
   }
 </style>
  <div class="main">
          <a href="{{url('/?email='.$email.'&merchant='.$merchant)}}" class="fonticon-wrap">
            <i class="feather icon-arrow-left"></i>
          </a>
          <div class="row crypto_content p-2">
          </div>
          <div class="title pl-2 pr-2">
              2-Factor Authentication
          </div>
          <div class=" pl-2 pr-2">
            You can secure your account better by enabling 2-Factor authentication via Google Authenticator app.
            <br/>
            For Android: <a target="_blank" href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2">click here to install</a>
            <br/>
            For iOS: <a target="_blank" href="https://apps.apple.com/us/app/google-authenticator/id388497605">click here to install</a>
        </div>
          <div class="justify-content-center mt-2 d-flex p-1" style="margin: auto; width: 70%; background-image: radial-gradient(circle at center, rgb(228, 166, 51),#ffffff);" >
                <div class="row pt-2" style="width: 99%; border-radius: 30px; background: white; align-items: center; justify-content: center;">
                  <img alt="Address" id="deposit_address_qrcode" class=""
                    src="<?php echo $qrCodeUrl;?>"
                  />
                  <div class="col-sm-6 pt-1 text-left">
                      <div class="form-group">
                        <div class="d-flex">
                          <input type="text" class="form-control" readonly id="copy-to-clipboard-input" value={{$secret}}>
                          <div class="text-center">
                            <button class="btn" id="btn-copy">Copy</button>
                          </div>
        
                        </div>
                        <label class="d-flex mt-2">
                            Use your Google Authenticator App to scan the QR code or enter the authenticator key shown
                        </label>
                      </div>
                  </div>
                                 
                </div>
          </div>
          <div class="justify-content-center mt-2 d-flex p-1" style="margin: auto; width: 70%; background-image: radial-gradient(circle at center, rgb(228, 166, 51),#ffffff);" >
                <div class="row p-2" style="width: 99%; border-radius: 30px; background: white; align-items: center; ">
                    <label class="d-flex ">
                        Enter the code from your Google Authenticator App and your login password
                    </label>
                    <div class="content_title mt-2">Code</div>
                    <input type="text" class="address_input " id="code" placeholder="Enter the code" />
                    <div class="content_title mt-2">Password</div>
                    <input type="text" class="address_input " id="password" placeholder="Enter your login password" />
                </div>
          </div>
          <div class="justify-content-center mt-2 d-flex p-1" style="margin: auto; width: 70%; background-image: radial-gradient(circle at center, rgb(228, 166, 51),#ffffff);" >
                <div class="row p-2" style="width: 99%; border-radius: 30px; background: white; align-items: center; justify-content: center;">
                    <label class="d-flex ">
                      Once you set up 2-Factor Authentication, you can do the following actions.
                    </label>
                    <label class="content_title mt-2">Withdrawals<br/></label>
                </div>
          </div>
          <div class="justify-content-center mt-2 d-flex p-1" style="margin: auto; width: 70%;" >
              <button class="btn" id="btn-enable">Enable 2-FA</button>
          </div>
  </div>
  {{-- Data list view end --}}
@endsection

@section('vendor-script')
{{-- vendor js files --}}
        <script src="{{ asset(mix('vendors/js/extensions/dropzone.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.bootstrap4.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.bootstrap.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.select.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.checkboxes.min.js')) }}"></script>
@endsection
@section('page-script')
        <script> 
            let base_url = '<?php echo url(""); ?>'
        </script>
        {{-- Page js files --}}
        <script src="{{ asset('js/scripts/ui/2fa.js') }}"></script>
        <script src="{{ asset('js/scripts/extensions/copy-to-clipboard.js') }}"></script>
@endsection
