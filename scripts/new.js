$(function ()
{
  /*
    **********************************
    ******* Declare Variable *********
    **********************************
  */
  
  let HotelFeatureId = 0,   // variable For the feature number available in the hotel
    Id = 0,  // For One Edit
    FloorId = $(".FloorId").text().split(" ", 3)[2],
    scrollButton = $("#scroll-top"), // Scroll Top
    tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]')), // Useing ToolTip
    popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]')), // Useing Popover
    placeAttr = "", // placeholder For Elements
    TableTheme = 'table-dark', // Theme Table For Setting
    OldTheme = '';
    SiteColors = new Array(),
    Icon = '<i class="fa-solid fa-circle-check fs-5 text-black"></i>', // Check Icon For Theme Table 
    FlatFeatureData = new Array(),
    Features = new Array();
    FeatureType = {'Room': 0, 'Bath': 0, 'Bed': 0},
    FlatsData = new Array(),
    StepDataShow = 2;

/**************************************************************************/

  /*
    **********************************
    ******* Exec On Load Page ********
    **********************************
  */

  /*
    * Cal Function To Display Data
  */
  DisplayData();

  /*
    * Cal Function When Window Scrolling
  */
  $(window).scroll(function () 
  {
    $(this).scrollTop() >= 400 ? scrollButton.show() : scrollButton.hide();
  });
  scrollButton.click(function () 
  {
    $("html,body").animate({ scrollTop: 0 }, 600);
  });

  /*
    * Cal Function To Show Title For Icon
  */
  tooltipTriggerList.map(function (tooltipTriggerEl) 
  {
    return new bootstrap.Tooltip(tooltipTriggerEl)
  });

  /*
    * Cal Function To Show Info About Inputs
  */
  popoverTriggerList.map(function (popoverTriggerEl) 
  {
    return new bootstrap.Popover(popoverTriggerEl)
  })

  /* 
    * Remove Class Active Form Navlinks
  */
  $(".navbar ul li").click(function () 
  {
    $(this).addClass("active").siblings().removeClass("active");
  });

  /* 
    * Hide placeholder On Focus & Restore On Blur
  */
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

  /* 
    * Blur & UnBlur Screen And Remove Error Message On Modal 
  */
  $('.modal').on('show.bs.modal', function()
  {
    if (!$(this).parent().is('body')) 
    {
      $(this).appendTo('body');
    }
    $('body').children().not(this).addClass('blur');
  })
  .on('hide.bs.modal', function()
  {
    $('body').children().not(this).removeClass('blur');
    $(this).find('.alert').remove();
  });

  /**
    * Moving Image For Full Window
  */
  $('.ImageCarousel').height(window.innerHeight - $('.navbar').height());

