function HideConfirm(parent)
{
  parent.find(".option-cell-transform-confirm").addClass("hidden");
  parent.find(".option-cell-transform-confirm").css("opacity",1);
}

function ShowConfirm(parent)
{
  parent.find(".option-cell-transform-confirm").removeClass("hidden");
}
jQuery(document).ready(function() {



  //Delete Inquiry

  jQuery(".canceldeleteInquiry").on("click",function(){

    var parent = jQuery(this).closest(".options-wrapper");

    var anim = new TimelineMax({paused:true,onComplete:HideConfirm,onCompleteParams:[parent]});
    anim.to(parent.find(".option-cell-transform-confirm"),0.2,{opacity:0});
    anim.staggerTo(parent.find(".option-cell-transform"),0.5,{opacity:1},0.3,0.2);

    anim.play();

  }
  );

  jQuery(".option-cell-shape.deleteInquiryConfirm").on("click",function(){

    var parent = jQuery(this).closest(".options-wrapper");

    var anim = new TimelineMax({paused:true});

    anim.staggerTo(parent.find(".option-cell-transform"),0.5,{opacity:0},0.3);
    anim.from(parent.find(".option-cell-transform-confirm"),0.5,{opacity:0},0.8);

    anim.play();
    ShowConfirm(parent);
  }
  );

  jQuery(".single-confirm-options.deleteInquiry").on("click",function(){

    var inquiryId = jQuery(this).data("value");
    var requestParent = jQuery(this).closest(".request_root");
    //alert(inquiryId);
    jQuery.post(
    ajaxurl,
    {
      'action':	'deleteInquiry',
      'data':		{
        'inquiryId'		:	inquiryId
        //'inquiry_direct_seller'				:	inquiry_direct_seller,
      }
    },
    function (response) {
      var response = JSON.parse(response);
      jQuery('html, body').animate({
        scrollTop: 0
      }, 500);
      if (response.status == 1) {
        console.log(" 0 "+response.message);
        jQuery('#message_area').find(".message_text").html(response.message);
        jQuery('#message_area').removeClass("hidden").fadeIn();
        jQuery('#message_area').addClass("active");
        requestParent.remove();
      }
      else {
        console.log(" else  "+response.message);
        jQuery('#message_area').find(".message_text").html(response.message);
        jQuery('#message_area').removeClass("hidden").fadeIn();
        jQuery('#message_area').addClass("active");
      }

    }
    );
    return false;
  });

  jQuery(".close_renew").on("click",function(){
    jQuery(".option-cell-shape.updateInquiry").trigger("click");
  });

  //Update inquiry end date  updateInquiry
  jQuery(".option-cell-shape.updateInquiry").on("click", function(e) {
    var inquiryId = jQuery(this).data("value");


    if (jQuery("#renewInquiry:visible").length == 1) {
      jQuery("#renewInquiry").fadeOut();
      jQuery(".body_mask").fadeOut();
      jQuery("#renewInquiry input[type='hidden']").val();
    }
    else {
      jQuery(".body_mask").fadeIn();
      jQuery("#renewInquiry").fadeIn();
      jQuery("#renewInquiry input[type='hidden']").val(inquiryId);
    }
  });
  jQuery('#renewInquiry input[type="submit"]').live("click", function(e) {
    e.preventDefault();

    jQuery.ajax({
      url : ajaxurl,
      type : 'post',
      data : {
        action : 'renewInquiry',
        inquiryId : jQuery("#renewInquiry input[name='inquiryId']").val(),
        date	:	jQuery("#renewInquiry input[name='inquiry_end_date']").val()
      },
      success : function( response ) {
        var data = JSON.parse(response);
        console.log(data);
        if (data.status == 1) {
          alert('Error '+data.message);
        }
        else {
          alert(data.message);
        }
        window.location.reload();

      }
    });
    return false;
  });




}); //end ready
