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
  $("#balance").html(limitDecimal($("#balance").text(), 6));
  $("#balance").show();

  $(".network_select").change((e) => {
    $("#copy-to-clipboard-input").val("");
    let network = e.target.value;
    if (network === "none") {
      $(".deposit_address").hide();
    } else {
      $.get(`/deposit_address/${network}/${"test"}`, (res) => {
        $("#copy-to-clipboard-input").val(res);
        $("#deposit_address_qrcode").attr("src", `https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl=${"sss"}`);
        $(".deposit_address").show();
      })
      
    }
  });
})
