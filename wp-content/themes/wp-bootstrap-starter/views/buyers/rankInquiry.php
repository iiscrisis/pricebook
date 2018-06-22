<form method="post" id="rankInquiry" action="" class="text-center">
  <input type="hidden" name="inquiryId" value="<?php echo $id; ?>" />
  <h3>Rank seller <?php echo get_field('seller_companyName','user_'.$seller); ?></h3>
  <div class="col-12">
		<button type="button" class="btn btn-default btn-sm" value="1"><span class="glyphicon glyphicon-star-empty"></span></button>
		<button type="button" class="btn btn-default btn-sm" value="2"><span class="glyphicon glyphicon-star-empty"></span></button>
		<button type="button" class="btn btn-default btn-sm" value="3"><span class="glyphicon glyphicon-star-empty"></span></button>
		<button type="button" class="btn btn-default btn-sm" value="4"><span class="glyphicon glyphicon-star-empty"></span></button>
		<button type="button" class="btn btn-default btn-sm" value="5"><span class="glyphicon glyphicon-star-empty"></span></button>
  </div>
</form>
<script type="text/javascript">
jQuery(".openRankInquiry").live("click", function(e) {
	e.preventDefault();
	if (jQuery("#rankInquiry:visible").length == 0) {
		jQuery(".body_mask").fadeIn();
		jQuery("#rankInquiry").fadeIn();
	}
	return false;
});
jQuery("#rankInquiry button").live("click", function(e) {
	var value = jQuery(this).val();
	jQuery.ajax({
		'type'	: 'post',
		'url'	:	ajaxurl,
		'data'	:	{
			action	:	'rankSeller',
			seller			:	'<?php echo $_GET['seller']; ?>',
			val				:	value
		},
		success: function(response) {
			var result = JSON.parse(response);
			if (result.status == 0) {
				jQuery("#rankInquiry").html(result.message);
				jQuery("#rankInquiry").delay(1500).fadeOut();
				jQuery(".body_mask").delay(1500).fadeOut();
				alert(result.message);
				window.location.reload();
			}
			else {
				alert(result.message);
				return false;
			}
		}
	});
});
</script>
