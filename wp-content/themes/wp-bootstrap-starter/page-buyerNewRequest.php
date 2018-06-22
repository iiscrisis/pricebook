<?php
/**
 * Template Name: Buyer New Request
 */
get_header(); ?>

<?php
/*

define("SERVICE", "2742", true);
define("HOTEL", "1719", true);
define("PRODUCT", "1718", true);

*/
	//request by sidebar call
	$choice = '';
	if (isset($_GET['cat'])) {
		$choice = intval($_GET['cat']);

		if ( ! $choice ) {
			$choice = PRODUCT;
		}

		$catId = $choice;


	}
	else {
		echo '<script type="text/javascript">window.location="'.get_site_url().'/home-buyers/?inquiries=active";</script>';
		exit;
	}
?>
<?php

$current = get_post($catId);
//var_dump(get_object_vars($current));



$categories = createPagination($current,3);



$overtitle = '<div class="overtitle-transform"><div class="overtitle-shape">'.$categories.'</div></div>';
$headTitle = $overtitle .$current->post_title;

$always_show_burger = 1;

include('includes/header.php');
$headTitle=$current->post_title;
?>
<?php $parentId = getParentId($current);?>
<div id="dashboard_main" class="site-content"> <?php // id="content" ?>
	<div class="container-fluid">
		<div class="white-bg row parentCat_<?php echo $parentId;?>" id="dashboard_main_area">

			<?php
				$parentCategories = get_posts(array(
					'post_type'		=>	'product_category',
					'hide_empty'	=> 0,
					'numberposts'		=> -1,
					'posts_per_page'=>-1,
					'post_parent'	=>	$catId
				));



				if(count($parentCategories)>0)
				{

?>
<div class="row">
	<div class="col-xs-12 col-md-12 col-lg-8 col-lg-offset-2 content_padding " id="dashboard-main-col">
		<!-- open applications -->
		<div class="main-area-transform ">
			<div class="main-area-shape product-category-selection">


				<div class='new-applications-transform'>

					<div class='new-applications-shape'>

						<?php // include('includes/root-product-categories-menu.php');?>

									<div class="current_category-transform row hidden">
										<div class="current_category-shape">
												<?php echo $current->post_title;?>
										</div>
									</div>


									<div class="row">
										<?php

										foreach ($parentCategories as $inquiry_parentCategory)
										{
												?>


												<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 product-thumb-col text-center">
													<a class="black2" href="<?php echo get_site_url(); ?>/new-request/?cat=<?php echo $inquiry_parentCategory->ID; ?>">
														<div class="product_thumb _white-bg _inline-block">

															<div class="single_cat_thumbnail-transform text-center">
																<div class="single_cat_thumbnail-shape circle text-center inline-block shadow">
																		<?php
																			$img =  get_the_post_thumbnail( $post = $inquiry_parentCategory->ID, $size = 'post-thumbnail', $attr = '' ) ;
																			if($img == "")
																			{
																				?>
																				<img src="<?php echo get_template_directory_uri() ;?>/images/bgs/trans.png"/>
																			<?php
																			}else {
																				echo $img;
																			}?>
																</div>
															</div>
															<div class="single_cat_text-transform">
																<div class="single_cat_text-shape">
																				<?php echo $inquiry_parentCategory->post_title; ?>
																</div>
															</div>

														</div>

												</div>
								<?php }	?>
											</div>



								</div> <!--end new-application-shape -->
							</div><!--end new-application-transform -->
						</div><!--main-area-shape-->
					</div><!--main-area-transform-->
					</div> <!--dashboard-main-col-->
</div>


				<?php
				} else {
					?>

					<div id="addInquiry" name="addInquiry" method="POST" action="">
						<input type="hidden" name="category" value="<?php echo $catId;?>" />
						<input type="hidden" name="inquiry_type" value="<?php echo $parentId;?>" />
						<?php include('includes/new-product-widgets.php');?>
						<?php include('includes/application-filter.php');?>



								<?php include('includes/new-product_attributes.php');?>

    			</div>





<script src='https://www.google.com/recaptcha/api.js'></script>

<script type="text/javascript">
var     map_initialized = false;
var mapBox;
var longlat="37.983810,23.727539";
var age_text = "";
function initMap()
{
//alert("g init "+longlat);

		var longlat_array = longlat.split(",");
	    mapBox = new appMaps(longlat_array[1],longlat_array[0],"map_box","map_box");


    map_initialized = true;
}
	function wp_editor_focus_out()
	{
	/*	var text = get_tinymce_content();
	//	alert(text);
		return text;*/
	}

	function get_tinymce_content(){
    /*if (jQuery("#inquiry_text").hasClass("tmce-active")){
      //  //alert(1);
      return tinyMCE.activeEditor.getContent();
    }else{
      //    //alert(2);
      tinyMCE.triggerSave();
      //    $('#comment_message').val();
      return jQuery('#inquiry_text').val();
    }*/
  }

	function spinnerStop()
	{

	}

	function spinnerStart()
	{

	}


	//enableBtn

	function create_age_boxes(qty){

								if(qty > 0 && qty > jQuery("#kids_age_container_lists").find(".single_kids_age_list").length)
								{
										var new_Select = jQuery("#kids_tmpl").find(".single_kids_age_list").clone();
										 jQuery("#kids_age_container_lists").append(new_Select);
										 jQuery("#kids_age_container").removeClass("hidden");
								}else {
									if(qty == 0)
									{
										jQuery("#kids_age_container").addClass("hidden");
										 jQuery("#kids_age_container_lists").empty();

									}else if(qty < jQuery("#kids_age_container_lists").find(".single_kids_age_list").length){
											for(k= jQuery("#kids_age_container_lists").find(".single_kids_age_list").length;k>qty;k--)
											{		var index = k-1;
												 jQuery("#kids_age_container_lists").find(".single_kids_age_list").eq(index).remove();
											}
									}
								}

									jQuery(".kids_age_list").trigger("change");

	}
	var priceSet = false;
	var placeSet = false;
	var filtersSet = false;
	var qtySet = false;
var textSet = false;

	checkForSubmit();

	function checkForSubmit()
	{

		if(priceSet &&  placeSet && ( filtersSet || textSet ) && qtySet)
		{
			jQuery(".create_request").removeClass("disabledbutton");
		}else {
			jQuery(".create_request").addClass("disabledbutton");
		}

	}

	function setServiceStart(when)
	{

		jQuery(".services-start-range").removeClass("hidden");
		jQuery(".start-from").removeClass("hidden");


		jQuery(".start-from").find("span").html(when);
		jQuery(".summary-startdays").removeClass("hidden");
	}

	function setServiceStop(when)
	{
		jQuery(".start-to").removeClass("hidden");


		jQuery(".start-to").find("span").html(when);
		jQuery(".summary-startdays").removeClass("hidden");
	}


	jQuery(".preview-image_delete-shape").live("click",function(){

		jQuery(this).closest(".preview-image-transform").remove();

	});

	/*
	jQuery("input[name='inquiry_start_date']").trigger("change");
	jQuery("input[name='inquiry_end_date']").trigger("change");
	*/

	jQuery(document).load(function() {
		jQuery("input[name='inquiry_start_date']").trigger("change");
		jQuery("input[name='inquiry_end_date']").trigger("change");
	});


		 function findMatches(strs,vals,q) {

			var matches, substringRegex,mathched_values;

			// an array that will be populated with substring matches
			matches = [];
			matched_values = [];
			// regex used to determine if a string contains the substring `q`
			substrRegex = new RegExp(q, 'i');

			// iterate through the pool of strings and for any string that
			// contains the substring `q`, add it to the `matches` array
			var counter = 0;
				jQuery(".area_optgroup").removeClass("filtered");
			jQuery(".area_option").removeClass("filtered");
			jQuery.each(strs, function(i, str) {
				if (substrRegex.test(str)) {
				//	matches.push(str);
					//matched_values.push
					console.log("MATCHING > "+q)
					var option_id = vals[counter];
					//var option = vals[counter][1];
					console.log(" > "+option_id+ " % ")
						jQuery("#"+option_id).closest("optgroup").addClass("filtered selected");
					jQuery("#"+option_id).addClass("filtered selected");
				}
				counter++
			});

		//	cb(matches);
		};


		jQuery(document).ready(function() {




		/*	var states = ['Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California',
			  'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii',
			  'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana',
			  'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota',
			  'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire',
			  'New Jersey', 'New Mexico', 'New York', 'North Carolina', 'North Dakota',
			  'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island',
			  'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont',
			  'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming'
			];*/

			/*jQuery('#scrollable-dropdown-menu .typeahead').typeahead(null, {
			  name: 'states',
			  limit: 50,
			  source: substringMatcher(states)
			});*/

			//var search_areas = substringMatcher() ;

		/*	jQuery('#scrollable-dropdown-menu .typeahead').on("keyup",function(){
				console.log(jQuery(this).val())
					findMatches(states,states_value,jQuery(this).val());
			});*/

			jQuery('#inquiry_areas_select').selectize({
			    sortField: 'text'
			});

			jQuery(".user-photo-btn").on("click",function(){
				jQuery("#userImage").trigger("click");
			});

			jQuery("#userImage").on("change",function(){
				var fullPath= jQuery(this).val();

				if (fullPath) {
				    var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
				    var filename = fullPath.substring(startIndex);
				    if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
				        filename = filename.substring(1);
				    }
				   // alert(filename);
						jQuery(".file_name_display").html(filename);
				}

				jQuery(".upload_inquiry_image").removeClass("disabledbutton");
			});

			  jQuery("#image-upload").on("submit",function(e){
				//	alert(1);
			      e.preventDefault();
			      var data_n = new FormData(this);
			    //  alert(JSON.stringify(data_n));

			      var data_send = new Array();

			      jQuery.ajax({

			        url : ajaxurl,
			        type : 'post',
			        data :new FormData(this),
			        beforeSend: function(){jQuery("#body-overlay").show();},
			        contentType: false,
			        processData:false,
			        success : function( response ) {
			          var data = JSON.parse(response);
			          console.log(data);
			          if (data.status == 1) {
									alert(data.message);
			              var newgallery_trans =  jQuery("<div>", {class: 'preview-image-transform _inline-block'}) ;
			              var newgallery_shape =  jQuery("<div>", {class: 'preview-image-shape'}) ;
			              var deletegallery_trans =  jQuery("<div>", {class: 'preview-image_delete-transform'}) ;
			              var deletegallery_shape =  jQuery("<div>", {class: 'preview-image_delete-shape pointer circle grey-bg shadow'}) ;
										var input_image = '<input type="hidden" name="inquiry_image" value="'+data.image_url+'" />';
			              deletegallery_shape.html(input_image+'<i class="material-icons red md-18">delete_forever</i>');

										//inquiry_image
			              deletegallery_trans.append(deletegallery_shape);

			              var new_g_image = jQuery("<img>");
			              var src = root_images_path+"/"+data.image_url;
			              new_g_image.attr('src',src);
			            //  alert(src);
										jQuery("#inquiry_image").val(data.image_url);
			              newgallery_shape.append(new_g_image);
			              newgallery_shape.append(deletegallery_trans);
			              newgallery_trans.append(newgallery_shape);
			              newgallery_trans.data("url",data.image_url);



			            jQuery(".inquiry-image-shape").empty();
			            jQuery(".inquiry-image-shape").append(newgallery_trans);

			        //    update_seller_banner(data.image_url);
			            /*
			            <div class="gallery-transform inline-block">
			              <div class="gallery-shape">
			                <img src="<?php echo $gallery['url'];?>"/>
			              </div>
			            </div>
			            */
			          }
			          else {
			            alert(data.message);
			          }
			        //  window.location.reload();
			        }

			      });

			  });


				jQuery(".application-title").on("click",function(){
						if(jQuery(this).closest(".application-filter-category-shape").hasClass("opened"))
						{
							jQuery(this).closest(".application-filter-category-shape").removeClass("opened");
						}else {
							jQuery(this).closest(".application-filter-category-shape").addClass("opened");
						}

				});



				//parent_filter



			jQuery("input[name='inquiry_filters[]']").on("change",function()
			{
					jQuery(".summary-filters-shape").html(' ');

					/*var str='<div class="summary-subtitle bold"> \
						@title \
					</div> \
					<div class="summary_general"> \
						@value \
					</div>';*/

					var str='<div class="summary_general"> \
						@value \
					</div>';

					var output="";

					var f_counter=0;
					jQuery(".application-filter-category-shape.parent_filter").each(function(){

						if(jQuery(this).find("input[name='inquiry_filters[]']:checked").length > 0)
						{
							f_counter++;


							var filter_cat_trans= jQuery("<div>", {class: 'filter-category-transform '}) ;
							var filter_cat_shape=  jQuery("<div>", {class: 'filter-category-shape '}) ;

							/**var parent = jQuery(this).closest(".application-filter-category-transform");
							var value="";*/
							var title = jQuery(this).find('span').html();
							var filter_cat_title_shape=  jQuery("<div>", {class: 'filter-category-title-shape  bold '}) ;
							filter_cat_title_shape.html(title);
							filter_cat_title_shape.appendTo(filter_cat_shape);

							jQuery(this).find("input[name='inquiry_filters[]']:checked").each(function() {

								console.log(title+ " "+jQuery(this).hasClass("filter_other_check"));
								if(jQuery(this).hasClass("filter_other_check"))
								{
									value =jQuery(this).data("value")+" > "+ jQuery(this).closest(".single-application-filter-shape").find('.filter_other').val();
									jQuery(this).val(value);
								}else {

									 value =jQuery(this).val();;//jQuery(this).closest(".single-application-filter-shape").find('span').html();
								}

								if(value !="")
								{

									var new_filter = jQuery("<div>", {class: 'filter-single-shape inline-block'}) ;
									new_filter.html(value);
									new_filter.appendTo(filter_cat_shape);
								}

							});

							filter_cat_shape.appendTo(filter_cat_trans);

							jQuery(".summary-filters-shape").append(filter_cat_trans);
						}else {





						}



					});

					if(f_counter > 0)
					{
						filtersSet = true;

					}else {
						 filtersSet = false;
					}


				  checkForSubmit();

				/*	jQuery("input[name='inquiry_filters[]']:checked").each(function() {
						var parent = jQuery(this).closest(".application-filter-category-transform");
						var value="";
						var title = parent.closest(".application-filter-category-shape").find('span').html();
						console.log(title+ " "+jQuery(this).hasClass("filter_other_check"));
						if(jQuery(this).hasClass("filter_other_check"))
						{
							value =jQuery(this).data("value")+" > "+ jQuery(this).closest(".single-application-filter-shape").find('.filter_other').val();
							jQuery(this).val(value);
						}else {

							 value =jQuery(this).val();;//jQuery(this).closest(".single-application-filter-shape").find('span').html();
						}

						if(value !="")
						{
							var tempStr = str;

							//tempStr = tempStr.replace('@title',title) ;
							tempStr = tempStr.replace('@value',value) ;
							output+=tempStr;
						}

					});*/



			});






			jQuery('#inquiry_areas_select').on("change",function(){

				//alert(longlat);



				var regions="";
				var counter=0;
			//	var longlat ="";
				jQuery( ".region_select option:selected" ).each(function() {

						if(counter>0)
						{
							regions +=" , ";
						}
						if(states_value[jQuery(this).val()])
						{
							 longlat = states_value[jQuery(this).val()];
						}

						regions = jQuery( this ).text() ;


						counter++;
				});


				if(counter>0)
				{
				placeSet = true;
				}else {
					placeSet = false;
				}
				checkForSubmit();




			//	alert(longlat);
				jQuery(".place_title").attr("data-longlat",longlat);
				if(counter>0)
				{
					jQuery(".summary-places").removeClass("hidden");

					if(jQuery("#map_box").length > 0)
					{
						var w = jQuery(".application-summary-transform").width();
					  jQuery("#map_box").width(w);

					  var m_h = w*0.5;
					 jQuery("#map_box").height(m_h);


					  if(map_initialized)
					  {
						//	alert(1);
					//   var mapBox = new appMaps(longlat,"map_box","map_pb");
						jQuery("#map_box").addClass("opaque");
						var longlat_array = longlat.split(",");
						//alert(longlat_array[0]+" "+longlat_array[1]);
				   // mapBox = new appMaps(longlat_array[1],longlat_array[0],"map_box","map_mats");
							mapBox.setAppPosition(longlat_array[0],longlat_array[1]);
					  }else {
						//	alert(2);
					  //	 var mapBox = new appMaps(longlat,"map_box","map_pb");
							//mapBox.setAppPosition(longlat);
					  }
					  //
					}

				}else {
					jQuery(".summary-places").addClass("hidden");
				}

				jQuery(".places_container").html(regions);


			});



			//single_rooms

			jQuery(".plus_button").on("click",function(){
				if(jQuery(this).closest(".quantity").length > 0)
				{
					var qty = jQuery("input[name='inquiry_product_quantities']").val();
					qty++;

					checkForSubmit();



						jQuery("input[name='inquiry_product_quantities']").val(qty);
						jQuery("input[name='inquiry_product_quantities']").trigger("change");

						return 0;
				}

				if(jQuery(this).closest(".persons").length > 0)
				{
					var qty = jQuery("input[name='inquiry_persons_quantities']").val();
					qty++;

						jQuery("input[name='inquiry_persons_quantities']").val(qty);
						jQuery("input[name='inquiry_persons_quantities']").trigger("change");
							return 0;
				}

				if(jQuery(this).closest(".children").length > 0)
				{
					var qty = jQuery("input[name='inquiry_children_quantities']").val();
					qty++;

						jQuery("input[name='inquiry_children_quantities']").val(qty);
						jQuery("input[name='inquiry_children_quantities']").trigger("change");

						create_age_boxes(qty);



							return 0;
				}

				if(jQuery(this).closest(".single_rooms").length > 0)
				{
					var qty = jQuery("input[name='inquiry_single_rooms_quantities']").val();
					qty++;

						jQuery("input[name='inquiry_single_rooms_quantities']").val(qty);
						jQuery("input[name='inquiry_single_rooms_quantities']").trigger("change");
							return 0;
				}
				//single_rooms double_rooms

				if(jQuery(this).closest(".double_rooms").length > 0)
				{
					var qty = jQuery("input[name='inquiry_double_rooms_quantities']").val();
					qty++;

						jQuery("input[name='inquiry_double_rooms_quantities']").val(qty);
						jQuery("input[name='inquiry_double_rooms_quantities']").trigger("change");
							return 0;
				}

			});




						jQuery(".minus_button").on("click",function(){
							if(jQuery(this).closest(".quantity").length > 0)
							{
								var qty = jQuery("input[name='inquiry_product_quantities']").val();
								qty--;
								if(qty < 1)
								{
									qty =1;
								}



									jQuery("input[name='inquiry_product_quantities']").val(qty);
									jQuery("input[name='inquiry_product_quantities']").trigger("change");

									return 0;
							}

							if(jQuery(this).closest(".persons").length > 0)
							{
								var qty = jQuery("input[name='inquiry_persons_quantities']").val();
								qty--;
								if(qty < 1)
								{
									qty =1;
								}

									jQuery("input[name='inquiry_persons_quantities']").val(qty);
									jQuery("input[name='inquiry_persons_quantities']").trigger("change");
										return 0;
							}

							if(jQuery(this).closest(".children").length > 0)
							{
								var qty = jQuery("input[name='inquiry_children_quantities']").val();
								qty--;
								if(qty < 0)
								{
									qty =0;
								}

								create_age_boxes(qty);

									jQuery("input[name='inquiry_children_quantities']").val(qty);
									jQuery("input[name='inquiry_children_quantities']").trigger("change");
										return 0;
							}

							if(jQuery(this).closest(".single_rooms").length > 0)
							{
								var qty = jQuery("input[name='inquiry_single_rooms_quantities']").val();
								qty--;
								if(qty < 0)
								{
									qty =0;
								}

									jQuery("input[name='inquiry_single_rooms_quantities']").val(qty);
									jQuery("input[name='inquiry_single_rooms_quantities']").trigger("change");
										return 0;
							}

							//double_rooms
							if(jQuery(this).closest(".double_rooms").length > 0)
							{
								var qty = jQuery("input[name='inquiry_double_rooms_quantities']").val();
								qty--;
								if(qty < 0)
								{
									qty =0;
								}

									jQuery("input[name='inquiry_double_rooms_quantities']").val(qty);
									jQuery("input[name='inquiry_double_rooms_quantities']").trigger("change");
										return 0;
							}
						});


						jQuery(".kids_age_list").live("change",function(){


							var counter=0;
								jQuery("#kids_age_container_lists").find(".kids_age_list").each(function(){
									if(counter==0)
									{
											age_text = jQuery(this).val();
									}else {
											age_text +=","+jQuery(this).val();
									}
									counter++;

								});

								if(counter==0)
								{
									jQuery(".summary_kids_container-title").addClass("hidden");
								}else {
									jQuery(".summary_kids_container-title").removeClass("hidden");
								}

								jQuery(".kids_ages_text").html(age_text);

						})


			jQuery("input[name='inquiry_product_quantities']").on("change",function()
			{


				var qty = jQuery("input[name='inquiry_product_quantities']").val()
				if(qty>1)
				{
					//jQuery(".summary-quantity").removeClass("hidden");

				}else {
					//jQuery(".summary-quantity").addClass("hidden");
				}
				qtySet = true;
				checkForSubmit();



				jQuery(".summary-quantity").html(qty);

			});


			jQuery("input[name='inquiry_persons_quantities']").on("change",function()
			{


				var qty = jQuery("input[name='inquiry_persons_quantities']").val()
				if(qty>0)
				{
					jQuery(".summary-persons").removeClass("hidden");
				}else {
					jQuery(".summary-persons").addClass("hidden");
				}

				jQuery(".summary-adults").find("span").html(qty);

			}); //

			jQuery("input[name='inquiry_double_rooms_quantities']").on("change",function()
			{


				var qty = jQuery("input[name='inquiry_double_rooms_quantities']").val()
				if(qty>0)
				{
					jQuery(".summary-rooms").removeClass("hidden");
				}else {
					jQuery(".summary-rooms").addClass("hidden");
				}

				jQuery(".summary-double").find("span").html(qty);

			});

			jQuery("input[name='inquiry_single_rooms_quantities']").on("change",function()
			{


				var qty = jQuery("input[name='inquiry_single_rooms_quantities']").val()
				if(qty>0)
				{
					jQuery(".summary-rooms").removeClass("hidden");
				}else {
					jQuery(".summary-rooms").addClass("hidden");
				}

				jQuery(".summary-single").find("span").html(qty);

			});



//inquiry_children_quantities
			jQuery("input[name='inquiry_children_quantities']").on("change",function()
			{


				var qty = jQuery("input[name='inquiry_children_quantities']").val()
				if(qty>0)
				{
					jQuery(".summary-children").removeClass("hidden");
				}else {
					jQuery(".summary-children").addClass("hidden");
				}

				jQuery(".summary-kids").find("span").html(qty);

			}); //



			jQuery("input[name='inquiry_min_price']").on("change",function()
			{


				var qty = jQuery("input[name='inquiry_min_price']").val()
				if(qty >= '0' && qty !="")
				{
					jQuery(".price-from").removeClass("hidden");
				}else {
					jQuery(".price-from").addClass("hidden");
				}

				jQuery(".price-from").find("span").html(qty);

				if(!jQuery(".price-to").hasClass("hidden") || !jQuery(".price-from").hasClass("hidden"))
				{
					jQuery(".summary-prices").removeClass("hidden");
				}else {
					jQuery(".summary-prices").addClass("hidden");
				}

					jQuery("input[name='inquiry_max_price']").trigger("change");

			});



			jQuery("input[name='inquiry_no_range']").on("change",function()
						{
						//	if(jQuery(this).)
						if(jQuery("input[name='inquiry_no_range']:checked").length > 0)
						{
							jQuery(".no_range").removeClass("hidden");
							jQuery(".with_range").addClass("hidden");
							jQuery(".price_range_input").addClass("services_disabled");

							priceSet = true;
							checkForSubmit();

						}else {

							jQuery(".no_range").addClass("hidden");
							jQuery(".with_range").removeClass("hidden");
							jQuery(".price_range_input").removeClass("services_disabled");

							jQuery("input[name='inquiry_max_price']").trigger("change");
						}
					});

			jQuery("input[name='inquiry_max_price']").on("change",function()
			{



				var qty = parseFloat(jQuery("input[name='inquiry_max_price']").val());
				if(qty < parseFloat(jQuery("input[name='inquiry_min_price']").val()))
				{
				//	alert(qty +" "+jQuery("input[name='inquiry_min_price']").val());
					jQuery("input[name='inquiry_max_price']").val( jQuery("input[name='inquiry_min_price']").val());
					qty =  jQuery("input[name='inquiry_min_price']").val();
				}
				if(qty>0 && qty !='∞' &&  qty !='')
				{
					jQuery(".price-to").parent("div").removeClass("hidden");
					jQuery(".price-from").parent("div").removeClass("col-xs-8");
					jQuery(".price-from").parent("div").addClass("col-xs-4");



					priceSet = true;
					checkForSubmit();

				}else {
					jQuery(".price-to").parent("div").addClass("hidden");
					jQuery(".price-from").parent("div").addClass("col-xs-8");
					jQuery(".price-from").parent("div").removeClass("col-xs-4");

					checkForSubmit();

					priceSet = false;
					checkForSubmit();

				}

				jQuery(".price-to").find("span").html(qty);

				if(!jQuery(".price-to").hasClass("hidden") || !jQuery(".price-from").hasClass("hidden"))
				{
					jQuery(".summary-prices").removeClass("hidden");
				}else {
					jQuery(".summary-prices").addClass("hidden");
				}

			});


			jQuery("input[name='inquiry_hotel_start_date']").on("change",function()
			{
				//alert(1);

				var qty = jQuery("input[name='inquiry_hotel_start_date']").val()
				if(qty != '0' && qty !="")
				{
//alert(2);
					jQuery(".stay-from").removeClass("hidden");
				}else {
				//	alert(3);
					jQuery(".stay-from").addClass("hidden");
				}

				jQuery(".stay-from").find("span").html(qty);

				if(!jQuery(".stay-to").hasClass("hidden") || !jQuery(".stay-from").hasClass("hidden"))
				{//alert(4);
					jQuery(".summary-staydates").removeClass("hidden");
				}else {
					//alert(5);
					jQuery(".summary-staydates").addClass("hidden");
				}

			});


			jQuery("input[name='inquiry_hotel_end_date']").on("change",function()
			{


				var qty = jQuery("input[name='inquiry_hotel_end_date']").val()
				if(qty != '0' && qty !="")
				{
					jQuery(".stay-to").removeClass("hidden");
				}else {
					jQuery(".stay-to").addClass("hidden");
				}

				jQuery(".stay-to").find("span").html(qty);

				if(!jQuery(".stay-to").hasClass("hidden") || !jQuery(".stay-from").hasClass("hidden"))
				{
					jQuery(".summary-staydates").removeClass("hidden");
				}else {
					jQuery(".summary-staydates").addClass("hidden");
				}

			});

			//Services DateTime
			jQuery("input[name='inquiry_service_start_date_select']").on("change",function()
			{
					//services_disabled


				var value = jQuery("input[name='inquiry_service_start_date_select']:checked").val();

				jQuery(".services-start-now").addClass("hidden");
				jQuery(".services-start-specific").addClass("hidden");
				//jQuery(".services-start-range").addClass("hidden");


				jQuery(".start-from-box").addClass("services_disabled");
				jQuery(".end-on-box").addClass("services_disabled");
				jQuery(".summary-startdays").addClass("hidden");

				timeval = "Άμεσα";

				if(value=="between" || value=="specific")
				{
					if(value=="between")
					{
						jQuery(".summary-startdays").removeClass("hidden");

						jQuery(".start-from-box").removeClass("services_disabled");
						jQuery(".end-on-box").removeClass("services_disabled");

						var from = jQuery("input[name='inquiry_service_start_date']").val()
						setServiceStart(from);

						var to = jQuery("input[name='inquiry_service_end_date']").val()
						setServiceStop(to);
						/*jQuery("input[name='inquiry_service_start_date']").trigger("change");
						jQuery("input[name='inquiry_service_end_date']").trigger("change");*/

						timeval = jQuery("input[name='inquiry_service_start_date']").val()+ " - "+ jQuery("input[name='inquiry_service_end_date']").val();
						/*jQuery(".services-start-from").find("span").html(time);
						jQuery(".services-start-from").find("to").html(time);
						jQuery(".services-start-range").removeClass("hidden");*/
					}else {

						timeval = jQuery("input[name='inquiry_service_start_date']").val();

						jQuery(".end-on-box").addClass("services_disabled");
						jQuery(".start-from-box").removeClass("services_disabled");
						jQuery(".start-to").addClass("hidden");
						var from = jQuery("input[name='inquiry_service_start_date']").val()
						setServiceStart(from);
					}
				}else {



					time = jQuery("input[name='inquiry_service_start_date_select']:checked").closest(".service_start_date_select").find("span").html();
					timeval = time;
						if(time)
						{
							jQuery(".services-start-range").addClass("hidden");
							jQuery(".start-from").addClass("hidden");
							jQuery(".start-to").addClass("hidden");
							jQuery(".summary-startdays").removeClass("hidden");
							jQuery(".summary-startdays").removeClass("hidden");
							jQuery(".services-start-now").find("span").html(time);
							jQuery(".services-start-now").removeClass("hidden");
						}

				}

					jQuery("input[name='inquiry_service_start_dates']").val(timeval);



			});




			jQuery("input[name='inquiry_service_start_date']").on("change",function()
			{

				jQuery("input[name='inquiry_service_start_date_select']").trigger("change");
				/*var when = jQuery("input[name='inquiry_service_start_date']").val()
				setServiceStart(when);*/
				/*jQuery(".start-from").removeClass("hidden");


				jQuery(".start-from").find("span").html(qty);
				jQuery(".summary-startdays").removeClass("hidden");*/


			});

			jQuery("input[name='inquiry_service_end_date']").on("change",function()
			{


					jQuery("input[name='inquiry_service_start_date_select']").trigger("change");


/*
				var when = jQuery("input[name='inquiry_service_end_date']").val()

					setServiceStop(when);*/

				/*jQuery(".start-to").removeClass("hidden");


				jQuery(".start-to").find("span").html(qty);
				jQuery(".summary-startdays").removeClass("hidden");*/


			});



			jQuery("input[name='inquiry_start_date']").on("change",function()
			{
			//	alert(1);

				var qty = jQuery("input[name='inquiry_start_date']").val();
				if(qty != '0' && qty !="")
				{
//alert(2);
					jQuery(".inquiry-from").removeClass("hidden");
				}else {
			//	alert(3);
				//	jQuery(".inquiry-from").addClass("hidden");
				}

				jQuery(".inquiry-from").removeClass("hidden");

				jQuery(".inquiry-from").find("span").html(qty);

						jQuery(".summary-inquirydates").removeClass("hidden");

				/*if(!jQuery(".inquiry-to").hasClass("hidden") || !jQuery(".inquiry-from").hasClass("hidden"))
				{//alert(4);
					jQuery(".summary-inquirydates").removeClass("hidden");
				}else {
					//alert(5);
					jQuery(".summary-inquirydates").addClass("hidden");
				}*/

			});




			jQuery("input[name='inquiry_end_date']").on("change",function()
			{


				var qty = jQuery("input[name='inquiry_end_date']").val();
			//	alert(qty);
				if(qty != '0' && qty !="")
				{
					jQuery(".inquiry-to").removeClass("hidden");
				}else {
					jQuery(".inquiry-to").addClass("hidden");
				}
				jQuery(".inquiry-to").removeClass("hidden");
				jQuery(".inquiry-to").find("span").html(qty);
				jQuery(".summary-inquirydates").removeClass("hidden");

				if(!jQuery(".inquiry-to").hasClass("hidden") || !jQuery(".inquiry-from").hasClass("hidden"))
				{
					jQuery(".summary-inquirydates").removeClass("hidden");
				}else {
					jQuery(".summary-inquirydates").addClass("hidden");
				}

			});


			jQuery(".more-shape").on("mouseleave",function(){
			//	var text = wp_editor_focus_out();
		var text =	jQuery("textarea[name='inquiry_text']").val()
				if(text !='')
				{
					jQuery(".summary-additional-info").removeClass("hidden");
					textSet = true;
					checkForSubmit();
				}else {
					textSet = false;
					checkForSubmit();
					jQuery(".summary-additional-info").addClass("hidden");
				}
				jQuery(".summary-additional-info").find(".additional-info-text").html(text);

			});

			/*jQuery("textarea[name='inquiry_text']").on("change",function()
			{


				var text =jQuery("textarea[name='inquiry_text']").val()
				if(text !='')
				{
					jQuery(".summary-additional-info").removeClass("hidden");
				}else {
					jQuery(".summary-additional-info").addClass("hidden");
				}

				jQuery(".summary-additional-info").html(text);



			}); */

			jQuery(".region_select").trigger("change");
			jQuery("input[name='inquiry_product_quantities']").trigger("change");
			jQuery("input[name='inquiry_max_price']").trigger("change");
			jQuery("input[name='inquiry_no_range']").trigger("change");
			jQuery("input[name='inquiry_min_price']").trigger("change");
			jQuery("textarea[name='inquiry_text']").trigger("change");
			jQuery("input[name='inquiry_filters[]']").trigger("change");
			jQuery("input[name='inquiry_persons_quantities']").trigger("change");
			jQuery("input[name='inquiry_children_quantities']").trigger("change");
			jQuery("input[name='inquiry_hotel_start_date']").trigger("change");
			jQuery("input[name='inquiry_hotel_end_date']").trigger("change");
				//inquiry_single_rooms_quantities inquiry_double_rooms_quantities
			jQuery("input[name='inquiry_single_rooms_quantities']").trigger("change");
			jQuery("input[name='inquiry_double_rooms_quantities']").trigger("change");
			jQuery("input[name='inquiry_service_start_date_select']").trigger("change");
			jQuery("input[name='inquiry_filters[]']").trigger("change");
				jQuery('#inquiry_areas_select').trigger("change");



		 //	jQuery("#userImage").val()

			jQuery(".filter_other").on("change",function()
			{

				if(jQuery(this).val() != "" && 	!jQuery(this).closest(".single-application-filter-shape").find(".filter_other_check").attr("checked"))
				{
						console.log("changing");
						jQuery(this).closest(".single-application-filter-shape").find(".filter_other_check").trigger("click");

				}else if(jQuery(this).val() == "" && jQuery(this).closest(".single-application-filter-shape").find(".filter_other_check").attr("checked")){

						console.log("uncheking  - changed");
						jQuery(this).closest(".single-application-filter-shape").find(".filter_other_check").trigger("click");
				}

				jQuery("input[name='inquiry_filters[]']").trigger("change");
			});
			//jQuery('select').selectmenu();
		/*	jQuery(".chosen-select").chosen({
				single_backstroke_delete: true
			});*/


			//Initialize calendars
			var today = new Date();
			jQuery('input[name="inquiry_start_date"]').datepicker({ minDate: 0 }).datepicker({ dateFormat: "yy-mm-dd"}).datepicker("setDate", "0");
			jQuery('input[name="inquiry_end_date"]').datepicker({	minDate: '+7D' }).datepicker("option", "maxDate", '+32D').datepicker({ dateFormat: "yy-mm-dd"}).datepicker("setDate","+5");

			jQuery('input[name="inquiry_hotel_start_date"]').datepicker({ minDate: 0 }).datepicker({ dateFormat: "yy-mm-dd"}).datepicker("setDate", "+2");
			jQuery('input[name="inquiry_hotel_end_date"]').datepicker({	minDate: '+1D' }).datepicker("option", "maxDate", '+190D').datepicker({ dateFormat: "yy-mm-dd"}).datepicker("setDate","+7");

			jQuery('input[name="inquiry_service_start_date"]').datepicker({ minDate: 0 }).datepicker({ dateFormat: "yy-mm-dd"}).datepicker("setDate", "+7");
			jQuery('input[name="inquiry_service_end_date"]').datepicker({	minDate: '+1D' }).datepicker("option", "maxDate", '+64D').datepicker({ dateFormat: "yy-mm-dd"}).datepicker("setDate","+14");

			jQuery("input[name='inquiry_start_date']").trigger("change");
			jQuery("input[name='inquiry_end_date']").trigger("change");



			jQuery(".close_preview").on("click",function(){
				jQuery("#preview_inquiry").removeClass("preview_inquiry");
			//	jQuery(".btn_submit").addClass("btn_preview");
		//		jQuery(".btn_submit").removeClass("btn_submit");
				jQuery("body").removeClass("unscrollable");
				jQuery("#menu_section").removeClass("zindex0");
			});



			jQuery("#addInquiry .btn_preview").live('click', function(e) {
			// document.getElementById("").disabled = true;
				if(!jQuery("#create_request_btn").hasClass("tested"))
				{
						 jQuery("#create_request_btn").addClass("disabledbutton");
				}

			//	alert(1);
				e.preventDefault();
			//	jQuery("this").removeClass("btn_preview");
		//		jQuery(this).addClass("btn_submit");
				jQuery("#preview_inquiry").addClass("preview_inquiry");



				jQuery("body").addClass("unscrollable");
				jQuery("#menu_section").addClass("zindex0");


			});


		//	jQuery("#addInquiry input[type='submit']").on('click', function(e) {
			jQuery("#addInquiry .btn_submit").live('click', function(e) {

				e.preventDefault();

				jQuery("#preview_inquiry").removeClass("preview_inquiry");
				/*jQuery(".btn_submit").addClass("btn_preview");
				jQuery(".btn_submit").removeClass("btn_submit");*/

				jQuery("ul[data-mandatory='1']").each(function() {
					var filterName = jQuery(this).prev("a").prev("h4").text();

					if (jQuery(this).find("input:checked").length == 0) {
						alert("Filter "+filterName+" is mandatory");
						return false;
					}

				});


				var inquiry_service_start_dates =jQuery("input[name='inquiry_service_start_dates']").val();
					var inquiry_service_end_date  =jQuery("input[name='inquiry_service_end_date']").val();
				if(jQuery("input[name='inquiry_service_start_date_select']").val() == 'now' || jQuery("input[name='inquiry_service_start_date_select']").val() =="7days")
				{
						var inquiry_service_end_date  ="";
				}



				var inquiry_product_category = jQuery("input[name='category']").val();
				var inquiry_product_quantities = jQuery("input[name='inquiry_product_quantities']").val();
				var inquiry_max_price = parseFloat(jQuery("input[name='inquiry_max_price']").val());
				var inquiry_min_price = parseFloat(jQuery("input[name='inquiry_min_price']").val());
				var inquiry_no_range =jQuery("input[name='inquiry_no_range']:checked").length;
			//	alert(inquiry_no_range);
				var inquiry_start_date = jQuery("input[name='inquiry_start_date']").val();
				var inquiry_end_date = jQuery("input[name='inquiry_end_date']").val();
				var inquiry_text = jQuery("textarea[name='inquiry_text']").val(); //get_tinymce_content();//j
				var inquiry_filters = jQuery(".summary-filters-shape").html(); //jQuery("input[name='inquiry_filters[]']:checked").serializeArray();
				var inquiry_areas = jQuery("select[name='inquiry_areas']").val();
				var longlat = jQuery(".place_title").attr("data-longlat");
				var inquiry_other_filter =  new Array();//jQuery("input[name='other_filter[]']").serializeArray();
				var inquiry_image =  jQuery("input[name='inquiry_image']").val();
				/*alert(longlat);
				/*alert(JSON.stringify(inquiry_filters));
				alert(JSON.stringify(inquiry_other_filter));
				return 0;*/
				var g_recaptcha_response = jQuery("[name='g-recaptcha-response']").val();
			//	alert(g_recaptcha_response);
				var 	inquiry_single_rooms_quantities =jQuery("input[name='inquiry_single_rooms_quantities']").val();
				var 	inquiry_double_rooms_quantities =jQuery("input[name='inquiry_double_rooms_quantities']").val();

				var inquiry_persons_quantities =jQuery("input[name='inquiry_persons_quantities']").val();
				var inquiry_children_quantities =jQuery("input[name='inquiry_children_quantities']").val();
				var inquiry_hotel_start_date =jQuery("input[name='inquiry_hotel_start_date']").val();
				var inquiry_hotel_end_date =jQuery("input[name='inquiry_hotel_end_date']").val();

				var inquiry_type= jQuery("input[name='inquiry_type']").val();

				//alert(JSON.stringify(inquiry_filters));

			/*	console.log("Cat :"+inquiry_product_category+" Attributes: "+inquiry_product_quantities+" "+inquiry_max_price);
				console.log(inquiry_start_date+" "+inquiry_service_end_date+" "+inquiry_end_date+" "+inquiry_text + " Area "+inquiry_areas + " Filter "+inquiry_filters);*/

				jQuery.post(
			    ajaxurl,
			    {
		        'action':	'addInquiry',
		        'data':		{
							'inquiry_product_category'		:	inquiry_product_category,
							'inquiry_product_quantities'	:	inquiry_product_quantities,
							'inquiry_max_price'						:	inquiry_max_price,
							'inquiry_min_price'						:	inquiry_min_price,
							'inquiry_no_range'						:	inquiry_no_range,
							'inquiry_start_date'					:	inquiry_start_date,
							'inquiry_end_date'						:inquiry_end_date	,
							'inquiry_kids_age'						:age_text,
							'inquiry_text'								:	inquiry_text,
							'inquiry_areas'								: inquiry_areas,
							'inquiry_longlat'							: longlat,
							'inquiry_filters'							: inquiry_filters,
							'inquiry_other_filter'				: inquiry_other_filter,
							'inquiry_persons_quantities'	: inquiry_persons_quantities,
							'inquiry_children_quantities'	: inquiry_children_quantities,
							'inquiry_hotel_start_date'		: inquiry_hotel_start_date,
							'inquiry_hotel_end_date'			: inquiry_hotel_end_date,
							'inquiry_service_start_dates'	: inquiry_service_start_dates,
							'inquiry_service_end_date'		: inquiry_service_end_date,
							'inquiry_type'								: inquiry_type,
							'inquiry_image'								:	inquiry_image,
							'inquiry_single_rooms_quantities' : inquiry_single_rooms_quantities,
							'inquiry_double_rooms_quantities'	: inquiry_double_rooms_quantities,
							'g-recaptcha-response'				: g_recaptcha_response
							//'inquiry_direct_seller'				:	inquiry_direct_seller,
						}
			    },
			    function (response) {
						var response = JSON.parse(response);
						jQuery('html, body').animate({
				      scrollTop: 0
				    }, 500);
						if (response.status == 0) {
							console.log(" success "+response.message);
							/*jQuery('#message_area').find(".message_text").html(response.message);
							jQuery('#message_area').removeClass("hidden").fadeIn();
							jQuery('#message_area').addClass("active");*/
							window.location = '<?php echo get_site_url();?>/home-buyers/?inquiries=active';
						}
						else {
							console.log(" else  "+response.message);

							jQuery("body").removeClass("unscrollable");
							jQuery("#menu_section").removeClass("zindex0");
							display_error(response.message);


						}

					}
				);
				return false;
			});

			jQuery("select[name='temp_category']").live('change', function() {
				if (jQuery("select[name='temp_category']").val() == 376) {
					jQuery("input[name='inquiry_product_quantities']").val(null);
					jQuery("input[name='inquiry_max_price']").val(null);
					jQuery('.qtyPrice').css('visibility','hidden');
				}
				else {
					jQuery('.qtyPrice').css('visibility','visible');
				}

				if (jQuery(this).parent().parent().parent('.categories').attr('data-depth') == '1') {
					jQuery("select[name='temp_category']").each(function() {
						if (jQuery(this).parent().parent().parent('.categories').attr('data-depth') != '1') {
								jQuery(this).parent().parent().parent('.categories').remove();
						}
					});
				}

				jQuery(".categories select").each(function() {
					//remove duplicate all options
					if (jQuery(this).find("option[value='all']").length > 1) {
						jQuery(this).find("option[value='all']")[0].remove();
					}
					//remove duplicate all options
					if (jQuery(this).find("option[value!='all']:not(:disabled)").length == 1) {
						jQuery(this).find("option[value='all']").remove();
					}
				});
				var trgt = jQuery(this);
				var category = jQuery(this).val();
				window.thisSelect = jQuery(this).parent().parent().parent(".categories");



				//update hidden field
				if (jQuery(this).val() == "all") {
					var ids = [];

					jQuery(this).find("option[value!=all]:not(:disabled)").each(function(e) {
						ids.push(jQuery(this).val());
					});

					jQuery("input[name='category']").val(ids.join());
					return false;
				}
				else {
					jQuery("input[name='category']").val(jQuery(this).val());
				}
				jQuery('#addInquiry #filterData').html('');
				getFilters(jQuery(this).val());
			});
			jQuery(".filters ul li input[type='checkbox']").live('change', function() {
				if (this.checked) {
					getSubFilters(jQuery(this).val());
				}
				else {
					jQuery(".filters ul[data-parent='"+jQuery(this).val()+"'], .filters h4[data-parent='"+jQuery(this).val()+"']").remove();
				}
			});
		});

		jQuery(".clearFilter").live("click", function(e) {
			e.preventDefault();

			var target = jQuery(this).attr("data-filterId");
			//clear checkbox values
			jQuery(".filters ul[data-filterId='"+target+"']").each(function() {
				jQuery(this).find("input:checked").each(function() {
					var theVal = jQuery(this).val();
					jQuery(".filters h4[data-parent='"+theVal+"']").remove();
					jQuery(".filters ul[data-parent='"+theVal+"']").remove();
				});
				jQuery(this).find("input:checked").attr('checked',false);
			})
			jQuery(".filters ul[data-parent='"+target+"'] input:checked").attr('checked',false);

			//remove subfilters if any
			jQuery(".filters h4[data-parent='"+target+"']").remove();
			jQuery(".filters ul.subFilter[data-parent='"+target+"']").remove();

			return false;
		});

		jQuery(".clearAllFilters").live("click", function(e) {
			e.preventDefault();

			jQuery(".filters ul[data-filterId] input:checked").attr('checked',false);
			jQuery(".filters h4[data-parent]").remove();
			jQuery(".filters ul.subFilter").remove();

			return false;
		});

		jQuery("input[name='inquiry_max_price'], input[name='inquiry_product_quantities']").keyup(function() {
			if (jQuery(this).val().indexOf(',') != -1) {
				jQuery(this).val(jQuery(this).val().replace(',','.'));
			}
		});




		jQuery(".clear_filters-shape").on("click",function(){
	    //alert(12);
	    jQuery("#application_filters").find('input:checkbox').removeAttr('checked');
			jQuery("input[name='inquiry_filters[]']").trigger("change");
	  });


		jQuery(".application-filter-trigger-shape").on("click",function(){
					if(jQuery(this).hasClass("active")){
							jQuery('html').removeClass("unscrollable");
						jQuery(this).removeClass("active");
						jQuery(this).find(".close_f").addClass("hidden");
							jQuery(this).find(".open_f").removeClass("hidden");
						TweenMax.to(jQuery("#application_filters"),0.9,{left:'-400px',ease:Power2.easeOut});
					}else {
						jQuery(this).addClass("active");
							jQuery('html').addClass("unscrollable");
						jQuery(this).find(".open_f").addClass("hidden");
							jQuery(this).find(".close_f").removeClass("hidden");
					TweenMax.to(jQuery("#application_filters"),0.9,{left:0,ease:Power2.easeOut});
					}

		});

		//#offer_summary-col

		jQuery(".application-summary-trigger-shape").on("click",function(){
					if(jQuery(this).hasClass("active")){
						jQuery('html').removeClass("unscrollable");
						jQuery(this).removeClass("active");
						jQuery(this).find(".close_f").addClass("hidden");
							jQuery(this).find(".open_f").removeClass("hidden");
						TweenMax.to(jQuery("#offer_summary-col"),0.9,{right:'-900px',ease:Power2.easeOut});
					}else {
						jQuery(this).addClass("active");
						jQuery('html').addClass("unscrollable");
						jQuery(this).find(".open_f").addClass("hidden");
							jQuery(this).find(".close_f").removeClass("hidden");
					TweenMax.to(jQuery("#offer_summary-col"),0.9,{right:0,ease:Power2.easeOut});
					}

		});

		jQuery("#preview_inquiry").find(".close_preview").on("click",function(){
				jQuery(".application-summary-trigger-shape").trigger("click");
		});

		jQuery("#application_filters").find(".close_preview").on("click",function(){
				jQuery(".application-filter-trigger-shape").trigger("click");
		});

		function enable_create_request_btn()
		{
			jQuery("#create_request_btn").removeClass("disabledbutton");
			jQuery("#create_request_btn").addClass("tested");
		}

		function disable_create_request_btn()
		{
			jQuery("#create_request_btn").addClass("disabledbutton");
			jQuery("#create_request_btn").removeClass("tested");
		}
	</script>
	<script async defer
			src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCMppMJEwYHBiCntuoE5NA1Z-jClaa5X-k&callback=initMap">
			</script>



	<?php
		}

		?>
<?php
//get_sidebar();
get_footer();
