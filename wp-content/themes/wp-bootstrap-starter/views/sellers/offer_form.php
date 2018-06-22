<?php
	if (get_field('inquiry_status') == 'complete') {
		$mine = getOffer($post->ID,get_current_user_id());
		foreach ($mine as $theOffer) {
			if (intval($theOffer[0]['inquiry_seller']['ID']) == intval(get_current_user_id())) {
				$offer = $theOffer[0];
				break;
			}
		}
	}

?>
<form method="post" id="sendOffer" data-hasOffer="<?php if (!empty($offer)) { echo '1'; } else { echo '0'; } ?>">
  <input type="hidden" name="inquiryId" value="<?php echo $post->ID; ?>" />
  <div class="col-12 text-center">
    <div class="row">
      <div class="col-6">
        <div class="row">
          Τιμή μονάδος
        </div>
        <div class="row">
          <input type="text" name="inquiry_seller_unit_cost" value="<?php echo (isset($offer['inquiry_seller_unit_cost']) ? $offer['inquiry_seller_unit_cost'] : NULL); ?>" <?php if (get_field('inquiry_status',$post->ID) == 'complete') { echo 'disabled'; } ?>/>
        </div>
      </div>
      <div class="col-6" style="visibility:<?php echo ($isService ? 'hidden' : 'visible'); ?>">
        <div class="row">
          Μεταφορικά
        </div>
        <div class="row">
          <input type="text" name="inquiry_shipping_cost" value="<?php echo (isset($offer['inquiry_seller_delivery_cost']) ? $offer['inquiry_seller_delivery_cost'] : NULL); ?>" <?php if (get_field('inquiry_status',$post->ID) == 'complete') { echo 'disabled'; } ?>/>
        </div>
      </div>
    </div>

    <div class="row">
			<div class="col-6" style="visibility:<?php echo ($isService ? 'hidden' : 'visible'); ?>">
	      <div class="row">
	        Ποσότητα
	      </div>
	      <div class="row">
	        <input type="number" name="inquiry_quantity" value="<?php if (is_null($offer['inquiry_seller_quantity'])) { echo get_field('inquiry_product_quantities',$post->ID); } else { echo get_field('inquiry_product_quantities',$post->ID); } ?>" disabled />
	      </div>
    	</div>
			<div class="col-6" style="visibility:<?php echo ($isService ? 'hidden' : 'visible'); ?>">
	      <div class="row">
	        Αντικαταβολή
	      </div>
	      <div class="row">
	        <input type="text" name="inquiry_cashondelivery_cost" value="<?php echo (isset($offer['inquiry_seller_cashondelivery_cost']) ? $offer['inquiry_seller_cashondelivery_cost'] : NULL); ?>"<?php if (get_field('inquiry_status',$post->ID) == 'complete') { echo 'disabled'; } ?>/>
	      </div>
	    </div>
    </div>
    <div class="row nopadding text-left">
      <div class="col-12 nopadding">
        <?php if (get_field('inquiry_status',$post->ID) != 'complete') { ?><input type="submit" class="btn btn-primary" value="Αποστολή προσφοράς" /> <?php } ?>
      </div>
    </div>
		<div class="row nopadding text-left">
      <div class="col-12 nopadding">
				<h3>Συνολικό κόστος προσφοράς: <span id="totalCost"><?php
				if ($isService) {
					$total = $offer['inquiry_seller_unit_cost'];
				}
				else {
					$total = (number_format((float)$offer['inquiry_seller_quantity'], 2, '.', '') * number_format((float)$offer['inquiry_seller_unit_cost'], 2, '.', '') + number_format((float)$offer['inquiry_seller_cashondelivery_cost'], 2, '.', '') + number_format((float)$offer['inquiry_seller_delivery_cost'], 2, '.', '') );
				}
				?><?php echo $total; ?></span></h3>
			</div>
		</div>

  </div>
</form>

<script type="text/javascript">
  jQuery("#sendOffer").submit(function(e) {
    e.preventDefault();
		alert(1);
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
           var result = JSON.parse(response);
           if (result.status == 0) {
						 alert(result.message);
             window.location.reload();
           }
           else {
             alert(result.message);
           }
         }
      });
  });
	jQuery("form input").keyup(function() {
		if (jQuery(this).val().indexOf(',') != -1) {
			jQuery(this).val(jQuery(this).val().replace(',','.'));
		}
		if (!isNaN(parseFloat(jQuery('form input[name="inquiry_quantity"]').val()))) {
			var qty = parseFloat(jQuery('form input[name="inquiry_quantity"]').val());
		}
		else {
			var qty = 0;
		}
		if (!isNaN(parseFloat(jQuery('form input[name="inquiry_seller_unit_cost"]').val()))) {
			var unitcost = parseFloat(jQuery('form input[name="inquiry_seller_unit_cost"]').val());
		}
		else {
			var unitcost = 0;
		}
		if (!isNaN(parseFloat(jQuery('form input[name="inquiry_cashondelivery_cost"]').val()))) {
			var cashcost = parseFloat(jQuery('form input[name="inquiry_cashondelivery_cost"]').val());
		}
		else {
			var cashcost = 0;
		}
		if (!isNaN(parseFloat(jQuery('form input[name="inquiry_shipping_cost"]').val()))) {
			var scost = parseFloat(jQuery('form input[name="inquiry_shipping_cost"]').val());
		}
		else {
			var scost = 0;
		}
		var isService = '<?php echo $isService; ?>';
		if (isService == 1) {
			var total = unitcost;
		}
		else {
			var total = (qty * unitcost)+cashcost+scost;
		}
		if (total > '0') {
			jQuery("#totalCost").text(total);
		}
		else {
			jQuery("#totalCost").text(0);
		}
	});
</script>
