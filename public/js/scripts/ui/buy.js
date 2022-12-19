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

  $("#spend_amount").on('keyup', function(e) {
    if ($("#spend_amount").val() === "") {
      $("#receive_amount").val("");
    } else {
      let receive_amount = parseFloat($("#spend_amount").val()) * 0.95;
      $("#receive_amount").val(Math.floor(receive_amount * 100) / 100);
    }
  })
  $("#spend_amount").on('keydown', function(e) {
     if (/^[\d+\.]$/.test(e.key) || e.key === "Backspace" || e.key === "Delete"|| e.key === "ArrowLeft"|| e.key === "ArrowRight"){
      console.log(e.key);
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
      $("#spend_amount").val(Math.ceil(receive_amount * 100) / 100);
    }
  })
  $("#receive_amount").on('keydown', function(e) {
    if (/^[\d+\.]$/.test(e.key) || e.key === "Backspace" || e.key === "Delete"|| e.key === "ArrowLeft"|| e.key === "ArrowRight"){
      console.log(e.key);
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
      $("#buy-with-card-btn").text("Buying...");
      $.post(`/buy-with-card`, { amount, currency }, (res) => {
        $("#buy-with-card-btn").text("Buy with card");
        console.log("buy", res)
        if(res.status === "success"){
          let result = JSON.parse(res.data);
          let url = (result.data.paymentPage.paymentPageURL);
          window.location.href = url;
        } else {
          toastr.error(res.message, 'Buy', { positionClass: 'toast-top-center', containerId: 'toast-top-center' });
        }
      })
  })
})
