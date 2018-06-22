<?php
/* ================================ */
/* USER ONLY FUNCTIONS BEGIN */
/* ================================ */

	// #ΕRROR TO FIX - Search for

define("SERVICE", "2742", true);
define("HOTEL", "1719", true);
define("PRODUCT", "1718", true);
define("PAGE_OPEN_BUYER","239",true);
define("PAGE_OPEN_SELLER","237",true);
define("SELLER_PROFILE","http://pricebook.gr/profile.php?c=",true);
define("UPLOADS_URL","http://pricebook.gr/pricebook/");

function reset_post_field($field_name,$owner)
{
	echo "AAA $field_name $owner ";
	$old = get_field($field_name,$owner);
	var_dump($old);
	$empty_array = array();
	update_field($field_name,$empty_array,$owner);
}


function filterOpenRequestsForRemoval($seller,$user)
{

      $prev_offers = get_field("sellers_open_requests","user_".$seller,false);
      $removeIds = array();
      foreach($prev_offers as $offer)
      {
          $result['message'] .= " # ".$offer." # ";
				//	$post_status = get_field

				$status = get_field('inquiry_status',$offer);


				if($status != 'active' )
				{
						continue;
				}

				//DELETE ONLY FROM ACTIVE OFFERS
        if(get_post($offer)->post_author == $user)
        {
          array_push($removeIds,$offer);

            $result['message'] .= " | ".$offer." | ";
        }
      }

      if(!empty($removeIds))
      {
        remove_offers_from_inquiry($removeIds,$seller);
      }

			return $result['message'];
}

	//Remove seller from offers held in array_  $inquiries

	function remove_offers_from_inquiry($inquiries,$seller)
	{

		foreach($inquiries as $inq)
		{
		//echo " : $inq :";
			$new_offers = array();
			$all_offers = get_field("inquiry_offers",$inq);
		//	var_dump($all_offers);
			foreach($all_offers as $offer)
			{

				//echo $offer['inquiry_seller']['ID']. ' > '.$seller;
				if($offer['inquiry_seller']['ID'] == $seller)
				{
					continue;
				}else {
					array_push($new_offers,$offer);
				}
			}
			//echo  " > Update inquiry_offers ".$comment->comment_ID;
			update_field("inquiry_offers",$new_offers,$inq);

			//var_dump($new_offers);

			$user_info = get_userdata($seller);


			$args = array(
			'author__in' => array("0"=>$seller),
			'post_id' => $inq

		);
		$comments = get_comments( $args );
		//var_dump($comments);

		foreach($comments as $comment)
		{
		//	echo  " > Delete Comment ".$comment->comment_ID."  : ".$comment->comment_content." #<br/>";
			 wp_delete_comment($comment->comment_ID);
		}


		}

		return 1;

	}




//move selected inquiry to sellers closed offers
function move_inquiry_to_closed_seller($post_id,$seller)
{
	//echo "MOVING TO CLOSED";
	$closed_requests = get_field('sellers_closed_offers','user_'.$seller,false);

	$result['status'] = 0;
	$result['message'] = 'Η προσφορά ολοκληρώθηκε αλλά δημιουργήθηκε σφάλμα κατά την 1963. '.$seller.' '.$post_id;

	if((empty($closed_requests)))
	{

		$closed_requests= array();
		//if (!is_array($user_successful_orders)) { $user_successful_orders = (array)$user_successful_orders; }
	}

	$new_closed = array();
	foreach($closed_requests as $key => $request)
	{
		if (intval($request) == intval($post_id)) {

		}else {
			//	$result['message'] .= 'error 1846 '.$request->post_title.' - '.$request->ID.'  ';
			array_push($new_closed,$request);
		}
	}

	array_push($new_closed,$post_id);

	if (!update_field('sellers_closed_offers', $new_closed, 'user_'.$seller )) {
		$result['status'] = 0;
		$result['message'] .= 'Η προσφορά ολοκληρώθηκε αλλά δημιουργήθηκε σφάλμα κατά την 1963. '.$notSeller.' '.$id;

	}else {

	}
}


function createPagination($currentCat, $level,$color="blue")
{
		$title="";
		$url = "http://pricebook.gr/" ;//get_site_url();
		//var_dump(get_object_vars($currentCat));
		$currentTemp = get_post($currentCat->post_parent);
		$titleAnchor = "<a class='$color' href='$url/products.php?c=$currentTemp->ID'>$currentTemp->post_title</a>";
		$level--;
		if($currentTemp->post_parent == 0 || $level == 0)
		{
			return $titleAnchor ;
		}

		$title= createPagination($currentTemp,$level).' <i class="material-icons md-18 blue inline-block middle">keyboard_arrow_right</i> '.$titleAnchor;

		return $title;;
}

function getParentId($currentCat)
{

		$currentTemp = get_post($currentCat->post_parent);

		if($currentTemp->post_parent == 0)
		{
			return $currentTemp->ID ;
		}

			$id = getParentId($currentTemp);

		return $id;;
}

//update_seller_data_work
add_action( 'wp_ajax_update_seller_data_certs', 'update_seller_data_certs' );
add_action( 'wp_ajax_nopriv_update_seller_data_certs', 'update_seller_data_certs' );

function update_seller_data_certs(){
	$response = array();
	$error="";


if (isset($_POST)) {

	$textarea="";




	if(isset($_POST['textarea']))
	{
		$textarea = sanitize_text_field($_POST['textarea']);
	}


	$seller_details_subscription_tmpl_id=get_field('seller_details_subscription_tmpl_id',		"user_".get_current_user_id());
	if(is_array($seller_details_subscription_tmpl_id))
	{
		$seller_details_subscription_tmpl_id = $seller_details_subscription_tmpl_id[0];
	}

	update_field("seller_data_qualifications_list",$textarea,$seller_details_subscription_tmpl_id);


	 $response['status'] = 1;
 	$response['message'] = "Aλλαγή Επιτυχής";

 	echo json_encode($response);
 	wp_die();
}
}

//update_seller_data_work
add_action( 'wp_ajax_update_seller_data_work', 'update_seller_data_work' );
add_action( 'wp_ajax_nopriv_update_seller_data_work', 'update_seller_data_work' );

function update_seller_data_work(){
	$response = array();
	$error="";


if (isset($_POST)) {

	$textarea="";




	if(isset($_POST['textarea']))
	{
		$textarea = sanitize_text_field($_POST['textarea']);
	}


	$seller_details_subscription_tmpl_id=get_field('seller_details_subscription_tmpl_id',		"user_".get_current_user_id());
	if(is_array($seller_details_subscription_tmpl_id))
	{
		$seller_details_subscription_tmpl_id = $seller_details_subscription_tmpl_id[0];
	}

	update_field("seller_data_work",$textarea,$seller_details_subscription_tmpl_id);


	 $response['status'] = 1;
 	$response['message'] = "Aλλαγή Επιτυχής";

 	echo json_encode($response);
 	wp_die();
}
}
//update_seller_data_education

add_action( 'wp_ajax_update_seller_data_education', 'update_seller_data_education' );
add_action( 'wp_ajax_nopriv_update_seller_data_education', 'update_seller_data_education' );

function update_seller_data_education(){
	$response = array();
	$error="";


if (isset($_POST)) {

	$textarea="";




	if(isset($_POST['textarea']))
	{
		$textarea = sanitize_text_field($_POST['textarea']);
	}


	$seller_details_subscription_tmpl_id=get_field('seller_details_subscription_tmpl_id',		"user_".get_current_user_id());
	if(is_array($seller_details_subscription_tmpl_id))
	{
		$seller_details_subscription_tmpl_id = $seller_details_subscription_tmpl_id[0];
	}

	update_field("seller_data_education",$textarea,$seller_details_subscription_tmpl_id);


	 $response['status'] = 1;
 	$response['message'] = "Aλλαγή Επιτυχής";

 	echo json_encode($response);
 	wp_die();
}
}

//update_hotel_amenities

add_action( 'wp_ajax_update_hotel_room_amenities', 'update_hotel_room_amenities' );
add_action( 'wp_ajax_nopriv_update_hotel_room_amenities', 'update_hotel_room_amenities' );

function update_hotel_room_amenities(){
	$response = array();
$error="";


if (isset($_POST)) {

	$reg_data_hotel_type="";
	$reg_seller_data_stars =  "";
	$reg_hotel_rooms  = "";


$array_amenities = array();
	if(isset($_POST['reg_hotel_room_amenities']))
	{
		$array_amenities = $_POST['reg_hotel_room_amenities'];
	}


	$seller_details_subscription_tmpl_id=get_field('seller_details_subscription_tmpl_id',		"user_".get_current_user_id());
	if(is_array($seller_details_subscription_tmpl_id))
	{
		$seller_details_subscription_tmpl_id = $seller_details_subscription_tmpl_id[0];
	}

	update_field("seller_data_room_amenities",$array_amenities,$seller_details_subscription_tmpl_id);


	 $response['status'] = 1;
 	$response['message'] = "Aλλαγή Επιτυχής";

 	echo json_encode($response);
 	wp_die();
}
}

//update_hotel_amenities

add_action( 'wp_ajax_update_hotel_amenities', 'update_hotel_amenities' );
add_action( 'wp_ajax_nopriv_update_hotel_amenities', 'update_hotel_amenities' );

function update_hotel_amenities(){
	$response = array();
$error="";


if (isset($_POST)) {

	$reg_data_hotel_type="";
	$reg_seller_data_stars =  "";
	$reg_hotel_rooms  = "";


$array_amenities = array();
	if(isset($_POST['reg_amenities']))
	{
		$array_amenities = $_POST['reg_amenities'];
	}


	$seller_details_subscription_tmpl_id=get_field('seller_details_subscription_tmpl_id',		"user_".get_current_user_id());
	if(is_array($seller_details_subscription_tmpl_id))
	{
		$seller_details_subscription_tmpl_id = $seller_details_subscription_tmpl_id[0];
	}

	update_field("seller_data_amenities",$array_amenities,$seller_details_subscription_tmpl_id);


	 $response['status'] = 1;
 	$response['message'] = "Aλλαγή Επιτυχής";

 	echo json_encode($response);
 	wp_die();
}
}

//update_hotel_general
add_action( 'wp_ajax_update_hotel_general', 'update_hotel_general' );
add_action( 'wp_ajax_nopriv_update_hotel_general', 'update_hotel_general' );

function update_hotel_general(){
	$response = array();
$error="";


if (isset($_POST)) {

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


	$seller_details_subscription_tmpl_id=get_field('seller_details_subscription_tmpl_id',		"user_".get_current_user_id());
	if(is_array($seller_details_subscription_tmpl_id))
	{
		$seller_details_subscription_tmpl_id = $seller_details_subscription_tmpl_id[0];
	}

	update_field("seller_data_hotel_type",$reg_data_hotel_type,$seller_details_subscription_tmpl_id);
	update_field("seller_data_stars",$reg_seller_data_stars,$seller_details_subscription_tmpl_id);
	 update_field("seller_data_rooms",$reg_hotel_rooms,$seller_details_subscription_tmpl_id);

	 $response['status'] = 1;
 	$response['message'] = "Aλλαγή Επιτυχής";

 	echo json_encode($response);
 	wp_die();
}
}


