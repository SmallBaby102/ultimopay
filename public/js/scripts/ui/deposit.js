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
  $(".network_select").change((e) => {
    $("#copy-to-clipboard-input").val("");
    let network = e.target.value;
    if (network === "none") {
      $(".deposit_address").hide();
    } else {
      $.get(`/deposit_address/${network}/${"test"}`, (res) => {
        $("#copy-to-clipboard-input").val(res);
        $("#deposit_address_qrcode").attr("src", `https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl=${res}`);
        $(".deposit_address").show();
      })
      
    }
  });
})
