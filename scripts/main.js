$(function () {

  // variable For the feature number available in the hotel
  let HotelFeatureId = 0,
    Id = 0, // For One Edit
    i = 0; // counter for create new elements for flat page

  // coll function
  DisplayData();

  // Page LogIn Move Image To The Left
  if (document.querySelector('#LogIn')) 
  {
    $('.navbar .navbar-brand').addClass('ImgLogIn');
  }

  // Scroll Top
  var scrollButton = $("#scroll-top");
  $(window).scroll(function () 
  {
    $(this).scrollTop() >= 400 ? scrollButton.show() : scrollButton.hide();
  });
  scrollButton.click(function () 
  {
    $("html,body").animate({ scrollTop: 0 }, 600);
  });

  // Useing ToolTip 
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) 
  {
    return new bootstrap.Tooltip(tooltipTriggerEl)
  });

  // Useing Popover
  var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
  var popoverList = popoverTriggerList.map(function (popoverTriggerEl) 
  {
    return new bootstrap.Popover(popoverTriggerEl)
  })

  // Remove Class Active Form Navlinks
  $(".navbar ul li").click(function () 
  {
    $(this).addClass("active").siblings().removeClass("active");
  });

  // Hide placeholder On Focus & Restore On Blur
  var placeAttr = "";
  $("[placeholder]")
    .focus(function () 
    {
      placeAttr = $(this).attr("placeholder");
      $(this).attr("placeholder", "");
    })
    .blur(function () 
    {
      $(this).attr("placeholder", placeAttr);
    });

  // Design Modal Add Blur
  $('.modal').on('show.bs.modal', function()
  {
    if (!$(this).parent().is('body')) 
    {
      $(this).appendTo('body');
    }
    $('body').children().not(this).addClass('blur');
  }).on('hide.bs.modal', function()
  {
    $('body').children().not(this).removeClass('blur');
  });

  /*
  *************************************************
  ******************Settings Page*********************
  *************************************************
  */
  // Page Color
  $('#PageColor').on('input change', function ()
  {
    $(':root').css('--color-BackgroundBody', $(this).val());
    if ($('#PageColor').val() >= '#242424') 
    {
      $(':root').css('--color-SecondaryText', 'black');
    } else 
    {
      $(':root').css('--color-SecondaryText', 'white');
    }
  });
  // Element Color
  $('#ElementColor').on('input change', function ()
  {
    $(':root').css('--color-BackgroundElement', $(this).val());
  });
  // Text Primary Color
  $('#TextPrimaryColor').on('input change', function ()
  {
    $(':root').css('--color-PrimaryText', $(this).val());
  });
  // Text Secondary Color
  $('#TextSecondaryColor').on('input change', function ()
  {
    $(':root').css('--color-SecondaryText', $(this).val());
  });
  // Input BoxShadow Color
  $('#InputBoxShadowColor').on('input change', function ()
  {
    $(':root').css('--color-InputBoxShadowSelect', $(this).val());
  });

  /*
  *************************************************
  ******************Flats Page*********************
  *************************************************
  */
  // Design Form Add Flat
  $('#collapseRoom').on('click', '.row #ButtonAddRoom', function()
  {
    let select = $('#DetailsRoom' + i).children();
    $('#collapseRoom .accordion-body').append(CreateRow(select, ++i, 'Room'));
    if (select.length - 1 == i) 
    {
      $('#ButtonAddRoom').remove();
    }
  });

  /*
  **************************************
  ************Features Page*************
  **************************************
  */
  // One Modal For Delete Any Feature Through Add Attribute data-id In Oreder To Know Which Feature Was Selected
  $('.table-customize-feature').on('click', 'tr td .DeleteAnyFeature', function()
  {
    HotelFeatureId = $(this).parent().siblings().first().text();
  });

  // design Edit Features
  $('.table-customize-feature').on('click', 'tr td .EditAnyFeature', function()
  {
    HotelFeatureId = $(this).parent().siblings().first().text();
    $('#FeatureName').attr('disabled', 'disabled').val(($(this).parent().siblings().first().next().text() == Word.Room ? 1 : ($(this).parent().siblings().first().next().text() == Word.Bath ? 2 : ($(this).parent().siblings().first().next().text() == Word.Bed ? 3 : ($(this).parent().siblings().first().next().text() == Word.TV ? 4 : ($(this).parent().siblings().first().next().text() == Word.AC ? 5 : ($(this).parent().siblings().first().next().text() == Word.Stove ? 6 : ($(this).parent().siblings().first().next().text() == Word.Oven ? 7 : ($(this).parent().siblings().first().next().text() == Word.Fridge ? 8 : ($(this).parent().siblings().first().next().text() == Word.Laundry ? 9 : 10)))))))))).change();
    Id = $('#FeatureName').val();
    $('#Price').val($(this).parent().siblings().last().prev().text());
    $('#Details').val($(this).parent().siblings().last().prev().prev().text());
    $('#HeaderAddEditFeature').html(Word.EditFeature);
    $('#ButtonAddFeature').text(Word.Save).attr('id', 'ButtonEditFeature');
  });

  // design Add Features
  $('#ButtonFormFeature').on('click', function()
  {
    $('#FeatureName').removeAttr('disabled').val('1').change();
    $('#Price').val('');
    $('#Details').val('');
    $('#HeaderAddEditFeature').html(Word.NewFeature);
    $('#ButtonEditFeature').html(Word.Add).attr('id', 'ButtonAddFeature');
  });

  /*
  ******************************************
  *************Employees Page***************
  ******************************************
  */
  // design Edit Employee
  $('.responseEmployees').on('click', 'tr td .EditAnyEmployee', function()
  {
    Id = $(this).parent().siblings().first().text();
    $('#UserName').val($(this).parent().siblings().first().next().text());
    $('#Password').removeAttr('required');
    $('#Password').val('');
    $('#HeaderAddEditEmployees').html(Word.EditEmployee);
    $('#ButtonAddEmployees').text(Word.Save).attr('id', 'ButtonEditEmployee');
  });

  // design Add Employee
  $('#ButtonFormEmployees').on('click', function()
  {
    $('#UserName').val('');
    $('#Password').val('');
    $('#Password').attr( 'required', 'required');
    $('#HeaderAddEditEmployees').html(Word.NewEmployee);
    $('#ButtonEditEmployee').html(Word.Add).attr('id', 'ButtonAddEmployees');
  });

  /*
  ******************************************
  **********Request To The Server***********
  ******************************************
  */
  function SendRequest(type, data, dataType = "html") 
  {
    var request = $.ajax(
    {
      method: type,
      url: "/Daarna-Hotel/global/DBOperations.php",
      data: data,
      contentType: false,
      processData: false,
      dataType: dataType,
      Cache: false,
      error: function (xhr, status, error) {
        alert(error);
      },
    });
    return request;
  }

  /*
  *********************************************
  ***************Page LogIn********************
  *********************************************
  */
  // Check If User Coming From HTTP Post Request
  $('#Formlogin').submit(function (e) 
  { 
    e.preventDefault();
    if (document.querySelector('.pageLogin .container .alert')) 
    {
      $('.pageLogin .container .alert').remove();
    }
    var data = new FormData($(this)[0]);
    data.append("LogIn", "");
    var response = SendRequest("POST", data);
    response.done(function (msg) 
    {
      if (msg == 'admin' || msg == 'reception' || msg == 'client') 
      {
        window.location = '/Daarna-Hotel/cpanel/' + msg + '/index.php';
      }
      else
      {
        $(".pageLogin .container").append(msg);
      }
    });
  });

  /*
  *******************************************
  ***************Display*********************
  *******************************************
  */
  // Request Display
  function DisplayData() 
  {
    /************Show All Floors**************/
    if (document.querySelector('#Floors')) 
    {
      var data = new FormData();
      data.append('ShowFloor', '');
      response = SendRequest("POST", data);
      response.done(function (msg) 
      {
        $(".responseFloor").html(msg);
        if ($(".noFloor").parent().is(".responseFloor")) 
        {
          $(".ButtonRemoveFloor").prop("disabled", true);
        } 
        else 
        {
          $(".ButtonRemoveFloor").prop("disabled", false);
        }
      });
    }
    /************Show All Flats**************/
    else if (document.querySelector('#Flats')) 
    {
      var data = new FormData();
      data.append('ShowFlat', '');
      response = SendRequest("POST", data);
      response.done(function (msg) 
      {
        $(".responseFlat").html(msg);
      });
      
    }
    /************Show All Features**************/
    else if (document.querySelector('#Features')) 
    {
      var data = new FormData();
      data.append("ShowFeature", "");
      var response = SendRequest("POST", data, "json");
      response.done(function (msg)
      {
        data = '';
        if (msg.length > 0) 
        {
          $.each(msg, function (indexInArray) 
          { 
              data += '<tr><td>'+ msg[indexInArray].Id +
              '</td><td>' + (msg[indexInArray].FeatureId == 1 ? Word.Room : (msg[indexInArray].FeatureId == 2 ? Word.Bath : (msg[indexInArray].FeatureId == 3 ? Word.Bed : (msg[indexInArray].FeatureId == 4 ? Word.TV : (msg[indexInArray].FeatureId == 5 ? Word.AC : (msg[indexInArray].FeatureId == 6 ? Word.Stove : (msg[indexInArray].FeatureId == 7 ? Word.Oven : (msg[indexInArray].FeatureId == 8 ? Word.Fridge : (msg[indexInArray].FeatureId == 9 ? Word.Laundry : Word.Cooler))))))))) + 
              '</td><td>' + msg[indexInArray].Details +
              '</td><td>' + msg[indexInArray].Price +
              '</td><td>' + msg[indexInArray].UserName +
              '</td><td><a class="DeleteAnyFeature text-danger me-4" role="botton" data-bs-toggle="modal" data-bs-target="#confirmTheDelete" aria-label="' + Word.Delete + '" data-balloon-nofocus data-balloon-pos="up"><i class="fas fa-trash-alt fs-6"></i></a>' +
              '<a class="EditAnyFeature text-success" role="botton" data-bs-toggle="modal" data-bs-target="#comfirmAddAndEditFeature" aria-label="' + Word.Edit + '" data-balloon-nofocus data-balloon-pos="down"><i class="fas fa-edit fs-6"></i></a></td></tr>'
            });
          }
          $('.table-customize-feature .container').append(
            '<div class="table-responsive overflow-visible">' +
              '<table class="table table-hover table-bordered table-striped text-center" id="table">' +
                '<thead>' +
                  '<tr>' +
                    '<th scope="col">' + Word.FeatureId + '</th>' +
                    '<th scope="col">' + Word.FeatureName + '</th>' +
                    '<th scope="col">' + Word.Details + '</th>' +
                    '<th scope="col">' + Word.Price + '</th>' +
                    '<th scope="col">' + Word.AddedBy + '</th>' +
                    '<th scope="col">' + Word.Processes +'</th>' +
                  '</tr>' +
                '</thead>' +
                '<tbody class="responseFeature align-middle">' + data +'</tbody>' +
              '</table>' +
            '</div>'
          )
          runTable();
      });
    }
    /************Show All Employees**************/
    else if (document.querySelector('#Employees')) 
    {
      var data = new FormData();
      data.append("ShowEmployees", "");
      var response = SendRequest("POST", data, "json");
      response.done(function (msg)
      {
        if (msg.length > 0) 
        {
          buttons = '<a class="BlockAnyEmployee text-danger me-4" role="botton" data-bs-toggle="modal" data-bs-target="#confirmTheBlock" aria-label="' + Word.Block + '" data-balloon-nofocus data-balloon-pos="up"><i class="fa-solid fa-user-lock"></i></a><a class="EditAnyEmployee text-success" role="botton" data-bs-toggle="modal" data-bs-target="#comfirmAddAndEditEmployees" aria-label="' + Word.Edit + '" data-balloon-nofocus data-balloon-pos="down"><i class="fas fa-edit fs-6"></i></a>';
          $.each(msg, function (indexInArray) 
          {
            $('.responseEmployees').append(
            '<tr><td>' + msg[indexInArray].EmpId +
            '</td><td>' + msg[indexInArray].UserName +
            '</td><td>' + msg[indexInArray].AddedBy +
            '</td><td>' + buttons + '</td></tr>');
          });
        }
        else
        {
          $('.responseEmployees').append('<tr><td class="text-center" colspan="4">' + Word.ThereAreNoEmployeesToDisplay + '</td></tr>')
        }
      });
    }
    /************New Flat**************/
    // Request Get Primary Feature
    else if (document.querySelector('#NewFlat'))
    {
      var data = new FormData();
      data.append('GetPrimaryFeature', '');
      response = SendRequest("POST", data, "json");
      response.done(function (msg) 
      {

        if (msg.Room && msg.Bath && msg.Bed) 
        {
          $('#collapseRoom .accordion-body').append(CreateRow(msg.Room, 0, 'Room'));
          $('#collapseBath .accordion-body').append(CreateRow(msg.Bath, 0, 'Bath'));
          $('#collapseBed .accordion-body').append(CreateRow(msg.Bed, 0, 'Bed'));
          CreateOption(msg.Room, $('#DetailsRoom0'));
          CreateOption(msg.Bath, $('#DetailsBath0'));
          CreateOption(msg.Bed, $('#DetailsBed0'));
        }
        else 
        {
          $('#NotFeatureInFlat').modal('show');
        }
      });
    }
    /************Show All Services**************/
    else if (document.querySelector('#Services')) 
    {
      var data = new FormData();
      data.append("ShowServices", "");
      // var response = SendRequest("POST", data, "json");
      // response.done(function (msg){

      // });
    };
  }

  function CreateOption(array, select)
  {
    $.each(array, function (item) { 
      let opt = document.createElement('option');
      opt.innerHTML = array[item].Details;
      opt.value = array[item].Id;
      select.append(opt);
    });
  }

  function CreateRow(array, i, Type)
  { 
    return '<div class="row">' +
    '<div class="col-4">' +
      '<label for="Details' + Type + i + '" class="form-label">' + Word.Details + '</label>' +
      '<select class="form-select" name="Details' + Type + i + '" id="Details' + Type + i + '" required>' +

      '</select>' +
    '</div>' +
    '<div class="col-4">' +
      '<label for="Quantity' + Type + i + '" class="form-label">' + Word.Quantity + '</label>' +
      '<input type="number" name="Quantity' + Type + i + '" class="form-control" id="Quantity' + Type + i + '" min="1" value="1" autocomplete="off" required>' +
    '</div>' +
    (array.length > 1 && i == 0 ?
    '<div class="col-4">' +
      '<button type="button" class="btn btn-success rounded-circle mt-4 hvr-grow shadow-none" id="ButtonAddRoom" data-balloon-nofocus data-balloon-pos="up" aria-label="' + Word.Add + '">' +
        '<i class="fas fa-plus"></i>' +
      '</button>' +
    '</div>' : (array.length > 1 && i > 0 ?
      '<div class="col-4">' +
        '<button type="button" class="btn btn-danger rounded-circle mt-4 hvr-grow shadow-none" id="ButtonRemoveRoom" data-balloon-nofocus data-balloon-pos="up" aria-label="' + Word.Remove + '">' +
          '<i class="fas fa-minus"></i>' +
        '</button>' +
      '</div>' : ''));
  }

  /*
  ****************************************
  **************Requests******************
  ****************************************
  */
  // Request Add Floor
  $("#ButtonAddFloor").on("click", function () 
  {
    var data = new FormData();
    data.append('AddFloor', '');
    data.append('FloorId', $(".FloorsId").last().children().html());
    response = SendRequest("POST", data);
    response.done(function (msg) 
    {
      DisplayData();
    });
  });

  // Request Remove Floor
  $("#ButtonRemoveFloor").on("click", function () 
  {
    var data = new FormData();
    data.append('RemoveFloor', '');
    data.append('FloorId', $(".FloorsId").last().children().html()); 
    response = SendRequest("POST", data);
    response.done(function (msg) 
    {
      DisplayData();
    });
  });

  // Request Add Flat To The Floor
  $("#FormNewFlat").submit(function (e) 
  {
    // Stop form from submitting normally
    e.preventDefault();
    // Create an FormData object
    var data = new FormData($(this)[0]);
    data.append("AddFlat", "");
    data.append("FloorId", $(".FloorId").text().split(" ", 3)[2]);
    var response = SendRequest("POST", data);
    response.done(function (msg) 
    {
      console.log(msg);
    });
  });

  // Request Remove Flat To The Floor

  // Request Add And Edit Feature
  $('#FormNewFeature').submit(function(e)
  {
    e.preventDefault();
    var data = new FormData($(this)[0]);
    if ($(this).find("button").is('#ButtonAddFeature')) 
    {
      data.append("AddFeature", "");
    }
    else 
    {
      data.append("EditFeature", "");
      data.append("FeatureId", Id);
      data.append("Id", HotelFeatureId);
    }
    var response = SendRequest("POST", data);
    response.done(function (msg)
    {
      $('#comfirmAddAndEditFeature').find('.alert').remove();
      if (msg) 
      {
        $('.table-customize-feature .container').children().last().remove();
        $('#comfirmAddAndEditFeature').modal('hide');
        DisplayData();
      }
      else 
      {
        $('<div class="alert alert-danger d-flex align-items-center alert-dismissible w-100 border-danger bg-black text-light" role="alert"><i class="fa-solid fa-ban text-danger mx-2 fs-4"></i><div>' + Word.ThisFeatureIsExsist + '</div></div>').insertBefore('#AddEditFeatureTemplate')
      }
    });
  });

  // Request Remove Feature
  $('#ButtonRemoveFeature').on('click', function()
  {
    var data = new FormData();
    data.append("RemoveFeature", "");
    data.append("Id", HotelFeatureId);
    var response = SendRequest("POST", data);
    response.done(function (msg)
    {
      $('#confirmTheDelete').find('.alert').remove();
      if (msg) 
      {
        $('.table-customize-feature .container').children().last().remove();
        $('#confirmTheDelete').modal('hide');
        DisplayData();
      }
      else
      {
        $('<div class="alert alert-danger d-flex align-items-center alert-dismissible w-100 border-danger bg-black text-light" role="alert"><i class="fa-solid fa-ban text-danger mx-2 fs-4"></i><div>' + Word.TheFeatureUsedInTheFlatCannotBeDeleted + '</div></div>').insertBefore('#DeleteFeatureTemplate');
      }
    });
  });

  // Request Add And Edit Employees
  $('#FormNewEmployees').submit(function(e)
  {
    e.preventDefault();
    var data = new FormData($(this)[0]);
    if ($(this).find("button").is('#ButtonAddEmployees')) 
    {
      data.append("AddEmployees", "");
    }
    else 
    {
      data.append("EditEmployees", "");
      data.append("EmpId", Id);
    }
    var response = SendRequest("POST", data);
    response.done(function (msg)
    {
      $('#comfirmAddAndEditEmployees').find('.alert').remove();
      if (msg) 
      {
        $('.responseEmployees').children().remove();
        $('#comfirmAddAndEditEmployees').modal('hide');
        DisplayData();
      }
      else 
      {
        $('<div class="alert alert-danger d-flex align-items-center alert-dismissible w-100 border-danger bg-black text-light" role="alert"><i class="fa-solid fa-ban text-danger mx-2 fs-4"></i><div>' + Word.ThisUserNameIsExsist + '</div></div>').insertBefore('#AddEditEmployeesTemplate')
      }
    });
  });

  // Remove Alert Error Message On Close Model Feature
  $('.modal').on('hidden.bs.modal', function()
  {
    $(this).find('.alert').remove();
  });
  
  // Call This Function After Set Data To Each Table
  function runTable () {
    // Style Tables
    $('.table').addClass('table-dark');
    myTable = new JSTable("#table", 
    {
      prevText: "<i class='fa fa-chevron-right'></i>",
      nextText: "<i class='fa fa-chevron-left'></i>",
      labels: {
          placeholder: "ابحث في الجدول ..",
          perPage: `
              اعرض
              <select class="dt-selector"><option value="5" selected="">5</option><option value="10">10</option><option value="15">15</option><option value="20">20</option><option value="25">25</option></select>
              عناصر في كل صفحة
          `,
          noRows: Word.ThereAreNoEmployeesToDisplay,
          info: "يظهر {start} من {end} من أصل {rows} سجلات",
          // loading: "بتم التحميل ...",
          infoFiltered: "يظهر {start} من {end} من أصل {rows} سجلات (تم البحث في {rowsTotal} سجلات)"
      },
    });
  }
});