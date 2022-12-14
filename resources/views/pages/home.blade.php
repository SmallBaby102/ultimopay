
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
  
   .header {
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
    justify-content: end;
   }
   .content {
    margin-left: 0 !important;
   }
   .menu_btn {
    width: 100px;
    padding: 10px;
    background-color: rgb(250, 200, 10);
    font-weight: 700;
    margin-left: 10px;
    border-radius: 25px;
    margin-top: 5px;

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
   .coin_name div {
        font-size: 1rem;
   }
   .error {
        font-size: 1.5rem;
        text-align: center;
        margin: 20px;
   }
 </style>
<div class="main header p-1 pt-5">
</div>
@if (isset($error))
    <div class="error">
        {{ $error }}
    </div>
@else
        <div class="row m-2 mt-5 p-1 pl-3 pr-3 justify-content-between" style="background-color: white; color: black">
                <div class="d-flex justify-content-between">
                <div class="d-flex">
                <img src="/images/logo/usdt.png" class="coin_img" alt="">
                <div  class="coin_name ">Tether USD 
                        <div style="margin-left: 2px">USDT</div>
                </div>
                
                </div>
                </div>
                <div class="text-right"> 
                <div id="balance" class="coin_balance text-right" style="display: none"> {{ $balance }} </div>
                <div class="d-flex menu " style="flex-flow: wrap">
                        <a href="{{url('deposit-page')}}" class="btn menu_btn" >Deposit</a>
                        <a href="{{url('withdraw-page')}}" class="btn menu_btn" >Withdraw</a>
                        <a href="{{url('buy-page')}}" class="btn menu_btn" style="width: max-content" >Buy with card</a>
                </div>
                </div>
        
        </div>
@endif
 

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
            let base_url = '<?php echo url(""); ?>';
            function limitDecimal(t, n){
                var s;
                if (t === "" || t === null) {
                t = 0;
                }
                var string = String(t);
                var decimal = "";
                if (string.substr(0, string.indexOf(".")) === -1|| string.substr(0, string.indexOf(".")) === "") {
                for (let index = 0; index < n; index++) {
                        decimal += "0";
                }   
                s = string  + "." +decimal;
                } else {
                decimal = string.substr(string.indexOf("."), n+1);
                let start = decimal.length -1;
                if(start < n){
                        for (let index = start; index < n; index++) {
                        decimal += "0";
                        }
                } else {
                        s = string.substr(0, string.indexOf(".")) + string.substr(string.indexOf("."), n+1);
                        return s;
                }
                
                s = string.substr(0, string.indexOf(".")) +decimal;
                }
                return s;
                }  
            $("#balance").html(limitDecimal($("#balance").text(), 6));
            $("#balance").show();
        </script>
        {{-- Page js files --}}
        <script src="{{ asset('js/scripts/ui/data-list-view.js') }}"></script>
@endsection
