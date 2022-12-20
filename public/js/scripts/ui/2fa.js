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
          $("#btn-enable").text("Enabling...");
          $.post(`/set-2Fa`, { code, password }, (res) => {
            console.log(res);
            let response = JSON.parse(res);
            if(response.result === "success"){
              $("#btn-enable").text("Disable 2-FA"); 
              toastr.success("Successfully Enabled 2-FA", '2-FA', { positionClass: 'toast-top-center', containerId: 'toast-top-center' });
            } else {
                $("#btn-enable").text("Enable 2-FA");
                if(response.error.errorMessage === "invalid credentials.")
                {
                  toastr.error("Invalid Password", '2-FA', { positionClass: 'toast-top-center', containerId: 'toast-top-center' });
                } else
                  toastr.error(response.error.errorMessage, '2-FA', { positionClass: 'toast-top-center', containerId: 'toast-top-center' });
            }
          })
      } else {
          $("#btn-enable").text("Disabling...");
          $.post(`/disable-2Fa`, { code, password }, (res) => {
            let response = JSON.parse(res);
            console.log(res);
            if(response.result === "success"){
              toastr.success("Successfully Disabled 2-FA", '2-FA', { positionClass: 'toast-top-center', containerId: 'toast-top-center' });
              $("#btn-enable").text("Enable 2-FA"); 
            } else {
                $("#btn-enable").text("Disable 2-FA"); 
                if(response.error.errorMessage === "invalid credentials")
                {
                  toastr.error("Invalid Password", '2-FA', { positionClass: 'toast-top-center', containerId: 'toast-top-center' });
                } else
                  toastr.error(response.error.errorMessage, '2-FA', { positionClass: 'toast-top-center', containerId: 'toast-top-center' });
            }
          })    
      }

     
  });
})
