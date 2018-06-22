<?php
/*
	Seller switch set
*/



function getAccountSubcategories_html($parent_id)
{

	$catsArray = get_field('seller_product_categories','user_'.get_current_user_id());

	$cat_html="";
		//echo $subscription_root_category->ID;
	$mainCategories = get_posts(array(
		'post_type'		=>	'product_category',
		'hide_empty'	=> 0,
		'numberposts'		=> -1,
		'posts_per_page'=>-1,
		'post_parent'	=>	$parent_id
	));

	if(count($mainCategories)>0)
	{
		foreach($mainCategories as $category)
		{
			$temp_cat = get_posts(array(
			 'post_type'		=>	'product_category',
			 'hide_empty'	=> 0,
			 'numberposts'		=> -1,
			 'posts_per_page'=>-1,
			 'post_parent'	=>	$category->ID
		 ));

		 $checked="";
		 $hidden = "";

		 if(!empty($catsArray))
		 {
			 if(in_array($category->ID,$catsArray))
			{
				$hidden = "_hidden";
				$checked="checked";
			}
		 }

		 $hasChildren = "";
			if(count($temp_cat)>0)
			{
				 $hasChildren = "hasChildren";
			}


					$cat_html.="	<div id='addcat$category->ID' class='_tesi addcat$category->ID single-account-category-transform _white-bg _shadow _inline-block single-account-selection-transform $hidden $hasChildren' data-parentId='".get_post($category->ID)->post_parent."'>";
					$cat_html.="<div class='single-account-category-shape' data-cat_id='$category->ID' data-parent='".get_post(get_post($category->ID)->post_parent)->post_title."'>";
					$cat_html.="<div class='single-account-area-title blue bold'>";
					$cat_html.=$category->post_title;
					$cat_html.="</div>";
						 if( $hasChildren != "")
								{

							$cat_html.='<div  class="bold inline-block open_subcats pointer "><i class="material-icons blue close_subcat">remove_circle</i> <i class="material-icons blue open_subcat">add_circle</i> </div>';
							$cat_html.='<div  class=" inline-block all_subcats pointer area_input right '.$checked.'">';
							$cat_html.='<div class="icon_action checkbox_action inline-block pointer bold aqua">';
							$cat_html.='	<i class="material-icons md-24 aqua check ">check_box</i>';
							$cat_html.='	<i class="material-icons  md-24 aqua uncheck">check_box_outline_blank</i>';
							$cat_html.='</div>';
							//$cat_html.='<input type="checkbox" value="'.$category->ID.'" name="areas[]" '.$checked.'/>';
							$cat_html.=' Όλη</div>';

							}else {

							//$cat_html.='<div  class="bold inline-block no_subcats pointer area_input"><input type="checkbox" value="'.$category->ID.'" name="areas[]" '.$checked.'/></div>';

							}
							$cat_html .= '';
						$cat_html.='</div><div class="subcategories"></div></div>';


		}

	}

	return $cat_html;
}


add_action( 'wp_ajax_switch_role', 'switch_role' );
add_action( 'wp_ajax_nopriv_switch_role', 'switch_role' );

function switch_role(){


	if (is_user_logged_in()) {
			$currentUser = wp_get_current_user();

			$roles = $currentUser->roles;

			if (in_array('sellers',$roles)) {

				//check if buyer_view is on
				$buyer_view = get_field("buyer_view",$currentUser->ID);
				if(!$buyer_view || get_field("buyer_view",$currentUser->ID) !=  1)
				{
						//if in seller view
						update_field('buyer_view', 1,	$currentUser->ID);
				}else {
					//if in buyer view switch to seller view
						update_field('buyer_view', 0,	$currentUser->ID);
				}
				$result=1;
			}
		}

		$response['status'] = $result;
		$response['message'] = "";
		echo json_encode($response);
		wp_die();

}

add_action( 'wp_ajax_getAccountSubcategories', 'getAccountSubcategories' );
add_action( 'wp_ajax_nopriv_getAccountSubcategories', 'getAccountSubcategories' );

function getAccountSubcategories(){



		$response = array();


		if (isset($_POST)) {

			$cat_html = "";

			$parent_id = sanitize_text_field($_POST['cat_id']);


			//$cat_html = getAccountSubcategories_html($parent_id);
			$cat_html = getSellerAreasCats($parent_id,'seller_product_categories','product_category');

			$response['status'] = 1;
			$response['message'] = $cat_html;
			echo json_encode($response);
			wp_die();

		}else {
			$response['status'] = 0;
			$response['message'] = "Παρουσιάστηκε πρόβλημα";
			echo json_encode($response);
			wp_die();

		}

}


