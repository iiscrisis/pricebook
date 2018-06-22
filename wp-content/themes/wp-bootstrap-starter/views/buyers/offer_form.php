<?php
	$qty  = (isset($offer['inquiry_seller_quantity']) ? $offer['inquiry_seller_quantity'] : 0);
	$cost = (isset($offer['inquiry_seller_unit_cost']) ? $offer['inquiry_seller_unit_cost'] : 0);
	$shipping = (isset($offer['inquiry_seller_delivery_cost']) ? $offer['inquiry_seller_delivery_cost'] : 0);
	$cash = (isset($offer['inquiry_seller_cashondelivery_cost']) ? $offer['inquiry_seller_cashondelivery_cost'] : 0);
?>
	<input type="hidden" name="inquiryId" value="<?php echo $post->ID; ?>" />


  <div class="col-12 text-center">
		<div class="col-12">
			<div class="row">
				Ημ/νια προσφοράς
			</div>
			<div class="row"><?php echo (isset($offer['inquiry_seller_actiondate']) ? $offer['inquiry_seller_actiondate'] : NULL); ?></div>
		</div>
    <div class="row">
	      <div class="col-6">
	        <div class="row">
	          Τιμή μονάδος
	        </div>
	        <div class="row"><?php echo (isset($offer['inquiry_seller_unit_cost']) ? $offer['inquiry_seller_unit_cost'] : NULL); ?></div>
	      </div>
			<?php if (!$isService) { ?>
				<div class="col-6">
	        <div class="row">
	          Μεταφορικά
	        </div>
	        <div class="row"><?php echo (isset($offer['inquiry_seller_delivery_cost']) ? $offer['inquiry_seller_delivery_cost'] : NULL); ?></div>
	      </div>
			<?php } ?>
    </div>
    <div class="row">
			<?php if (!$isService) { ?>
				<div class="col-6">
	        <div class="row">
	          Ποσότητα
	        </div>
	        <div class="row"><?php echo (isset($offer['inquiry_seller_quantity']) ? $offer['inquiry_seller_quantity'] : NULL); ?></div>
	      </div>
	      <div class="col-6">
	        <div class="row">
	          Αντικαταβολή
	        </div>
	        <div class="row"><?php echo (isset($offer['inquiry_seller_cashondelivery_cost']) ? $offer['inquiry_seller_cashondelivery_cost'] : NULL); ?></div>
	      </div>
			<?php } ?>
    </div>
    <div class="row">
      <div class="col-12 text-center">
        <div class="row">
					<?php
						if (!$isService) {
							if ($qty != 0 && $cost != 0) { $total = ($cost * $qty) + $cash + $shipping; }
							elseif ($qty == 0 && $cost != 0) { $total = $cost + $cash + $shipping; }
							else { $total = 0; }
						}
						else {
							if ($qty != 0 && $cost != 0) { $total = ($cost * $qty); }
							elseif ($qty == 0 && $cost != 0) { $total = $cost; }
							else { $total = 0; }
						}
					?>
						<?php if ($total != 0) { ?>
							<h3>Σύνολο <?php echo $total; ?>&euro;</h3>
					<?php } else { ?>
						<h3>Χωρίς τιμή</h3>
					<?php } ?>
				</div>
      </div>
    </div>
		<?php if ($status == 'active') { ?>
			<div class="row buyer-offer-actions">
	      <div class="col-4">
	        <a href="#" class="offer-complete">
	          <span class="glyphicon glyphicon-ok"></span>
	          <strong>ΟΛΟΚΛΗΡΩΣΗ</strong>
	        </a>
	      </div>
	      <div class="col-4">
	        <a href="#" class="offer-intrested">
						<?php if ($offer['inquiry_seller_interesting'] == 1) { ?>
	          	<span class="glyphicon glyphicon-star"></span>
	          	<strong>ΔΕΝ EΝΔΙΑΦΕΡΟΜΑΙ</strong>
						<?php } else { ?>
							<span class="glyphicon glyphicon-star-empty"></span>
	          	<strong>EΝΔΙΑΦΕΡΟΜΑΙ</strong>
						<?php } ?>
	        </a>
	      </div>
	      <div class="col-4">
	        <a href="#" class="offer-ignore">
	          <span class="glyphicon glyphicon-remove"></span>
	          <strong>ΑΠΟΡΡΙΨΗ</strong>
	        </a>
	      </div>
	    </div>
		<?php } ?>
  </div>
<script type="text/javascript">
  jQuery("#sendOffer").submit(function(e) {
    e.preventDefault();

      jQuery.ajax({
         type : "post",
         url : ajaxurl,
         data : {
           action                       : "placeOffer",
           inquiryId                    : jQuery('#sendOffer input[name="inquiryId"]').val(),
           inquiry_seller_unit_cost     : jQuery('#sendOffer input[name="inquiry_seller_unit_cost"]').val(),
           inquiry_shipping_cost        : jQuery('#sendOffer input[name="inquiry_shipping_cost"]').val(),
           inquiry_quantity             : jQuery('#sendOffer input[name="inquiry_quantity"]').val(),
           inquiry_cashondelivery_cost  : jQuery('#sendOffer input[name="inquiry_cashondelivery_cost"]').val(),
         },
         success: function(response) {

         }
      });
  });
  jQuery(".buyer-offer-actions a").click(function(e) {
    e.preventDefault();
    var action = jQuery(this).attr("class");
    var run = '';
    switch (action) {
      case 'offer-complete':
        run = 'markOfferComplete';
        break;
      case 'offer-intrested':
        run = 'MarkInterestingOffer';
        break;
      case 'offer-ignore':
        run = 'ignoreOffer';
        break;
      default:
        return false;
        break;
    }

    jQuery.ajax({
       type : "post",
       url : ajaxurl,
			 dataType	: 'html',
       data : {
         action     : run,
         inquiryId  : '<?php echo $post->ID; ?>',
         seller     : '<?php echo $_REQUEST['seller']; ?>'
       },
       success: function(response) {
				 var result = JSON.parse(response);
				 if (result.status == 0) {
           /*not used anymore
					 jQuery(result.message).appendTo("body");
					 jQuery(".body_mask").show();
					 jQuery("#rankInquiry").show();
					 jQuery("#rankInquiry button").live("mouseover", function() {
						 jQuery(this).find(".glyphicon").removeClass("glyphicon-star-empty").addClass("glyphicon-star");
					 });
					 jQuery("#rankInquiry button").live("mouseout", function() {
						 jQuery(this).find(".glyphicon").removeClass("glyphicon-star").addClass("glyphicon-star-empty");
					 });

					 jQuery("#rankInquiry button").live("click", function(e) {
						 var value = jQuery(this).val();
						 jQuery.ajax({
							 'type'	: 'post',
							 'url'	:	ajaxurl,
							 'data'	:	{
								 action	:	'rankSeller',
								 inquiryId	:	'<?php echo $post->ID; ?>',
								 seller			:	'<?php echo $_REQUEST['seller']; ?>',
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
           */
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
