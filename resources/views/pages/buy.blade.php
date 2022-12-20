
@extends('layouts/contentLayoutMaster')

@section('title', 'Payment.Ultimopay')

@section('vendor-style')
        {{-- vendor files --}}
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/datatables.min.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/extensions/dataTables.checkboxes.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.css')) }}">
@endsection
@section('page-style')
        {{-- Page css files --}}
        {{-- <link rel="stylesheet" href="{{ asset(mix('css/pages/data-list-view.css')) }}"> --}}
        <link rel="stylesheet" href="{{ asset('css/plugins/extensions/toastr.css') }}">
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
    padding: 10px 25px 25px 25px;
   }
   .content_title {
    text-align: left;
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
     /* border-right: 1px solid rgb(119, 117, 117); */
     
   }
   .right_side {
     width: 40%;
     padding: 5px;
     padding-left: 20px;
   }
   .notice_item {
    font-size: .9rem;
    margin: auto;
    /* border-bottom: 1px solid rgb(119, 117, 117); */
   }
   .form-control:focus {
    border: 1px solid rgb(250, 200, 10);
   }
   .coin_icon {
    width: 50px;
    height: 50px;
    margin-right: 10px;
   }
   .card_icon{
    width: 66px;
    height: 40px;
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
    margin-bottom: 15px;
    display: flex;
   }
   .buy-input {
    display: flex;
    position: relative;
   }
   .buy-input img {
    position: absolute;
    right: 0;
    top: 10px;
    width: 25px;
    height: 25px;
   }
   .error {
        font-size: 1.5rem;
        text-align: center;
        margin: 20px;
   }
   .buy_success_desc {
      font-size: 22px;
      text-align: center;
      display: block;
      margin-bottom: 20px;
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
                  <p id="balance" class="text-left" style="display: none">  {{$balance}} 
                  </p>
                  <p class="text-left" style="font-weight:300; font-size:25px"> USDT</p>
                </div>
              <div class="d-flex menu">
                          <a href="{{url('deposit-page')}}" class="btn menu_btn " >Deposit</a>
                          <a href="{{url('withdraw-page')}}" class="btn menu_btn " >Withdraw</a>
                          <a href="{{url('buy-page')}}" class="btn menu_btn active" >Buy with card</a>
              </div>
            </div>
              <div class="withdraw_content">
                  @if(isset($paymentConfirm))
                  <div class="buy_success_desc" >
                        {!! $paymentConfirm !!}
                  </div>  
                  @endif
                  <div class="two_desc">
                    <div>
                        You can buy USDT with Credit Card or Debit card. The card brands that can be used are MasterCard and UnionPay.
                        <br/>You will receive it instantly in your USDT wallet in your account.
                    </div>
                   
                  </div>
                  <div class="d-flex justify-content-start">
                      <a href="/transaction-history">Order History</a>
                  </div>
                  <div class="w-75 m-auto text-center">
                    <div class="content_title mt-2">YOU SPEND</div>
                    <div class="buy-input">
                      <input type="text" class="amount_input" id="spend_amount" placeholder="0.000000" />
                      <img alt="Icon" class="coin_icon"src="images/logo/usd.svg"/>  
                    </div>
                    <div class="content_title mt-2">YOU RECEIVE</div>
                    <div class="buy-input">
                      <input type="text" class="amount_input" id="receive_amount" placeholder="0.000000" />
                      <img alt="Icon" class="coin_icon"src="images/logo/usdt.png"/>
                    </div>
                    
                    <div class="mt-2">
                      <button class="btn content_btn" type="button" disabled  id="buy-processing" style="display: none">
                        <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                        Processing...
                      </button>
                      <button class="btn content_btn" id="buy-with-card-btn" >Buy with card</button>
                    </div>
                    <div class="mt-2 ">
                      <img alt="Icon" class="card_icon"src="images/logo/mastercard.png"/>
                      <img alt="Icon" class="card_icon"src="images/logo/unionpay.png"/>
                    </div>
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
        <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
@endsection
@section('page-script')
        <script> 
            let base_url = '<?php echo url(""); ?>'
            let balance = '<?php echo isset($balance) ?  $balance : 0 ?>'
        </script>
        {{-- Page js files --}}
        <script src="{{ asset('js/scripts/ui/buy.js') }}"></script>
@endsection