add_action( 'wp_ajax_update_seller_categories', 'update_seller_categories' );
add_action( 'wp_ajax_nopriv_update_seller_categories', 'update_seller_categories' );

function update_seller_categories(){

  /*$response['status'] = 1;
  $response['message'] = "938 ";
  echo json_encode($response);
  wp_die();*/

$response = array();
$prev_offers = array();
$prev_offersIds = array();
 $allCats =array();// = array_merge($children,$posts);
$msg="";

$response['status'] = 0;




if (isset($_POST['cats'])) {

  //Get previous open Inquiries
/*$prev_offers = get_field("sellers_open_requests","user_".get_current_user_id(),false);



  if(!is_array($prev_offers))
  {
    $prev_offers = array();
  }else {
    foreach($prev_offers as $inq)
    {
      array_push($prev_offersIds,$inq);
    }
  }*/


  //Get all input into an array- include children and grandchildren for Parents
$cats_temp =" $ ";

  $cats = $_POST['cats'];
  foreach($cats as $cat)
  {
    $parentCat = get_post($cat);
    array_push($allCats,$parentCat);
    $children = get_posts_children($cat ,"product_category");
    $allCats =  array_merge($children,$allCats);


  }



}

$allCatsIds = array();

foreach ($allCats as  $value) {
  //# code...
  $cats_temp .= " ".$value->ID	;
  array_push($allCatsIds,$value->ID	);
}


update_field('seller_product_categories',$allCatsIds,'user_'.get_current_user_id());
$response['status'] = 1;
$response['message'] = "Kατηγορίες Ανανεώθηκαν ";




$response['message'] .= setOpenRequests();

echo json_encode($response);
wp_die();

//seller_areas
}

function getSellerAreasCats($parent_id,$custom_fiels,$post_type)
{
		$catsArray = get_field($custom_fiels,'user_'.get_current_user_id(),false);

		$cat_html="";
			//echo $subscription_root_category->ID;
		$mainCategories = get_posts(array(
			'post_type'		=>	$post_type,
			'hide_empty'	=> 0,
			'numberposts'		=> -1,
			'posts_per_page'=>-1,
			'post_parent'	=>	$parent_id,
			'orderby'	=>'title',
			 'order' => 'ASC'
		));

		if(count($mainCategories)>0)
		{

$children ="";
$parents ="";

			foreach($mainCategories as $category)
			{
				$temp_cat = get_posts(array(
				 'post_type'		=>	$post_type,
				 'hide_empty'	=> 0,
				 'numberposts'		=> -1,
				 'posts_per_page'=>-1,
				 'post_parent'	=>	$category->ID
			 ));

			 $checked="";
			 $hidden = "";

			 if(!empty($catsArray))
			 {
				 if(in_array($category->ID,$catsArray))
				{
					$hidden = "_hidden";
					$checked="checked";
				}
			 }

			 $hasChildren = "";
				if(count($temp_cat)>0)
				{
					 $hasChildren = "hasChildren";
					 $cols_widths = " col-12";
				}else {
					 $cols_widths = " col-12 ";
				}


						$cat_html="	<div id='addcat$category->ID' class='_tesi__1 addcat$category->ID $cols_widths single-account-category-transform opaque _white-bg _shadow _inline-block single-account-selection-transform $hidden $hasChildren' data-parentId='".get_post($category->ID)->post_parent."'>";
						$cat_html.="<div class='single-account-category-shape' data-cat_id='$category->ID' data-parent='".get_post(get_post($category->ID)->post_parent)->post_title."'>";
						$cat_html.="<div class='single-account-area-title  _bold'>";
						$cat_html.=$category->post_title;
						$cat_html.="</div>";
							 if( $hasChildren != "")
									{

								$cat_html.='<div  class="bold inline-block open_subcats pointer "><i class="material-icons blue close_subcat">arrow_drop_up</i> <i class="material-icons blue open_subcat">arrow_drop_down</i> </div>';
								$cat_html.='<div  class=" _inline-block all_subcats pointer  area_input right '.$checked.' ">';
								$cat_html.='<div class="icon_action checkbox_action inline-block pointer bold aqua hidden">';
								$cat_html.='	<i class="material-icons md-24 aqua check hidden">check_box</i>';
								$cat_html.='	<i class="material-icons  md-24 aqua uncheck hidden">check_box_outline_blank</i>';
								$cat_html.='</div>';
								//$cat_html.='<input type="checkbox" value="'.$category->ID.'" name="areas[]" '.$checked.'/>';
								$cat_html.='</div>';

								}else {

								//$cat_html.='<div  class="bold inline-block no_subcats pointer area_input"><input type="checkbox" value="'.$category->ID.'" name="areas[]" '.$checked.'/></div>';

								}
								$cat_html .= '';
							$cat_html.='</div><div class="subcategories row"></div></div>';

							if(count($temp_cat)>0)
							{

								$parents .=$cat_html;
							}else {
								$children .=$cat_html;
							}
			}

		}

		$complete_html = $children.$parents;

		return $complete_html;
}

