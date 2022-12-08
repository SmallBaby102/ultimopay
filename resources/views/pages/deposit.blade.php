
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
    padding: 20px;
    font-size: 1.5rem;
    color: black;
    font-weight: bold;
   }
   .address_input {
    width: 100%;
    border: none;
    border-bottom: 1px solid rgb(250, 200, 10);
    padding: 20px;
    font-size: 1.5rem;
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
   #btn-copy {
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
                        <a href="{{url('deposit-page')}}" class="btn menu_btn active" >Deposit</a>
                        <a href="{{url('withdraw-page')}}" class="btn menu_btn" >Withdraw</a>
                        <a href="{{url('buy-page')}}" class="btn menu_btn" >Buy</a>
            </div>
          </div>
          <div class="deposit_content pl-2 pr-2">
            <div class="form-group mt-2 ">
              <div class="content_title">NETWORK</div>
              <select class="form-control network_select">
                <option value="none">--Select Network--</option>
                <option value="ETHEREUM_ERC20">Ethereum(ERC20)</option>
                <option value="TRON_TRC20">Tron(TRC20)</option>
                <option value="BNB_SMART_CHAIN_BEP20">BNB Smart Chain(BEP20)</option>
              </select>
            </div>
          </div>
          <div class="important_notice pl-2 pr-2">
              Please note that you do not mistake the network, if you deposit via another network  your assets may be lost.
          </div>
          <div class="deposit_address p-2" style="display:none" >
                <div class="row" style="align-items: center">
                  
                  <div class="col-sm-6 text-left">
                    <div class="pr-0 text-left">
                      <div class="form-group">
                        <div class="content_title">DEPOSIT ADDRESS</div>
                        <div class="d-flex">
                          <input type="text" class="form-control" readonly id="copy-to-clipboard-input" value="">
                          <div class="text-center">
                            <button class="btn" id="btn-copy">Copy</button>
                          </div>
        
                        </div>
                      </div>
                    </div>
                  </div>
                  <img alt="Address" id="deposit_address_qrcode" class=""
                    src=""
                  />
                
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
        <script src="{{ asset('js/scripts/ui/deposit.js') }}"></script>
        <script src="{{ asset('js/scripts/extensions/copy-to-clipboard.js') }}"></script>
@endsection
