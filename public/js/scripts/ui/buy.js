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
<<<<<<< HEAD
      let currency = "USDT";
      $.post(`/buy-with-card`, { amount, currency }, (res) => {
        if(res === "failed"){
          alert("failed");
        } else {
          console.log(res);
          // window.location.href = res;
=======
      $.post(`/buy-with-card`, { amount }, (res) => {
        console.log(res);
        if(res === "failed"){
          alert("failed");
        } else {
          window.location.href = res;
>>>>>>> 8c160274f5950eb7c04dfadf6692324bb3b7798a
        }
      })    
  })
})