add_action( 'wp_ajax_getAccountsAreas', 'getAccountsAreas' );
add_action( 'wp_ajax_nopriv_getAccountsAreas', 'getAccountsAreas' );

function getAccountsAreas(){



		$response = array();


		if (isset($_POST)) {

			$cat_html = "";

			$parent_id = sanitize_text_field($_POST['cat_id']);


			//$cat_html = getAreas_html($parent_id);
			$cat_html = getSellerAreasCats($parent_id,'seller_areas','areas');

			$response['status'] = 1;
			$response['message'] = $cat_html;
			echo json_encode($response);
			wp_die();

		}else {
			$response['status'] = 0;
			$response['message'] = "Παρουσιάστηκε πρόβλημα";
			echo json_encode($response);
			wp_die();

		}

}

add_action( 'wp_ajax_update_seller_areas', 'update_seller_areas' );
add_action( 'wp_ajax_nopriv_update_seller_areas', 'update_seller_areas' );

function update_seller_areas(){
$response = array();

$prev_offers = array();
$prev_offersIds = array();
$allAreas =array();// = array_merge($children,$posts);
$msg="";
if (isset($_POST['areas'])) {

  //Get previous open Inquiries


/*
  if(!is_array($prev_offers))
  {
    $prev_offers = array();
  }else {
    foreach($prev_offers as $inq)
    {
      array_push($prev_offersIds,$inq->ID);
    }
  }*/


  //Get all input into an array- include children and grandchildren for Parents
  $areas = $_POST['areas'];
  foreach($areas as $area)
  {
    $parentArea = get_post($area);
    array_push($allAreas,$parentArea);
    $children = get_posts_children($area ,"areas");
    $allAreas =  array_merge($children,$allAreas);


  }

}

$allAreasIds = array();

foreach ($allAreas as  $value) {
  //# code...
  $cats_temp .= " ".$value->ID	;

  array_push($allAreasIds,$value->ID	);
}


update_field('seller_areas',$allAreasIds,'user_'.get_current_user_id());
$response['status'] = 1;
$response['message'] = "Περιοχές Ανανεώθηκαν ";

$response['message'] .= setOpenRequests();

echo json_encode($response);
wp_die();

//seller_areas


}

function setOpenRequests()
{
  //check for any Inquiries matching new criteria

  $changedInquiries = getOpenSellerInquiries() ;
  $prev_offers = get_field("sellers_open_requests","user_".get_current_user_id(),false);

  $difId = removeOldOffers($changedInquiries,$prev_offers,get_current_user_id());


  if (update_field('sellers_open_requests',$changedInquiries, 'user_'.get_current_user_id())) {
    $message= "Αιτημα Ανανεώθηκαν : diff ".$difId;//.count($inquiries_difference);//." - ".$difId;
  }
  else {
    $message= " Αιτημα ΔΕΝ Ανανεώθηκαν ".$changedInquiries[0]->ID;
  }

  return $message;
}


//calculate difference between arrays and remove user from inquiries

function removeOldOffers($changedInquiries,$prev_offersIds,$seller)
{

		$changedInquiriesIds = array();
		if(!is_array($changedInquiries))
		{
			$changedInquiries = (array)$changedInquiries;
		}else {
			foreach($changedInquiries as $inq)
			{
				array_push($changedInquiriesIds,$inq->ID);
			}
		}

	$difId = -1;
	if(!empty($changedInquiriesIds) && !empty($prev_offersIds))
	{
		//some previous offers have to be removed
		$inquiries_difference = array_diff($prev_offersIds,$changedInquiries);

		remove_offers_from_inquiry($inquiries_difference,$seller);
		$difId = -2;
	}else if(empty($changedInquiriesIds) && !empty($prev_offersIds))
	{
		//All previous offers have to dissapear

		remove_offers_from_inquiry($prev_offersIds,$seller);

		//$inquiries_difference = array_diff($prev_offers,$changedInquiries);
		$difId = '-3 > '.$prev_offersIds[0];
	}else if(!empty($changedInquiriesIds) && empty($prev_offersIds))
	{
		//no previous offers, do nothing
		//$inquiries_difference = array_diff($prev_offers,$changedInquiries);
		$difId = '-4 > '.$changedInquiriesIds[0];;
	}

	return $difId;

}