add_action( 'wp_ajax_update_user_address', 'update_user_address' );
add_action( 'wp_ajax_nopriv_update_user_address', 'update_user_address' );

function update_user_address(){
	$response = array();
$error="";


if (isset($_POST)) {

	$reg_area = $_POST['reg_area'];
	$reg_address = $_POST['reg_address'];
	$reg_pc = $_POST['reg_pc'];
	$reg_contactPhone = $_POST['reg_contactPhone'];

	if(empty($reg_area) || empty($reg_address) || empty($reg_pc) || empty($reg_pc))
	{
		$error.="Παρακαλουμε να συμπληρώσετε όλα τα πεδία<br/>";

							$response['status'] = 0;
							$response['message'] = $error;

							echo json_encode($response);
							wp_die();
	}


	if(strlen($reg_area)<2)
	{
		$error.='Something is wrong with Area';
	}

	if(strlen($reg_address)<2)
	{
		$error.='Something is wrong with address';
	}

	if(strlen(trim(str_replace(" ","",$reg_pc)))!=5)
	{
		$error.='Something is wrong with post_code';
	}

	if($error != "")
	{
		$response['status'] = 0;
		$response['message'] = $error;

		echo json_encode($response);
		wp_die();
	}


		$reg_area = sanitize_text_field($reg_area);
		$reg_address = sanitize_text_field($reg_address);
	$reg_pc =sanitize_text_field($reg_pc);
		$reg_contactPhone = sanitize_text_field($reg_contactPhone);

	update_field('seller_details_address',					$reg_address,				"user_".get_current_user_id());
	update_field('seller_details_area',							$reg_area,				"user_".get_current_user_id());
	update_field('seller_details_postcode',					$reg_pc,				"user_".get_current_user_id());
	update_field('seller_details_telephone',			$reg_contactPhone,				"user_".get_current_user_id());
	$response['status'] = 1;
	$response['message'] = "Αλλαγή Στοιχείων Επιτυχής";

	echo json_encode($response);
	wp_die();
}
}

// wp_set_password( $password, $user_id )


add_action( 'wp_ajax_update_user_pass', 'update_user_pass' );
add_action( 'wp_ajax_nopriv_update_user_pass', 'update_user_pass' );

function update_user_pass(){
	$response = array();
if (isset($_POST)) {
	$error="";
	$reg_pass = $_POST['reg_pass'];
	$reg_pass2 = $_POST['reg_pass2'];
	if((empty($reg_pass) || empty($reg_pass2)) || sanitize_text_field($reg_pass) != $reg_pass2)
	{
		$error.="Passwords do not match or invalid characters where used<br/>";

							$response['status'] = 0;
							$response['message'] = $error;

							echo json_encode($response);
							wp_die();
	}
	if (strlen($reg_pass) < 5) {
		$error.= 'Password length must be greater than 5';

		$response['status'] = 0;
		$response['message'] = $error;

		echo json_encode($response);
		wp_die();
	}

	wp_set_password( $reg_pass, get_current_user_id() );
		$response['status'] = 1;
		$response['message'] = "Αλλαγή Password Επιτυχής";

		echo json_encode($response);
		wp_die();

}
}

//

add_action( 'wp_ajax_update_seller_banner', 'update_seller_banner' );
add_action( 'wp_ajax_nopriv_update_seller_banner', 'update_seller_banner' );

function update_seller_banner(){


	$response = array();
	if (isset($_POST)) {

		if (isset($_POST['img_url']) )
		{

			$seller_details_subscription_tmpl_id=get_field('seller_details_subscription_tmpl_id',		"user_".get_current_user_id());
			if(is_array($seller_details_subscription_tmpl_id))
			{
				$seller_details_subscription_tmpl_id = $seller_details_subscription_tmpl_id[0];
			}
			$gallery = get_field("seller_data_banner",$seller_details_subscription_tmpl_id);

			$gallery_array = explode(",",$gallery);
			$new_img = sanitize_text_field($_POST['img_url']);
			if(!isset($_POST['delete']))
			{
				// Add to gallery


				if(!in_array($new_img,$gallery_array))
				{


					$gallery= $new_img;

					update_field("seller_data_banner",$gallery,$seller_details_subscription_tmpl_id);

					$response['status'] = 1;
					$response['message'] = "banner Saved";

					echo json_encode($response);
					wp_die();
				}else {
					# code...
					$response['status'] = 0;
					$response['message'] = "banner Failure";

					echo json_encode($response);
					wp_die();
				}
			}else {
				//delete




					if(in_array($new_img,$gallery_array))
					{


									$new_gallery = "";//""
									update_field("seller_data_banner",$new_gallery,$seller_details_subscription_tmpl_id);

									$response['status'] = 1;
									$response['message'] = "banner deleted Saved";

									echo json_encode($response);
									wp_die();

					}else {
						# code...
						$response['status'] = 0;
						$response['message'] = "banner deleted Failure";

						echo json_encode($response);
						wp_die();
					}

			}



		}
	}
}


add_action( 'wp_ajax_update_seller_gallery', 'update_seller_gallery' );
add_action( 'wp_ajax_nopriv_update_seller_gallery', 'update_seller_gallery' );

function update_seller_gallery(){



	$response = array();
	if (isset($_POST)) {

		if (isset($_POST['img_url']))
		{

			$seller_details_subscription_tmpl_id=get_field('seller_details_subscription_tmpl_id',		"user_".get_current_user_id());
			if(is_array($seller_details_subscription_tmpl_id))
			{
				$seller_details_subscription_tmpl_id = $seller_details_subscription_tmpl_id[0];
			}
			$gallery = get_field("seller_data_gallery",$seller_details_subscription_tmpl_id);

			$gallery_array = explode(",",$gallery);
			$new_img = sanitize_text_field($_POST['img_url']);
			if(!isset($_POST['delete']))
			{

							if(!in_array($new_img,$gallery_array))
							{

								if($gallery !="")
								{
									$gallery.=",";
								}
								$gallery.= $new_img;

								update_field("seller_data_gallery",$gallery,$seller_details_subscription_tmpl_id);

								$response['status'] = 1;
								$response['message'] = "gallery Saved";

								echo json_encode($response);
								wp_die();
							}else {
								# code...
								$response['status'] = 0;
								$response['message'] = "gallery Failure";

								echo json_encode($response);
								wp_die();
							}

			}else {

									if(in_array($new_img,$gallery_array))
									{		$new_gallery="";
													foreach($gallery_array as $key=> $gallery)
													{
														if($gallery == $new_img)
														{
															continue;
														}else {
															if($new_gallery=="")
															{
																$new_gallery .=$gallery;
															}else {
																	$new_gallery .=",".$gallery;
															}

														}
													}

													// = implode(",",$gallery);
													update_field("seller_data_gallery",$new_gallery,$seller_details_subscription_tmpl_id);

													$response['status'] = 1;
													$response['message'] = "gallery delete Saved : ".$new_gallery;

													echo json_encode($response);
													wp_die();

									}else {
										# code...
										$response['status'] = 0;
										$response['message'] = "gallery delete  Failure";

										echo json_encode($response);
										wp_die();
									}
			}





		}
	}
}



add_action( 'wp_ajax_update_seller_certificate', 'update_seller_certificate' );
add_action( 'wp_ajax_nopriv_update_seller_certificate', 'update_seller_certificate' );

function update_seller_certificate(){



	$response = array();
	if (isset($_POST)) {

		if (isset($_POST['img_url']))
		{
			$seller_details_subscription_tmpl_id=get_field('seller_details_subscription_tmpl_id',		"user_".get_current_user_id());
			if(is_array($seller_details_subscription_tmpl_id))
			{
				$seller_details_subscription_tmpl_id = $seller_details_subscription_tmpl_id[0];
			}
			$gallery = get_field("seller_data_certifications",$seller_details_subscription_tmpl_id);

			$gallery_array = explode(",",$gallery);
			$new_img = sanitize_text_field($_POST['img_url']);

			if(!isset($_POST['delete']))
			{

				if(!in_array($new_img,$gallery_array))
				{

					if($gallery !="")
					{
						$gallery.=",";
					}
					$gallery.= $new_img;

					update_field("seller_data_certifications",$gallery,$seller_details_subscription_tmpl_id);

					$response['status'] = 1;
					$response['message'] = "Certificates Saved";

					echo json_encode($response);
					wp_die();
				}else {
					# code...
					$response['status'] = 0;
					$response['message'] = "Certificates Failure";

					echo json_encode($response);
					wp_die();
				}

			}else {
				if(in_array($new_img,$gallery_array))
				{		$new_gallery="";
								foreach($gallery_array as $key=> $gallery)
								{
									if($gallery == $new_img)
									{
										continue;
									}else {
										if($new_gallery=="")
										{
											$new_gallery .=$gallery;
										}else {
												$new_gallery .=",".$gallery;
										}

									}
								}

								// = implode(",",$gallery);
								update_field("seller_data_certifications",$new_gallery,$seller_details_subscription_tmpl_id);

								$response['status'] = 1;
								$response['message'] = "Certification delete Saved : ".$new_gallery;

								echo json_encode($response);
								wp_die();

				}else {
					# code...
					$response['status'] = 0;
					$response['message'] = "Certification delete  Failure";

					echo json_encode($response);
					wp_die();
				}

			}



		}
	}
}


//Get custom avatar solution, if none exists fall back to gravatar
function getCustomAvatar($user=-1,$img=false)
{
	if($user == -1)
	{
		$user = get_current_user_id();
	}
	$current_user_login= get_the_author_meta('user_login',$user);// wp_get_current_user();
	$upload_dir   = wp_upload_dir();
	$user_dirname = $upload_dir['basedir'].'/'.$current_user_login;
	$avatar_dir = $user_dirname."/avatar";
	$targetPathJPG = $avatar_dir."/avatar.jpg";
	$targetPathPNG = $avatar_dir."/avatar.png";



	 if($img)
	 {
		 $avatar=get_avatar($user,192);
			if(file_exists( $targetPathJPG ))
			{
				$avatar = UPLOADS_URL."/wp-content/uploads/".$current_user_login."/avatar"."/avatar.jpg";
					$avatar="<img src='$avatar' />";
			}else if(file_exists( $targetPathPNG ))
			{
				$avatar = UPLOADS_URL."/wp-content/uploads/".$current_user_login."/avatar"."/avatar.png";
					$avatar="<img src='$avatar' />";
			}

	 }else {
		 $avatar=get_avatar_url($user,192);
			if(file_exists( $targetPathJPG ))
			{
				$avatar = UPLOADS_URL."/wp-content/uploads/".$current_user_login."/avatar"."/avatar.jpg";
			}else if(file_exists( $targetPathPNG ))
			{
				$avatar = UPLOADS_URL."/wp-content/uploads/".$current_user_login."/avatar"."/avatar.png";
			}
	 }
	// echo '<h1>YOYOYOYOYO'.$targetPathJPG.'</h1>';
	 return $avatar;
}

