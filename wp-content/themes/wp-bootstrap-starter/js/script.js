if (!Object.entries)
  Object.entries = function( obj ){
    alert(1);
    var ownProps = Object.keys( obj ),
        i = ownProps.length,
        resArray = new Array(i); // preallocate the Array
    while (i--)
      resArray[i] = [ownProps[i], obj[ownProps[i]]];

    return resArray;
  };



  function showPreview(objFileInput) {
      if (objFileInput.files[0]) {
        var fileReader = new FileReader();
        fileReader.onload = function (e) {
        $('#blah').attr('src', e.target.result);
  			$("#targetLayer").html('<img src="'+e.target.result+'" width="200px" height="200px" class="upload-preview" />');
  			$("#targetLayer").css('opacity','0.7');
  			$(".icon-choose-image").css('opacity','0.5');
          }
  		fileReader.readAsDataURL(objFileInput.files[0]);
      }
  }

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

function makeFloat(evt)
{
  return parseFloat(evt);
}

function display_error(msg)
{
  jQuery('#message_area').find(".message_text").html(msg);
  jQuery('#message_area').removeClass("hidden").fadeIn();
  jQuery('#message_area').addClass("active");
}

function display_success(msg)
{
  jQuery('#message_area').find(".message_text").html(msg);
  jQuery('#message_area').removeClass("hidden").fadeIn();
  jQuery('#message_area').addClass("active");
}


function password_validator()
{

  jQuery("#reg_pass, #reg_pass2").keyup(checkPasswordMatch);

    var strength = {
      0: "Worst",
      1: "Bad",
      2: "Weak",
      3: "Good",
      4: "Strong"
    }

    var password = document.getElementById('reg_pass');
    var meter = document.getElementById('password-strength-meter');
    var text = document.getElementById('password-strength-text');
    //password meter test
    password.addEventListener('input', function() {
      var val = password.value;
      var result = zxcvbn(val);

      // Update the password strength meter
      meter.value = result.score;

      // Update the text indicator
      if (val !== "") {
        text.innerHTML = "Strength: " + strength[result.score];
      } else {
        text.innerHTML = "";
      }
    });

  }

  function checkPasswordMatch() {
      var password = jQuery("#reg_pass").val();
      var confirmPassword = jQuery("#reg_pass2").val();
      if(password !="")
      {
        if (password != confirmPassword)
            jQuery("#divCheckPasswordMatch").html("Passwords do not match!");
        else
            jQuery("#divCheckPasswordMatch").html("Passwords match.");
      }

  }


