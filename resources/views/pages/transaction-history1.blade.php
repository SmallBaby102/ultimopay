
@extends('layouts/contentLayoutMaster')

@section('title', 'Dashboard')

@section('vendor-style')
        {{-- vendor files --}}
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/datatables.min.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/extensions/dataTables.checkboxes.css')) }}">
@endsection
@section('page-style')
        {{-- Page css files --}}
        <link rel="stylesheet" href="{{ asset('css/pages/data-list-view.css') }}">
@endsection

@section('content')
 <style>
   #DataTables_Table_0_length select{
      width: 50;
      height: 30;
      font-size: 11px;
   }
 </style>
<div class="px-5 mx-5 mt-3">
    <form method="POST" id="uploadForm" action="{{url('upload/csvFile')}}" enctype="multipart/form-data">
       @csrf
        <div class="d-flex justify-content-around">
          <div>
              <p>Agent Balance: </p>
              <p class="mr-auto">Upload Csv file here: </p>
              <p class="mr-auto">Merchant: </p>
          </div>
          <div>
              <div class="d-flex">
                <p class="" id="balance"> {{$balance ? $balance : 0}} </p><span>&nbsp; USDT</span>
              </div>
              <input type="file" name="csvFile" id="csvFile" required class="ml-auto" accept=".csv" />
              <div class="mt-2">
                  <select name="merchant" id="merchant" class="ml-auto">
                    @foreach ($merchants as $merchant)
                      <option value="{{$merchant->merchant}}">{{$merchant->merchant}}</option>
                    @endforeach
                </select>
              </div>
              
          </div>
        </div>
        <div class="d-flex mt-4">
            <button type="submit" id="upload" class="btn btn-primary m-auto float-right btn-inline">Upload</button>
        </div>
    </form>

</div>
  {{-- Data list view starts --}}
  <section id="data-list-view" class="data-list-view-header">
      {{-- DataTable starts --}}
      <div class="table-responsive">
        <table class="table data-list-view">
          <thead>
            <tr>
              <th></th>
              <th>Date</th>
              <th>File Name</th>
              <th>Success</th>
              <th>Fail</th>
              <th>Merchant</th>
              <th>Amount</th>
              <th>Detail</th>
            </tr>
          </thead>
          <tbody>
            @if (isset($products))
              @foreach ($products as $product)
                @if($product["order_status"] === 'delivered')
                  <?php $color = "success" ?>
                @elseif($product["order_status"] === 'pending')
                  <?php $color = "primary" ?>
                @elseif($product["order_status"] === 'on hold')
                  <?php $color = "warning" ?>
                @elseif($product["order_status"] === 'canceled')
                  <?php $color = "danger" ?>
                @endif
                <?php
                  $arr = array('success', 'primary', 'info', 'warning', 'danger');
                ?>

                <tr>
                  <td></td>
                  <td class="product-name">{{ $product["created_at"] }}</td>
                  <td class="product-category">{{ $product["file_name"] }}</td>
                  <td class="product-category">{{ $product["success"] }}</td>
                  <td class="product-price">{{ $product["fail"] }}</td>
                  <td class="product-price">{{ $product["merchant"] }}</td>
                  <td class="product-price">{{ $product["amount"] }}</td>
                  <td class="product-action">
                    <span class="action-edit" onclick="viewDetail({{$product}})"><i class="feather icon-edit"></i></span>
                  </td>
                </tr>
              @endforeach
            @endif
          </tbody>
        </table>
      </div>
      {{-- DataTable ends --}}

  </section>
  {{-- Data list view end --}}
@endsection

<div class="modal text-left" id="confirmDialog" tabindex="-1" role="dialog"
aria-labelledby="myModalLabel130" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
  <div class="modal-content">
    <div class="modal-header bg-info white">
      <h5 class="modal-title" id="myModalLabel130">Confirmation Modal</h5>
      <button type="button" class="close"  id="closeConfirm" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body p-3">
      <div class="d-flex justify-content-around">
        <div>
          <p>File Name: </p>
          <p>Merchant:</p>
          <p>Total Amount of uploaded file: </p>
        </div>
        <div>
            <p id="filename" class=""> </p>
            <p id="selectedMerchant"  class=""></p>
            <div class="d-flex">
              <p id="totalAmount" ></p><span>&nbsp; USDT</span>
            </div>
           
            
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-info" id="uploadConfirm" >Confirm</button>
      <button type="button" class="btn btn-gray" id="uploadCancel" >Cancel</button>
    </div>
  </div>
</div>
</div>
 {{-- Modal --}}
 <div class="modal text-left" id="errorDialog" tabindex="-1" role="dialog"
  aria-labelledby="myModalLabel120" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger white">
        <h5 class="modal-title" id="myModalLabel120">Error</h5>
        <button type="button" class="close"  aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="errorBody">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-gray" id="closeErrorModal" >Close</button>
      </div>
    </div>
  </div>
  </div>
 {{-- Modal --}}
 <div class="modal text-left" id="detailDialog" tabindex="-1" role="dialog"
  aria-labelledby="myModalLabel120" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content" style="max-height: inherit">
      <div class="modal-header bg-info white d-flex justify-content-around">
        <h5 class="modal-title" id="detailModalName"></h5>
        <div class="d-flex">
          <span>Success:  &nbsp;</span>
          <h6 class="modal-title" id="detailModalSuccessCount"></h6>
        </div>
        <div class="d-flex">
          <span>Fail:  &nbsp;</span>
          <h6 class="modal-title" id="detailModalFailCount"></h6>
        </div>
      </div>
      <div class="modal-body" id="detailBody">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th></th>
                <th>Num</th>
                <th>User ID</th>
                <th>Amount</th>
                <th>Result</th>
                <th></th>
              </tr>
            </thead>
            <tbody id="file_detail">
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-gray" id="closeDetailModal" >Close</button>
      </div>
    </div>
  </div>
  </div>
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
        <script src="{{ asset(mix('js/scripts/ui/transaction_history.js')) }}"></script>
@endsection
