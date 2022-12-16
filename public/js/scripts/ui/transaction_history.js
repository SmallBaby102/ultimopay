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
 
  $("#upload").click((e) => {
    e.preventDefault();
    if($('#csvFile')[0].files[0]){
        // creating FileReader
        var totalAmount = 0;
        var reader = new FileReader();

        // assigning handler
        reader.onloadend = function(evt) {      
            let lines = evt.target.result.split(/\r?\n/);

            lines.forEach(function (line) {
              let itemArray =line.split(/,/);
              if(parseInt(itemArray[1]))
                totalAmount += parseInt(itemArray[1]);
            });
            if(totalAmount > parseInt($("#balance").text())){

              $("#errorBody").text("This agent USDT balance is insufficient.");
              $("#errorDialog").show();
            } else{
              $("#filename").text(file.name);
              $("#totalAmount").text(totalAmount);
              console.log($("#merchant").val())
              var merchant = $("#merchant").val();
              $("#selectedMerchant").text(merchant);
              $("#confirmDialog").show();

            }
        };

        // getting File instance
        var file = $('#csvFile')[0].files[0];

        // start reading
        reader.readAsText(file);


    }
    else 
      alert("Select a csv file");

  });
  $("#uploadConfirm").click(e => {
    let url = base_url + '/upload/csvFile';
    var fd = new FormData();
    var files = $('#csvFile')[0].files[0];
    fd.append('csvFile', files);
    fd.append('merchant', $("#merchant").val());
    $.ajax({
        url: url,
        type: 'POST',
        data: fd,
        cache: false,
        contentType: false,
        processData: false,
        enctype: 'multipart/form-data',
        success: function(response){
            $("#confirmDialog").hide();
            if(response != 0){
                alert('file uploaded');
            }
            else{
                alert('file not uploaded');
            }
        },
    });
  });

  $("#uploadCancel, #csvFile, #closeErrorModal, #closeDetailModal, .close").click(e => {
    $("#confirmDialog").hide();
    $("#errorDialog").hide();
    $("#detailDialog").hide();
  });
  // init list view datatable
  var dataListView = $(".data-list-view").DataTable({
    responsive: false,
    columnDefs: [
      {
        orderable: true,
        targets: 0,
        checkboxes: { selectRow: true }
      }
    ],
    dom:
      '<"top"<"actions action-btns"B><"action-filters"lf>><"clear">rt<"bottom"<"actions">p>',
    oLanguage: {
      sLengthMenu: "_MENU_",
      sSearch: ""
    },
    aLengthMenu: [[4, 10, 15, 20], [4, 10, 15, 20]],
    select: {
      style: "multi"
    },
    order: [[1, "asc"]],
    bInfo: false,
    pageLength: 4,
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

  dataListView.on('draw.dt', function(){
    setTimeout(function(){
      if (navigator.userAgent.indexOf("Mac OS X") != -1) {
        $(".dt-checkboxes-cell input, .dt-checkboxes").addClass("mac-checkbox")
      }
    }, 50);
  });

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

  // mac chrome checkbox fix
  if (navigator.userAgent.indexOf("Mac OS X") != -1) {
    $(".dt-checkboxes-cell input, .dt-checkboxes").addClass("mac-checkbox")
  }
})
