
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
    background-color: rgb(250, 200, 10);
    padding: 10px;

   }
   .title {
    font-size: 30px;
    color: black;
    align-items: center;
    font-weight: bold;
    padding: 30px;
   }
   .menu {
    align-items: center;
   }
   .content {
    margin-left: 0 !important;
   }
   .menu_btn {
    width: 100px;
    padding: 10px;
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
 
   .coin_img {
    width: 50px;
    height: 50px;
   }
   .coin_name {
    font-size: 1.4rem;
    align-items: center;
    margin-left: 20px;
   }
   .coin_balance {
    font-size: 1.4rem;
    align-items: center;
   }
 </style>
<div class="main crypto_content p-1 pt-5">
      <div class="row mt-5">
          <div class="col-sm-8 d-flex justify-content-between">
              <div class="d-flex col-sm-6">
                <img src="/images/logo/usdt.png" class="coin_img" alt="">
                <div  class=" d-flex coin_name ">Tether USD</div>
              </div>
              <div id="balance" class="d-flex coin_balance col-sm-6"> 124142354 <span> &nbsp; USDT</span></div>
            </div>
          <div class="col-sm-4 d-flex menu">
                <a href="{{url('deposit-page')}}" class="btn menu_btn" >Deposit</a>
                <a href="{{url('withdraw-page')}}" class="btn menu_btn" >Withdraw</a>
          </div>
    </div>
</div>

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