function getOpenSellerInquiries() {

	$areas = getMyAreas();
	$sellersBlacklistedUsers = get_field('seller_blacklist','user_'.get_current_user_id(),false);
	if (!is_array($sellersBlacklistedUsers)) { $sellersBlacklistedUsers = (array)$sellersBlacklistedUsers; }
	$sellersCategories = getSellerCategories();

	$args = array(
		'numberposts'		=> -1,
		'posts_per_page'=>-1,
		'post_type'			=> 'client_inquiry',
		'order'					=> 'ASC',
		'orderby'				=> 'post_date',
		'meta_query'		=> array(
			'relation'		=> 'AND',
			array(
				'key'	 			=> 'inquiry_status',
				'value'	  	=> 'active',
				'compare' 	=> '=',
			)
		)
	);

	$query = new WP_Query($args);
	$requests = array();
	$inquiryBlacklist = array();
	$inquiry_areas = array();
	$temp_inquiries = $query->posts;
	$sellerId = (int) get_current_user_id();
	$inquiries = array();

	foreach ($temp_inquiries as $inquiry) {
		array_push($inquiries,$inquiry->ID);
	}

	//filter seller's blacklisted users & inquiry buyer's blacklisted sellers- WORKS
	foreach ($inquiries as $inquiry) {
		$post_author = (int) get_post($inquiry)->post_author;
		$tempUserBlacklist = get_field('user_blacklist', 'user_'.$post_author, false);
		if (!is_array($tempUserBlacklist)) { $tempUserBlacklist = (array)$tempUserBlacklist; }
		$buyerBlacklistedSellers = array();
		foreach ($tempUserBlacklist as $seller) {
			array_push($buyerBlacklistedSellers,$seller);
		}

		if (in_array($sellerId,$buyerBlacklistedSellers,false)) {
			$key = array_search($inquiry,$inquiries);
			if ($key !== false) {
				unset($inquiries[$key]);
			}
		}
	}

	foreach ($inquiries as $inquiry) {
		$post_author = (int) get_post($inquiry)->post_author;
		foreach ($sellersBlacklistedUsers as $user) {
			if ($post_author == $user) {
				$key = array_search($inquiry,$inquiries);
				if ($key !== false) {
					unset($inquiries[$key]);
				}
			}
		}
	}


	//remove duplicate user
	foreach ($inquiries as $inquiry) {
		$post_author = (int) get_post($inquiry)->post_author;
		$key = array_search($inquiry,$inquiries);

		if (checkIfSameUser($post_author)) {
			unset($inquiries[$key]);
		}
	}

	//filter inquiry's category - WORKS
	foreach ($inquiries as $inquiry) {
		$temp_inquiryCategories = get_field('inquiry_product_category',$inquiry, true);
		$inquiryCategories = $temp_inquiryCategories;

		if (count(array_intersect($sellersCategories,$inquiryCategories)) === 0) {
			$key = array_search($inquiry,$inquiries);

			if ($key !== false) {
				unset($inquiries[$key]);
			}
		}
	}

	//filter inquiry's areas - WORKS
	foreach ($inquiries as $inquiry) {
		$inquiryAreas = get_field('inquiry_areas',$inquiry);

		if (count(array_intersect($areas,$inquiryAreas)) === 0) {
			$key = array_search($inquiry,$inquiries);

			if ($key !== false) {
				unset($inquiries[$key]);
			}
		}
	}

	//filter for specific seller
	foreach ($inquiries as $inquiry) {
		$hasSpecificSeller = get_field('inquiry_direct_seller',$inquiry);

		if (!empty($hasSpecificSeller) && $hasSpecificSeller['ID'] != get_current_user_id()) {
			$key = array_search($inquiry,$inquiries);

			if ($key !== false) {
				unset($inquiries[$key]);
			}
		}
	}

	//feed the results
	foreach ($inquiries as $inquiry) {
	//	array_push($requests,get_post($inquiry));
    array_push($requests,$inquiry);
	}


	return $requests;
}

