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
  $(".amount_input").change(e => {
    let withdraw_fee = 5 + parseFloat($(".amount_input").val()) * 5 / 100;
    $("#withdraw_fee").html(Math.ceil(withdraw_fee * 100) / 100 + "&#8202;USDT");
  });
  $(".amount_input").keypress(e => {
      console.log(e.key)
      if (/^[\d+\.]$/.test(e.key)){
      let withdraw_fee = 5 + parseFloat($(".amount_input").val() + e.key) * 5 / 100;
    $("#withdraw_fee").html(Math.ceil(withdraw_fee * 100) / 100 + "&#8202;USDT");
    } else {
      e.preventDefault();

    }

  })
})
