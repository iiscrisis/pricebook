<?php
  $offers = getAllOffers($post->ID);
  $status = get_field('inquiry_status',$post->ID);
?>
<div class="col-md-8">
	<h2>Offers</h2>
	<?php if (!empty($offers['best'][0]) && $status != 'complete') { ?>
		<h3>Καλύτερη προσφορά</h3>
		<div class="row offer" data-seller="<?php echo $offers['best'][0]['inquiry_seller']['ID']; ?>" style="background:#c2c2c2;margin-bottom:10px;">
			<div class="col-12">
				<div class="col-md-2 ">
					<div class="row">
						<div class="col-md-12 text-center">
              <?php echo get_avatar($offers['best'][0]['inquiry_seller']['ID']); ?>
            </div>
					</div>
					<div class="row">
						<div class="col-md-12 text-center">
							<a href="/sellerprofile/?seller=<?php echo $offers['best'][0]['inquiry_seller']['ID']; ?>">
								<?php echo get_field('seller_companyName','user_'.$offers['best'][0]['inquiry_seller']['ID']); ?>
							</a>
						</div>
					</div>
				</div>
				<div class="col-md-6 text-center">
					<div class="row">
						<div class="col-6">
							<div class="row">
								Τιμή μονάδος
							</div>
							<div class="row">
                <?php echo (isset($offers['best'][0]['inquiry_seller_unit_cost']) ? $offers['best'][0]['inquiry_seller_unit_cost'] : NULL); ?></div>
						</div>
            <?php if (!$isService) { ?>
  						<div class="col-6">
  							<div class="row">
  								Μεταφορικά
  							</div>
  							<div class="row">
                  <?php echo (isset($offers['best'][0]['inquiry_seller_delivery_cost']) ? $offers['best'][0]['inquiry_seller_delivery_cost'] : NULL); ?></div>
  						</div>
            <?php } ?>
					</div>
          <?php if (!$isService) { ?>
  					<div class="row">
  						<div class="col-6">
  						<div class="row">
  							Ποσότητα
  						</div>
  						<div class="row"><?php echo (isset($offers['best'][0]['inquiry_seller_quantity']) ? $offers['best'][0]['inquiry_seller_quantity'] : NULL); ?></div>
  					</div>
  						<div class="col-6">
  						<div class="row">
  							Αντικαταβολή
  						</div>
  						<div class="row"><?php echo (isset($offers['best'][0]['inquiry_seller_cashondelivery_cost']) ? $offers['best'][0]['inquiry_seller_cashondelivery_cost'] : NULL); ?></div>
  					</div>
  					</div>
          <?php } ?>
				</div>
				<div class="col-md-2 text-center">Σε αναμονή</div>
				<div class="col-md-2 text-center">
					Συνολο <?php
          if ($isService) { $offers['best'][0]['inquiry_seller_quantity'] = 1; }
          $total = (number_format((float)$offers['best'][0]['inquiry_seller_quantity'], 2, '.', '') * number_format((float)$offers['best'][0]['inquiry_seller_unit_cost'], 2, '.', '') + number_format((float)$offers['best'][0]['inquiry_seller_cashondelivery_cost'], 2, '.', '') + number_format((float)$offers['best'][0]['inquiry_seller_delivery_cost'], 2, '.', '') );
          echo $total;
          ?>
					<a class="btn btn-default btnMarkInterestingOffer" data-seller="<?php echo $offers['best'][0]['inquiry_seller']['ID']; ?>" href="">
						<span class="glyphicon glyphicon-star<?php if ($offers['best'][0]['inquiry_seller_interesting']) { ?>"> <?php } else { ?>-empty">
						<?php } ?>
					</a>
					<a class="btn btn-default" href="<?php echo get_permalink($post->ID)?>?seller=<?php echo $offers['best'][0]['inquiry_seller']['ID']; ?>">ΔΕΙΤΕ ΤΗΝ</a>
					<a class="btn btn-default btnIgnoreOffer" data-seller="<?php echo $offers['best'][0]['inquiry_seller']['ID']; ?>" href="#">ΑΓΝΟΗΣΗ</a>
					<button type="button" class="btn btn-default btn-sm btnAddSeller" data-seller="<?php echo $offers['best'][0]['inquiry_seller']['ID']; ?>">
						<span class="glyphicon glyphicon-user"></span>Add to my sellers
					</button>
					<button type="button" class="btn btn-default btn-sm btnAddSellerBlacklist" data-seller="<?php echo $offers['best'][0]['inquiry_seller']['ID']; ?>">
						<span class="glyphicon glyphicon-alert"></span>Add to blacklist
					</button>


					<button type="button" class="btn btn-default btn-sm offer-complete" data-seller="<?php echo $offers['best'][0]['inquiry_seller']['ID']; ?>">
						<span class="glyphicon glyphicon-alert"></span>ΟΛΟΚΛΗΡΩΣΗ
					</button>


				</div>
				<div class="col-md-2 text-center">
					Ημ/νια προσφοράς <?php echo $offers['best'][0]['inquiry_seller_actiondate']; ?>
				</div>
			</div>
		</div>
	<?php } ?>
	<?php if (!empty($offers['interesting']) && $status != 'complete') { ?>
		<h3>Επιλεγμένες ενδιαφέρουσες προσφορές</h3>
		<?php foreach($offers['interesting'] as $offer) { ?>
			<?php
        if ($isService) { $offer['inquiry_seller_quantity'] = 1; }
				$total = (number_format((float)$offer['inquiry_seller_quantity'], 2, '.', '') * number_format((float)$offer['inquiry_seller_unit_cost'], 2, '.', '') + number_format((float)$offer['inquiry_seller_cashondelivery_cost'], 2, '.', '') + number_format((float)$offer['inquiry_seller_delivery_cost'], 2, '.', '') );
				$nextBest = ($total == $offers['nextBest'] ? true : false);
			?>
			<div class="row offer" data-seller="<?php echo $offer['inquiry_seller']['ID']; ?>" style="background:<?php echo ($nextBest ? 'lightgreen' : '#c2c2c2') ?>;margin-bottom:10px;">
				<div class="col-12">
					<div class="col-md-2 ">
						<div class="row">
							<div class="col-md-12 text-center"><?php echo get_avatar($offer['inquiry_seller']['ID']); ?></div>
						</div>
						<div class="row">
							<div class="col-md-12 text-center">
								<a href="/sellerprofile/?seller=<?php echo $offer['inquiry_seller']['ID']; ?>">
									<?php echo get_field('seller_companyName','user_'.$offer['inquiry_seller']['ID']); ?>
								</a>
							</div>
						</div>
					</div>
					<div class="col-md-6 text-center">
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
              <?php if (!$isService) { ?>
    						<div class="row">
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
    						</div>
            <?php } ?>
					</div>
					<div class="col-md-2 text-center">Σε αναμονή</div>
					<div class="col-md-2 text-center">
						Συνολο <?php echo $total; ?>
						<a class="btn btn-default btnMarkInterestingOffer" data-seller="<?php echo $offer['inquiry_seller']['ID']; ?>" href="">
							<span class="glyphicon glyphicon-star<?php if ($offer['inquiry_seller_interesting']) { ?>"> <?php } else { ?>-empty">
							<?php } ?>
						</a>
            <a class="btn btn-default" href="<?php echo get_permalink($post->ID)?>?seller=<?php echo $offer['inquiry_seller']['ID']; ?>">ΔΕΙΤΕ ΤΗΝ</a>
            <a class="btn btn-default btnIgnoreOffer" data-seller="<?php echo $offer['inquiry_seller']['ID']; ?>" href="#">ΑΓΝΟΗΣΗ</a>
						<button type="button" class="btn btn-default btn-sm btnAddSeller" data-seller="<?php echo $offer['inquiry_seller']['ID']; ?>">
		          <span class="glyphicon glyphicon-user"></span>Add to my sellers
		        </button>
						<button type="button" class="btn btn-default btn-sm btnAddSellerBlacklist" data-seller="<?php echo $offer['inquiry_seller']['ID']; ?>">
		          <span class="glyphicon glyphicon-alert"></span>Add to blacklist
		        </button>
						<button type="button" class="btn btn-default btn-sm offer-complete" data-seller="<?php echo $offer['inquiry_seller']['ID']; ?>">
							<span class="glyphicon glyphicon-alert"></span>ΟΛΟΚΛΗΡΩΣΗ
						</button>
          </div>
					<div class="col-md-2 text-center">
						Ημ/νια προσφοράς <?php echo $offer['inquiry_seller_actiondate']; ?>
					</div>
				</div>
			</div>
		<?php } ?>
	<?php } ?>
	<hr />
	<?php if (!empty($offers['pending']) && $status != 'complete') { ?>
		<h3>ΥΠΟΛΟΙΠΕΣ ΠΡΟΣΦΟΡΕΣ</h3>
    <?php foreach ($offers['pending'] as $pending) { ?>
			<?php
        if ($isService) { $pending['inquiry_seller_quantity'] =1; }
				$total = (number_format((float)$pending['inquiry_seller_quantity'], 2, '.', '') * number_format((float)$pending['inquiry_seller_unit_cost'], 2, '.', '') + number_format((float)$pending['inquiry_seller_cashondelivery_cost'], 2, '.', '') + number_format((float)$pending['inquiry_seller_delivery_cost'], 2, '.', '') );
				$nextBest = ($total == $offers['nextBest'] ? true : false);
			?>
      <div class="row offer" data-seller="<?php echo $pending['inquiry_seller']['ID']; ?>" style="background:<?php echo ($nextBest ? 'lightgreen' : '#c2c2c2') ?>;margin-bottom:10px;">
			<!--<div class="row offer" data-seller="<?php echo $pending['inquiry_seller']['ID']; ?>" style="background:#c2c2c2;margin-bottom:10px;">-->
        <div class="col-12">
          <div class="col-md-2 ">
            <div class="row">
              <div class="col-md-12 text-center"><?php echo get_avatar($pending['inquiry_seller']['ID']); ?></div>
            </div>
            <div class="row">
              <div class="col-md-12 text-center">
                <a href="/sellerprofile/?seller=<?php echo $pending['inquiry_seller']['ID']; ?>">
									<?php echo get_field('seller_companyName','user_'.$pending['inquiry_seller']['ID']); ?>
								</a>
              </div>
            </div>
          </div>
          <div class="col-md-6 text-center">
            <div class="row">
              <div class="col-6">
                <div class="row">
                  Τιμή μονάδος
                </div>
                <div class="row"><?php echo (isset($pending['inquiry_seller_unit_cost']) ? $pending['inquiry_seller_unit_cost'] : NULL); ?></div>
              </div>
              <?php if (!$isService) { ?>
                <div class="col-6">
                  <div class="row">
                    Μεταφορικά
                  </div>
                  <div class="row"><?php echo (isset($pending['inquiry_seller_delivery_cost']) ? $pending['inquiry_seller_delivery_cost'] : NULL); ?></div>
                </div>
              <?php } ?>
            </div>
            <?php if (!$isService) { ?>
              <div class="row">
                <div class="col-6">
                <div class="row">
                  Ποσότητα
                </div>
                <div class="row"><?php echo (isset($pending['inquiry_seller_quantity']) ? $pending['inquiry_seller_quantity'] : NULL); ?></div>
              </div>
                <div class="col-6">
                <div class="row">
                  Αντικαταβολή
                </div>
                <div class="row"><?php echo (isset($pending['inquiry_seller_cashondelivery_cost']) ? $pending['inquiry_seller_cashondelivery_cost'] : NULL); ?></div>
              </div>
              </div>
            <?php } ?>
          </div>
          <div class="col-md-2 text-center">Σε αναμονή</div>
          <div class="col-md-2 text-center">
						Συνολο <?php echo $total; ?>
						<a class="btn btn-default btnMarkInterestingOffer" data-seller="<?php echo $pending['inquiry_seller']['ID']; ?>" href="">
							<span class="glyphicon glyphicon-star<?php if ($pending['inquiry_seller_interesting']) { ?>"> <?php } else { ?>-empty">
							<?php } ?>
						</a>
            <a class="btn btn-default" href="<?php echo get_permalink($post->ID)?>?seller=<?php echo $pending['inquiry_seller']['ID']; ?>">ΔΕΙΤΕ ΤΗΝ</a>
            <a class="btn btn-default btnIgnoreOffer" data-seller="<?php echo $pending['inquiry_seller']['ID']; ?>" href="#">ΑΓΝΟΗΣΗ</a>
						<button type="button" class="btn btn-default btn-sm btnAddSeller" data-seller="<?php echo $pending['inquiry_seller']['ID']; ?>">
		          <span class="glyphicon glyphicon-user"></span>Add to my sellers
		        </button>
						<button type="button" class="btn btn-default btn-sm btnAddSellerBlacklist" data-seller="<?php echo $pending['inquiry_seller']['ID']; ?>">
		          <span class="glyphicon glyphicon-alert"></span>Add to blacklist
		        </button>
						<button type="button" class="btn btn-default btn-sm offer-complete" data-seller="<?php echo $pending['inquiry_seller']['ID']; ?>">
							<span class="glyphicon glyphicon-alert"></span>ΟΛΟΚΛΗΡΩΣΗ
						</button>
          </div>
					<div class="col-md-2 text-center">
						Ημ/νια προσφοράς <?php echo $pending['inquiry_seller_actiondate']; ?>
					</div>
        </div>
      </div>
    <?php } ?>
  <?php } ?>
  <?php if (!empty($offers['succeeded']) && $status == 'complete') { ?>
    <?php foreach ($offers['succeeded'] as $succeeded) { ?>
      <div class="col-md-12 offer" data-seller="<?php echo $succeeded['inquiry_seller']['ID']; ?>" style="background:#c2c2c2">
        <div class="row">

          <div class="col-md-2 ">
            <div class="row">
              <div class="col-md-12 text-center"><?php echo get_avatar($succeeded['inquiry_seller']['ID']); ?></div>
            </div>
            <div class="row">
              <div class="col-md-12 text-center">
                <a href="/sellerprofile/?seller=<?php echo $succeeded['inquiry_seller']['ID']; ?>">
									<?php echo get_field('seller_companyName','user_'.$succeeded['inquiry_seller']['ID']); ?>
								</a>
              </div>
            </div>
          </div>

          <div class="col-md-6 text-center">
            <div class="row">
              <div class="col-6">
                <div class="row">
                  Τιμή μονάδος
                </div>
                <div class="row"><?php echo (isset($succeeded['inquiry_seller_unit_cost']) ? $succeeded['inquiry_seller_unit_cost'] : NULL); ?></div>
              </div>
              <?php if (!$isService) { ?>
                <div class="col-6">
                  <div class="row">
                    Μεταφορικά
                  </div>
                  <div class="row"><?php echo (isset($succeeded['inquiry_seller_delivery_cost']) ? $succeeded['inquiry_seller_delivery_cost'] : NULL); ?></div>
                </div>
              <?php } ?>
            </div>
            <?php if (!$isService) { ?>
              <div class="row">
                <div class="col-6">
                <div class="row">
                  Ποσότητα
                </div>
                <div class="row"><?php echo (isset($succeeded['inquiry_seller_quantity']) ? $succeeded['inquiry_seller_quantity'] : NULL); ?></div>
              </div>
                <div class="col-6">
                <div class="row">
                  Αντικαταβολή
                </div>
                <div class="row"><?php echo (isset($succeeded['inquiry_seller_cashondelivery_cost']) ? $succeeded['inquiry_seller_cashondelivery_cost'] : NULL); ?></div>
              </div>
              </div>
            <?php } ?>
          </div>

          <div class="col-2 text-center">Ολοκληρωμένη</div>
          <div class="col-2 text-center">
						Συνολο <?php
            if ($isService) { $succeeded['inquiry_seller_quantity'] = 1; }
            $total = (number_format((float)$succeeded['inquiry_seller_quantity'], 2, '.', '') * number_format((float)$succeeded['inquiry_seller_unit_cost'], 2, '.', '') + number_format((float)$succeeded['inquiry_seller_cashondelivery_cost'], 2, '.', '') + number_format((float)$succeeded['inquiry_seller_delivery_cost'], 2, '.', '') );
            echo $total; ?>
            <a class="btn btn-default" href="<?php echo get_permalink($post->ID)?>?seller=<?php echo $succeeded['inquiry_seller']['ID']; ?>">ΔΕΙΤΕ ΤΗΝ</a>
						<button type="button" class="btn btn-default btn-sm btnAddSeller" data-seller="<?php echo $succeeded['inquiry_seller']['ID']; ?>">
		          <span class="glyphicon glyphicon-user"></span>Add to my sellers
		        </button>
						<button type="button" class="btn btn-default btn-sm btnAddSellerBlacklist" data-seller="<?php echo $succeeded['inquiry_seller']['ID']; ?>">
		          <span class="glyphicon glyphicon-alert"></span>Add to blacklist
		        </button>
						<a class="btnGenerateCert" data-seller="<?php echo $succeeded['inquiry_seller']['ID']; ?>" href="">Δημιουργία Πιστοποιητικού Έρευνας Αγοράς</a>
          </div>
					<div class="col-md-2 text-center">
						Ημ/νια προσφοράς <?php echo $succeeded['inquiry_seller_actiondate']; ?>
					</div>
        </div>
      </div>
    <?php } ?>
  <?php } ?>
	<?php if (!empty($offers['failed']) && $status == 'complete') { ?>
    <?php foreach ($offers['failed'] as $failed) { ?>
      <div class="col-md-12 offer" data-seller="<?php echo $failed['inquiry_seller']['ID']; ?>" style="background:#c2c2c2">
        <div class="row">

          <div class="col-md-2 ">
            <div class="row">
              <div class="col-md-12 text-center"><?php echo get_avatar($failed['inquiry_seller']['ID']); ?></div>
            </div>
            <div class="row">
              <div class="col-md-12 text-center">
                <a href="/sellerprofile/?seller=<?php echo $failed['inquiry_seller']['ID']; ?>">
									<?php echo get_field('seller_companyName','user_'.$failed['inquiry_seller']['ID']); ?>
								</a>
              </div>
            </div>
          </div>

          <div class="col-md-6 text-center">
            <div class="row">
              <div class="col-6">
                <div class="row">
                  Τιμή μονάδος
                </div>
                <div class="row"><?php echo (isset($failed['inquiry_seller_unit_cost']) ? $failed['inquiry_seller_unit_cost'] : NULL); ?></div>
              </div>
              <?php if (!$isService) { ?>
                <div class="col-6">
                  <div class="row">
                    Μεταφορικά
                  </div>
                  <div class="row"><?php echo (isset($failed['inquiry_seller_delivery_cost']) ? $failed['inquiry_seller_delivery_cost'] : NULL); ?></div>
                </div>
              <?php } ?>
            </div>
            <?php if (!$isService) { ?>
              <div class="row">
                <div class="col-6">
                <div class="row">
                  Ποσότητα
                </div>
                <div class="row"><?php echo (isset($failed['inquiry_seller_quantity']) ? $failed['inquiry_seller_quantity'] : NULL); ?></div>
              </div>
                <div class="col-6">
                <div class="row">
                  Αντικαταβολή
                </div>
                <div class="row"><?php echo (isset($failed['inquiry_seller_cashondelivery_cost']) ? $failed['inquiry_seller_cashondelivery_cost'] : NULL); ?></div>
              </div>
              </div>
            <?php } ?>
          </div>

          <div class="col-2 text-center">Αποτυχημένη</div>
          <div class="col-2 text-center">
						Συνολο <?php
            if ($isService) { $failed['inquiry_seller_quantity'] = 1; }
            $total = (number_format((float)$failed['inquiry_seller_quantity'], 2, '.', '') * number_format((float)$failed['inquiry_seller_unit_cost'], 2, '.', '') + number_format((float)$failed['inquiry_seller_cashondelivery_cost'], 2, '.', '') + number_format((float)$failed['inquiry_seller_delivery_cost'], 2, '.', '') );
            echo $total; ?>
            <a class="btn btn-default" href="<?php echo get_permalink($post->ID)?>?seller=<?php echo $failed['inquiry_seller']['ID']; ?>">ΔΕΙΤΕ ΤΗΝ</a>
						<button type="button" class="btn btn-default btn-sm btnAddSeller" data-seller="<?php echo $failed['inquiry_seller']['ID']; ?>">
		          <span class="glyphicon glyphicon-user"></span>Add to my sellers
		        </button>
						<button type="button" class="btn btn-default btn-sm btnAddSellerBlacklist" data-seller="<?php echo $failed['inquiry_seller']['ID']; ?>">
		          <span class="glyphicon glyphicon-alert"></span>Add to blacklist
		        </button>
          </div>
					<div class="col-md-2 text-center">
						Ημ/νια προσφοράς <?php echo $failed['inquiry_seller_actiondate']; ?>
					</div>
        </div>
      </div>
    <?php } ?>
  <?php } ?>

	<?php if (!empty($threadStarters) && $status != 'complete') { ?>
		<h3>ΕΝΔΙΑΦΕΡΟΜΕΝΟΙ ΧΩΡΙΣ ΠΡΟΣΦΟΡΑ</h3>
    <?php foreach ($threadStarters as $starter) { ?>
			<?php if (empty(getOffer($post->ID,$starter)['pending'])) { ?>
	      <div class="row offer" data-seller="<?php echo $starter; ?>" style="background:#c2c2c2;margin-bottom:10px;">
	        <div class="col-12">
	          <div class="col-md-2 ">
	            <div class="row">
	              <div class="col-md-12 text-center"><?php echo get_avatar($starter); ?></div>
	            </div>
	            <div class="row">
	              <div class="col-md-12 text-center">
	                <a href="/sellerprofile/?seller=<?php echo $starter; ?>">
										<?php echo get_field('seller_companyName','user_'.$starter); ?>
									</a>
	              </div>
	            </div>
	          </div>
	          <div class="col-md-2 text-center">Χωρίς προσφορά</div>
	          <div class="col-md-2 text-center">
	            <a class="btn btn-default" href="<?php echo get_permalink($post->ID)?>?seller=<?php echo $starter; ?>">ΔΕΙΤΕ ΤΗΝ</a>
	            <button type="button" class="btn btn-default btn-sm btnAddSeller" data-seller="<?php echo $starter; ?>">
			          <span class="glyphicon glyphicon-user"></span>Add to my sellers
			        </button>
							<button type="button" class="btn btn-default btn-sm btnAddSellerBlacklist" data-seller="<?php echo $starter; ?>">
			          <span class="glyphicon glyphicon-alert"></span>Add to blacklist
			        </button>

	          </div>
	        </div>
	      </div>
			<?php } ?>
    <?php } ?>
  <?php } ?>

	<?php
		if ($status != 'complete') {
			if (empty($offers['pending'])) { ?>
  			No offers yet</pre>
			<?php
			}
		}
	?>
