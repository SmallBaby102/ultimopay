/*=========================================================================================
    File Name: data-list-view.js
    Description: List View
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/
  // On Edit
  function viewDetail(product){
    console.log(product);
    $("#detailModalName").text(product.file_name);
    $("#detailModalSuccessCount").text(product.success);
    $("#detailModalFailCount").text(product.fail);
    let tBody = "";
    product.detail.forEach((element, i) => {
      let index = i+1;
     tBody += `<td></td><td>`
            + index + `  </td><td>`
            + element.user_id + `  </td><td>`
            + element.amount + `  </td><td>`
            + element.result + `  </td>
            <td  class="text-primary text-underline"> <u>Retry</u> </td>`;
    });
   
    $('#file_detail').html(tBody);
    $("#detailDialog").show();
  }

$(document).ready(function() {
  "use strict"
 
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