//update_seller_general , seller_customer_contact

add_action( 'wp_ajax_update_seller_general', 'update_seller_general' );
add_action( 'wp_ajax_nopriv_update_seller_general', 'update_seller_general' );

function update_seller_general(){
	$response = array();
$error="";


if (isset($_POST)) {
  $reg_customer_contact="";
	$reg_seller_summary="";
	$reg_data_employees =  "";
	$reg_fb   = "";
	$reg_linkedin   = "";
	$reg_web = "";
	$reg_data_founded ="";
	$reg_custom_message = "";
	$reg_age ="";

	$reg_data_hotel_type="";
	$reg_seller_data_stars =  "";
	$reg_hotel_rooms  = "";


	if(isset($_POST['reg_data_hotel_type']))
	{
		$reg_data_hotel_type =sanitize_text_field($_POST['reg_data_hotel_type']);
	}

	if(isset($_POST['reg_seller_data_stars']))
	{
		$reg_seller_data_stars=sanitize_text_field($_POST['reg_seller_data_stars']);
	}

	if(isset($_POST['reg_hotel_rooms']))
	{
		$reg_hotel_rooms=sanitize_text_field($_POST['reg_hotel_rooms']);
	}

  if(isset($_POST['reg_customer_contact']))
	{
		$reg_customer_contact=sanitize_text_field($_POST['reg_customer_contact']);
	}

	$seller_details_subscription_tmpl_id=get_field('seller_details_subscription_tmpl_id',		"user_".get_current_user_id());

	if(is_array($seller_details_subscription_tmpl_id))
	{
		$seller_details_subscription_tmpl_id = $seller_details_subscription_tmpl_id[0];
	}




	if(isset($_POST['reg_seller_summary']))
	{
		$reg_seller_summary =sanitize_text_field($_POST['reg_seller_summary']);
	}

	if(isset($_POST['reg_age']))
	{
		$reg_age =sanitize_text_field($_POST['reg_age']);
	}


	if(isset($_POST['seller_custom_message']))
	{
		$reg_custom_message =$_POST['seller_custom_message'];
	}

	if(isset($_POST['reg_data_founded']))
	{
		$reg_data_founded =sanitize_text_field($_POST['reg_data_founded']);
	}

	if(isset($_POST['reg_data_employees']))
	{
		$reg_data_employees=sanitize_text_field($_POST['reg_data_employees']);
	}

	if(isset($_POST['reg_fb']))
	{
		$reg_fb=sanitize_text_field($_POST['reg_fb']);
	}

	if(isset($_POST['reg_linkedin']))
	{
		$reg_linkedin=sanitize_text_field($_POST['reg_linkedin']);
	}
	if(isset($_POST['reg_web']))
	{
		$reg_web=sanitize_text_field($_POST['reg_web']);
	}





	update_field("seller_custom_message",$reg_custom_message,	"user_".get_current_user_id());



	update_field("seller_data_age",$reg_age,$seller_details_subscription_tmpl_id);
	update_field("seller_data_facebook",$reg_fb,$seller_details_subscription_tmpl_id);

//seller_data_founded
	update_field("seller_data_founded",$reg_data_founded,$seller_details_subscription_tmpl_id);
	update_field("seller_data_linkedin",$reg_linkedin,$seller_details_subscription_tmpl_id);
	 update_field("seller_data_web",$reg_web,$seller_details_subscription_tmpl_id);
	 update_field("seller_data_summary",$reg_seller_summary,$seller_details_subscription_tmpl_id);
	 update_field("seller_data_employees",$reg_data_employees,$seller_details_subscription_tmpl_id);
  update_field("seller_customer_contact",$reg_customer_contact,	$seller_details_subscription_tmpl_id);

	 	update_field("seller_data_hotel_type",$reg_data_hotel_type,$seller_details_subscription_tmpl_id);
	 	update_field("seller_data_stars",$reg_seller_data_stars,$seller_details_subscription_tmpl_id);
	 	 update_field("seller_data_rooms",$reg_hotel_rooms,$seller_details_subscription_tmpl_id);

	 $response['status'] = 1;
 	$response['message'] = "Aλλαγή Επιτυχής ";//.$seller_details_subscription_tmpl_id." l> ".$reg_linkedin." f>".$reg_fb." w> ".$reg_web." s> ".$reg_seller_summary." e> ".$reg_data_employees." >".$reg_data_founded;;

 	echo json_encode($response);
 	wp_die();
}
}

?>
