
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
  
   #DataTables_Table_0_length select{
      width: 50;
      height: 30;
      font-size: 11px;
   }
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
    padding: 25px;
   }
   .content_title {
    font-size: 1.3rem;
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
    padding: 15px;
    font-size: 1rem;
    color: black;
    font-weight: bold;
   }
   .address_input {
    width: 100%;
    border: none;
    border-bottom: 1px solid rgb(250, 200, 10);
    padding: 15px;
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
   .coin_icon {
    width: 50px;
    height: 50px;
    margin-right: 10px;
   }
   .important_notice {
    color: red;
   }
   .fonticon-wrap {
    margin: 5px;
    position: absolute;
    font-size: 25px;
    left: 5px;
    color: black;
   }
   .two_desc {
    margin-bottom: 25px;
    display: flex;
   }
   .feather-circle {
    margin: 5px;
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
        @if (isset($error))
          <div class="row crypto_content p-2">
          </div>
          <div class="error">
                {{ $error }}
          </div>
        @else
            <div class="row crypto_content p-2">
              <div class="text-center title align-center justify-content-center">
                  <p class="text-left"><img alt="Icon" class="coin_icon"src="images/logo/usdt.png"/>Tether USD</p>
                  <p id="balance" class="text-left">  {{$balance}} 
                  </p>
                  <p class="text-left" style="font-weight:300; font-size:25px"> USDT</p>
                </div>
              <div class="d-flex menu">
                          <a href="{{url('deposit-page')}}" class="btn menu_btn " >Deposit</a>
                          <a href="{{url('withdraw-page')}}" class="btn menu_btn active" >Withdraw</a>
              </div>
            </div>
              <div class="withdraw_content">
                  <div class="two_desc">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14px" height="12px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>
                    <div>
                        You have to turn on 2-Factor Authentication in order to make any withdrawals. 
                        <a href="#">
                            Turn on 2-Factor Authentication now.
                        </a> 
                    </div>
                  </div>
                  <div class="content_title">IMPORTANT NOTICE</div>
                  <div>
                      <div class="d-flex w-75 notice_item">
                        <div class="left_side">Minimum withdrawal amount(including fees)</div>
                        <div class="right_side">USDT</div>
                      </div>
                      <div class="d-flex w-75 notice_item">
                          <div class="left_side">Withdraw fee</div>
                          <div class="right_side">USDT + 0.1% of withdraw amount</div>
                      </div>
                      <div class="d-flex w-75 notice_item">
                          <div class="left_side">Available amount for withdrawal(including fees)</div>
                          <div class="right_side">USDT</div>
                      </div>
                  </div>
                  <div class="form-group mt-2 ">
                    <div class="content_title">NETWORK</div>
                    <select class="form-control network_select">
                      <option>--Select Network--</option>
                      <option>Ethereum(ERC20)</option>
                      <option>Tron(TRC20)</option>
                      <option>BNB Smart Chain(BEP20)</option>
                    </select>
                  </div>
                  <div class="important_notice">
                      Please note that you do not mistake the network, if you deposit via another network  your assets may be lost.
                  </div>
                  <div class="content_title mt-2">AMOUNT</div>
                  <input type="text" class="amount_input" placeholder="0.00" />
                  <div class="content_title mt-2">TETHER USD ADDRESS</div>
                  <input type="text" class="address_input " placeholder="ENTERE TETHER USD ADDRESS" />
                  <div class="content_title mt-2">2-FA code(from Google 2-Factor Authenticator app)</div>
                  <input type="text" class="address_input " placeholder="ENTERE 2-FA code(for https://dashboard.ultimopay.io)" />
              
                  <div class="mt-2">
                    <button class="btn content_btn">WITHDRAW</button>
                  </div>
              </div>
        @endif
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
        <script src="{{ asset(mix('js/scripts/ui/data-list-view.js')) }}"></script>
@endsection