/*****************************************************************************/

  /*
    **********************************
    ******* Declare Functions ********
    **********************************
  */

  /*
    ******************** Function For Send Request To The Server **********************
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
  };

  /*
    ******************** Function Get Data Of Each Page *************************
  */
  function DisplayData() 
  {
    /*
      ************** Move Image To The Left *************
    */
    if (document.querySelector('#LogIn')) 
    {
      $('.navbar .navbar-brand').addClass('ImgLogIn');
    }
    /*
      ************** Show All Floors ********************
    */
    else if (document.querySelector('#Floors')) 
    {
      var data = new FormData();
      data.append('ShowFloor', '');
      response = SendRequest("POST", data, "json");
      response.done(function (msg) 
      {
        data = '';
        if (msg.length > 0) 
        {
          Id = msg.length;
          $(".ButtonRemoveFloor").prop("disabled", false);
          $.each(msg, function (indexInArray) 
          { 
            data += `<tr><td>${msg[indexInArray].FloorId}
            </td><td>${msg[indexInArray].FlatCount}
            </td><td>${msg[indexInArray].UserName}
            </td><td><a href="?Page=Flats&Id=${msg[indexInArray].FloorId}" class="LinkShowFlats text-info" aria-label="${Word.Show}" data-balloon-pos="up"><i class="far fa-eye fs-5"></i></a></td></tr>`
          });
        }
        else
        {
          $(".ButtonRemoveFloor").prop("disabled", true);
        }
        $('.table-customize-floor .container').append(`
          <div class="table-responsive overflow-visible">
            <table class="table table-hover table-bordered table-striped text-center" id="table">
              <thead>
                <tr>
                  <th scope="col">${Word.FloorId}</th>
                  <th scope="col">${Word.FlatCount}</th>
                  <th scope="col">${Word.AddedBy}</th>
                  <th scope="col">${Word.Show}</th>
                </tr>
              </thead>
              <tbody class="responseFloor align-middle">${data}</tbody>
            </table>
          </div>`
        )
        runTable();
      });
    }
    /*
      ************** Show All Flats ********************
    */
    else if (document.querySelector('#Flats')) 
    {
      var data = new FormData();
      data.append('ShowFlat', '');
      data.append('FloorId', FloorId);
      var response = SendRequest("POST", data, 'json');
      response.done(function (msg) 
      {
        data = '';
        if (msg.length > 0) 
        {
          $.each(msg, function (indexInArray) 
          { 
            data += `<tr><td>${msg[indexInArray].FlatId}
            </td><td>${msg[indexInArray].RoomsCount}
            </td><td>${Word[msg[indexInArray].View]}
            </td><td>${msg[indexInArray].Area}
            </td><td>${msg[indexInArray].UserName}
            </td><td><a class="DeleteAnyFlat text-danger me-3" role="botton" data-bs-toggle="modal" data-bs-target="#confirmTheDelete" aria-label="${Word.Delete}" data-balloon-nofocus data-balloon-pos="up"><i class="fa-solid fa-trash"></i></a><a href="#" class="LinkShowFlat text-info" aria-label="${Word.Show}" data-balloon-pos="up"><i class="far fa-eye fs-5"></i></a></td></tr>`
          });
        }
        $('.table-customize-flat .container').append(`
          <div class="table-responsive overflow-visible">
            <table class="table table-hover table-bordered table-striped text-center" id="table">
              <thead>
                <tr>
                  <th scope="col">${Word.FlatId}</th>
                  <th scope="col">${Word.RoomsCount}</th>
                  <th scope="col">${Word.View}</th>
                  <th scope="col">${Word.FlatArea}</th>
                  <th scope="col">${Word.AddedBy}</th>
                  <th scope="col">${Word.Processes}</th>
                </tr>
              </thead>
              <tbody class="responseFlat align-middle">${data}</tbody>
            </table>
          </div>`
        )
        runTable();
      });
    }
    /*
      ************** Show All Features ******************
    */
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
              data += `<tr><td>${msg[indexInArray].Id}
              </td><td>${(msg[indexInArray].FeatureId == 1 ? Word.Room : (msg[indexInArray].FeatureId == 2 ? Word.Bath : (msg[indexInArray].FeatureId == 3 ? Word.Bed : (msg[indexInArray].FeatureId == 4 ? Word.TV : (msg[indexInArray].FeatureId == 5 ? Word.AC : (msg[indexInArray].FeatureId == 6 ? Word.Stove : (msg[indexInArray].FeatureId == 7 ? Word.Oven : (msg[indexInArray].FeatureId == 8 ? Word.Fridge : (msg[indexInArray].FeatureId == 9 ? Word.Laundry : Word.Cooler)))))))))}
              </td><td>${msg[indexInArray].Details}
              </td><td>${msg[indexInArray].Price}
              </td><td>${msg[indexInArray].UserName}
              </td><td><a class="DeleteAnyFeature text-danger me-4" role="botton" data-bs-toggle="modal" data-bs-target="#confirmTheDelete" aria-label="${Word.Delete}" data-balloon-nofocus data-balloon-pos="up"><i class="fas fa-trash-alt fs-6"></i></a>
              <a class="EditAnyFeature text-success" role="botton" data-bs-toggle="modal" data-bs-target="#comfirmAddAndEditFeature" aria-label="${Word.Edit}" data-balloon-nofocus data-balloon-pos="down"><i class="fas fa-edit fs-6"></i></a></td></tr>`
            });
        }
        $('.table-customize-feature .container').append(`
          <div class="table-responsive overflow-visible">
            <table class="table table-hover table-bordered table-striped text-center" id="table">
              <thead>
                <tr>
                  <th scope="col">${Word.FeatureId}</th>
                  <th scope="col">${Word.FeatureName}</th>
                  <th scope="col">${Word.Details}</th>
                  <th scope="col">${Word.Price}</th>
                  <th scope="col">${Word.AddedBy}</th>
                  <th scope="col">${Word.Processes}</th>
                </tr>
              </thead>
              <tbody class="responseFeature align-middle">${data}</tbody>
            </table>
          </div>`
        )
        runTable();
      });
    }
    /*
      ************** Show All Employees ******************
    */
    else if (document.querySelector('#Employees')) 
    {
      var data = new FormData();
      data.append("ShowEmployees", "");
      var response = SendRequest("POST", data, "json");
      response.done(function (msg)
      {
        data = '';
        if (msg.length > 0) 
        {
          $.each(msg, function (indexInArray) 
          { 
            data += `<tr><td>${msg[indexInArray].EmpId}
            </td><td>${msg[indexInArray].UserName}
            </td><td>${msg[indexInArray].AddedBy}
            </td><td>
            <a class="${msg[indexInArray].Block == 'false' ? 'text-danger BlockAnyEmployee' : 'text-primary UnBlockAnyEmployee' } me-4" role="botton" data-bs-toggle="modal" data-bs-target="#confirmTheBlockEmployees" aria-label="${msg[indexInArray].Block == 'false' ? Word.Block : Word.UnBlock}" data-balloon-nofocus data-balloon-pos="up">
              <i class="fa-solid ${msg[indexInArray].Block == 'false' ? 'fa-user-lock' : 'fa-lock-open'}"></i>
            </a>
            <a class="EditAnyEmployee text-success" role="botton" data-bs-toggle="modal" data-bs-target="#comfirmAddAndEditEmployees" aria-label="${Word.Edit}" data-balloon-nofocus data-balloon-pos="down">
              <i class="fas fa-edit fs-6"></i>
            </a></td></tr>`
          });
        }
        $('.table-customize-employees .container').append(`
          <div class="table-responsive overflow-visible">
            <table class="table table-hover table-bordered table-striped text-center" id="table">
              <thead>
                <tr>
                  <th scope="col">${Word.EmpId}</th>
                  <th scope="col">${Word.UserName}</th>
                  <th scope="col">${Word.AddedBy}</th>
                  <th scope="col">${Word.Processes}</th>
                </tr>
              </thead>
              <tbody class="responseEmployees align-middle">${data}</tbody>
            </table>
          </div>`
        )
        runTable();
      });
    }
    /*
      ************** Get Primary Feature ******************
    */
    else if (document.querySelector('#NewFlat'))
    {
      var data = new FormData();
      data.append('GetFeatures', '');
      response = SendRequest("POST", data, "json");
      response.done(function (msg) 
      {
        if (msg.Room && msg.Bath && msg.Bed) 
        {
          Features = msg;
          CreateFlatFeatureTable();
        }
        else 
        {
          $('#ComfirmNotFeatureInFlat').modal('show');
        }
      });
    }
    /*
      ************** Show All Services ******************
    */
    else if (document.querySelector('#Services')) 
    {
      var data = new FormData();
      data.append("ShowServices", "");
      var response = SendRequest("POST", data, "json");
      response.done(function (msg)
      {
        data = '';
        if (msg.length > 0) 
        {
          $.each(msg, function (indexInArray) 
          { 
            data += `<tr><td>${msg[indexInArray].ServiceId}
            </td><td>${msg[indexInArray].ServiceName}
            </td><td>${msg[indexInArray].UserName}
            </td><td><a class="DeleteAnyServices text-danger" role="botton" data-bs-toggle="modal" data-bs-target="#confirmTheDelete" aria-label="${Word.Delete}" data-balloon-nofocus data-balloon-pos="up"><i class="fa-solid fa-trash"></i></a></td></tr>`
          });
        }
        $('.table-customize-services .container').append(`
          <div class="table-responsive overflow-visible">
            <table class="table table-hover table-bordered table-striped text-center" id="table">
              <thead>
                <tr>
                  <th scope="col">${Word.ServiceId}</th>
                  <th scope="col">${Word.ServiceName}</th>
                  <th scope="col">${Word.AddedBy}</th>
                  <th scope="col">${Word.Processes}</th>
                </tr>
              </thead>
              <tbody class="responseEmployees align-middle">${data}</tbody>
            </table>
          </div>`
        )
        runTable();
      });
    }
    /*
      ************** Select Table Theme ******************
    */
    else if (document.querySelector('#SiteSettings')) 
    {
      OldTheme = TableTheme;
      SiteColors = 
      [
        $(':root').css('--color-BackgroundBody'), 
        $(':root').css('--color-BackgroundElement'), 
        $(':root').css('--color-PrimaryText'),
        $(':root').css('--color-SecondaryText'),
        $(':root').css('--color-InputBoxShadowSelect'),
      ]; 
      $('#PageColor').val(SiteColors[0]);
      $('#ElementColor').val(SiteColors[1]);
      $('#TextPrimaryColor').val(SiteColors[2]);
      $('#TextSecondaryColor').val(SiteColors[3]);
      $('#InputBoxShadowColor').val(SiteColors[4]);
      SelectTableTheme(TableTheme);
    }
    /**
      ************* Show Flats In Home Page ***************
    */
    else if (document.querySelector('#HomePage')) 
    {
      var data = new FormData();
      data.append("GETFlats", "");
      var response = SendRequest("POST", data, "json");
      response.done(function (msg)
      {
        PageCount = Math.ceil(msg.length / StepDataShow),
        FlatsData = msg;
        GetFlats(1)
        for (let index = 1; index <= PageCount; index++) 
        {
          $('.SectionFlatsShow .container').append(`<button class="btn Pagination me-2 ${index == 1 ? `active` : ``} shadow-none rounded-circle">${index}</button>`);
        }
      });
    }
  }

  /*
    ******************** Function Create Flat Card And Put Data Inside It *************************
  */
  function GetFlats(CurrentPage) 
  { 
    $('#FlatsCard').children().remove();
    for (let index = (CurrentPage - 1) * StepDataShow, i = 0; i < StepDataShow && index < FlatsData.length; index++, i++) 
    {
      $('#FlatsCard').append(`
        <div class="col-12 col-md-6">
          <div class="card mb-3" style="max-width: 540px;">
            <div class="row g-0">
              <div class="col-lg-8">
                <img src="photos/${FlatsData[index]['MainImage']}" class="img-fluid rounded-start p-2 h-100" alt="Flat2">
              </div>
              <div class="col-lg-4">
                <div class="card-body p-2 pt-lg-3">
                  <h5 class="card-title">FL ${FlatsData[index]['FloorId']} - Flat ${FlatsData[index]['FlatId']}</h5>
                  <div class=" fs-5 card-text">
                    <div class="row">
                      <div class="col-2 col-lg-2">
                        <i class="fa-solid fa-binoculars"></i>
                      </div>
                      <div class="col-5 col-lg-10">
                        <span>${FlatsData[index]['View']}</span>
                      </div>
                      <div class="col-2 col-lg-2">
                        <i class="fa-solid fa-house"></i>
                      </div>
                      <div class="col-3 col-lg-10">
                        <span>${FlatsData[index]['RoomCount']}</span>
                      </div>
                      <div class="col-2 col-lg-2">
                        <i class="fa-solid fa-bed"></i>
                      </div>
                      <div class="col-5 col-lg-10">
                        <span>${FlatsData[index]['BedCount']}</span>
                      </div>
                      <div class="col-2 col-lg-2">
                        <i class="fa-solid fa-dollar-sign"></i>
                      </div>
                      <div class="col-3 col-lg-10">
                        <span>${FlatsData[index]['Price']}</span>
                      </div>
                      <div class="col-12 mt-2">
                        ${
                          FlatsData[index]['Rate'] != null ?
                          `<i class="fa${FlatsData[index]['Rate'] >= 1 ? ' text-warning' : 'r'} fa-star"></i>
                          <i class="fa${FlatsData[index]['Rate'] >= 2 ? ' text-warning' : 'r'} fa-star"></i>
                          <i class="fa${FlatsData[index]['Rate'] >= 3 ? ' text-warning' : 'r'} fa-star"></i>
                          <i class="fa${FlatsData[index]['Rate'] >= 4 ? ' text-warning' : 'r'} fa-star"></i>
                          <i class="fa${FlatsData[index]['Rate'] == 5 ? ' text-warning' : 'r'} fa-star"></i>
                          <span class="fs-6 d-block">(5/${FlatsData[index]['Rate']})</span>`
                          :
                          `<i class="far fa-star"></i>
                          <i class="far fa-star"></i>
                          <i class="far fa-star"></i>
                          <i class="far fa-star"></i>
                          <i class="far fa-star"></i>
                          <span class="fs-6 d-block">${Word.NotRated}</span>`
                        }
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <a href="#" class="btn hvr-icon-back shadow-none"><i class="fas fa-arrow-circle-left hvr-icon mx-2"></i>${Word.MoreDetails}</a>
            </div>
          </div>
        </div>`
      );
    }
  }

  /*
    ******************** Function For Js Table *************************
  */
  function runTable() 
  {
    // Style Tables
    $('.table').addClass(TableTheme);
    myTable = new JSTable("#table", 
    {
      prevText: "<i class='fa fa-chevron-left'></i>",
      nextText:  "<i class='fa fa-chevron-right'></i>",
      labels: {
          placeholder: Word.Search,
          perPage: Word.Show + `
              <select class="dt-selector"><option value="5" selected="">5</option><option value="10">10</option><option value="15">15</option><option value="20">20</option><option value="25">25</option></select>
          ` + Word.ElemnetsOnEachPage,
          noRows: Word.ThereAreNoResult,
          info: Word.Show + " {start} " + Word.From + " {end} " + Word.OutOf + " {rows} " + Word.Records,
          infoFiltered: Word.Show + " {start} " + Word.From + " {end} " + Word.OutOf + " {rows} " + Word.Records + " ( {rowsTotal} " + Word.Records + " " + Word.Searched + ")"
      },
    });
  }

  /*
    ***************** Function For Theme Table *********************
  */
  function SelectTableTheme(NewTheme)
  { 
    /*
    * NewTheme Is After Edit Theme
    * TableTheme Is Befor Edit Theme
    */
    $('#TableTheme').removeClass(TableTheme).addClass(NewTheme);
    switch (TableTheme) // Remove Icon From Old Theme
    {
      case 'table-dark':
        $('#TableThemeDark').removeAttr('style').children().remove();
        break;
      case 'table-primary':
        $('#TableThemePrimary').removeAttr('style').children().remove();
        break;
      case 'table-secondary':
        $('#TableThemeSecondary').removeAttr('style').children().remove();
        break;
      case 'table-success':
        $('#TableThemeSuccess').removeAttr('style').children().remove();
        break;
      case 'table-danger':
        $('#TableThemeDanger').removeAttr('style').children().remove();
        break;
      case 'table-warning':
        $('#TableThemeWarning').removeAttr('style').children().remove();
        break;
      case 'table-info':
        $('#TableThemeInfo').removeAttr('style').children().remove();
        break;
      case 'table-light':
        $('#TableThemeLight').removeAttr('style').children().remove();
        break;
      default:
        $('#TableThemewhite').removeAttr('style').children().remove();
        break;
    }
    switch (NewTheme) // Add Icon From New Theme
    {
      case 'table-dark':
        $('#TableThemeDark').append(Icon).css('border', '3px solid black');
        break;
      case 'table-primary':
        $('#TableThemePrimary').append(Icon).css('border', '3px solid black');
        break;
      case 'table-secondary':
        $('#TableThemeSecondary').append(Icon).css('border', '3px solid black');
        break;
      case 'table-success':
        $('#TableThemeSuccess').append(Icon).css('border', '3px solid black');
        break;
      case 'table-danger':
        $('#TableThemeDanger').append(Icon).css('border', '3px solid black');
        break;
      case 'table-warning':
        $('#TableThemeWarning').append(Icon).css('border', '3px solid black');
        break;
      case 'table-info':
        $('#TableThemeInfo').append(Icon).css('border', '3px solid black');
        break;
      case 'table-light':
        $('#TableThemeLight').append(Icon).css('border', '3px solid black');
        break;
      default:
        $('#TableThemewhite').append(Icon).css('border', '3px solid black');
        break;
    }
    TableTheme = NewTheme; // Assign New Theme For Table To Table Theme
  }

  /*
    ***************** Function For Create Flat Feature Table *********************
  */
  function CreateFlatFeatureTable()
  {
    let data = '', FeatureNames = Object.keys(Features);
    $('#FeatureName').children().remove();
    $.each(FeatureNames, function (indexInArray) 
    {
      if (Features[FeatureNames[indexInArray]].length > 0)
      {
        $('#FeatureName').append("<option value='" + FeatureNames[indexInArray] + "'>" + Word[FeatureNames[indexInArray]] + "</option>");
      }
    });
    
    PutDataOnSelect($('#FeatureName').val());

    $('.table-responsive').remove();
    if (FlatFeatureData.length > 0) 
    {
      $.each(FlatFeatureData, function (indexInArray) 
      { 
        data += '<tr><td>'+ FlatFeatureData[indexInArray].FeatureName +
        '</td><td>' + FlatFeatureData[indexInArray].Details + 
        '</td><td>' + FlatFeatureData[indexInArray].Quantity +
        '</td><td><a class="DeleteAnyFeatureFromFlat text-danger" role="botton" data-id="' + indexInArray + '" data-bs-toggle="modal" data-bs-target="#confirmTheDelete" aria-label="' + Word.Delete + '" data-balloon-nofocus data-balloon-pos="up"><i class="fas fa-trash-alt fs-6"></i></a></td></tr>'
      });
    }
    $('<div class="table-responsive overflow-visible">' +
        '<table class="table table-hover table-bordered table-striped text-center" id="table">' +
          '<thead>' +
            '<tr>' +
              '<th scope="col">' + Word.FeatureName + '</th>' +
              '<th scope="col">' + Word.Details + '</th>' +
              '<th scope="col">' + Word.Quantity + '</th>' +
              '<th scope="col">' + Word.Processes +'</th>' +
            '</tr>' +
          '</thead>' +
          '<tbody class="responseFlatFeatuer align-middle">' + data + '</tbody>' +
        '</table>' +
      '</div>'
    ).insertBefore('#BottomAddFlat');
    runTable();
    console.log("Featrues : ", Features);
    console.log("FlatFeatureData : ", FlatFeatureData);
    console.log("FeatureType : ", FeatureType);
  }

  /*
    ****************** Function For Put Data On Details Select ********************
  */
  function PutDataOnSelect(Type) 
  {
    $('#Details').children().remove();
    $.each(Features[Type], function (indexInArray)
    { 
      $('#Details').append("<option value='" + indexInArray + "'>" + Features[Type][indexInArray]['Details'] + "</option>");
    });
  }

