/*=========================================================================================
    File Name: data-list-view.js
    Description: List View
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/
  // On Edit

$(document).ready(function() {
  "use strict"
  let available_amount = (balance - 5) / 1.05;
  $("#available_amount").html(Math.floor(available_amount * 100) / 100 + "&#8202;USDT");

  $("#amount").on('keyup', function(e) {
    if ($("#amount").val() === "") {
      $("#withdraw_fee").val("");
    } else {
      let withdraw_fee = 5 + parseFloat($("#amount").val()) * 5 / 100;
      $("#withdraw_fee").html(Math.ceil(withdraw_fee * 100) / 100 + "&#8202;USDT");
    }
  })
  $("#amount").on('keydown', function(e) {
     if (/^[\d+\.]$/.test(e.key) || e.key === "Backspace" || e.key === "Delete"|| e.key === "ArrowLeft"|| e.key === "ArrowRight"){
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
      $.post(`/withdraw`, { code, password, network, address, amount }, (res) => {
        console.log(res);
        alert(res.result);
      })   
  })
})
