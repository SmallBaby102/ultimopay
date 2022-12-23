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
  console.log(balance);
  balance = balance.replaceAll("," , "");
  let available_amount = (balance - 5) / 1.05;
  if (available_amount < 0) {
    available_amount = 0;
  }
  let originVal = 0;
  $("#balance").html(limitDecimal($("#balance").text(), 6));
  $("#balance").show();
  $("#available_amount").html(limitDecimal(available_amount, 6) + "&#8202;USDT");
  $("#withdraw-processing").hide();
  
  $("#amount").on('keyup', function(e) {
    if ($("#amount").val() === "") {
    $("#withdraw_fee").html("5&#8202;USDT + 5% of withdraw amount");
    } else {
      if(parseFloat($("#amount").val()) > available_amount ){
        $("#amount").val(originVal);
        toastr.warning("Please input value under the available amount!", 'Withdraw', { positionClass: 'toast-top-center', containerId: 'toast-top-center' });
        return;
      }
      if(!(/^\d+\.?\d{0,6}$/.test( $("#amount").val()))){
        $("#amount").val(originVal);
        toastr.warning("You can't input the value under the decimal 6.", 'Withdraw', { positionClass: 'toast-top-center', containerId: 'toast-top-center' });
        return;
      }
      let withdraw_fee = 5 + parseFloat($("#amount").val()) * 5 / 100;
      $("#withdraw_fee").html(Math.ceil(withdraw_fee * 1000000) / 1000000 + "&#8202;USDT");
    }
  })
  $("#amount").on('keydown', function(e) {
     if (/^[\d+\.]$/.test(e.key) || e.key === "Backspace" || e.key === "Delete"|| e.key === "ArrowLeft"|| e.key === "ArrowRight"){
      originVal = $("#amount").val();
    }
    else {
      e.preventDefault();
    }
  })
  $("#withdraw").on("click", function(e) {
      let network = $("#network").val();
      let amount = $("#amount").val();
      let address = $("#address").val();
      let code = $("#code").val();
      let password = $("#password").val();
      if (network === "none") {
         toastr.warning("Please select a Network!", 'Withdraw', { positionClass: 'toast-top-center', containerId: 'toast-top-center' });
        return;
      }
      if (amount < 100) {
          toastr.warning("Amount must be over 100!", 'Withdraw', { positionClass: 'toast-top-center', containerId: 'toast-top-center' });
          return;
      }
      if (address === "") {
          toastr.warning("Address is required!", 'Withdraw', { positionClass: 'toast-top-center', containerId: 'toast-top-center' });
          return;
      }
      $("#withdraw").hide();
      $("#withdraw-processing").show();
      $.post(`/withdraw`, { code, password, network, address, amount }, (res) => {
        $("#withdraw").show();
        $("#withdraw-processing").hide();
       
          // Position Top Center
        let response = JSON.parse(res);
        if(response.result === "success"){
          toastr.success('Withdraw succeeded.', 'Withdraw', { positionClass: 'toast-top-center', containerId: 'toast-top-center' });
          setTimeout(function (){
            $.get("/balance", (val) => {
              balance = val.replaceAll("," , "");
              let available_amount = (balance - 5) / 1.05;
              if (available_amount < 0) {
                available_amount = 0;
              }
              $("#balance").html(limitDecimal(val, 6));
              $("#available_amount").html(limitDecimal(available_amount , 6) + "&#8202;USDT");

            })
            // window.location.reload();

          }, 3000); 
        }
        else {
          if(response.error.errorMessage === "invalid credentials.")
          {
            toastr.error("Invalid Password!", 'Withdraw', { positionClass: 'toast-top-center', containerId: 'toast-top-center' });
          } else
            toastr.error(response.error.errorMessage, 'Withdraw', { positionClass: 'toast-top-center', containerId: 'toast-top-center' });
        }
      })   
  })
})
