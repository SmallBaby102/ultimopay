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
  $("#btn-enable").click((e) => {
      let code = $("#code").val();
      let password = $("#password").val();
      if($("#btn-enable").text() === "Enable 2-FA" ){
          $("#btn-enable").text("Loading");
          $.post(`/set-2Fa`, { code, password }, (res) => {
            console.log(res);
            if(res === "success"){
              $("#btn-enable").text("Disable 2-FA"); 
            } else {
                $("#btn-enable").text("Enable 2-FA");
                alert("failed");
            }
          })
      } else {
          $("#btn-enable").text("Loading");
          $.post(`/disable-2Fa`, { code, password }, (res) => {
            console.log(res);
            if(res === "success"){
              $("#btn-enable").text("Enable 2-FA"); 
            } else {
              $("#btn-enable").text("Disable 2-FA"); 
              alert("failed");
            }
          })    
      }

     
  });
})
