/*=========================================================================================
    File Name: data-list-view.js
    Description: List View
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/
  // On Edit
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
$(document).ready(function() {
  "use strict"
  let originVal_spend = 0;
  let originVal = 0;
  $("#buy-processing").hide();
  $("#balance").html(limitDecimal($("#balance").text(), 6));
  $("#balance").show();

  $("#spend_amount").on('keyup', function(e) {
    if ($("#spend_amount").val() === "") {
      $("#receive_amount").val("");
    } else {
      if(parseFloat($("#spend_amount").val()) > 5000){
        $("#spend_amount").val(originVal_spend);
        toastr.warning("Please input value under 5000!", 'Buy', { positionClass: 'toast-top-center', containerId: 'toast-top-center' });
        return;
      }
      let receive_amount = parseFloat($("#spend_amount").val()) * 0.95;
      $("#receive_amount").val(limitDecimal(receive_amount, 6));
    }
  })
  $("#spend_amount").on('keydown', function(e) {
     if (/^[\d+\.]$/.test(e.key) || e.key === "Backspace" || e.key === "Delete"|| e.key === "ArrowLeft"|| e.key === "ArrowRight"){
      originVal_spend = $("#spend_amount").val();
    }
    else {
      e.preventDefault();
    }

  })
  $("#receive_amount").on('keyup', function(e) {
    if ($("#receive_amount").val() === "") {
      $("#spend_amount").val("");
    } else {
     
      let receive_amount = parseFloat($("#receive_amount").val()) / 0.95;
      $("#spend_amount").val(limitDecimal(Math.ceil(receive_amount * 1000000) / 1000000, 6));
      if(parseFloat($("#spend_amount").val()) > 5000){
        $("#receive_amount").val(originVal);
        $("#spend_amount").val(originVal_spend);
        toastr.warning("Please input value under 5000!", 'Buy', { positionClass: 'toast-top-center', containerId: 'toast-top-center' });
        return;
      }
    }
  })
  $("#receive_amount").on('keydown', function(e) {
    if (/^[\d+\.]$/.test(e.key) || e.key === "Backspace" || e.key === "Delete"|| e.key === "ArrowLeft"|| e.key === "ArrowRight"){
      originVal = $("#receive_amount").val();
      originVal_spend = $("#spend_amount").val();
    }
    else {
      e.preventDefault();
    }
  })
  $("#buy-with-card-btn").on("click", function (e) {
      let amount = $("#spend_amount").val();
      let currency = "USDT";
      if (amount === "" || amount === "0") {
        toastr.warning('Input a correct amount!', 'Buy', { positionClass: 'toast-top-center', containerId: 'toast-top-center' });
        return;
      }
      $("#buy-with-card-btn").hide();
      $("#buy-processing").show();
      $.post(`/buy-with-card`, { amount, currency }, (res) => {
        $("#buy-with-card-btn").show();
        $("#buy-processing").hide();
        if(res.status === "success"){
          let result = JSON.parse(res.data);
          let url = (result.response.Data.paymentPage.paymentPageURL);
          window.location.href = url;
        } else {
          toastr.error(res.message, 'Buy', { positionClass: 'toast-top-center', containerId: 'toast-top-center' });
        }
      })
  })
})
