//Update inquiry end date
jQuery('.buyer-actions .action[data-action=update]').live("click", function(e) {
	var target = jQuery(this).parent('.buyer-actions').attr('data-target');

	if (jQuery("#renewInquiry:visible").length == 1) {
		jQuery("#renewInquiry").fadeOut();
		jQuery(".body_mask").fadeOut();
		jQuery("#renewInquiry input[type='hidden']").val();
	}
	else {
		jQuery(".body_mask").fadeIn();
		jQuery("#renewInquiry").fadeIn();
		jQuery("#renewInquiry input[type='hidden']").val(target);
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
//Delete inquiry
jQuery('.buyer-actions .action[data-action=delete]').live("click", function(e) {
	e.preventDefault();
	var target = jQuery(this).parent(".buyer-actions").attr('data-target');

	jQuery.ajax({
		url : ajaxurl,
		type : 'post',
		data : {
			action : 'deleteInquiry',
			inquiryId : target
		},
		success : function( response ) {
			var data = JSON.parse(response);
			console.log(data);
			if (data.status == 0) {
				alert(data.message);
			}
			else {
				alert(data.message);
			}
			window.location.reload();
		}
	});
	return false;
});
