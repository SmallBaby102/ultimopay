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
  // init list view datatable
  var dataListView = $(".data-list-view").DataTable({
    responsive: false,
    // columnDefs: [
    //   {
    //     orderable: true,
    //     targets: 0,
    //     checkboxes: { selectRow: true }
    //   }
    // ],
    oLanguage: {
      sLengthMenu: "_MENU_",
      sSearch: ""
    },
    bFilter: false,
    aLengthMenu: [[5, 10, 15, 20], [5, 10, 15, 20]],
    order: [[0, "desc"]],
    bInfo: false,
    pageLength: 5,
    buttons: [
      // {
      //   text: "<i class='feather icon-plus'></i> Add New",
      //   action: function() {
      //     $(this).removeClass("btn-secondary")
      //     $(".add-new-data").addClass("show")
      //     $(".overlay-bg").addClass("show")
      //     $("#data-name, #data-price").val("")
      //     $("#data-category, #data-status").prop("selectedIndex", 0)
      //   },
      //   className: "btn-outline-primary"
      // }
    ],
    initComplete: function(settings, json) {
      $(".dt-buttons .btn").removeClass("btn-secondary")
    }
  });

  // dataListView.on('draw.dt', function(){
  //   setTimeout(function(){
  //     if (navigator.userAgent.indexOf("Mac OS X") != -1) {
  //       $(".dt-checkboxes-cell input, .dt-checkboxes").addClass("mac-checkbox")
  //     }
  //   }, 50);
  // });

  // To append actions dropdown before add new button
  var actionDropdown = $(".actions-dropodown")
  actionDropdown.insertBefore($(".top .actions .dt-buttons"))


  // Scrollbar
  if ($(".data-items").length > 0) {
    new PerfectScrollbar(".data-items", { wheelPropagation: false })
  }

  // Close sidebar
  $(".hide-data-sidebar, .cancel-data-btn, .overlay-bg").on("click", function() {
    $(".add-new-data").removeClass("show")
    $(".overlay-bg").removeClass("show")
    $("#data-name, #data-price").val("")
    $("#data-category, #data-status").prop("selectedIndex", 0)
  })


  // On Delete
  $('.action-delete').on("click", function(e){
    e.stopPropagation();
    $(this).closest('td').parent('tr').fadeOut();
  });

  // dropzone init
  Dropzone.options.dataListUpload = {
    complete: function(files) {
      var _this = this
      // checks files in class dropzone and remove that files
      $(".hide-data-sidebar, .cancel-data-btn, .actions .dt-buttons").on(
        "click",
        function() {
          $(".dropzone")[0].dropzone.files.forEach(function(file) {
            file.previewElement.remove()
          })
          $(".dropzone").removeClass("dz-started")
        }
      )
    }
  }
  Dropzone.options.dataListUpload.complete()

  // // mac chrome checkbox fix
  // if (navigator.userAgent.indexOf("Mac OS X") != -1) {
  //   $(".dt-checkboxes-cell input, .dt-checkboxes").addClass("mac-checkbox")
  // }
})