/*****************************************************************************/

  /*
    **********************************
    *********** Home Page ***********
    **********************************
  */

  /**
    * Paginaton Buttons
  */
  $('.SectionFlatsShow .container').on('click', '.Pagination', function () 
  {
    if (!$(this).is('.active'))
    {
      GetFlats($(this).text());
      $(this).addClass('active').siblings().removeClass('active');
    }
  })

  /**
    * Get Number Of Satrs To Search In Flats 
  */
  $('.FormSearch').on('click', '.fa-star', function()
  {
    if ($(this).attr('id') == Id)
    {
      Id = 0;
      $('.FormSearch .fa-star').removeClass('text-warning').addClass('fa-regular');
    }
    else
    {
      Id = $(this).attr('id');
      for (let index = 1; index <= 5; index++) 
      {
        if (index <= Id)
        {
          $('#' + index).addClass('text-warning');
        }
        else 
        {
          $('#' + index).removeClass('text-warning').addClass('fa-regular');
        }
      }
    }
  });

  /*
    * Requset For Search Of Flat
  */
  $('.FormSearch').submit(function (e) 
  {
    e.preventDefault();
    if ($('#LowPrice').val() != '' && $('#HeighPrice').val() == '')
    {
      $('#HeighPrice').attr('required', 'required');
    }
    else if($('#HeighPrice').val() != '' && $('#LowPrice').val() == '')
    {
      $('#LowPrice').attr('required', 'required');
    }
    else
    {
      $('.SectionFlatsShow .container').children('.Pagination').remove();
      var data = new FormData($(this)[0]);
      data.append("Rate", Id);
      data.append("GETFlats", "");
      var response = SendRequest("POST", data, "json");
      response.done(function (msg)
      {
        if (msg.length > 0)
        {
          $('#flush-collapseSearch').removeClass('show');
          $('#Btn-flush-collapseSearch').addClass('collapsed');
          $('#Btn-flush-collapseSearch').attr('aria-expanded', 'false');
          PageCount = Math.ceil(msg.length / StepDataShow),
          FlatsData = msg;
          GetFlats(1)
          for (let index = 1; index <= PageCount; index++) 
          {
            $('.SectionFlatsShow .container').append(`<button class="btn Pagination me-2 ${index == 1 ? `active` : ``} shadow-none rounded-circle">${index}</button>`);
          }
        }
        else
        {
          if ($('#FlatsCard').find('.alert').is('div'))
          {
            console.log('ok');
            $('#FlatsCard').remove('.alert');
          }
          $('#FlatsCard').append(`
          <div class="alert alert-danger d-flex align-items-center alert-dismissible" role="alert">
            <svg class="ErrorLogIn mx-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
              <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </svg>
            <div>
              ${Word.ThereAreNoResult}
            </div>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          `)
          // console.log('ok');
        }
      });
      $('#LowPrice').removeAttr('required');
      $('#HeighPrice').removeAttr('required');
    }
  });