</div>
<script type="text/javascript">
  jQuery(".btnIgnoreOffer").click(function(e) {
    e.preventDefault();
    var seller = jQuery(this).attr("data-seller");
    jQuery.ajax({
      type : "post",
      url : ajaxurl,
      data    : {
        action    : 'ignoreOffer',
        inquiryId : '<?php echo $post->ID; ?>',
        seller    : seller
      },
      success: function(response) {
        var result = JSON.parse(response);
        if (result.status == 0) {
          alert(result.message);
					window.location.reload();
        }
        else {
          alert("ERROR "+result.message);
        }
      }
    });
    return false;
  });


	jQuery(".btnGenerateCert").click(function(e) {
		e.preventDefault();
		var seller = jQuery(this).attr("data-seller");

		jQuery.ajax({
			type : "post",
			url : ajaxurl,
			data    : {
				action    : 'generatePurchaseCert',
				inquiryId : '<?php echo $post->ID; ?>',
				seller    : seller
			},
			success: function(response) {
				var result = JSON.parse(response);
				if (result.status == 0) {
					jQuery("body").append("<div class='absBox'>Κάντε λήψη του πιστοποιητικού κάνοντας κλικ <a href='"+result.message+"'>εδώ</a></div>")
				}
				else {
					alert("ERROR "+result.message);
				}
			}
		});
		return false;
	});


	jQuery(".btnMarkBestOffer").click(function(e) {
    e.preventDefault();
    var seller = jQuery(this).attr("data-seller");
		var isbest = jQuery(this).find(".glyphicon").attr("class").split(' ')[1];
		if (isbest == 'glyphicon-star') {
			isbest = false;
		}
		else {
			isbest = true;
		}

    jQuery.ajax({
      type : "post",
      url : ajaxurl,
      data    : {
        action    : 'MarkBestOffer',
        inquiryId : '<?php echo $post->ID; ?>',
        seller    : seller,
				mark			:	isbest
      },
      success: function(response) {
        var result = JSON.parse(response);
				var seller = this.data.split('&')[2].replace('seller=','');
				var marked = this.data.split('&')[3].replace('mark=','');
				jQuery(".offer[data-seller="+seller+"]").find(".glyphicon:first").removeClass("glyphicon-star-empty glyphicon-star");

        if (result.status == 0) {
          alert(result.message);
					if (marked == 'false') {
						jQuery(".offer[data-seller="+seller+"]").find(".glyphicon:first").addClass("glyphicon-star-empty");
					}
					else {
						jQuery(".offer[data-seller="+seller+"]").find(".glyphicon:first").addClass("glyphicon-star");
					}
        }
        else {
          alert("ERROR "+result.message);
					return false;
        }
      }
    });
    return false;
  });
	jQuery(".btnMarkInterestingOffer").click(function(e) {

    e.preventDefault();
    var seller = jQuery(this).attr("data-seller");
		var mark = jQuery(this).find(".glyphicon").attr("class").split(' ')[1];
		if (mark == 'glyphicon-heart') {
			mark = false;
		}
		else {
			mark = true;
		}

    jQuery.ajax({
      type : "post",
      url : ajaxurl,
      data    : {
        action    : 'MarkInterestingOffer',
        inquiryId : '<?php echo $post->ID; ?>',
        seller    : seller,
				mark			:	mark
      },
      success: function(response) {
        var result = JSON.parse(response);
				var seller = this.data.split('&')[2].replace('seller=','');
				var marked = this.data.split('&')[3].replace('mark=','');
				jQuery(".offer[data-seller="+seller+"]").find(".glyphicon:last").removeClass("glyphicon-heart-empty glyphicon-heart");

        if (result.status == 0) {
          alert(result.message);
					if (marked == 'false') {
						jQuery(".offer[data-seller="+seller+"]").find(".glyphicon:last").addClass("glyphicon-heart-empty");
					}
					else {
						jQuery(".offer[data-seller="+seller+"]").find(".glyphicon:last").addClass("glyphicon-heart");
					}
					window.location.reload();
        }
        else {
          alert("ERROR "+result.message);
        }
      }
    });
    return false;
  });
	jQuery(".btnAddSellerBlacklist").live("click", function(e) {
		e.preventDefault();
		var seller = jQuery(this).attr('data-seller');
		jQuery.ajax({
			'type'	: 'post',
			'url'	:	ajaxurl,
			'data'	:	{
				action	:	'BlacklistSeller',
				seller	:	seller,
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
		return false;
	});

	jQuery(".btnAddSeller").live("click", function(e) {
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
					window.location.reload();
				}
				else {
					alert(result.message);
				}
			}
		});
		return false;
	});



	jQuery(".btn.offer-complete").click(function(e) {
		var theSeller = jQuery(this).attr('data-seller');
		jQuery.ajax({
       type : "post",
       url : ajaxurl,
			 dataType	: 'html',
       data : {
         action     : 'markOfferComplete',
         inquiryId  : '<?php echo $post->ID; ?>',
         seller     : theSeller
       },
       success: function(response) {
				 var result = JSON.parse(response);
				 if (result.status == 0) {
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
