$(function () {
  // variable For the feature number available in the hotel
  var HotelFeatureId = 0,
    Id = 0; // For One Edit

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

  // Flats Page
  // Design Form Add Flat
  $('.ButtonFormAddFlat').on('click', function () 
  {
    response = 2;
    for (let index = 0; index < response.length; index++) 
    {
      console.log(index);
      $('#buttonAddRoom').on('click', function () 
      {
        $('<div class="col-5 mb-2"><label for="Details" class="form-label">' + Word.Details + '</label><select class="form-select" name="Details" id="Details" required><option value="N">' + Word.North + '</option><option value="WN">' + Word.WestNorth + '</option></select></div><div class="col-5 mb-2"><label for="Quantity" class="form-label">' + Word.Quantity + '</label><input type="number" name="Quantity" class="form-control" id="Quantity" min="1" placeholder="1" autocomplete="off" required></div>').insertAfter($(this));
      });
    }
  });

  // Request To The Server
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

   // Request Display
  function DisplayData() 
  {
    // Show All Floors
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
    // Show All Flats
    else if (document.querySelector('#Flats')) 
    {
      var data = new FormData();
      data.append('CheckFeature', '');
      response = SendRequest("POST", data);
      response.done(function (msg) 
      {
        if (msg) 
        {
          var data = new FormData();
          data.append('ShowFlat', '');
          response = SendRequest("POST", data);
          response.done(function (msg) 
          {
            $(".responseFlat").html(msg);
          });
        }
        else
        {
          $('#NotFeatureInFlat').modal('show');
        }
      });
      
    }
    // Show All Features
    else if (document.querySelector('#Features')) 
    {
      var data = new FormData();
      data.append("ShowFeature", "");
      var response = SendRequest("POST", data, "json");
      response.done(function (msg)
      {
        if (msg.length > 0) 
        {
          $.each(msg, function (indexInArray) 
          { 
            $('.responseFeature').append(
              '<tr><td>'+ msg[indexInArray].Id +
              '</td><td>' + (msg[indexInArray].FeatureId == 1 ? Word.Room : (msg[indexInArray].FeatureId == 2 ? Word.Bath : (msg[indexInArray].FeatureId == 3 ? Word.Bed : (msg[indexInArray].FeatureId == 4 ? Word.TV : (msg[indexInArray].FeatureId == 5 ? Word.AC : (msg[indexInArray].FeatureId == 6 ? Word.Stove : (msg[indexInArray].FeatureId == 7 ? Word.Oven : (msg[indexInArray].FeatureId == 8 ? Word.Fridge : (msg[indexInArray].FeatureId == 9 ? Word.Laundry : Word.Cooler))))))))) + 
              '</td><td>' + msg[indexInArray].Details +
              '</td><td>' + msg[indexInArray].Price +
              '</td><td>' + msg[indexInArray].UserName +
              '</td><td><a class="DeleteAnyFeature text-danger me-4" role="botton" data-bs-toggle="modal" data-bs-target="#confirmTheDelete" aria-label="' + Word.Delete + '" data-balloon-nofocus data-balloon-pos="up"><i class="fas fa-trash-alt fs-6"></i></a>' +
              '<a class="EditAnyFeature text-success" role="botton" data-bs-toggle="modal" data-bs-target="#comfirmAddAndEditFeature" aria-label="' + Word.Edit + '" data-balloon-nofocus data-balloon-pos="down"><i class="fas fa-edit fs-6"></i></a></td></tr>')
          });
        }
        else
        {
          $('.responseFeature').append('<tr><td class="text-center" colspan="6">' + Word.ThereAreNoFeaturesToDisplay + '</td></tr>')
        }
      });
    }
    // Show All Employees
    else if (document.querySelector('#Employees')) 
    {
      var data = new FormData();
      data.append("ShowEmployees", "");
      var response = SendRequest("POST", data, "json");
      response.done(function (msg)
      {
        if (msg.length > 0) 
        {
          $.each(msg, function (indexInArray) 
          { 
            $('.responseEmployees').append(
              '<tr><td>' + msg[indexInArray].EmpId +
              '</td><td>' + msg[indexInArray].UserName +
              '</td><td>' + msg[indexInArray].AddedBy +
              '</td><td><a class="BlockAnyEmployee text-danger me-4" role="botton" data-bs-toggle="modal" data-bs-target="#confirmTheBlock" aria-label="' + Word.Block + '" data-balloon-nofocus data-balloon-pos="up"><i class="fa-solid fa-user-lock"></i></a>' +
              '<a class="EditAnyEmployee text-success" role="botton" data-bs-toggle="modal" data-bs-target="#comfirmAddAndEditEmployees" aria-label="' + Word.Edit + '" data-balloon-nofocus data-balloon-pos="down"><i class="fas fa-edit fs-6"></i></a></td></tr>')
          });
        }
        else
        {
          $('.responseEmployees').append('<tr><td class="text-center" colspan="4">' + Word.ThereAreNoEmployeesToDisplay + '</td></tr>')
        }
      });
    }
  }

  // Features Page
  // One Modal For Delete Any Feature Through Add Attribute data-id In Oreder To Know Which Feature Was Selected
  $('.responseFeature').on('click', 'tr td .DeleteAnyFeature', function()
  {
    HotelFeatureId = $(this).parent().siblings().first().text();
  });

  // design Edit Features
  $('.responseFeature').on('click', 'tr td .EditAnyFeature', function()
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

  // Employees Page
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

  // Requests
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
        $('.responseFeature').children().remove();
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
        $('.responseFeature').children().remove();
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
});