/*****************************************************************************/

  /*
    **********************************
    *********** Login Page ***********
    **********************************
  */

  $('#Formlogin').submit(function (e) 
  { 
    e.preventDefault();
    $('.pageLogin .container .alert').remove();
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

/***********************************************************************************/

  /*
    **********************************
    ********** Settings Page *********
    **********************************
  */

  /**
    * Display Image For Logo
  */
  $('#CustomImageLogo').on('click', function () 
  {
    $('#LogoImage').click();
  });
  $('#LogoImage').on('change', function () 
  {
    var reader = new FileReader();
    reader.addEventListener('load', function () 
    {
      $('.ImageLogo').attr('src', reader.result);
    });
    reader.readAsDataURL(this.files[0]);
  });

  /*
    * Page BackGround Color
  */
  $('#PageColor').on('input change', function ()
  {
    $(':root').css('--color-BackgroundBody', $(this).val());
    $('#TextSecondaryColor').val($(this).val() >= '#242424' ? '#000000' : '#FFFFFF').change();
  });

  /* 
    * Element BackGround Color
  */
  $('#ElementColor').on('input change', function ()
  {
    $(':root').css('--color-BackgroundElement', $(this).val());
    $('#TextSecondaryColor').val($(this).val() >= '#242424' ? '#000000' : '#FFFFFF').change();
  });

  /*
    * Text Primary Color
  */
  $('#TextPrimaryColor').on('input change', function ()
  {
    $(':root').css('--color-PrimaryText', $(this).val());
  });

  /*
    * Text Secondary Color
  */
  $('#TextSecondaryColor').on('input change', function ()
  {
    $(':root').css('--color-SecondaryText', $(this).val());
  });

  /*
    * Element Color
  */
  $('#InputBoxShadowColor').on('input change', function ()
  {
    $(':root').css('--color-InputBoxShadowSelect', $(this).val());
  });

  /*
    * Theme White
  */
  $('#TableThemewhite').on('click', function () 
  {
    SelectTableTheme('');
  });

  /*
    * Theme Dark
  */
  $('#TableThemeDark').on('click', function () 
  {
    SelectTableTheme('table-dark');
  });

  /*
    * Theme Primary
  */
  $('#TableThemePrimary').on('click', function () 
  {
    SelectTableTheme('table-primary');
  });

  /*
    * Theme Secondary
  */
  $('#TableThemeSecondary').on('click', function () 
  {
    SelectTableTheme('table-secondary');
  });

  /*
    * Theme Success
  */
  $('#TableThemeSuccess').on('click', function () 
  {
    SelectTableTheme('table-success');
  });

  /*
    * Theme Danger
  */
  $('#TableThemeDanger').on('click', function () 
  {
    SelectTableTheme('table-danger');
  });

  /*
    * Theme Warning
  */
  $('#TableThemeWarning').on('click', function () 
  {
    SelectTableTheme('table-warning');
  });

  /*
    * Theme Info
  */
  $('#TableThemeInfo').on('click', function () 
  {
    SelectTableTheme('table-info');
  });

  /*
    * Theme Light
  */
  $('#TableThemeLight').on('click', function () 
  {
    SelectTableTheme('table-light');
  });

  /*
    * Request Site Sittings
  */
  $('#FormSiteStyle').submit(function (e) 
  { 
    e.preventDefault();
    var data = new FormData($(this)[0]);
    data.append("ChangeSiteSittings", "");
    SiteColors.forEach(element => {
      data.append("SiteColors[]", element);
    });
    data.append("NewTheme", TableTheme);
    data.append("OldTheme", OldTheme);
    var response = SendRequest("POST", data);
    response.done(function () 
    {
      window.location.reload(true);
    });
  });

  $('#ButtonHotelImages').on('click', function () 
  {
    $('#HotelImages').click();
  });
  $('#HotelImages').on('change', function () 
  {
    var reader = new FileReader();
    reader.addEventListener('load', function () 
    {
      $('.ImageLogo').attr('src', reader.result);
    });
    reader.readAsDataURL(this.files[0]);
  });

  /**
    * Drop Zone For Image
  */
  Dropzone.options.dropzoneForm = {
    autoProcessQueue: false,
    acceptedFiles:".webp",
    init: function()
    {
      var submitButton = document.querySelector('#submitAll');
      myDropzone = this;
      submitButton.addEventListener("click", function()
      {
        myDropzone.processQueue();
      });
      this.on("complete", function()
      {
        if(this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0)
        {
          var _this = this;
          _this.removeAllFiles();
        }
        list_image();
      });
    },
  };

/***********************************************************************************/

  /*
    **************************************
    *********** Features Page ************
    **************************************
  */

  /*
    * One Modal For Delete Any Feature Through Know Which Feature Was Selected
  */
  $('.table-customize-feature').on('click', 'tr td .DeleteAnyFeature', function()
  {
    HotelFeatureId = $(this).parent().siblings().first().text();
  });

  /*
    * Form Edit Features
  */
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

  /*
    * Form Add Features
  */
  $('#ButtonFormFeature').on('click', function()
  {
    $('#FeatureName').removeAttr('disabled').val('1').change();
    $('#Price').val('');
    $('#Details').val('');
    $('#HeaderAddEditFeature').html(Word.NewFeature);
    $('#ButtonEditFeature').html(Word.Add).attr('id', 'ButtonAddFeature');
  });

  /*
    * Request Add And Edit Feature
  */
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

  /*
    * Request Remove Feature
  */
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

/***********************************************************************************/

  /*
    **********************************
    *********** Floors Page **********
    **********************************
  */

  /*
    * Request Add Floor
  */
  $("#ButtonAddFloor").on("click", function () 
  {
    var data = new FormData();
    data.append('AddFloor', '');
    data.append('FloorId', Id);
    var response = SendRequest("POST", data);
    response.done(function () 
    {
      $('.table-customize-floor .container').children().last().remove();
      DisplayData();
    });
  });

  /*
    * Request Remove Floor
  */
  $("#ButtonRemoveFloor").on("click", function () 
  {
    var data = new FormData();
    data.append('RemoveFloor', '');
    data.append('FloorId', Id); 
    var response = SendRequest("POST", data);
    response.done(function (msg) 
    {
      $('.table-customize-floor .container').children().last().remove();
      DisplayData();
    });
  });

/***********************************************************************************/

  /*
    **********************************
    *********** Flat Page ************
    **********************************
  */

  /**
    * Get Feature For Add To Flat
  */
  $('#FormAddFeature').submit(function (e)
  {
    e.preventDefault();
    var Type = $('#FeatureName').val();
    FlatFeatureData[FlatFeatureData.length] = Features[Type][$('#Details').val()];
    FlatFeatureData[FlatFeatureData.length - 1]['Quantity'] = $('#Quantity').val();
    Features[Type] = jQuery.grep(Features[Type], function(n, i) 
    {
      return (i != $('#Details').val());
    });
    if (Object.keys(FeatureType).some(function(type) { return type == Type })) 
    {
      FeatureType[Type] += 1;
    }
    CreateFlatFeatureTable();
    $('#Quantity').val('');
    $('.ComfirmAddFeatureToFlat').modal('hide');
  });

  /**
    * On Change Select Of Feature Type 
  */
  $('#FeatureName').on("change", function()
  {
    PutDataOnSelect($('#FeatureName').val());
  });

  /*
    * Get Flat Feature Data Index
  */
  $('.SectionAddFlat .container').on('click', 'tr td .DeleteAnyFeatureFromFlat', function()
  {
    Id = $(this).data('id');
  });

  /*
    * Delete Feature From Flat
  */
  $('#ButtonRemoveFeatureFromFlat').on('click',  function()
  {
    var Type = FlatFeatureData[Id]['FeatureName'];
    Features[Type].push(FlatFeatureData[Id]);
    FlatFeatureData = jQuery.grep(FlatFeatureData, function(n, i) 
    {
      return (i != Id);
    });
    if (Object.keys(FeatureType).some(function(type) { return type == Type })) 
    {
      FeatureType[Type] -= 1;
    }
    CreateFlatFeatureTable();
  });

  /*
    * One Modal For Delete Any Flat Through  Know Which Flat Was Selected
  */
  $('.table-customize-flat').on('click', 'tr td .DeleteAnyFlat', function()
  {
    Id = $(this).parent().siblings().first().text();
  });

  /*
    * Requset Add Flat
  */
  $('#FormNewFlat').submit(function (e)
  {
    e.preventDefault();
    if (FeatureType.Room > 0 && FeatureType.Bath > 0 && FeatureType.Bed > 0) 
    {
      // Create an FormData object
      var data = new FormData($('#FormNewFlat')[0]);
      data.append("AddFlat", "");
      // Get Floor Id From Breadcrumb Flats Page 
      data.append("FloorId", FloorId);
      $.each(FlatFeatureData, function (indexInArray) 
      { 
        data.append("Data[" + indexInArray + "][FeatureId]", FlatFeatureData[indexInArray].Id);
        data.append("Data[" + indexInArray + "][Quantity]", FlatFeatureData[indexInArray].Quantity);
      });
      var response = SendRequest("POST", data);
      response.done(function (msg) 
      {
        if (msg)
        {
          window.location = '/Daarna-Hotel/cpanel/admin/floors.php?Page=Flats&Id=' + FloorId;
        }
        else
        {
          $("html,body").animate({ scrollTop: 0 }, 0);
          $('#FlatId').val('').focus();
        }
      });
    }
    else
    {
      $('#ComfirmFlatFeaturesEmpty').modal('show');
    }
  });

  /**
    * Requset Remove Flat
  */
  $('#ButtonRemoveFlat').on('click', function()
  {
    var data = new FormData();
    data.append('RemoveFlat', '');
    data.append('FloorId', FloorId); 
    data.append('FlatId', Id); 
    var response = SendRequest("POST", data);
    response.done(function (msg) 
    {
      $('.table-customize-flat .container').children().last().remove();
      DisplayData();
    });
  });

/***************************************************************************************/

  /*
    ******************************************
    *************Employees Page***************
    ******************************************
  */
  
  /*
    * Form Edit Employee
  */
  $('.table-customize-employees').on('click', 'tr td .EditAnyEmployee', function()
  {
    Id = $(this).parent().siblings().first().text();
    $('#UserName').val($(this).parent().siblings().first().next().text());
    $('#Password').removeAttr('required');
    $('#Password').val('');
    $('#HeaderAddEditEmployees').html(Word.EditEmployee);
    $('#ButtonAddEmployees').text(Word.Save).attr('id', 'ButtonEditEmployee');
  });

  /*
    * Form Add Employee
  */
  $('#ButtonFormEmployees').on('click', function()
  {
    $('#UserName').val('');
    $('#Password').val('');
    $('#Password').attr( 'required', 'required');
    $('#HeaderAddEditEmployees').html(Word.NewEmployee);
    $('#ButtonEditEmployee').html(Word.Add).attr('id', 'ButtonAddEmployees');
  });

  /**
    * Block Any Employee
  */
  $('.table-customize-employees').on('click', 'tr td .BlockAnyEmployee', function()
  {
    Id = $(this).parent().siblings().first().text();
    $('#ButtonBlockEmployee').text(Word.Block);
  });

  /**
    * UnBlock Any Employee
  */
  $('.table-customize-employees').on('click', 'tr td .UnBlockAnyEmployee', function()
  {
    Id = $(this).parent().siblings().first().text();
    $('#ButtonBlockEmployee').text(Word.UnBlock);
  });

  /*
    * Request Add And Edit Employees
  */
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
        $('.table-customize-employees .container').children().last().remove();
        $('#comfirmAddAndEditEmployees').modal('hide');
        DisplayData();
      }
      else 
      {
        $('<div class="alert alert-danger d-flex align-items-center alert-dismissible w-100 border-danger bg-black text-light" role="alert"><i class="fa-solid fa-ban text-danger mx-2 fs-4"></i><div>' + Word.ThisUserNameIsExsist + '</div></div>').insertBefore('#AddEditEmployeesTemplate')
      }
    });
  });

  /**
    * Request Block Employees
  */
  $('#ButtonBlockEmployee').on('click', function()
  {
    var data = new FormData();
    if ($(this).text() == Word.UnBlock) 
    {
      data.append('UnBlockEmployee', '');
    }
    else
    {
      data.append('BlockEmployee', '');
    }
    data.append('id', Id);
    var response = SendRequest("POST", data);
    response.done(function (msg)
    {
      $('.table-customize-employees .container').children().last().remove();
      $('#confirmTheBlockEmployees').modal('hide');
      DisplayData();
    });
  });

  /***********************************************************************************/

  /*
    **************************************
    *********** Services Page ************
    **************************************
  */

  /*
    * One Modal For Delete Any Feature Through Add Attribute data-id In Oreder To Know Which Feature Was Selected
  */
  $('.table-customize-services').on('click', 'tr td .DeleteAnyServices', function()
  {
    Id = $(this).parent().siblings().first().text();
  });

  /*
    * Request Add Services
  */
  $('#FormNewService').submit(function (e)
  { 
    e.preventDefault();
    var data = new FormData($(this)[0]);
    data.append("AddService", "");
    var response = SendRequest("POST", data);
    response.done(function (msg)
    {
      $('#ComfirmAddService').find('.alert').remove();
      if (msg)
      {
        $('.table-customize-services .container').children().last().remove();
        $('#ComfirmAddService').modal('hide');
        DisplayData();
      }
      else 
      {
        $('<div class="alert alert-danger d-flex align-items-center alert-dismissible w-100 border-danger bg-black text-light" role="alert"><i class="fa-solid fa-ban text-danger mx-2 fs-4"></i><div>' + Word.ThisServiceIsExsist + '</div></div>').insertBefore('#AddServiceTemplate')
      }
    });
    $('#ServiceName').val('');
  });

  /*
    * Request Remove Services
  */
  $('#ButtonRemoveService').on('click', function ()
  { 
    var data = new FormData();
    data.append("RemoveService", "");
    data.append("Id", Id);
    var response = SendRequest("POST", data);
    response.done(function (msg)
    {
      $('.table-customize-services .container').children().last().remove();
      $('#confirmTheDelete').modal('hide');
      DisplayData();
    });
  });
});