add_action( 'wp_ajax_uploadImageFiles', 'uploadImageFiles' );
add_action( 'wp_ajax_nopriv_uploadImageFiles', 'uploadImageFiles' );

function uploadImageFiles(){

	$max_image_width = 600;
		$isAvatar =false;
	$current_user = wp_get_current_user();
	$upload_dir   = wp_upload_dir();


	// Check if the form was submitted
	if($_SERVER["REQUEST_METHOD"] == "POST"){

		// Check if file was uploaded without errors

		if(isset($_POST['size']))
		{
			if($_POST['size'] == "#profile-banner")
			{
				$max_image_width = 1200;
			}else if($_POST['size'] == "#avatar-container")
				{
					$max_image_width = 140;
					$isAvatar =true;
				}
		}

		if(is_array($_FILES)) {
			if(is_uploaded_file($_FILES['photo']['tmp_name'])) {
				$sourcePath = $_FILES['photo']['tmp_name'];


				$allowed = array("JPG" => "image/jpg", "jpg" => "image/jpg", "jpeg" => "image/jpeg","JPEG" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");

        $filename = $_FILES["photo"]["name"];

        $filetype = $_FILES["photo"]["type"];

        $filesize = $_FILES["photo"]["size"];

				list($width, $height, $type, $attr) = getimagesize($_FILES["photo"]['name']);

				$ext = pathinfo($filename, PATHINFO_EXTENSION);

				if(!array_key_exists($ext, $allowed))
				{


					$response['status'] = 0;
					$response['message'] = "Error: Please select a valid file format";
					echo json_encode($response);
					wp_die();
				}


				        // Verify file size - 5MB maximum

				$maxsize = 5 * 1024 * 1024;

				 if($filesize > $maxsize){


 					$response['status'] = 0;
 					$response['message'] = "Error: File size is larger than the allowed limit.";
 					echo json_encode($response);
 					wp_die();
 				}

			//	$targetPath = "/wp-content/uploads/user_images/".$_FILES['userImage']['name'];
			//$targetPath = "/uploads/".$_FILES['userImage']['name'];


			//$targetPath = $upload_dir.$_FILES['userImage']['name'];

			$user_dirname = $upload_dir['basedir'].'/'.$current_user->user_login;
			if ( ! file_exists( $user_dirname ) ) {
			 wp_mkdir_p( $user_dirname );
	 		}




			if($isAvatar)
			{
					$avatar_dir = $user_dirname."/avatar";
					if ( ! file_exists( $avatar_dir ) ) {
					 wp_mkdir_p( $avatar_dir );
			 		}

					$targetPath = $avatar_dir."/avatar.".$ext;
			}else {
				$santitized_path = strtolower(preg_replace(array('/[^\w\(\).-]/i','/(_)\1+/'),'_',$_FILES['photo']['name']));
				$targetPath = $user_dirname."/".$santitized_path ;
			}




			$filename_n =$santitized_path;

			if ( !$isAvatar && file_exists( $targetPath )) {

				$filename_n = rand(1000,600000).$filename_n;

			 	$targetPath = $user_dirname."/".$filename_n;
			}

				if(move_uploaded_file($sourcePath,$targetPath)) {


					$file = $targetPath;
					//indicate the path and name for the new resized file
					if($isAvatar)
					{
						$resizedFile = $targetPath;
					}else {
						$resizedFile = $user_dirname."/resized_".$filename_n;
					}

					//call the function (when passing path to pic)

					$img_ratio = $width/$height;
					$n_width = $width > 600?600:$width;
					$n_height = $width/$img_ratio;
					if(true)
					{
						if(smart_resize_image($file , null, $max_image_width , $max_image_width , true , $resizedFile , false , false ,50 ))
						{
							$response['status'] = 1;
							$response['message'] = "RESIZED > ".$width. " -- ".$targetPath;

							if($isAvatar)
							{
								$img_url = "/wp-content/uploads/".$current_user->user_login."/avatar"."/avatar.".$ext;
							}else {
								$img_url = "/wp-content/uploads/".$current_user->user_login."/resized_".$filename_n;
							}

							$response['image_url'] =$img_url;

							echo json_encode($response);
							wp_die();
						}else {
							$response['status'] = 0;
							$response['message'] = "Error resizing ".$sourcePath.' vs '.$targetPath;
							echo json_encode($response);
							wp_die();
						}
					}else {
						$response['status'] = 1;
						$response['message'] =$width." -- ".$targetPath;
						$response['image_url'] = "/wp-content/uploads/".$current_user->user_login."/".$filename_n;

						echo json_encode($response);
						wp_die();
					}



					//	<!-- <img src="<?php echo $targetPath; " width="200px" height="200px" class="upload-preview" /> -->

				}else {
					$response['status'] = 0;
					$response['message'] = "move error ".$sourcePath.' vs '.$targetPath;
					echo json_encode($response);
					wp_die();
				}
			}else {
				$response['status'] = 2;
				$response['message'] = "error 2";
				echo json_encode($response);
				wp_die();
			}

		}else {
			$response['status'] = 3;
			$response['message'] = "error 3";
			echo json_encode($response);
			wp_die();
		}
	}else {
		$response['status'] = 4;
		$response['message'] = "error 4";
		echo json_encode($response);
		wp_die();
	}



}
add_action( 'wp_ajax_getAllAreaChildren', 'getAllAreaChildren' );
add_action( 'wp_ajax_nopriv_getAllAreaChildren', 'getAllAreaChildren' );

function getAllAreaChildren()
{


	if(isset($_POST['cat_id']) )
	{
		$parent_id  =  esc_attr($_POST['cat_id']);
	}else {

		$response['status'] = 0;
		$response['message'] = "error ".$_POST['cat_id'];
		echo json_encode($response);
		wp_die();

	}

	 getAllChildren($parent_id,'areas');


}




function has_children($child) {
	$c = count( get_posts( array('post_parent' => $child->ID, 'post_type' => $child->post_type) ) );
	if($c == 0)
	{
		return false;
	}else {
		return true;
	}
}





function getAreas_html($parent_id)
{

//get users areas_details

$areasArray = get_field('seller_areas','user_'.get_current_user_id());

	$cat_html="";
		//echo $subscription_root_category->ID;
	$mainCategories = get_posts(array(
		'post_type'		=>	'areas',
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
			 'post_type'		=>	'areas',
			 'hide_empty'	=> 0,
			 'numberposts'		=> -1,
			 'posts_per_page'=>-1,
			 'post_parent'	=>	$category->ID
		 ));

		 $checked="";


		 if(isset($areasArray) && !empty($areasArray))
		 {
			 if(in_array($category->ID,$areasArray))
 			{
				//continue;
 				$checked="checked";
 			}
		 }


		 $hasChildren = "";
			if(count($temp_cat)>0)
			{
				 $hasChildren = "hasChildren";
			}
/*
<div class="single_selected_item-transform inline-block" data-area="<?php echo $area;?>">
	<input class="hidden" type="checkbox" value="<?php echo $area;?>" name="areas[]" checked/>
	<div class="single_selected_item-shape shadow white-bg radius2">


		<div class="selected_item_title blue bold">
			<?php echo get_post($area)->post_title ;?>
		</div>
		<div class="selected_item_parent grey3 ">
			<?php echo get_post(get_post($area)->post_parent)->post_title ;?>
		</div>
		<div class="map green">
			<?php echo get_field("area_longlat",$area);?>
		</div>
	</div>
</div>

*/


		$cat_html.="	<div id='addarea$category->ID' class='single-account-area-transform _white-bg _shadow _inline-block single-account-selection-transform $hasChildren' data-parentId='".get_post($category->ID)->post_parent."'>";
		$cat_html.="<div class='single-account-area-shape' data-cat_id='$category->ID' data-parent='".get_post(get_post($category->ID)->post_parent)->post_title."' data-longlat='".get_field("area_longlat",$category->ID)."'>";
		$cat_html.="<div class='single-account-area-title blue bold'>";
		$cat_html.=$category->post_title;
		$cat_html.="</div>";
			 if( $hasChildren != "")
					{

				$cat_html.='<div  class="bold inline-block open_subcats pointer "><i class="material-icons blue close_subcat">remove_circle</i> <i class="material-icons blue open_subcat">add_circle</i>  </div>';
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

















add_action( 'wp_ajax_gsisCheck', 'gsisCheck' );
add_action( 'wp_ajax_nopriv_gsisCheck', 'gsisCheck' );

function gsisCheck(){

}



//Remove the selected inquiry from the sellers list. Future implementation will move the seletd inquiry to the ignred list with timestamp
add_action( 'wp_ajax_ignoreInquiry', 'ignoreInquiry' );
add_action( 'wp_ajax_nopriv_ignoreInquiry', 'ignoreInquiry' );
function ignoreInquiry()
{


if ($_POST && is_user_logged_in()) {
	$id = $_POST['data']['inquiryId'];
	$seller = get_current_user_id();
	$msg = '';
	$msg.=get_post($id)->post_title;
	$newOpenInquiries = array();
	//recreate open inquiries


 $remove_response = remove_inquiry_from_open_seller($id,$seller);
 //$result['status'] = remove_offers_from_inquiry(array("0"=>$id),$seller);



		if($remove_response['status'] == 1)
		{

		$response['status'] = 1;
		$response['message'] = 'To αίτημα '.$msg.' αφαιρέθηκε απο την λίστα σας.';

		$array_temp = array("0"=> intval($id));

		remove_offers_from_inquiry($array_temp,$seller);


	}
	else {
		$response['status'] = 0;
		$response['message'] = 'To αίτημα '.$msg.' δεν αφαιρέθηκε απο την λίστα σας λόγω κάποιου λάθους.';
	}
}else {
	$response['status'] = 0;
	$response['message'] = 'To αίτημα '.$msg.' δεν αφαιρέθηκε απο την λίστα σας γιατι δεν ειστε συνδεδεμένοι';
}



				echo json_encode($response);
				wp_die();


}

//retrieves the sellers list of open inquiries
//$all_offers = 0 : unsuccesful, 2:successful
function getClosedSellerInquiriesFromList($seller,$page_no=1,$posts_per_page=10,$order = 0,$all_offers=1)
{

	$requests = array();
	if($all_offers==0)
	{
		$closedInquiries = get_field('sellers_closed_offers','user_'.$seller,false);
		$successfulInquiries=array();
	}else if($all_offers==2)
	{
		$closedInquiries=array();
			$successfulInquiries = get_field('sellers_successful_offers','user_'.$seller,false);
	}else {
			$successfulInquiries = get_field('sellers_successful_offers','user_'.$seller,false);
			$closedInquiries = get_field('sellers_closed_offers','user_'.$seller,false);
	}



	if (!is_array($closedInquiries)) { $closedInquiries = (array)$closedInquiries; }
	if (!is_array($successfulInquiries)) { $successfulInquiries = (array)$successfulInquiries; }


	if($order == 1) //reverse
	{
	$successfulInquiries = array_reverse($successfulInquiries);
	$closedInquiries =  array_reverse($closedInquiries);
	}

	$openInquiries = array_merge($successfulInquiries,$closedInquiries);


	//print_r($closedInquiries);

	if (!is_array($openInquiries)) { $openInquiries = (array)$openInquiries; }

	$sellersBlacklistedUsers = get_field('seller_blacklist','user_'.$seller,false);
	if (!is_array($sellersBlacklistedUsers)) { $sellersBlacklistedUsers = (array)$sellersBlacklistedUsers; }


	$start_from = ($page_no-1)*$posts_per_page;
	$end = $start_from+$posts_per_page;
	$counter = 0;


	foreach($openInquiries as $inquiry)
	{
		//echo ">> $inquiry->ID <<" ;
		if(!($inquiry))
		{
			continue;
		}
		//filter seller's blacklisted users & inquiry buyer's blacklisted sellers- WORKS

			if( get_post($inquiry)->post_status !="publish")
			{
				continue;
			}

			$post_author = (int) get_post($inquiry)->post_author;
			$tempUserBlacklist = get_field('user_blacklist', 'user_'.$post_author, false);
			if (!is_array($tempUserBlacklist)) { $tempUserBlacklist = (array)$tempUserBlacklist; }

		/*	$buyerBlacklistedSellers = array();

			foreach ($tempUserBlacklist as $seller) {
				array_push($buyerBlacklistedSellers,$seller);
			}*/

			if (in_array($seller,$tempUserBlacklist,false)) {
				continue;
			}

			if (in_array($post_author,$sellersBlacklistedUsers,false)) {
				continue;
			}

		//if all good, push to $requests
		$counter++;


					if($counter < $start_from+1)
								{
							continue;
								}


					if($counter <= $end)
								{
							array_push($requests,get_post($inquiry));
								}







	} //end main foreach


	$response =array();
	$response['requests']=$requests;
	$response['total'] = $counter;
	return $response;


}


//retrieves the sellers list of open inquiries
function getOpenSellerInquiriesFromList($seller,$page_no=1,$posts_per_page=10,$order = 0,$all_offers=1)
{
//	echo $page_no." > ".$posts_per_page." > ".$order." > ".$all_offers." > ";
	$requests = array();
	$openInquiries = get_field('sellers_open_requests','user_'.$seller,false);

	if($order ==1)
	{
		$openInquiries = array_reverse($openInquiries);
	}
	//var_dump($openInquiries);
	if (!is_array($openInquiries)) { $openInquiries = (array)$openInquiries; }

	$sellersBlacklistedUsers = get_field('seller_blacklist','user_'.$seller,false);

	$openInquiries = array_reverse($openInquiries);
	if (!is_array($sellersBlacklistedUsers)) { $sellersBlacklistedUsers = (array)$sellersBlacklistedUsers; }


	$start_from = ($page_no-1)*$posts_per_page;
	$end = $start_from+$posts_per_page;
	$counter = 0;



	foreach($openInquiries as $inquiry)
	{

		//filter seller's blacklisted users & inquiry buyer's blacklisted sellers- WORKS

		if(!($inquiry))
		{
			continue;
		}

			if( get_post($inquiry)->post_status !="publish")
			{
				continue;
			}




			$post_author = (int) get_post($inquiry)->post_author;
			$tempUserBlacklist = get_field('user_blacklist', 'user_'.$post_author, false);
			if (!is_array($tempUserBlacklist)) { $tempUserBlacklist = (array)$tempUserBlacklist; }

		/*	$buyerBlacklistedSellers = array();

			foreach ($tempUserBlacklist as $seller) {
				array_push($buyerBlacklistedSellers,$seller);
			}*/

			if (in_array($seller,$tempUserBlacklist,false)) {
				continue;
			}

			if (in_array($post_author,$sellersBlacklistedUsers,false)) {
				continue;
			}


			$req_status = get_field("inquiry_status", get_post($inquiry)->ID,false);
			//echo "> STATUS : $req_status <".gettype($inquiry);



			if($req_status =="complete")
			{
				var_dump($inquiry);
			//	echo "> MOVING  : $inquiry <";
				remove_inquiry_from_open_seller($inquiry,get_current_user_id());
				move_inquiry_to_closed_seller($inquiry,get_current_user_id());

				continue;
			}




			//if all offers do not filter

				if($all_offers !=0 &&  $all_offers !=2 )
				{
					$counter++;

			//		echo $counter;

					if($counter < $start_from+1)
								{
							continue;
								}


					if($counter <= $end)
								{
							array_push($requests,get_post($inquiry));
								}


				}else {

						//if fltering
						//if filtering of offers is REQUEST_METHOD
							$theoffer = getOffer($inquiry,get_current_user_id());
							if(!empty($theoffer['pending']))
							{
								$hasOffer = true;
							}

							if($all_offers == 0  && !$hasOffer)
							 {
								 $counter++;
							//	 echo "NO Offer > ".$counter;

								 if($counter < $start_from+1)
								{
									continue;
								}

								if($counter <= $end)
								{
									 array_push($requests,get_post($inquiry));
								}

							 }else if ($all_offers == 2  && $hasOffer)
							 {
								 $counter++;
							//		echo "Offer > ".$counter;

									if($counter < $start_from+1)
								 {
									 continue;
								 }

								 if($counter <= $end)
								 {
										array_push($requests,get_post($inquiry));
								 }

							 }




				}





					$hasOffer = false;









			//get offer status








	} //end main foreach

	//echo $counter;
	$response =array();
	$response['requests']=$requests;
	$response['total'] = $counter;
	return $response;

}


function getUserBlacklist($withSales = null) {
	$blacklist = get_field('user_blacklist','user_'.get_current_user_id(),false);
	if (!is_array($blacklist)) { $blacklist = (array)$blacklist; }

	if (!is_null($withSales)) {

			$args = array(
				'numberposts'		=> -1,
				'post_type'			=> 'client_inquiry',
				'order'					=> 'ASC',
				'orderby'				=> 'post_date',
				'author'				=> get_current_user_id(),
				'meta_query' => array(
					'relation'		=> 'AND',
					array(
						'key'	 			=> 'inquiry_status',
						'value'	  	=> 'active',
						'compare' 	=> '!=',
					)
				)
			);

			$query = new WP_Query($args);
			$requests = array();
			$requests = $query->posts;
			$sellers = $blacklist;

			$succeded = array();
			if (!empty($sellers)) {

				foreach ($requests as $request) {
					foreach ($sellers as $sel) {
						$offers = get_field('inquiry_offers',$request->ID);
						foreach ($offers as $offer) {
							if ($offer['inquiry_seller']['ID'] == $sel && $offer['inquiry_status'] == 'succeeded') {
								$succeded[$offer['inquiry_seller']['ID']][] = $request->ID;
							}
						}
					}
				}
			}

			foreach ($sellers as $sel) {
				if (!array_key_exists($sel,$succeded)) {
					$succeded[$sel] = 0;
				}
			}

			$totals = array();
			foreach ($succeded as $key=>$val) {
				if ($val[0] == 0) {
					$totals[$key][] = 0;
				}
				else {
					$totals[$key][] = (int) sizeof($val);
				}
			}
			return $totals;
	}
	else {
		return $blacklist;
	}
}
function getAllOffers($id) {
	if (!$id) { return false; }

	$offers = get_field('inquiry_offers',$id, true);
	$blacklist = getUserBlacklist();

	$result = array();
	$result['pending'] = array();
	$result['succeeded'] = array();
	$result['failed'] = array();
	$result['ignored'] = array();
	$result['best'] = array();
	$result['interesting'] = array();
	$blacklisted = false;
	$result['awesome'] = array();
	$result['latest'] = array();

	if (!empty($offers)) {
		$offerCosts = array();
		foreach ($offers as $offer) {
			//check if is isService
			$cats = get_field('inquiry_product_category',$id);
			$isService = false;

			if ($cats != SERVICE || in_array(SERVICE,$cats)) {
				foreach ($cats as $cat) {
					$parents = get_post_ancestors($cat);
					if (!empty($parents)) {
						foreach ($parents as $parent) {
							array_push($cats,$parent);
						}
					}
					//array_push($cats);
				}
			}

			//is sevice
			if (in_array(SERVICE,$cats)) {
				$isService = true;
			}

			//get best offer based on price

			if ($isService) { $offer['inquiry_seller_quantity'] = 1; }

			if ($offer['inquiry_seller_unit_cost'] != 0) {
				$total = (number_format((float)$offer['inquiry_seller_quantity'], 2, '.', '') * number_format((float)$offer['inquiry_seller_unit_cost'], 2, '.', '') + number_format((float)$offer['inquiry_seller_cashondelivery_cost'], 2, '.', '') + number_format((float)$offer['inquiry_seller_delivery_cost'], 2, '.', '') );
				if (!in_array($offer['inquiry_seller']['ID'],$blacklist)) {
					array_push($offerCosts,array('seller'=>$offer['inquiry_seller']['ID'],'total'=>$total));
				}
			}

			$status = $offer['inquiry_status'];
			if (!empty($blacklist)) {
				foreach ($blacklist as $list) {
					if ($list == $offer['inquiry_seller']['ID']) {


						$inquiries = array('0'=>$id);
						if($status == 'active')
						{
							remove_offers_from_inquiry($inquiries,$offer['inquiry_seller']['ID']);
							$blacklisted = true;
						}else {
							# code...
							$blacklisted = false;
						}
					}
					else {
						$blacklisted = false;
					}
				}
			}

			if (!$blacklisted) {
				switch ($status) {
					case 'pending':
						if ($offer['inquiry_seller_interesting'] == true) {
							array_push($result['interesting'],$offer);
						}
						else {
							array_push($result['pending'],$offer);
						}
						break;
					case 'succeeded':
						array_push($result['succeeded'],$offer);
						break;
					case 'failed':
						array_push($result['failed'],$offer);
						break;
					case 'ignored':
						array_push($result['ignored'],$offer);
						break;
					default:
						break;
				}
			}
		}

		if (!function_exists('sortByPrice')) {
			function sortByPrice($a, $b) {
		    return $a['total'] - $b['total'];
			}
		}

		usort($offerCosts, 'sortByPrice');
		$ss = 0;

		foreach ($result['pending'] as $offer) {
			if ((intval($offer['inquiry_seller']['ID']) == intval($offerCosts[0]['seller'])) || $offer['inquiry_seller_bestoffer']) { //push if its the best ora has been flagged by the user as best
					//$result['best'] = array($offer);
					array_push($result['best'],$offer);
					$result['nextBest'] = $offerCosts[0]['total'];
					unset($result['pending'][$ss]);
					//break;
			}
			$ss++;
		}

		$restSorted = array();
		foreach ($offerCosts as $key=>$val) {
			foreach ($result['pending'] as $shit) {
					if ($shit['inquiry_seller']['ID'] == $offerCosts[$key]['seller']) {
						array_push($restSorted,$shit);
					}
			}
		}
			$result['pending'] = $restSorted;

			$interestingSorted = array();
			foreach ($offerCosts as $key=>$val) {
				foreach ($result['interesting'] as $shit) {
					if ($shit['inquiry_seller']['ID'] == $offerCosts[$key]['seller']) {
						array_push($interestingSorted,$shit);
					}
				}
			}
			$result['interesting'] = $interestingSorted;

			$fin = 0;
			$newInteresting = array();
			foreach ($result['interesting'] as $res) {
				if ((intval($res['inquiry_seller']['ID']) == intval($offerCosts[0]['seller'])) || $res['inquiry_seller_bestoffer']) {
				//	$result['best'] = array($res);
					array_push($result['best'],$res);
					$result['nextBest'] = $offerCosts[0]['total'];
					unset($result['interesting'][$fin]);
				}
				$fin++;
			}
	}

	return $result;
}



function getOffer($id,$sellerid) {
	if (!$id || !$sellerid) { return false; }
	$offers = get_field('inquiry_offers',$id, true);
	$blacklist = getUserBlacklist();
	$result = array();

	$blacklisted = false;

	if ($offers && sizeof($offers) > 0) {
		$result['status']=array();
		$result['inquiry_new_messages']=array();
		$result['pending'] = array();
		$result['succeeded'] = array();
		$result['failed'] = array();
		$result['ignored'] = array();
		foreach ($offers as $offer) {

			if (!empty($blacklist)) {
				foreach ($blacklist as $list) {
					if ($list == $offer['inquiry_seller']['ID']) {
						$blacklisted = true;
					}
					else {
						$blacklisted = false;
					}
				}
			}

			if ($offer['inquiry_seller']['ID'] == $sellerid && !$blacklisted) {

				$status = $offer['inquiry_status'];
				array_push($result['status'],$status);

				$inquiry_seller_lastmessage = $offer['inquiry_seller_lastmessage'];
				$messages = getInquiryConversation($id,get_post($id)->post_author);
				$new_msgs_number = 0;
				//var_dump($messages);
				if(!is_array($messages['thread']))
				{
				//	echo "1677";
					(array)$messages['thread'];
				}
				if(!is_array($messages['messages']))
				{
					//echo "1682";
					(array)$messages['messages'];
				}


				$total_messages = 1 + count($messages['messages']);
				if($inquiry_seller_lastmessage != "" && $total_messages > 0)
				{
					$new_msgs_number = intval($inquiry_seller_lastmessage) < $total_messages? $total_messages- intval($inquiry_seller_lastmessage) : 0;

					$new_msgs_number =$new_msgs_number;// "COUNT ". $total_messages. " ". intval($inquiry_seller_lastmessage)." REGISTERED MSGS : ".$new_msgs_number;
				}


				array_push($result['inquiry_new_messages'],$new_msgs_number);
			//
				switch ($status) {
					case 'pending':
						array_push($result['pending'],$offer);
						break;
					case 'succeeded':
						array_push($result['succeeded'],$offer);
						break;
					case 'failed':
						array_push($result['failed'],$offer);
						break;
					case 'ignored':
						array_push($result['ignored'],$offer);
						break;
					default:
						break;
				}
			}
		}
	}

	return $result;
}
add_action( 'wp_ajax_fetchAreas', 'fetchAreas' );
add_action( 'wp_ajax_nopriv_fetchAreas', 'fetchAreas' );
function fetchAreas() {
	//if (!isset($_POST) || (isset($_POST) && strlen($_POST['area']) < 1)) { return false; }
	$data = $_GET['area'];
	$result = array();
	$search_query = 'SELECT ID as "id",post_title as "title" FROM pb_posts WHERE post_type = "areas" AND post_title LIKE "'.$data.'%"';
	global $wpdb;
	$results = $wpdb->get_results($wpdb->prepare($search_query, $like), ARRAY_N);
	foreach($results as $key => $array){
		//echo 'key '.$key.' val '.$val.'<br/>';
		array_push($result,array('id'=>$array[0],'name'=>$array[1],'value'=>$array[1]));
	}
	echo json_encode($result);
	wp_die();
}


function getUserStatistics() {
	$args = array(
		'numberposts'		=> -1,
		'post_type'			=> 'client_inquiry',
		'order'					=> 'ASC',
		'orderby'				=> 'post_date',
		'author'		=> get_current_user_id()
	);

	$inquiries = get_posts($args);
	$complete = 0;
	$pending = 0;
	$inactive = 0;

	foreach ($inquiries as $inquiry) {
		$status = get_field('inquiry_status',$inquiry->ID);
		if ($status == 'complete') { $complete++; }
		if ($status == 'active') { $pending++; }
		if ($status == 'inactive') { $inactive++; }
	}

	$result = array(
		'complete'	=>	$complete,
		'active'		=>	$pending,
		'inactive'	=>	$inactive
	);

	return $result;
	wp_die();
}
add_action( 'wp_ajax_renewInquiry', 'renewInquiry' );
add_action( 'wp_ajax_nopriv_renewInquiry', 'renewInquiry' );
function renewInquiry() {
	$response = array();
	if (!isset($_POST) || !isset($_POST['inquiryId']) || !isset($_POST['date'])) { return false; }

	if (isset($_POST) && is_user_logged_in()) {
		$id = $_POST['inquiryId'];
		$newDate = $_POST['date'];

		if (is_buyer()) {
			$inquiry = get_post($id);

			if ($inquiry->post_author == intval(get_current_user_id())) {
				$newDate = date('d/m/Y', strtotime(str_replace('/','-',$newDate)) );

				update_field( 'inquiry_end_date', $newDate, $id);
				$response['status'] = 0;
				$response['message'] = 'Inquiry updated and ends at '.$newDate;



				$user_info = get_userdata(get_current_user_id());
				$user_nickname = $user_info->nickname;
				$link = '<a class="" href="'.get_permalink($id).'">'.get_post($id)->post_title.'</a>';

				$user_msg = $user_nickname.' το αίτημα σας  για '.$link.' ανανεώθηκε και λήγει '.$newDate.'.';


				//notify user
				sendNotificationMessage(false,get_current_user_id(),false,$user_msg);
			}
			else {
				$response['status'] = 1;
				$response['message'] = 'Your are not the owner of this inquiry.';
			}
			echo json_encode($response);
			wp_die();
		}
		else {
			return false;
		}
	}
	else {
		return false;
	}
}

add_action( 'wp_ajax_deleteInquiry', 'deleteInquiry' );
function deleteInquiry() {
	$response = array();

	if ($_POST && is_user_logged_in()) {
		$id = $_POST['data']['inquiryId'];

		$inquiry = get_post($id);

		if ($inquiry->post_author == intval(get_current_user_id()))  {
			wp_delete_post($inquiry->ID);
			$response['status'] = 1;
			$response['message'] = 'Inquiry deleted';
		}
		else {
			$response['status'] = 0;
			$response['message'] = 'You are not the owner of this inquiry '.$id.' : ' .get_current_user_id() ." vs ".$inquiry->post_author;
		}
	}
	echo json_encode($response);
	wp_die();
}
add_action( 'wp_ajax_ignoreOffer', 'ignoreOffer' );
add_action( 'wp_ajax_nopriv_ignoreOffer', 'ignoreOffer' );
function ignoreOffer() {
	if (!isset($_POST) || !isset($_POST['inquiryId']) || !isset($_POST['seller'])) { return false; }

	$id = $_POST['inquiryId'];
	$seller = $_POST['seller'];

	$inquiries =array("0"=>$id);

if(get_post($id)->post_author != get_current_user_id())
{
	$result['status'] = 0;
	$result['message'] = 'You are not the owner of this Inquiry';

	echo json_encode($result);
	wp_die();
}

	$result['status'] = remove_offers_from_inquiry($inquiries,$seller);
	remove_inquiry_from_open_seller($id,$seller);


	$result['message'] = 'seller\'s offer successfully ignored.';

	echo json_encode($result);
	wp_die();


/*

	$offer_status = get_field('inquiry_status',$id);

	//check if inquiry status is incorrect
	if ($offer_status != 'active') { return false; }

	$offers = getOffer($id,$seller);

	//check if the seller really has placed an offer
	if (empty($offers['pending'][0]) || $offers['pending'][0]['inquiry_seller']['ID'] != $seller) {
		$sellerExists = false;
		$result['status'] = 1;
		$result['message'] = "Seller hasn't placed an offer";

		echo json_encode($result);
		wp_die();
	}
	else {
		//actually update the inquiry offer
		$sellerExists = true;
		$existingOffers = get_field('inquiry_offers',$id);

		$len = 1;
		foreach ($existingOffers as $key => $val) {
			$theOffer = array(
				'field_598537ec1b336' => $seller,
				'field_598538221b337' => 'ignored',
				'field_59f6fa4c43b41' => $val['inquiry_seller_unit_cost'],
				'field_59f6fa8743b42' => $val['inquiry_shipping_cost'],
				'field_59f6fa9f43b43' => $val['inquiry_quantity'],
				'field_59f6fab743b44'	=> $val['inquiry_cashondelivery_cost']
			);

			if ($val['inquiry_seller']['ID'] == $seller && $val['inquiry_status'] == 'pending') {
				if (update_row('field_598537c81b335',$len,$theOffer, $id)) {
					sendNotificationMessage(false,$seller,false,'Η προσφορά σας στο <a href="'.get_permalink($id).'">αίτημα</a> αγνοήθηκε.');

					$result['status'] = 0;
					$result['message'] = 'seller\'s offer successfully ignored.';

					echo json_encode($result);
					wp_die();
				}
				else {
					$result['status'] = 1;
					$result['message'] = "Error when ignoring offer. Please contact the admin";
					echo json_encode($result);
					wp_die();
				}
			}
			$len++;
		}
	}*/
}




add_action( 'wp_ajax_MarkBestOffer', 'MarkBestOffer' );
add_action( 'wp_ajax_nopriv_MarkBestOffer', 'MarkBestOffer' );
function MarkBestOffer() {
	if (!isset($_POST) || !isset($_POST['inquiryId']) || !isset($_POST['seller'])) { return false; }

	$id = $_POST['inquiryId'];
	$seller = $_POST['seller'];
	$offer_status = get_field('inquiry_status',$id);

	//check if inquiry status is incorrect
	if ($offer_status != 'active') { return false; }

	$offers = getOffer($id,$seller);

	$sellerExists = true;
	$existingOffers = get_field('inquiry_offers',$id);
	//$mark = ($_POST['mark'] == 'true' ? true : false);
	$len = 1;


	foreach ($existingOffers as $key => $val) {

		if ($val['inquiry_status'] == 'pending') {
			if ($val['inquiry_seller']['ID'] == $seller) {



				$interesting =false;
				$mark = false;
				if ($val['inquiry_seller_bestoffer']) {
					$interesting =true;
				}else {
					$mark=true;
				}



					$theOffer = array(
						'field_598537ec1b336' => $seller,
						'field_598538221b337' => 'pending',
						'field_59f6fa4c43b41' => $val['inquiry_seller_delivery_cost'],
						'field_59f6fa8743b42' => $val['inquiry_seller_cashondelivery_cost'],
						'field_59f6fa9f43b43' => $val['inquiry_seller_unit_cost'],
						'field_59f6fab743b44'	=> $val['inquiry_seller_quantity'],
						'field_5a0ab98366d15'	=> $interesting,	//$val['inquiry_seller_interesting'],
						'field_5a0ab92ebadb8'	=> $mark
					);

					if (update_row('field_598537c81b335',$len,$theOffer, $id)) {
						$result['status'] = 0;

						if ($mark) {
							$result['message'] = 'seller\'s offer successfully marked as best.';//. $val['inquiry_seller_unit_cost'].' - '. $val['inquiry_seller_delivery_cost'].' '. $val['inquiry_seller_quantity'].' '. $val['inquiry_seller_cashondelivery_cost'].' ';
						}
						else {
							$result['message'] = 'seller\'s offer successfully unmarked as best.';//. $val['inquiry_seller_unit_cost'].' - '. $val['inquiry_shipping_cost'].' '. $val['inquiry_quantity'].' '. $val['inquiry_cashondelivery_cost'].' ';
						}
					}
					else {
						$result['status'] = 1;
						$result['message'] = "Error when marking offer. Please contact the admin";
						echo json_encode($result);
						wp_die();
					}
				//}
			}
			else {
				$else = false;
			//	if ($mark == true) { $else = false; }
				$theOffer = array(
					'field_598537ec1b336' => $val['inquiry_seller']['ID'],
					'field_598538221b337' => $val['inquiry_status'],
					'field_59f6fa4c43b41' => $val['inquiry_seller_delivery_cost'],
					'field_59f6fa8743b42' => $val['inquiry_seller_cashondelivery_cost'],
					'field_59f6fa9f43b43' => $val['inquiry_seller_unit_cost'],
					'field_59f6fab743b44'	=> $val['inquiry_seller_quantity'],
					'field_5a0ab98366d15'	=> $val['inquiry_seller_interesting'],	//$val['inquiry_seller_interesting'],
					'field_5a0ab92ebadb8'	=> $else
				/*	'field_598537ec1b336' => $val['inquiry_seller']['ID'],
					'field_598538221b337' => $val['inquiry_status'],
					'field_59f6fa4c43b41' =>  $val['inquiry_seller_delivery_cost'],
					'field_59f6fa8743b42' =>  $val['inquiry_shipping_cost'],
					'field_59f6fa9f43b43' =>	$val['inquiry_seller_unit_cost'],
					'field_59f6fab743b44'	=> $val['inquiry_cashondelivery_cost'],
					'field_5a0ab92ebadb8'	=> $else,
					'field_5a0ab98366d15'	=> $val['inquiry_seller_interesting']*/
				);
				update_row('field_598537c81b335',$len,$theOffer, $id);
			}
		}
		$len++;
		}
		echo json_encode($result);
		wp_die();
}
//mark as best

//mark` as interesting
add_action( 'wp_ajax_MarkInterestingOffer', 'MarkInterestingOffer' );
add_action( 'wp_ajax_nopriv_MarkInterestingOffer', 'MarkInterestingOffer' );
function MarkInterestingOffer() {
	if (!isset($_POST) || !isset($_POST['inquiryId']) || !isset($_POST['seller'])) { return false; }

	$id = $_POST['inquiryId'];
	$seller = $_POST['seller'];
	$offer_status = get_field('inquiry_status',$id);

	//check if inquiry status is incorrect
	if ($offer_status != 'active') { return false; }

	$offers = getOffer($id,$seller);

	$sellerExists = true;
	$existingOffers = get_field('inquiry_offers',$id);
	$len = 1;

	foreach ($existingOffers as $key => $val) {

		if ($val['inquiry_status'] == 'pending') {
			//IF WE FIND THE SELLER
			if ($val['inquiry_seller']['ID'] == $seller) {
				//IF ITS ALREADY INTRESTING MAKE IT FALSE
				if ($val['inquiry_seller_interesting'] == true) {
					$theOffer = array(
						'field_598537ec1b336' => $seller,
						'field_598538221b337' => 'pending',
						'field_59f6fa9f43b43' => $val['inquiry_seller_unit_cost'],
						'field_59f6fa4c43b41' => $val['inquiry_seller_delivery_cost'],
						'field_59f6fab743b44' => $val['inquiry_seller_quantity'],
						'field_59f6fa8743b42'	=> $val['inquiry_seller_cashondelivery_cost'],
						'field_5a0ab98366d15'	=> false,
						'field_5a0ab92ebadb8'	=> $val['inquiry_seller_bestoffer'],
					);
					if (update_row('field_598537c81b335',$len,$theOffer, $id)) {
						$result['status'] = 0;
						$result['message'] = 'seller\'s offer successfully unmarked as interesting.';
						echo json_encode($result);
						wp_die();
					}
					else {
						$result['status'] = 1;
						$result['message'] = "Error when marking offer. Please contact the admin";
						echo json_encode($result);
						wp_die();
					}
				}
				else {
					//IF ITS NOT INTERESTING MAKE IT TRUE
					$theOffer = array(
						'field_598537ec1b336' => $seller,
						'field_598538221b337' => 'pending',
						'field_59f6fa9f43b43' => $val['inquiry_seller_unit_cost'],
						'field_59f6fa4c43b41' => $val['inquiry_seller_delivery_cost'],
						'field_59f6fab743b44' => $val['inquiry_seller_quantity'],
						'field_59f6fa8743b42'	=> $val['inquiry_seller_cashondelivery_cost'],
						'field_5a0ab98366d15'	=> true,
						'field_5a0ab92ebadb8'	=> $val['inquiry_seller_bestoffer'],
					);
					if (update_row('field_598537c81b335',$len,$theOffer, $id)) {
						$result['status'] = 0;
						$result['message'] = 'seller\'s offer successfully marked as interesting.';
						echo json_encode($result);
						wp_die();
					}
					else {
						$result['status'] = 1;
						$result['message'] = "Error when marking offer. Please contact the admin";
						echo json_encode($result);
						wp_die();
					}
				}
			}
		}
		$len++;
		}
		echo json_encode($result);
		wp_die();
}


















add_action( 'wp_ajax_rankSeller', 'rankSeller' );
add_action( 'wp_ajax_nopriv_rankSeller', 'rankSeller' );
function rankSeller($ratingAdd,$seller) {

$user = 'user_'.$seller;

									//	get_field('seller_clientlist','user_'.$val['inquiry_seller']['ID'],false);
$newRating = get_field('seller_rank_1',$user) + $ratingAdd;
$newRating_numbers = get_field('seller_rank_2',$user) + 1;


//update_field($field,intval($sellerRank),$user)

	if (update_field('seller_rank_1',$newRating,$user) && update_field('seller_rank_2',$newRating_numbers,$user)) {

		//notify seller
		sendNotificationMessage(false,$_POST['seller'],false,'Ένας χρήστης μόλις σας βαθμολόγησε.');
		return $newRating.' - '.$newRating_numbers;
	}else {
		return  '// '.$newRating.' + '.$newRating_numbers;;
	}


}









add_action( 'wp_ajax_removeBlacklistSeller', 'removeBlacklistSeller' );
add_action( 'wp_ajax_nopriv_removeBlacklistSeller', 'removeBlacklistSeller' );
function removeBlacklistSeller() {
	if (!isset($_POST) || !isset($_POST['seller'])) { return false; }

	$result = array();
	$currentBlacklist = get_field('user_blacklist','user_'.get_current_user_id(),false);
	if (!is_array($currentBlacklist)) { $currentBlacklist = (array)$currentBlacklist; }
	$newBlackList = array();

	if (!empty($currentBlacklist)) {
		foreach ($currentBlacklist as $blacklist) {
			if ($blacklist != $_POST['seller']) {
				array_push($newBlackList,$blacklist);
			}
		}
	}
	$user = $_POST['seller'];

	if (update_field('user_blacklist',$newBlackList, 'user_'.get_current_user_id())) {
		$result['status'] = 0;
		$result['message'] = "Seller removed from blacklist.";
		echo json_encode($result);
		wp_die();
	}
	else {
		$result['status'] = 1;
		$result['message'] = "Something went wrong when removing seller from blacklist.";
		echo json_encode($result);
		wp_die();
	}
}




add_action( 'wp_ajax_removeFromMyClients', 'removeFromMyClients' );
add_action( 'removeFromMyClients', 'removeFromMyClients' );
function removeFromMyClients() {
	if (!isset($_POST) || !isset($_POST['user'])) { return false; }

	$result = array();
	$currentUserlist = get_field('seller_clientlist','user_'.get_current_user_id(),false);
	if (!is_array($currentUserlist)) { $currentUserlist = (array)$currentUserlist; }
	$newUserList = array();

	if (!empty($currentUserlist)) {
		foreach ($currentUserlist as $user) {
			if ($user != $_POST['user']) {
				array_push($newUserList,$user);
			}
		}
	}
	$user = $_POST['user'];

	if (update_field('seller_clientlist',$newUserList, 'user_'.get_current_user_id())) {
		$result['status'] = 0;
		$result['message'] = "User removed from your list.";
		echo json_encode($result);
		wp_die();
	}
	else {
		$result['status'] = 1;
		$result['message'] = "Something went wrong when removing User from your list.";
		echo json_encode($result);
		wp_die();
	}
}

add_action( 'wp_ajax_removeFromMySellers', 'removeFromMySellers' );
add_action( 'wp_ajax_nopriv_removeFromMySellers', 'removeFromMySellers' );
function removeFromMySellers() {
	if (!isset($_POST) || !isset($_POST['seller'])) { return false; }

	$result = array();
	$currentUserlist = get_field('user_sellerlist','user_'.get_current_user_id(),false);
	if (!is_array($currentUserlist)) { $currentUserlist = (array)$currentUserlist; }
	$newUserList = array();

	if (!empty($currentUserlist)) {
		foreach ($currentUserlist as $user) {
			if ($user != $_POST['seller']) {
				array_push($newUserList,$user);
			}
		}
	}
	$user = $_POST['seller'];

	if (update_field('user_sellerlist',$newUserList, 'user_'.get_current_user_id())) {
		$result['status'] = 0;
		$result['message'] = "Seller removed from your list.";
		echo json_encode($result);
		wp_die();
	}
	else {
		$result['status'] = 1;
		$result['message'] = "Something went wrong when removing seller from your list.";
		echo json_encode($result);
		wp_die();
	}
}

// $all_offers = 2 : with offers, 0:Withou offers
function getOpenUserInquiries($page_no,$posts_per_page,$order = 0,$all_offers=1) {
	// args
		//echo $order;

	if(intval($order) == 1)
	{
		$order ="ASC";
	}else {
		$order ="DESC";
	}


	$all_offers_query="";
	if($all_offers == 2)
	{
		$all_offers_query=array(
			'key'				=> 'inquiry_offers',
			'value'			=> '',
			'compare'		=>	'!='
		);
	}else if($all_offers == 0)
	{
		$all_offers_query=array(
			'key'				=> 'inquiry_offers',
			'value'			=> '',
			'compare'		=>	'='
		);
	}
	/*
	array(
		'key'				=> 'inquiry_offers',
		'value'			=> '',
		'compare'		=>	'!='
	)
	*/
//echo $order;
	$args = array(
		'numberposts'		=> -1,
		'posts_per_page'	=>	$posts_per_page,
		'paged'						=>	$page_no,
		'post_type'			=> 'client_inquiry',
		'order'					=> $order,
		'orderby'				=> 'ID',
		'author'		=>	get_current_user_id(),
		'meta_query' => array(
			'relation'		=> 'AND',
			array(
				'key'	 			=> 'inquiry_status',
				'value'	  	=> 'active',
				'compare' 	=> '=',
			),
			$all_offers_query

		)
	);

	// get results
//	add_filter( 'posts_orderby', 'filter_query' );
	$query = new WP_Query( $args );
//remove_filter( 'posts_orderby', 'filter_query' );

	return $query;
}



function getClosedUserInquiries($page_no,$posts_per_page,$order = 0,$all_offers=1)  {
	// args

	//print_m(2338);
		if(intval($order) == 1)
		{
			$order ="ASC";
		}else {
			$order ="DESC";
		}


// $all_offers == 0 : usuccesful ,   $all_offers == 2 : successful

$all_offers_query="";
if($all_offers == 0)
{
	$all_offers_query=array(
		'key'				=> 'inquiry_status',
		'value'			=> 'inactive',
		'compare'		=>	'='
	);
}else if($all_offers == 2)
{
	$all_offers_query=array(
		'key'				=> 'inquiry_status',
		'value'			=> 'complete',
		'compare'		=>	'='
	);
}

	$args = array(
		'numberposts'		=> -1,
		'post_type'			=> 'client_inquiry',
		'order'					=> $order,
		'orderby'				=> 'ID',
		'author'		=>	get_current_user_id(),
		'meta_query' => array(
			'relation'		=> 'AND',
			array(
				'key'	 			=> 'inquiry_status',
				'value'	  	=> 'active',
				'compare' 	=> '!=',
			),$all_offers_query
		)
	);

	// get results
	$query = new WP_Query( $args );
	$requests = $query->posts;

	return $query;
}




function isSellerBlacklisted($userId) {
	$currentBlacklist = get_field('user_blacklist','user_'.$userId,false);
	if (!is_array($currentBlacklist)) { $currentBlacklist = (array)$currentBlacklist; }

	foreach ($currentBlacklist as $blacklist) {
		if (intval($blacklist) == intval(get_current_user_id())) {
			return true;
		}
		else {
			return false;
		}
	}
}
add_action( 'wp_ajax_deleteMessage', 'deleteMessage' );
function deleteMessage() {
	if (!isset($_POST) || !isset($_POST['messageId'])) { return false; }
	$messageId = $_POST['messageId'];

	$message = get_post($messageId);
	$result = array();

	if (!empty($message)) {
		$action = wp_delete_post($messageId);
		if (!$action->ID) {
			$result['status'] = 1;
			$result['message'] = 'Error, message not deleted';
			echo json_encode($result);
			wp_die();
		}
		else {
			$result['status'] = 0;
			$result['message'] = 'Message deleted';
			echo json_encode($result);
			wp_die();
		}
	}
}
add_action( 'wp_ajax_markMessageRead', 'markMessageRead' );
function markMessageRead() {
	if (!isset($_POST) || !isset($_POST['messageId'])) { return false; }
	$messageId = $_POST['messageId'];

	$message = get_post($messageId);
	$result = array();

	if (!empty($message)) {
		$status = get_field('user_messages_isRead',$messageId);
		if ($status == '1') {
			$result['status'] = 1;
			$result['message'] = 'Message already read';
			echo json_encode($result);
			wp_die();
		}
		else {
			if (update_field('field_5a15aa32c581f',true,$messageId)) {
				$result['status'] = 0;
				$result['message'] = 'Message marked as read';
				echo json_encode($result);
				wp_die();
			}
			else {
				$result['status'] = 1;
				$result['message'] = 'Error updating post status';
				echo json_encode($result);
				wp_die();
			}
		}
	}
}
add_action( 'wp_ajax_markMessageUnread', 'markMessageUnread' );
function markMessageUnread() {
	if (!isset($_POST) || !isset($_POST['messageId'])) { return false; }
	$messageId = $_POST['messageId'];

	$message = get_post($messageId);
	$result = array();

	if (!empty($message)) {
		$status = get_field('user_messages_isRead',$messageId);

		if ($status == '0') {
			$result['status'] = 1;
			$result['message'] = 'Message already unread';
			echo json_encode($result);
			wp_die();
		}
		else {
			if (update_field('field_5a15aa32c581f',false,$messageId)) {
				$result['status'] = 0;
				$result['message'] = 'Message marked as unread';
				echo json_encode($result);
				wp_die();
			}
			else {
				$result['status'] = 1;
				$result['message'] = 'Error updating post status';
				echo json_encode($result);
				wp_die();
			}
		}
	}
}

/* ================================ */
/* USER ONLY FUNCTIONS END */
/* ================================ */

/* ================================ */
/* SELLER ONLY FUNCTIONS BEGIN */
/* ================================ */


//addUser
add_action( 'wp_ajax_addUser', 'addUser' );
add_action( 'wp_ajax_nopriv_addUser', 'addUser' );
function addUser() {


	if (!isset($_POST) || !isset($_POST['user'])) { return false; }

	$result = array();
	$currentUserList = get_field('seller_clientlist','user_'.get_current_user_id(),false);
	if (!is_array($currentUserList)) { $currentUserList = (array)$currentUserList; }
	$currentBlacklist = get_field('seller_blacklist','user_'.get_current_user_id(),false);


$user_exists = 0;
	$newUserList = array();
	if (!empty($currentUserList)) {
		foreach ($currentUserList as $user) {
			if ($user == $_POST['user']) {
				$newUserList = $currentUserList;
				$user_exists = 1;
				$result['status'] = 1;
				$result['message'] = "User is already in your List.";
				echo json_encode($result);
				wp_die();
				break;
			}
			array_push($newUserList,$user);
		}
	}

	array_push($newUserList, $_POST['user']);

	//remove user from clients list
	$newBlackList = array();
	foreach ($currentBlacklist as $user) {
		if ($user != $_POST['user']) {
			array_push($newBlackList,$user);
		}
	}

	update_field('seller_blacklist',$newBlackList, 'user_'.get_current_user_id());

	/*$user = $_POST['user'];*/




	if (update_field('seller_clientlist',$newUserList,'user_'.get_current_user_id())) {
		$result['status'] = 0;
		$result['message'] = "User added to List.";
		echo json_encode($result);
		wp_die();
	}
	else {
		$result['status'] = 1;
		$result['message'] = "Something went wrong when adding user to blacklist.";
		echo json_encode($result);
		wp_die();
	}
}



add_action( 'wp_ajax_removeBlacklistUser', 'removeBlacklistUser' );
add_action( 'wp_ajax_nopriv_removeBlacklistUser', 'removeBlacklistUser' );
function removeBlacklistUser() {
	if (!isset($_POST) || !isset($_POST['user'])) { return false; }

	$result = array();
	$currentBlacklist = get_field('seller_blacklist','user_'.get_current_user_id(),false);
	if (!is_array($currentBlacklist)) { $currentBlacklist = (array)$currentBlacklist; }


	$user = $_POST['user'];
	$newSellerBlackList = array();

	if (!empty($currentBlacklist)) {
		foreach ($currentBlacklist as $list) {
			if (intval($list) != intval($_POST['user'])) {
				array_push($newSellerBlackList,$list);
			}
		}
	}

	if (update_field('seller_blacklist',$newSellerBlackList, 'user_'.get_current_user_id())) {
		$result['status'] = 0;
		$result['message'] = "User removed from blacklist.";
		echo json_encode($result);
		wp_die();
	}
	else {
		$result['status'] = 1;
		$result['message'] = "Something went wrong when adding user to blacklist.";
		echo json_encode($result);
		wp_die();
	}

}
function getSellerCategories() {
  $my_categories = get_field('seller_product_categories', 'user_'.get_current_user_id());
  return $my_categories;
}

function getSellerCategoriesById($seller) {
  $my_categories = get_field('seller_product_categories', 'user_'.$seller);
  return $my_categories;
}
function getOpenSpecificSellerInquiries($seller = null) {
	$areas = array();
  $my_areas = get_user_meta($seller, 'seller_areas', false);

  foreach ($my_areas[0] as $area) {
    array_push($areas,intval($area));
  }
	$sellersBlacklistedUsers = get_field('seller_blacklist','user_'.$seller,false);
	if (!is_array($sellersBlacklistedUsers)) { $sellersBlacklistedUsers = (array)$sellersBlacklistedUsers; }
	$sellersCategories = get_field('seller_product_categories', 'user_'.$seller);

	$args = array(
		'numberposts'		=> -1,
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
	$sellerId = (int) $seller;
	$inquiries = array();

	foreach ($temp_inquiries as $inquiry) {
		array_push($inquiries,$inquiry->ID);
	}

	//filter seller's blacklisted users & inquiry buyer's blacklisted sellers- WORKS
	foreach ($inquiries as $inquiry) {
		$post_author = (int) get_post($inquiry)->post_author;
		$buyerBlacklistedSellers = get_field('user_blacklist', 'user_'.$post_author,false);
		if (!is_array($buyerBlacklistedSellers)) { $buyerBlacklistedSellers = (array)$buyerBlacklistedSellers; }

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
		$isSame = false;
		$user = get_user_by('ID',$post_author);
		$me = get_user_by('ID',$sellerId);

		if ($user) {
			$cleanUserUsername = str_replace('_2','', str_replace('_1','',get_userdata($user->ID)->user_login) );
			$cleanMeUsername = str_replace('_2','',str_replace('_1','',get_userdata($me->ID)->user_login));

			if ($cleanUserUsername == $cleanMeUsername) {
				$isSame = true;
			}
			else {
				$isSame = false;
			}
		}
		else {
			$isSame = false;
		}
		if ($isSame) {
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

		if (!empty($hasSpecificSeller) && $hasSpecificSeller['ID'] != $sellerId) {
			$key = array_search($inquiry,$inquiries);

			if ($key !== false) {
				unset($inquiries[$key]);
			}
		}
	}

	//feed the results
	foreach ($inquiries as $inquiry) {
		array_push($requests,get_post($inquiry));
	}


	return $requests;
}
function sendOfferForInquiry($id) {
	if (!is_seller()) { return false; }
	if (!$_POST) { return false; }

	$cashondelivery_cost	=	$_POST['cashondelivery_cost'];
	$shipping_cost				=	$_POST['shipping_cost'];
	$unit_cost						=	$_POST['unit_cost'];
	$quantity							=	$_POST['quantity'];

	if ($id && !empty(get_post($id))) {
		if (!empty($cashondelivery_cost) && !empty($shipping_cost) && !empty($unit_cost) && !empty($quantity)) {
			update_field('field_598537ec1b336',	get_current_user_id(),	$id);
			update_Field('field_598538221b337', 'pending',							$id);
			update_field('field_59f6fa4c43b41',	$shipping_cost,					$id);
			update_field('field_59f6fa8743b42',	$cashondelivery_cost,		$id);
			update_field('field_59f6fa9f43b43',	$unit_cost,							$id);
			update_field('field_59f6fab743b44',	$quantity,							$id);

			$result['status'] = 0;
			$result['message'] = "Offer ok";




			//notify user
			sendNotificationMessage(false,get_current_user_id(),false,'Έχετε νέα προσφορά για το αίτημα σας.');
		}
		else {
			$result['status'] = 1;
			$result['message'] = "Offer fields empty";
		}
		return json_encode($result);
	}
	else {
		return false;
	}
}
function getSellerBlacklist($withSales = null) {
	$blacklist = get_field('seller_blacklist','user_'.get_current_user_id(),false);
	if (!is_array($blacklist)) { $blacklist = (array)$blacklist; }

	if (!is_null($withSales)) {

		$sellers = $blacklist;
		$succeded = array();
		if (!empty($sellers)) {

			foreach ($sellers as $sel) {
				$args = array(
					'numberposts'		=> -1,
					'post_type'			=> 'client_inquiry',
					'order'					=> 'ASC',
					'orderby'				=> 'post_date',
					'author'				=> $sel,
					'meta_query' => array(
						'relation'		=> 'AND',
						array(
							'key'	 			=> 'inquiry_status',
							'value'	  	=> 'active',
							'compare' 	=> '!=',
						)
					)
				);

				$query = new WP_Query($args);
				$requests = array();
				$requests = $query->posts;
				foreach ($requests as $request) {
					$offers = get_field('inquiry_offers',$request->ID);
					foreach ($offers as $offer) {
						if ($offer['inquiry_seller']['ID'] == get_current_user_id() && $offer['inquiry_status'] == 'succeeded') {
							$succeded[$sel][] = $request->ID;
						}
					}

				}
			}

		}

		foreach ($sellers as $sel) {
			if (!array_key_exists($sel,$succeded)) {
				$succeded[$sel] = 0;
			}
		}

		$totals = array();
		foreach ($succeded as $key=>$val) {
			if ($val[0] == 0) {
				$totals[$key][] = 0;
			}
			else {
				$totals[$key][] = (int) sizeof($val);
			}
		}
		return $totals;
	}
	return $blacklist;
}
function getSellerStatistics() {

	$user_info = get_userdata(get_current_user_id());

	$args = array(
		'numberposts'		=> -1,
		'post_type'			=> 'client_inquiry',
		'order'					=> 'ASC',
		'orderby'				=> 'post_date',
		'meta_query'		=> array(
			'relation'		=> 'AND',
			array(
				'key'	 			=> 'inquiry_completion_date',
				'value'	  	=> $user_info->user_registered,
				'compare' 	=> '>=',
			)
		),
	);

	$wonOffers = 0;
	$lostOffers = 0;
	$noParticipation = 0;
	$result = array();
	$inquiries = get_posts($args);

	foreach ($inquiries as $inquiry) {
		$offers = getOffer($inquiry->ID,get_current_user_id());


		$pending		=	count($offers['pending']);
		$succeeded	=	count($offers['succeeded']);
		$failed			=	count($offers['failed']);
		$ignored		=	count($offers['ignored']);

		if ($pending == 0 && $succeeded == 0 && $failed == 0 && $ignored == 0) {
			$noParticipation++;
		}

		$wonOffers = $wonOffers+$succeeded;
		$lostOffers = $lostOffers+$failed+$ignored;
	}
	$result = array(
		'wonOffers'				=>	$wonOffers,
		'lostOffers'			=>	$lostOffers,
		'noParticipation'	=>	$noParticipation
	);
	return $result;

}






function getClosedSellerInquiries() {
	$areas = getMyAreas();
	$user_info = get_userdata(get_current_user_id());
	# Use date_parse to cast your date to an array
	$sellersBlacklistedUsers = get_field('seller_blacklist','user_'.get_current_user_id(),false);

	$args = array(
		'numberposts'		=> -1,
		'post_type'			=> 'client_inquiry',
		'order'					=> 'ASC',
		'orderby'				=> 'post_date',
		'meta_query'		=> array(
			'relation'		=> 'AND',
			array(
				'key'	 			=> 'inquiry_status',
				'value'	  	=> 'active',
				'compare' 	=> '!=',
			),
			array(
				'key'	 			=> 'inquiry_completion_date',
				'value'	  	=> $user_info->user_registered,
				'compare' 	=> '>=',
			)
		),
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

	//feed the results
	foreach ($inquiries as $inquiry) {
		array_push($requests,get_post($inquiry));
	}

	return $requests;
}
function getSellersRepliesForInquiry($id) {
	if (!isset($id)) {
		return false;
	}
	$creator = get_post($id)->post_author;
	global $wpdb;
	$q = "SELECT
		distinct(user_id),
		`comment_ID`,
		`comment_post_ID`,
		`comment_author`,
		`comment_author_email`,
		`comment_author_url`,
		`comment_author_IP`,
		`comment_date`,
		`comment_date_gmt`,
		`comment_content`,
		`comment_karma`,
		`comment_approved`,
		`comment_agent`,
		`comment_type`,
		`comment_parent`
		FROM pb_comments WHERE user_id !='$creator' AND comment_parent=0 AND comment_post_ID='$id' AND comment_approved='1'";
	$result = $wpdb->get_results($q,OBJECT);

	return $result;
}
function getLatestCommentsForInquiry($id) {
	$args = array(
				'post_id' => $id,
				'orderby' => array('comment_date'),
				'order' => 'DESC',
				'number' => 2
		);
		$comments = get_comments( $args );
		$result = array();
		if (sizeof($comments) != 0) {
			$result = $comments;
		}

		return $result;
}
function getCommentsForPost($id) {
	if (!isset($id)) {
		return false;
	}

	$creator = get_post($id)->post_author;
	global $wpdb;
	$q = "SELECT
		 `user_id`,
		 `comment_ID`,
		 `comment_post_ID`,
		 `comment_author`,
		 `comment_author_email`,
		 `comment_author_url`,
		 `comment_author_IP`,
		 `comment_date`,
		 `comment_date_gmt`,
		 `comment_content`,
		 `comment_karma`,
		 `comment_approved`,
		 `comment_agent`,
		 `comment_type`,
		 `comment_parent`
		 FROM pb_comments WHERE user_id !='$creator' AND comment_post_ID='$id' AND comment_approved='1'";
	$result = $wpdb->get_results($q,OBJECT);

	return $result;
}
function getSellerClientsSummary() {
	$sellerId = (int) get_current_user_id();
	$clients = array();
	$data = get_field('seller_clientlist','user_'.$sellerId,false);

	if (!is_array($data)) { $clients = (array)$data; } else { $clients = $data; }

	$totals = array();
	foreach ($clients as $client) {

		$args = array(
			'numberposts'		=> -1,
			'post_type'			=> 'client_inquiry',
			'order'					=> 'ASC',
			'orderby'				=> 'post_date',
			'author'				=> $client,
			'meta_query' => array(
				'relation'		=> 'AND',
				array(
					'key'	 			=> 'inquiry_status',
					'value'	  	=> 'active',
					'compare' 	=> '!=',
				)
			)
		);

		$query = new WP_Query($args);
		$inquiries = array();
		$inquiries = $query->posts;

		foreach ($inquiries as $inquiry) {
			if (get_field('inquiry_status',$inquiry->ID) == 'complete') {
				$offers = get_field('inquiry_offers',$inquiry->ID);

				if (!empty($offers)) {
					foreach ($offers as $offer) {
						if ($offer['inquiry_seller']['ID'] == $sellerId && $offer['inquiry_status'] == 'succeeded') {
							$totals[$client][] = $inquiry->ID;
						}
					}
				}
			}
		}
	}

	return $totals;
}
function getSellerClientList($sellerId = null) {
	$result = array();

	if (empty($sellerId)) {
		$sellerId = get_current_user_id();
	}
	$clients = get_field('seller_clientlist','user_'.$sellerId,false);

	if (!is_array($clients)) { $result = (array) $clients; } else { $result = $clients; }

	return $result;
}
function getInquiryThreads($id) {
	$result = array();
	$args = array(
		'post_id'			=>	$id,
		'parent'			=>	0,
		'orderby'			=>	'comment_date_gmt',
		'order' 			=>	'ASC',
		'status'			=>	'approve'
	);

	$threads = (!empty(get_comments($args)[0]) ? get_comments($args) : array());

	if (!empty($threads)) {
		foreach ($threads as $key =>$thread) {
			$threadStarter = $thread->user_id;
			if (is_seller($threadStarter)) {
				array_push($result,intval($threadStarter));
			}
		}
	}
	return $result;
}
function getInquiryConversation($id, $sellerid) {
	$thread_id = 0;
	$result = array();
	$args = array(
		'post_id'			=>	$id,
		'parent'			=>	0,
		'orderby'			=>	'comment_date_gmt',
		'order' 			=>	'DESC',
		'author__in'	=>	array($sellerid,get_current_user_id()),
		'status'			=>	'approve'
	);

	$thread = (!empty(get_comments($args)[0]) ? get_comments($args)[0] : array());

	if (!empty($thread)) {
		$thread_id = intval($thread->comment_ID);
		$args = array(
			'post_id'			=>	$id,
			'parent'			=>	$thread_id,
			'orderby'			=>	'comment_date_gmt',
			'order' 			=>	'DESC',
			'status'			=>	'approve',
			'author__in'	=>	array($sellerid,get_current_user_id())
		);

		$conversation = get_comments($args);
		$length = count($conversation);

		$result['thread'] = $thread;
		$result['messages'] = ($length > 0 ? $conversation : array());
	}
	else {
		$result['thread'] = array();
		$result['messages'] = array();
	}
 /*echo "length ".$length.'-  '.$id." seller ".$sellerid;
 var_dump($result);*/
	return $result;
}



?>