(function($) {




  var sophomore = 0;

  $(window).load(function() {

    intervalid = setInterval(function(){

      if(sophomore == 1)
      {
        clearInterval(intervalid);
        //  notify("LOADING DONE");
        start_app();

      }

      if(sophomore == -1)
      {
        clearInterval(intervalid);
        notify("FAILED TO LOAD IMAGES");
      }




    },100);




  });

  function start_app(){

    init_seller_gallery();
    TweenMax.staggerTo($(".single-seller-gallery-image"),0.6,{opacity:1,ease:Power2.easeOut},0.2);
    // Start your app after loading scripts here
    if($("#comment_editor").length > 0)
    {
      $("#comment_editor").removeClass("invisible");
      TweenMax.to($("#comment_editor"),0.8,{bottom:0,ease:Power2.easeOut});
    }


  }


  function resize_general()
  {
    var w_w = $(window).width();
    var w_h = $(window).height();


    $(".single_menu_item").map(function(){

      if($(this).find(".active_subgroup").length < 1)
      {
        $(this).css("height","auto");
        $(this).find(".menu_group").css("margin-bottom","20px");
      }
    });

    if($("#seller-bg").length > 0)
    {
      var nh =  ( $(".seller-banner-shape").width()*0.3) ;
      $(".seller-banner-shape").height(nh);
        $("#seller-bg").height(nh);
    }

    if($("#application_filters").length > 0)
    {
      $("#application_filters").height(w_h);
        }

    $(".fullscreen").css("height",w_h+"px");
    $(".fullscreen").css("width",w_w+"px");

    $(".fullheight").css("min-height",w_h+"px");

    $("#filters_wrapper").css("max-height",w_h+"px");


    $(".halfheigt").css("min-height",w_h/2+"px");

    var offset_trigers = (w_h/2)*-1;
    var offset_owner = (w_h*0.85)*-1;
    $(".header_triggers").css("top",offset_trigers+"px");
    //  $("#business_trigger").css("top",offset_owner+"px");


  }


  $(document).ready(function() {

    // YOUR SCRIPT HERE

    $('#wrapper').imagesLoaded()
    .always( function( instance ) {
      console.log('all images loaded');
      sophomore = 1;
    }).done( function( instance ) {
      sophomore = 1;
      console.log('all images successfully loaded');
    }).fail( function() {
      console.log('all images loaded, at least one is broken');
      sophomore = -1;
    }).progress( function( instance, image ) {
      var result = image.isLoaded ? 'loaded' : 'broken';
      console.log( 'image is ' + result + ' for ' + image.img.src );
    });


    //general actions
    $("input[type=number]").each(function(){

      var floating_number = parseFloat($(this).val()).toFixed(2);
      var float_str = ""+floating_number;
      float_str = float_str.replace(".",",");
      $(this).val(floating_number);


    });


    $(".view_password").on("click",function(){

    		if($(this).hasClass("active"))
    		{
    			$(this).removeClass("active");
    			$(this).parent("div").find("input").attr("type","password");
    		}else {
    			$(this).addClass("active");
    			$(this).parent("div").find("input").attr("type","text");
    		}
    });

    $("input[type=number]").on("change",function(){
      var floating_number = parseFloat($(this).val()).toFixed(2);
      $(this).val(floating_number);
    });

    resize_general();
    $(window).resize(resize_general);

    init_menu();
    init_images();
    init_options_button();
    init_filters();
    init_messages();

    init_application_view();

    init_generate_certificate();
    init_offer_chat();

    init_dragable();
    init_new_application();

    init_seller_account();

    init_user_actions();
  });

  function init_user_actions()
  {

    if($(".btnAddSeller").length > 0)
    {

      jQuery(".btnAddSeller").live("click", function(e) {

        $parent = "";
        if($(this).closest(".single_blacklist_seller").length > 0)
        {
        //  alert(187);
          $parent = $(this).closest(".single_blacklist_seller");
        }
        e.preventDefault();
        var seller = jQuery(this).attr('data-seller');
        jQuery.ajax({
          'type'	: 'post',
          'url'	:	ajaxurl,
          'data'	:	{
            action	:	'addToMySellers',
            seller	:	seller,
          },
          success: function(response) {
            var result = JSON.parse(response);
            if (result.status == 0) {
              alert(result.message);
              if($parent!="")
              {
                $parent.remove();
              }
            //  window.location.reload();
            }
            else {
              alert(result.message);
            }
          }
        });
        return false;
      });
    }


  }




  function update_seller_gallery(image_url)
  {
    //alert(image_url);

    jQuery.ajax({
      url : ajaxurl,
      type : 'post',
      data : {
        action : 'update_seller_gallery',
        img_url : image_url
      },
      success : function( response ) {
        var data = JSON.parse(response);
        console.log(data);
        if (data.status == 1) {
        //  alert("153 "+data.message);
            display_success(data.message);
        }
        else {
        //  alert("157 "+data.message);
            display_error(data.message);
        }
      //  window.location.reload();

      }
    });
  }

function update_seller_certificate(image_url)
{
  //alert(image_url);

  jQuery.ajax({
    url : ajaxurl,
    type : 'post',
    data : {
      action : 'update_seller_certificate',
      img_url : image_url
    },
    success : function( response ) {
      var data = JSON.parse(response);
      console.log(data);
      if (data.status == 1) {
      //  alert("153 "+data.message);
          display_success(data.message);
      }
      else {
        //alert("157 "+data.message);
          display_error(data.message);
      }
    //  window.location.reload();

    }
  });
}

function update_seller_banner(image_url)
{
  //alert(image_url);

  jQuery.ajax({
    url : ajaxurl,
    type : 'post',
    data : {
      action : 'update_seller_banner',
      img_url : image_url
    },
    success : function( response ) {
      var data = JSON.parse(response);
      console.log(data);
      if (data.status == 1) {
      //  alert("153 "+data.message);
          display_success(data.message);
      }
      else {
          display_error(data.message);
      //alert("157 "+data.message);
      }
    //  window.location.reload();

    }
  });
}


  /*function get_wp_editor_content(){
    if (jQuery("#comment-reply").hasClass("tmce-active")){
      //  //alert(1);
      return tinyMCE.activeEditor.getContent();
    }else{
      //    //alert(2);
      tinyMCE.triggerSave();
      //    $('#comment_message').val();
      return jQuery('#comment_message').val();
    }
  }*/


function create_gallery_image(image_url)
{

  var newgallery_trans =  $("<div>", {class: 'seller-gallery-transform inline-block'}) ;
  var newgallery_shape =  $("<div>", {class: 'seller-gallery-shape shadow'}) ;


  var deletegallery_trans =  $("<div>", {class: 'gallery_delete-transform'}) ;
  var deletegallery_shape =  $("<div>", {class: 'gallery_delete-shape pointer'}) ;
  deletegallery_shape.html("Διαγραφή")
  deletegallery_trans.append(deletegallery_shape);

  var newgallery_link = $("<a>");
  var new_g_image = $("<img>");

  var src = root_images_path+"/"+image_url;

  newgallery_link.attr('href',src);

  newgallery_link.append(new_g_image);
  newgallery_shape.append(newgallery_link);
  newgallery_shape.append(deletegallery_trans);
  newgallery_trans.append(newgallery_shape);
  newgallery_trans.data("url",image_url);
//
  return newgallery_trans;
}

function   init_seller_account()
{
  if($("#categories_details").length < 1 && $("#user_profile").length < 1)
  {
    return 0;
  }


  $(".hotel_checkbox_action").on('click',function(){

    if(!$(this).hasClass("checked"))
    {
      $(this).closest(".form-group").find("input[type=checkbox]").attr("checked","checked");
      $(this).addClass("checked");

    }else {
      $(this).closest(".form-group").find("input[type=checkbox]").removeAttr("checked");
      $(this).removeClass("checked");
    }


  });

  var waypoint = new Array();
  var count = 0;
    $(".account_step").each(function(){
      var id = $(this).attr("id");
      console.log(count+" > "+ id + " WAY : "+$(this).data("step"));

      waypoint[count] = new Waypoint({
        element: document.getElementById(id),
        handler: function(direction) {
          //  alert(1);
          console.log(direction +"  >> " +this.element.dataset.step);


          $(".complete").removeClass("complete");
          $(".step_button_"+this.element.dataset.step).addClass("complete");
          //  alert('Basic waypoint triggered '+direction);
        },
        offset:170
      });
      count++;

    });

    $(".step_transform").on("click",function(){
      //alert(1);
      var step = $(this).data("step");
      var top = $(".account_step_"+step).offset().top - 180;
      $('html,body').animate({scrollTop:top},800,'swing');



    });



  $(".certs-button-shape").on("click",function(){

    $new_row = $("#certs_tmpl > .single_table-row").clone();
    var row_counter = $("#certs-rows").find(".single_table-row").length + 1;
    $new_row.find(".single-table-counter-shape").html(row_counter);
    $new_row.appendTo("#certs-rows");
  });

  $("#certs-form").on("submit",function(e){
      e.preventDefault();
    var textfield ="";

    $(this).find(".single_table-row").map(function(){


      //  alert(" "+textfield);
      var dates = "@@"+$(this).find(".education_dates").val()+"@#";
      var establishment = $(this).find(".education_establishment").val()+"@#";
      var title = $(this).find(".education_title").val();
      //var field = $(this).find(".education_educ_area").val();

      if($(this).find(".education_dates").val() =="" &&  $(this).find(".education_establishment").val() =="" && $(this).find(".education_title").val() =="" )
      {

      }else {
          textfield +=dates+establishment+title;
      }


    });



    //seller_data_education
        var data = $(this).serialize()  + '&action=update_seller_data_certs&textarea='+textfield;
        //alert(textfield);
        $.ajax({
          url : ajaxurl,
          type : 'post',
          data : data,
          success : function( response ) {
            var data = JSON.parse(response);
            console.log(data);
            if (data.status == 1) {
              //alert(data.message);
                display_success(data.message);
            }
            else {
                display_error(data.message);
            //  alert(data.message);
            }
          //  window.location.reload();

        },
        error:function()
        {
          alert("error");
        }
        });

  });

  $(".work-button-shape").on("click",function(){

    $new_row = $("#work_tmpl > .single_table-row").clone();
    var row_counter = $("#work-rows").find(".single_table-row").length + 1;
    $new_row.find(".single-table-counter-shape").html(row_counter);
    $new_row.appendTo("#work-rows");
  });

  $("#work-form").on("submit",function(e){
      e.preventDefault();
    var textfield ="";

    $(this).find(".single_table-row").map(function(){


      //  alert(" "+textfield);
      var dates = "@@"+$(this).find(".education_dates").val()+"@#";
      var establishment = $(this).find(".education_establishment").val()+"@#";
      var title = $(this).find(".education_title").val()+"@#";
      var field = $(this).find(".education_educ_area").val();

      if($(this).find(".education_dates").val() =="" &&  $(this).find(".education_establishment").val() =="" && $(this).find(".education_title").val() =="" && $(this).find(".education_educ_area").val() =="")
      {

      }else {
          textfield +=dates+establishment+title+field;
      }


    });



    //seller_data_education
        var data = $(this).serialize()  + '&action=update_seller_data_work&textarea='+textfield;
        alert(textfield);
        $.ajax({
          url : ajaxurl,
          type : 'post',
          data : data,
          success : function( response ) {
            var data = JSON.parse(response);
            console.log(data);
            if (data.status == 1) {
              //alert(data.message);
                display_success(data.message);
            }
            else {
                display_error(data.message);
            }
          //  window.location.reload();

        },
        error:function()
        {
          display_error("Δημιουργήθηκε Πρόβλημα");
        }
        });

  });

  $(".education-button-shape").on("click",function(){

    $new_row = $("#education_tmpl > .single_table-row").clone();
    var row_counter = $("#education-rows").find(".single_table-row").length + 1;
    $new_row.find(".single-table-counter-shape").html(row_counter);
    $new_row.appendTo("#education-rows");
  });


    $(".single-table-remove-shape").live("click",function(){
      $(this).closest(".single_table-row").remove();
    });


  $("#education-form").on("submit",function(e){
      e.preventDefault();
    var textfield ="";

    $(this).find(".single_table-row").map(function(){


        alert(" "+textfield);
      var dates = "@@"+$(this).find(".education_dates").val()+"@#";
      var establishment = $(this).find(".education_establishment").val()+"@#";
      var title = $(this).find(".education_title").val()+"@#";
      var field = $(this).find(".education_educ_area").val();

      if($(this).find(".education_dates").val() =="" &&  $(this).find(".education_establishment").val() =="" && $(this).find(".education_title").val() =="" && $(this).find(".education_educ_area").val() =="")
      {

      }else {
          textfield +=dates+establishment+title+field;
      }


    });



    //seller_data_education
        var data = $(this).serialize()  + '&action=update_seller_data_education&textarea='+textfield;
        //alert(textfield);
        $.ajax({
          url : ajaxurl,
          type : 'post',
          data : data,
          success : function( response ) {
            var data = JSON.parse(response);
            console.log(data);
            if (data.status == 1) {

                display_success(data.message);
            }
            else {
              display_error(data.message);
            }
          //  window.location.reload();

        },
        error:function()
        {
          alert("error");
        }
        });

  });
//reg_amenities

//hotel_amenities-form
$("#hotel_amenities-room-form").on("submit",function(e){

  //alert(284);
    e.preventDefault();
    var data = $(this).serialize()  + '&action=update_hotel_room_amenities';

    $.ajax({
      url : ajaxurl,
      type : 'post',
      data : data,
      success : function( response ) {
        var data = JSON.parse(response);
        console.log(data);
        if (data.status == 1) {
            display_success(data.message);

        }
        else {
            display_error(data.message);
        }
      //  window.location.reload();

    },
    error:function()
    {
      alert("error");
    }
    });

});
//hotel_amenities-form
$("#hotel_amenities-form").on("submit",function(e){

  //alert(284);
    e.preventDefault();
    var data = $(this).serialize()  + '&action=update_hotel_amenities';

    $.ajax({
      url : ajaxurl,
      type : 'post',
      data : data,
      success : function( response ) {
        var data = JSON.parse(response);
        console.log(data);
        if (data.status == 1) {
          display_success(data.message);

        }
        else {
            display_error(data.message);
        }
      //  window.location.reload();

    },
    error:function()
    {
      alert("error");
    }
    });

});

  $("#hotel-form").on("submit",function(e){

    //alert(284);
      e.preventDefault();
      var data = $(this).serialize()  + '&action=update_hotel_general';

      $.ajax({
        url : ajaxurl,
        type : 'post',
        data : data,
        success : function( response ) {
          var data = JSON.parse(response);
          console.log(data);
          if (data.status == 1) {
              display_success(data.message);
                window.location.reload();
          }
          else {
              display_error(data.message);
          }


      },
      error:function()
      {
        alert("error");
      }
      });

  });

$("#seller_general-data").on("submit",function(e){

//alert(284);
  e.preventDefault();
  var data = $(this).serialize()  + '&action=update_seller_general';

  $.ajax({
    url : ajaxurl,
    type : 'post',
    data : data,
    success : function( response ) {
      var data = JSON.parse(response);
      console.log(data);
      if (data.status == 1) {
      //  alert(data.message);
      location.reload();
      }
      else {
          display_error(data.message);
      }
    //  window.location.reload();

  },
  error:function()
  {
    alert("error");
  }
  });

});
//address format

$("#address-form").validator();

$("#address-form").on("submit",function(e){

//alert(284);
  e.preventDefault();
  var data = $(this).serialize()  + '&action=update_user_address';

  $.ajax({
    url : ajaxurl,
    type : 'post',
    data : data,
    success : function( response ) {
      var data = JSON.parse(response);
      console.log(data);
      if (data.status == 1) {
          display_success(data.message);

      }
      else {
          display_error(data.message);
      }
    //  window.location.reload();

  },
  error:function()
  {
    alert("error");
  }
  });
});

//password action_button_shape




password_validator();

$("#password_change").on("submit",function(e){


  e.preventDefault();
  var data = $(this).serialize()  + '&action=update_user_pass';

  $.ajax({
    url : ajaxurl,
    type : 'post',
    data : data,
    success : function( response ) {
      var data = JSON.parse(response);
      console.log(data);
      if (data.status == 1) {
          display_success(data.message);

      }
      else {
          display_error(data.message);
      }
    //  window.location.reload();

  },
  error:function()
  {
      display_error(data.message);
  }
  });
});

  //gallery

  $("#banner-upload").on("submit",function(e){

      e.preventDefault();
      var data_n = new FormData(this);
    //  alert(JSON.stringify(data_n));
      for (var pair of data_n.entries()) {
          console.log(pair[0]+ ', ' + pair[1]);
      }

      var data_send = new Array();

      jQuery.ajax({
        url : ajaxurl,
        type : 'post',
        data :new FormData(this),
        beforeSend: function(){$("#body-overlay").show();},
        contentType: false,
        processData:false,
        success : function( response ) {
          var data = JSON.parse(response);
          console.log(data);
          if (data.status == 1) {
          /*    var newgallery_trans =  $("<div>", {class: 'gallery-transform col-xs-12 col-sm-6 col-md-4'}) ;
              var newgallery_shape =  $("<div>", {class: 'gallery-shape'}) ;
              var deletegallery_trans =  $("<div>", {class: 'gallery_delete-transform'}) ;
              var deletegallery_shape =  $("<div>", {class: 'gallery_delete-shape pointer'}) ;
              deletegallery_shape.html("Διαγραφή")
              deletegallery_trans.append(deletegallery_shape);

              var new_g_image = $("<img>");
              var src = root_images_path+"/"+data.image_url;
              new_g_image.attr('src',src);
              alert(src);

              newgallery_shape.append(new_g_image);
              newgallery_shape.append(deletegallery_trans);
              newgallery_trans.append(newgallery_shape);
              newgallery_trans.data("url",data.image_url);

*/
              var src = root_images_path+"/"+data.image_url;
              $("#seller-banner").data("url",data.image_url);
              $("#seller-banner").find(".seller-banner-shape").css('background-image', 'url(' + src + ')')

          /*  $(".banner-shape").empty();
            $(".banner-shape").append(newgallery_trans);*/

              update_seller_banner(data.image_url);
            /*
            <div class="gallery-transform inline-block">
              <div class="gallery-shape">
                <img src="<?php echo $gallery['url'];?>"/>
              </div>
            </div>
            */
          }
          else {
              display_error(data.message);
          }
        //  window.location.reload();

        }
      });

  });

  $(".banner_delete-shape").on("click",function(){
    alert(1);
    var image_url =   $("#seller-banner").data("url");

      action="update_seller_banner";
      alert("delete "+image_url+" "+action);

      jQuery.ajax({
        url : ajaxurl,
        type : 'post',
        data : {
          action : action, //'update_seller_gallery',
          img_url : image_url,
          delete : 1
        },
        success : function( response ) {
          var data = JSON.parse(response);
          console.log(data);
          if (data.status == 1) {
            //alert("153 "+data.message);
              $("#seller-banner").find(".seller-banner-shape").css('background-image', 'none')
          }
          else {
            display_error(data.message);
          }
        //  window.location.reload();

        }
      });
  });


  $(".gallery_delete-shape").live("click",function(){

    var image_url = $(this).closest(".seller-gallery-transform").data("url");
    var parent = $(this).closest(".seller-gallery-transform");

    var action="update_seller_gallery";
    if($(this).closest("#seller-page-certificate").length > 0)
    {
    /*  var image_url = $(this).closest(".seller-gallery-transform").data("url");
      var parent = $(this).closest(".seller-gallery-transform");*/
       action="update_seller_certificate";
    }else {
    /*  var image_url = $(this).closest(".seller-gallery-transform").data("url");
      var parent = $(this).closest(".seller-gallery-transform");*/
      action="update_seller_gallery";
    //  seller-gallery-transform
    }

      alert("delete "+image_url+" "+action);

      jQuery.ajax({
        url : ajaxurl,
        type : 'post',
        data : {
          action : action, //'update_seller_gallery',
          img_url : image_url,
          delete : 1
        },
        success : function( response ) {
          var data = JSON.parse(response);
          console.log(data);
          if (data.status == 1) {
              //display_success(data.message);
            parent.remove();
          }
          else {
            display_error(data.message);
          }
        //  window.location.reload();

        }
      });

  });

//gallery
/*Dropzone.options.galleryUpload = {
  paramName: "photo", // The name that will be used to transfer the file
  maxFilesize: 2, // MB
  autoProcessQueue :false,
  accept: function(file, done) {

    if (file.name == "justinbieber.jpg") {
      done("Naha, you don't.");
    }
    else { done("ΟΚ!"); }
  },
  init:function(){

    this.on("addedfile", function(file) { alert("Added file."+file); });
  }
};


galleryUpload.on("complete", function(file) {
alert(1035);
});*/

$("#gallery-upload").on("submit",function(e){

    e.preventDefault();
    var data_n = new FormData(this);
  //  alert(JSON.stringify(data_n));
    for (var pair of data_n.entries()) {
        console.log(pair[0]+ ', ' + pair[1]);
    }

    var data_send = new Array();

    jQuery.ajax({
      url : ajaxurl,
      type : 'post',
      data :new FormData(this),
      beforeSend: function(){$("#body-overlay").show();},
      contentType: false,
      processData:false,
      success : function( response ) {
        var data = JSON.parse(response);
        console.log(data);
        if (data.status == 1) {

          var newgallery_trans = create_gallery_image(data.image_url);
          $(".seller-page-gallery-shape").append(newgallery_trans);

          update_seller_gallery(data.image_url);
          /*
          <div class="gallery-transform inline-block">
            <div class="gallery-shape">
              <img src="<?php echo $gallery['url'];?>"/>
            </div>
          </div>
          */
        }
        else {
          display_error(data.message);
        }
      //  window.location.reload();

      }
    });

});
  //image uploads certificates-upload

  $("#certificates-upload").on("submit",function(e){
      e.preventDefault();
      var data_n = new FormData(this);
    //  alert(JSON.stringify(data_n));
      for (var pair of data_n.entries()) {
          console.log(pair[0]+ ', ' + pair[1]);
      }

      var data_send = new Array();

      jQuery.ajax({
        url : ajaxurl,
        type : 'post',
        data :new FormData(this),
        beforeSend: function(){$("#body-overlay").show();},
  			contentType: false,
     	  processData:false,
        success : function( response ) {
          var data = JSON.parse(response);
          console.log(data);
          if (data.status == 1) {

            var newgallery_trans = create_gallery_image(data.image_url);
            $(".seller-page-certificate-shape").append(newgallery_trans);

            update_seller_certificate(data.image_url);
            /*
            <div class="gallery-transform inline-block">
              <div class="gallery-shape">
                <img src="<?php echo $gallery['url'];?>"/>
              </div>
            </div>
            */
          }
          else {
              display_error(data.message);
          }
        //  window.location.reload();

        }
      });

  });

  $("#categories-form").on("submit",function(e){
    e.preventDefault();
  // alert(" 1 "+catid);
    //alert("487"+JSON.stringify($(this).serialize()));
    var data = $(this).serialize()  + '&action=update_seller_categories';
    //alert("950"+data);
    $.ajax({
      url : ajaxurl,
      type : 'post',
      data : data,
      success : function( response ) {
        var data = JSON.parse(response);
        console.log(data);
        if (data.status == 1) {
          //alert(data.status +" - "+data.message);
          display_success(data.message);
        }
        else {
          //alert(data.status +" - "+data.message);
            display_error(data.message);
        }
      //  window.location.reload();

    },
    error:function()
    {
      alert("error");
    }
    });

  });

  $("#areas-form").on("submit",function(e){
    e.preventDefault();
  // alert(" 1 "+catid);
    //alert(JSON.stringify($(this).serialize()));
    var data = $(this).serialize()  + '&action=update_seller_areas';

    $.ajax({
      url : ajaxurl,
      type : 'post',
      data : data,
      success : function( response ) {
        var data = JSON.parse(response);
        console.log(data);
        if (data.status == 1) {
        //  alert(data.message);
            display_success(data.message);
        }
        else {
        //  alert(data.message);
            display_error(data.message);
        }
      //  window.location.reload();

    },
    error:function()
    {
      alert("error");
    }
    });

  });


$(".close_areas").on("click",function(){
$("#area_selector").addClass("hidden");
$("#area_selector").find(".subcategories").html("");
$("#area_selector").find(".single-account-category-transform  .open_subcats").removeClass("opened");
$("#areas-form").trigger("submit");
});

$(".open_areas").on("click",function(){
$("#area_selector").removeClass("hidden");
});

$(".open_categories").on("click",function(){
  $("#categories_selector").removeClass("hidden");
});


$(".close_categories").on("click",function(){
  $("#categories_selector").addClass("hidden");
$("#categories_selector").find(".subcategories").html("");
$("#categories_selector").find(".single-account-category-transform  .open_subcats").removeClass("opened");
  $("#categories-form").trigger("submit");
});


/*
$(".single-account-area-transform  .open_subcats").live("click",function(e){

  var catid = $(this).closest(".single-account-area-shape").data("cat_id");
  var parent = $(this).closest(".single-account-area-transform");
    e.preventDefault();


      if($(this).hasClass("opened"))
      {
        $(this).removeClass("opened");
        parent.children(".single-account-area-shape").children(".all_subcats").fadeOut();
        parent.find(".subcategories").html("");
        return 0;
      }

      $(this).addClass("opened");



  //alert(" 2 "+catid);
    jQuery.ajax({
      url : ajaxurl,
      type : 'post',
      data : {
        action : 'getAccountsAreas',
        cat_id :catid
      },
      success : function( response ) {
        var data = JSON.parse(response);
      //  console.log(data);
        if (data.status == 1) {
        //  alert(data.message);
          parent.find(".subcategories").html(data.message);

          $("#areas-form").find("input[type=checkbox]").each(function(){

            if($("#addcat"+$(this).val()).length > 0)
            {
              $("#addcat"+$(this).val()).addClass("hidden");
            }
//addarea$category
          });
          parent.find(".all_subcats").fadeIn();
        }
        else {
          alert(data.message);
        }
      //  window.location.reload();

      }
    });
  //  return false;



});

*/
/*
$(".subcategories").find(".single-account-area-shape").live("click",function(){
  //alert(1);
    var parent_id = $(this).parent().data("parentid");
  var parent= $(this).data("parent");
  var longlat= $(this).data("longlat");
  var id =  $(this).data("cat_id");

  var newArea = $("#area_tmpl").find(".single_selected_item-transform").clone();

  newArea.data("area",id);

  newArea.find(".selected_item_title").html($(this).find(".single-account-area-title").html());
  newArea.find(".selected_item_parent").html(parent);
  newArea.find(".map").html(longlat);
  newArea.find("input").val(id);
  newArea.find("input").attr("name","areas[]");
  newArea.addClass("area_parent_"+parent_id);
  newArea.appendTo(".selected_areas");

  if($("#area_filter_"+parent_id).length < 1 )
  {

    $("#filter_areas").append('<option id="area_filter_'+parent_id+'" value="'+parent_id+'" >'+parent+'</option>');
  }


  $(this).closest(".single-account-area-transform").fadeOut();

});
*/


//Delete Category or Area
$(".delete_area-shape").live("click",function(){
  var parent = $(this).closest(".single_selected_item-transform");

  var input_id = parent.find("input").val();
//  if(parent.closest("#categories-form").length > 0)
//  {
    //if category

    if($("#addcat"+input_id).length > 0)
    {
      $("#addcat"+input_id).removeClass("hidden");
      $("#addcat"+input_id).fadeIn();
    }
  //  input_id

//  }

  $(this).closest(".single_selected_item-transform").fadeOut(function(){
    parent.remove();
  })

});

//Add Area or subcategories children

$(".single-account-category-transform  .open_subcats").live("click",function(e){

  var catid = $(this).closest(".single-account-category-shape").data("cat_id");
  var parent = $(this).closest(".single-account-category-transform");
  var action = "";

  if($(this).closest("#area_selector").length>0)
  {
    isCat = 0;
    isArea = 1;

     action = "getAccountsAreas";
  }else if($(this).closest("#categories_selector").length>0)
  {
    isCat = 1;
    isArea = 0;
    action="getAccountSubcategories";
  }else {
    return 0;
  }


// /  getAccountsAreas
//  parent.find(".all_subcats").fadeIn();

  if($(this).hasClass("opened"))
  {
    $(this).removeClass("opened");
    parent.children(".single-account-category-shape").children(".all_subcats").fadeOut();
    parent.find(".subcategories").html("");
    return 0;
  }

  $(this).addClass("opened");
    e.preventDefault();
  // alert(" 1 "+catid);
    jQuery.ajax({
      url : ajaxurl,
      type : 'post',
      data : {
        action :action,
        cat_id :catid
      },
      success : function( response ) {
        var data = JSON.parse(response);
        console.log(data);
        if (data.status == 1) {
          //alert(data.message);
          parent.find(".subcategories").html(data.message);
          var newform;
          //hide all categories that exis already
          if(isCat)
          {
          newform = "#categories-form";
          }else if(isArea)
          {
            newform = "#areas-form";
          }

          $(newform).find("input[type=checkbox]").each(function(){

            if($("#addcat"+$(this).val()).length > 0)
            {
              $("#addcat"+$(this).val()).addClass("hidden");
            }

          });

          parent.children(".single-account-category-shape").children(".all_subcats").fadeIn();


        }
        else {
        //  alert(data.message);
            display_error(data.message);
        }
      //  window.location.reload();

      }
    });
  //  return false;



});

function create_cat_entry(newArea,isCat,isArea,id,parent,parent_id,title)
{
  console.log("INSIDE CREAATE");
 console.log("adding "+title+" "+parent);

 if($("#cat"+id).length > 0)
 {
   return 0;
 }

    newArea.attr("id","cat"+id);
    newArea.data("cat",id);


    newArea.find(".selected_item_title").html(title);
    newArea.find(".selected_item_parent").html(parent);

    newArea.find("input").val(id);
    if(isCat)
    {
        newArea.find("input").attr("name","cats[]");
        newArea.appendTo(".selected_cats");
          newArea.addClass("category_parent_"+parent_id);

          if($("#cat_filter_"+parent_id).length < 1 )
          {

            $("#filter_categories").append('<option id="cat_filter_'+parent_id+'" value="'+parent_id+'" >'+parent+'</option>');
          }


    }else if(isArea)
    {
        newArea.find("input").attr("name","areas[]");
        newArea.addClass("area_parent_"+parent_id);
          newArea.appendTo(".selected_areas");

          if($("#area_filter_"+parent_id).length < 1 )
          {

            $("#filter_areas").append('<option id="area_filter_'+parent_id+'" value="'+parent_id+'" >'+parent+'</option>');
          }

    }
}

//Add areas and Categories
//$(".subcategories").find(".single-account-category-shape").live("click",function(){
$(".single-account-category-shape").live("click",function(){

//  alert(1286);
  if($(this).closest(".single-account-category-transform").hasClass("hasChildren"))
  {
    //alert(1);
    return 0;
  }else {
  //  alert(2);
  }
  //alert(1);
  var parent_id = $(this).parent().data("parentid");
  var parent= $(this).data("parent");

  var id =  $(this).data("cat_id");

//check if it exists
  if($("#cat"+id).length > 0)
  {
    $("#cat"+id).remove();
  }

  var isCat = 1;
  var isArea = 0;
var newArea ;//= $("#cat_tmpl").find(".single_selected_item-transform").clone();
  if($(this).closest("#area_selector").length>0)
  {
    isCat = 0;
    isArea = 1;
    //
    var newArea = $("#area_tmpl").find(".single_selected_item-transform").clone();
  }else if($(this).closest("#categories_selector").length>0)
  {
    isCat = 1;
    isArea = 0;
    var newArea = $("#cat_tmpl").find(".single_selected_item-transform").clone();
  }else {
    return 0;
  }

 create_cat_entry(newArea,isCat,isArea,id,parent,parent_id,$(this).find(".single-account-area-title").html());

  $(this).closest(".single-account-category-transform").fadeOut();

});

$(".delete_categories").on("click",function(){
//  alert(1);
  $(".selected_cats").find(".single_selected_item-transform").each(function(){
      if(!$(this).hasClass("hidden"))
      {
        $(this).remove();
      }
  });

});


$(".delete_areas").on("click",function(){
//  alert(1);

  $(".selected_areas").find(".single_selected_item-transform").each(function(){
      if(!$(this).hasClass("hidden"))
      {
        $(this).remove();
      }
  });

});
//get all children and add them

$(".single-account-category-shape").find(".all_subcats").live("click",function(){
  alert("CATS");

  var parentid = $(this).closest(".single-account-category-shape").parent().data("parentid");
  var parent= $(this).closest(".single-account-category-shape").data("parent");
  /*return 0;
    var parent = $(this).closest(".single-account-category-transform");
    console.log("done");
    parent.find(".subcategories").find(".single-account-category-shape").each(function(){

      console.log("removing");
      $(this).trigger('click');

      parent.fadeOut(function(){
          parent.remove();
      });

    });*/

    var action = "";

    var catid = $(this).closest(".single-account-category-shape").data("cat_id");
// alert(catid);

  var isCat = 1;
  var isArea = 0;


  if($(this).closest("#area_selector").length>0)
  {
    isCat = 0;
    isArea = 1;
    //
    action = "getAllAreaChildren";

  }else if($(this).closest("#categories_selector").length>0)
  {
    isCat = 1;
    isArea = 0;
    action = "getAllCatChildren";
  }else {
    return 0;
  }



    jQuery.ajax({
      url : ajaxurl,
      type : 'post',
      data : {
        action :action,
        cat_id :catid
      },
      success : function( response ) {
        var data = JSON.parse(response);
        console.log(data);
        if (data.status == 1) {
        //alert("1 " +data.message.length);

         console.log(data.message);
        //  alert(data.children.length);
          if(data.children.length > 0)
          {
          //  alert(data.children[0].child['post_parent_title']);

           for(var i=0;i<data.children.length;i++)
           {
             var newArea ;

             if(isCat)
             {
                  newArea = $("#cat_tmpl").find(".single_selected_item-transform").clone();
             }else if(isArea)
             {
                  newArea = $("#cat_tmpl").find(".single_selected_item-transform").clone();
             }
             create_cat_entry(newArea,isCat,isArea,data.children[i].child['post_id'],data.children[i].child['post_parent_title'],data.children[i].child['post_parent'],data.children[i].child['post_title']);
             $("#addcat"+data.children[i].child['post_id']).addClass("hidden");
           }

          }



        // alert(data.children.length);
      /*  for (var key in data.children) {
          if (data.children.hasOwnProperty(key)) {
              console.log(key + " -> " + );
          }
      }*/

        //  for(var i=0;i<)

        }
        else {
          alert("0 "+data.message);
        }
      //  window.location.reload();

      }
    });


});


/*
$(".single-account-area-shape").find(".all_subcats").live("click",function(){
    alert("AREA");
    return 0;
    var parent = $(this).closest(".single-account-area-transform");
    console.log("done");
    parent.find(".subcategories").find(".single-account-area-shape").each(function(){

      console.log("removing");
      $(this).trigger('click');

      parent.fadeOut(function(){
          parent.remove();
      });

    });
});

*/
/*
$(".single-account-area-shape .area_input").live("click",function(){


  var hasChildren = 0;
  var $parent = $(this).closest(".single-account-area-transform");
  if($parent.hasClass("hasChildren"))
  {

      if($(this).hasClass("checked"))
      {
        //  alert(544);
          $(this).removeClass("checked");
          $parent.find("input").removeAttr("checked");
      }else {
        $(this).addClass("checked")
        $parent.find("input").attr("checked","checked");
      }

  }else {
    if($(this).hasClass("checked"))
    {
      alert(563);

        $(this).removeClass("checked");
        $(this).find("input").removeAttr("checked");
        //uncheck all areas from root
         $(this).closest(".hasChildren").children(".single-account-area-shape").children(".all_subcats").each(function(){

           if($(this).hasClass("checked"))
           {
               alert(571);
                $(this).removeClass("checked");
                $(this).children("input").removeAttr("checked");
           }
         });


    }else {
      $(this).addClass("checked")
      $parent.find("input").attr("checked","checked");
    }
  }

});
*/
$("#filter_categories").change(function(){
  var id = $(this).val();
  //alert(id);
  if(id == -1)
  {
      $(".categories_container-transform").find(".single_selected_item-transform").removeClass("hidden");
  }else {
    $(".categories_container-transform").find(".single_selected_item-transform").addClass("hidden");
    $(".category_parent_"+id).removeClass("hidden");
  }


});
//filter_areas
$("#filter_areas").change(function(){
  var id = $(this).val();
  //alert(id);
  if(id == -1)
  {
      $(".areas_container-transform").find(".single_selected_item-transform").removeClass("hidden");
  }else {
    $(".areas_container-transform").find(".single_selected_item-transform").addClass("hidden");
    $(".area_parent_"+id).removeClass("hidden");
  }


});


/*
$(".single-account-category-shape .cat_input").live("click",function(){


  var hasChildren = 0;
  var $parent = $(this).closest(".single-account-category-transform");


  if($parent.hasClass("hasChildren"))
  {
  alert(674);
      if($(this).hasClass("checked"))
      {
        //  alert(544);
          $(this).removeClass("checked");
          $parent.find("input").removeAttr("checked");
      }else {
        $(this).addClass("checked");
        $parent.removeClass("no_subcat_selected");
        $parent.find("input").attr("checked","checked");

        //  $(this).closest(".no_subcat_selected").removeClass(".no_subcat_selected");
      }



  }else {
      alert(690);
    if($(this).hasClass("checked"))
    {
      alert(563);

        $(this).removeClass("checked");
        $(this).find("input").removeAttr("checked");
        //uncheck all areas from root
         $(this).closest(".hasChildren").children(".single-account-category-shape").children(".all_subcats").each(function(){

           if($(this).hasClass("checked"))
           {
               alert(571);
                $(this).removeClass("checked");
                $(this).children("input").removeAttr("checked");
           }
         });


    }else {
      $(this).addClass("checked")
      $parent.find("input").attr("checked","checked");
    //    $(this).closest(".no_subcat_selected").removeClass(".no_subcat_selected");
    }
  }

});

*/

}


  var current_post_id;

  function init_generate_certificate()
  {

    if($(".btnGenerateCert").length < 1)
    {
      return 0;
    }
    //Sortable

    jQuery(".btnGenerateCert").on("click",function(e) {

      e.preventDefault();
      var seller = jQuery(this).data("seller");
      var inquiryId = jQuery(this).data("postid");

      jQuery.ajax({
        type : "post",
        url : ajaxurl,
        data    : {
          action    : 'generatePurchaseCert',
          inquiryId : inquiryId//, //'<?php echo $post->ID; ?>',
          //seller    : seller
        },
        success: function(response) {
          var result = JSON.parse(response);
          if (result.status == 0) {
          //  alert(result.message_container);
            alert(130);
            jQuery("body").append("<div class='absBox radius4 shadow text-center'><img src='http://pricebook.gr/pricebook/wp-content/themes/wp-bootstrap-starter/images/certificate/cert.svg'><p>Κάντε λήψη του πιστοποιητικού <a class='aqua' target='_blank' href='"+result.message+"'>εδώ</a></p></div>")
          }
          else {
            alert("ERROR "+result.message);
          }
        }
      });
      return false;
    });

    $(".absBox").live("click",function(){
        $(this).remove();
    });

  }

  function init_offer_chat()
  {
    if($("#comment_editor").length < 1)
    {
      return 0;
    }


    $(".editor-toggle-shape").on("click",function(){


      if($(this).hasClass("toggle-down"))
      {
        $(this).removeClass("toggle-down");
        $(this).addClass("toggle-up");

        TweenMax.to($("#comment_editor"),0.8,{bottom:-260,ease:Power2.easeOut});
      }else {
        $(this).addClass("toggle-down");
        $(this).removeClass("toggle-up");
        TweenMax.to($("#comment_editor"),0.8,{bottom:0,ease:Power2.easeOut});
      }
    });

    $(".application-details-toggle-shape").on("click",function(){


      if($(this).hasClass("toggle-down"))
      {
        $(this).removeClass("toggle-down");
        $(this).addClass("toggle-up");
        var height_n= $(".application-summary-shape").height();
        TweenMax.to($(".toggle-summary"),0.8,{height:height_n,ease:Power2.easeOut});

      }else {
        $(this).addClass("toggle-down");
        $(this).removeClass("toggle-up");
        TweenMax.to($(".toggle-summary"),0.8,{height:0,ease:Power2.easeOut});
      }
    });

    //.toggle-summary
  }

  function init_dragable()
  {
    if($(".drag-container").length < 1)
    {
      return 0;
    }


  }

  function init_application_view()
  {
    //View summary

    jQuery(".quick-read-button-shape").on("click",function(){

      if(jQuery(this).closest(".single_open_application-transform").hasClass("active"))
      {
        $("#dashboard_main").removeClass("max_index");
        jQuery(this).closest(".single_open_application-transform").removeClass("active");
      }else {
          $("#dashboard_main").addClass("max_index");
        jQuery(this).closest(".single_open_application-transform").addClass("active");
      }


      if( $(this).closest(".single_open_application-transform").find(".longlat_data").length > 0)
      {
        if(map_initialized)
        {
      //	alert($(this).closest(".single_open_application-transform").find(".longlat_data").html());
      //   var mapBox = new appMaps(longlat,"map_box","map_pb");
        var longlat = $(this).closest(".single_open_application-transform").find(".longlat_data").html();
        var longlat_array = longlat.split(",");

        var w = jQuery(".application-summary-transform").find(".application-summary-shape").width();
        //alert(w);
        $("#map_box").width(w);

        var m_h = w*0.5;
       $("#map_box").height(m_h);

         $("#map_box").appendTo($(this).closest(".single_open_application-transform").find(".summary-places"));
        //alert(longlat_array[0]+" "+longlat_array[1]);
       // mapBox = new appMaps(longlat_array[1],longlat_array[0],"map_box","map_mats");
          mapBox.setAppPosition(longlat_array[0],longlat_array[1]);
        }else {
        //	alert(2);
        //	 var mapBox = new appMaps(longlat,"map_box","map_pb");
          //mapBox.setAppPosition(longlat);
        }
      }

    });

    //Close summary

    jQuery(".close-quick-read").on("click",function(){

    });

    jQuery(".single_open_application-transform").find(".close_preview").on("click",function(){

      if(jQuery(this).closest(".single_open_application-transform").hasClass("active"))
      {
          $("#dashboard_main").removeClass("max_index");
        jQuery(this).closest(".single_open_application-transform").removeClass("active");
      }else {
          $("#dashboard_main").addClass("max_index");
        jQuery(this).closest(".single_open_application-transform").addClass("active");
      }
    });

  /*  .single_open_appliacation-col:hover .single_appllication_top-transform .white2-bg
    {
    background-color: #023344;

  }*/

    $(".single_open_appliacation-col").on("mouseenter",function(){
      TweenMax.to($(this).find(".single_appllication_top-transform").find(".white2-bg"),0.7,{backgroundColor:'#fbfbfb',ease:Power2.easeOut});
    });

    $(".single_open_appliacation-col").on("mouseleave",function(){
      TweenMax.to($(this).find(".single_appllication_top-transform").find(".white2-bg"),0.7,{backgroundColor:'#fdfdfd',ease:Power2.easeOut});
    });

  }

  function init_seller_gallery()
  {
    if($(".seller-image-gallery").length >0)
    {
    /*  $(".seller-image-gallery").masonry(
        {  columnWidth: 1,
          itemSelector: '.single-seller-gallery-image'
        }
      );*/
    }

    if($(".seller-page-gallery-shape").length >0)
    {
    /*  $(".seller-gallery-transform").masonry(
        {  columnWidth: 1,
          itemSelector: '.single-seller-gallery-image'
        }
      );*/
    }
  }

  function init_new_application()
  {

    if($(".selection-list-wrapper").length <1 )
    {
      return 0;
    }



    $(".selection-action-button").on("click",function(){

      $parent = $(this).closest(".select-category-input-shape");
      var opened = $parent.hasClass("open");

      $(".select-category-lists").find(".open").removeClass("open");

      if(!opened)
      {
        $parent.addClass('open');

      }

    });






  }

  function init_options_button()
  {
    if($(".options_button-shape").length <1 )
    {
      return 0;
    }

    $(".options_button-shape").on("click",function(){


      var $parent = $(this).closest(".action-box");
      if($parent.find(".options-wrapper").length > 0)
      {
        var menu_wrapper = $parent.find(".options-wrapper");

        if($parent.find(".options-wrapper").hasClass(".active"))
        {
          $parent.find(".options-wrapper").removeClass("active");
        }else {

          //  var options_anim = new TimelineMax();
          TweenMax.to(menu_wrapper,0.9,{right:'0%',ease:Power2.easeOut});
            TweenMax.staggerTo(menu_wrapper.find(".option-cell-transform"),1.05,{right:'0%',ease:Power2.easeOut},0.2);
        //
          /*  options_anim.play();*/
          $parent.find(".options-wrapper").addClass("active");

        }

      }

    });


    $(".options-back-button").on("click",function(){
      //    alert(1);
      var $parent = $(this).closest(".action-box");
      if($parent.find(".options-wrapper").length > 0)
      {
        var menu_wrapper = $parent.find(".options-wrapper");


        if($parent.find(".options-wrapper").hasClass("active"))
        {
          TweenMax.staggerTo(menu_wrapper.find(".option-cell-transform"),0.55,{right:'-200%',ease:Power2.easeIn},-0.2);
          TweenMax.to(menu_wrapper,1.15,{right:'-200%',ease:Power2.easeIn});

          //  $parent.find(".options-wrapper").removeClass("active");
        }else {
          $parent.find(".options-wrapper").addClass("active");

        }

      }

    });


    if($(".info-button-shape").length > 0)
    {
      $(".info-button-shape").on("click",function(){
          var parent = $(this).closest(".single_open_application-shape");
          var tm = new TimelineMax({paused:true});

          if($(this).hasClass("clicked"))
          {
            $(this).removeClass("clicked");

              tm.staggerTo(parent.find(".info_animate"),1,{right:-600, ease:Power2.easeOut},0.3,0);
              tm.to(parent.find(".info_animate_main"),1,{right:-600, ease:Power2.easeOut,onComplete:function(){$(".latest_messages-transform").addClass("hidden") ;}},0.3);

          }else {
            $(this).addClass("clicked");
            tm.to(parent.find(".info_animate_main"),0.5,{right:0, ease:Power2.easeOut});
            tm.staggerTo(parent.find(".info_animate"),1,{right:0, ease:Power2.easeOut},0.2,0);
            $(".latest_messages-transform").removeClass("hidden") ;
          }

          tm.play();

      });
    }


  }
  var side_menu_anim;
  var waypoint_anim;

  function init_menu()
  {

    if($("#side_menu").length <1 )
    {
      return 0;
    }
    console.log('init_menu');

    if($('.menu-small-action-button').length > 0)
    {
      $(".menu-small-action-button").on("click",function(){

        $parent = $(this).closest(".dashboard-menu-small-shape");

        if($parent.find(".menu-small-list-transform").hasClass("active"))
        {
          $(this).removeClass("active");
          $parent.find(".menu-small-list-transform").removeClass("active");
        }else {
          $(this).addClass('active');
          $parent.find(".menu-small-list-transform").addClass("active");
        }

      });
    }


    $(".dashboard_menu_link").on("mouseenter",function(){
    //  TweenMax.to($(this),1,{opacity:0.5,ease:Power2.easeOut});
    });

    $(".dashboard_menu_link").on("mouseleave",function(){
    //  TweenMax.to($(this),1,{opacity:1,ease:Power2.easeOut});
    });




    if($("#searchbox").length > 0)
    {

      $(".menu_search-shape").on("click",function(){


        $(".searchbox-transform").show();

      });

      $("#searchbox").find(".close").on("click",function(){

        $(".searchbox-transform").hide();

      });
    }


    side_menu_anim = new TimelineMax({paused:true});
    side_menu_anim.from($("#side_menu"),0.6,{width:0,left:-$(window).width()+"px",ease:Power2.easeout},0);
    side_menu_anim.from($("#side_menu").find(".close_trigger"),0.6,{opacity:0},0.3);


    $(".menu_burger-transform").on("click",function(){

      if($(this).hasClass("active"))
      {
        $(this).removeClass("active");
        side_menu_anim.reverse();
      } else
      {
        $(this).addClass("active");
        $("#side_menu").removeClass("invisible");
        side_menu_anim.play();
      }

    });

    $(".menu_close-window ").on("click",function(){

      if($(".menu_burger-transform").hasClass("active"))
      {
        $(".menu_burger-transform").removeClass("active");
        side_menu_anim.reverse();
      } else
      {
        $(".menu_burger-transform").addClass("active");
        side_menu_anim.play();
      }

    });

    $(".info_close-window").on("click",function(){

      if($("#message_area").hasClass("active"))
      {
        $("#message_area").removeClass("active");
        $("#message_area").fadeOut().addClass("hidden");

      }

    });

    $("#side_menu").find(".close_trigger").on("click",function(){

      if($(".menu_burger-transform").hasClass("active"))
      {
        $(".menu_burger-transform").removeClass("active");
        side_menu_anim.reverse();
      } else
      {
        $(".menu_burger-transform").addClass("active");
        side_menu_anim.play();
      }

    });




    $(".how-info-shape").on("click",function(){

      var $parent = $(this).closest(".single-how-transform");
      var target = $parent.data("details");
      $(".single-how-details-transform").addClass("hidden");

      if($parent.hasClass("active"))
      {
        $parent.removeClass("active");
        $(".single-how-transform").removeClass("opaque");

      } else
      {
        $parent.addClass("active");
        $(".single-how-transform").addClass("opaque");
        $parent.removeClass("opaque");
        $("#"+target).removeClass("hidden");
      }

    });

    $(".how_close-window").on("click",function(){
      $('#wrap').removeClass("hidden");
      $("#howitworks").addClass("hidden");
    });

    $(".how_it_works_btn").on("click",function(e){
      e.preventDefault();
      $('#wrap').addClass("hidden");
      $("#howitworks").removeClass("hidden");
    });
    var waypoint_anim_time = 0.3;
    waypoint_anim = new TimelineMax({paused:true});
    waypoint_anim.to($(".waypoint_scale"),waypoint_anim_time,{css:{scaleX:0.6,scaleY:0.6,top:-15}},0);
    waypoint_anim.to($(".waypoint_scale2"),waypoint_anim_time,{css:{scaleX:1,scaleY:1,top:-15}},0);
    waypoint_anim.to($(".waypoint_scale3"),waypoint_anim_time,{css:{scaleX:0.6,scaleY:0.6}},0);

    waypoint_anim.to($(".menu_main-shape"),waypoint_anim_time,{height:40},0);
    waypoint_anim.to($("#menu_offset"),waypoint_anim_time,{height:40},0);
    waypoint_anim.to($(".menu_link-transform"),waypoint_anim_time,{'padding-top':11},0);
    //waypoints
    //bluebar-trigger
    var waypoint = new Waypoint({
      element: $("#menu_trigger"),
      handler: function(direction) {
        //  alert(1);
        if(direction=='down')
        {
          $("#menu_section").addClass("menu_fixed");
        //  waypoint_anim.play();
        }
        //  alert('Basic waypoint triggered '+direction);
      },
      offset:-4
    });


    var waypoint = new Waypoint({
      element: $("#bluebar-trigger"),
      handler: function(direction) {
        //  alert(1);
        if(direction=='down')
        {
          $("#blue_bar").addClass("bluebar_fixed");
          $("#bluebar-trigger").addClass('height_offset');
          //waypoint_anim.play();
        }else {
          $("#blue_bar").removeClass("bluebar_fixed");
        }
        //  alert('Basic waypoint triggered '+direction);
      },
      offset:36
    });

    //menu_offset
    var waypoint = new Waypoint({
      element: $("#menu_offset"),
      handler: function(direction) {
        //alert(direction);
        if(direction=='up')
        {
          $("#blue_bar").removeClass("bluebar_fixed");
          $("#bluebar-trigger").removeClass('height_offset');
          //waypoint_anim.play();
          waypoint_anim.reverse();
        }
        //  alert('Basic waypoint triggered '+direction);
      },
      offset:-5
    });


    $(".arrow-down-avatar-shape").on("click",function(){

      $(".menutop-left-transform").toggleClass("showMenu");

    });

  }

  function init_filters()
  {
    console.log('init_menu');

    if($('.filters-action-button').length > 0)
    {/*
      $(".filters-action-button").on("click",function(){

      $parent = $(this).closest(".filters_shape");

      if($parent.hasClass("active"))
      {
      $(this).removeClass("active");
      $parent.find(".menu-small-list-transform").removeClass("active");
      $parent.find(".single-filter-transform").removeClass("selection");

    }else {
    $(this).addClass('active');
    $parent.addClass("active");
    $parent.find(".single-filter-transform").addClass("selection");
  }

});*/
}
}

function init_messages()
{
  console.log('init_msg 1');

  if($('.main_message').length > 0)
  {


    jQuery(".delete_msg").click(function(e) {
      e.preventDefault();


      var $msg_container = jQuery(this).closest(".single-message-transform");
      var id =$msg_container.data('message');
      jQuery.post(
        ajaxurl,
        {
          'action'		:	'deleteMessage',
          'messageId'	:	id
        },
        function (response) {
          var response = JSON.parse(response);
          if (response.status == 0) {
            $msg_container.remove();
          }
          else {
            alert(response.message);
          }
        });
    });

    $(".main_message").on("click",function(){


      var $msg_container = jQuery(this).closest(".single-message-transform");

      var id = jQuery(this).closest(".single-message-transform").data('message');


      jQuery.post(
        ajaxurl,
        {
          'action'		:	'markMessageRead',
          'messageId'	:	id
        },
        function (response) {
          var response = JSON.parse(response);
          if (response.status == 0) {
            $msg_container.find(".message-item:first").addClass("read");
          }
          else {
            //alert(response.message);
          }
        });


        $parent = $(this).closest(".single-message-shape");

        if($parent.hasClass("open"))
        {
          $parent.removeClass("open");


        }else {
          $parent.addClass('open');

        }

      });



    }
  }

  function init_images()
  {

  }

})(jQuery);

function initMap()
{
//  var mapBox = new appMaps("contact_tmpl","map_box","map_mats");
}
