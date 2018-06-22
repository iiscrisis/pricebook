<?php


add_action( 'wp_ajax_addInquiry', 'addInquiry' );
add_action( 'wp_ajax_nopriv_addInquiry', 'addInquiry' );

function addInquiry() {
	//alert("addInquiry 8 -pb_functions");
	$response = array();
	if (isset($_POST)) {
		//Get inquiry Type
	/**/	$inquiry_type;
	$recaptchaSecret = '6LerLVYUAAAAAGRpQ8bTvToSO62ektoFkb03oJqj';


	if (!isset($_POST['data']['g-recaptcha-response'])) {
		$response['status'] = 1;
		$response['message'] = 'ReCaptcha was not validated.';
		echo json_encode($response);
		wp_die();
	}
			// do not forget to enter your secret key in the config above
			// from https://www.google.com/recaptcha/admin

			$recaptcha = new \ReCaptcha\ReCaptcha($recaptchaSecret, new \ReCaptcha\RequestMethod\CurlPost());


			$response_recaptcha = $recaptcha->verify($_POST['data']['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);

			// we validate the ReCaptcha field together with the user's IP address
	/*		$response['status'] = 1;
			$response['message'] = 'ReCaptcha was not validated 122';
			echo json_encode($response);
			wp_die();
*/
			if (!$response_recaptcha->isSuccess()) {
				//	throw new \Exception('ReCaptcha was not validated.');

					$response['status'] = 1;
					$response['message'] = 'ReCaptcha was not validated.'.$response_recaptcha ;
					echo json_encode($response);
					wp_die();

			}

		if (isset($_POST['data']['inquiry_type']))
		{

			switch ($_POST['data']['inquiry_type']) {
				case PRODUCT:
					$inquiry_type = "products";
					break;

				case HOTEL:
							$inquiry_type = "hotels";
					break;

				case SERVICE:
							$inquiry_type = "services";
						break;
				default:
				$response['status'] = 1;
				$response['message'] = 'You should be in a category';
				echo json_encode($response);
				wp_die();
				break;
			}
		}/**/

	/*	*/
	$data['inquiry_product_category'] = array();
		if (isset($_POST['data']['inquiry_product_category'])) {
			$data['inquiry_product_category'] = explode(',',$_POST['data']['inquiry_product_category']);
		}
		/**/

		/**
		 *
		 */

		$areas = array();

		if (isset($_POST['data']['inquiry_areas']) && $_POST['data']['inquiry_areas'] != NULL) {
			$val = $_POST['data']['inquiry_areas'];
			$parents = get_post_ancestors($val);
			if (sizeof($parents) == 0) {
				$children = get_posts(array('post_type'=>'areas','post_parent'=>$val,'numberposts'=>-1));

				if (sizeof($children) > 0) {
					array_push($areas,intval($val));
					foreach ($children as $child) {
						array_push($areas,$child->ID);
					}
				}
			}
			else {
				array_push($areas,intval($val));
			}
		}else{
			$response['status'] = 1;
			$response['message'] = 'Areas must be set.';
			echo json_encode($response);
			wp_die();
		}
		/**/

		/**/
		$filters = array();
		$filters_other= array();
		$other_filters = array();
		/*if (isset($_POST['data']['inquiry_filters'])) {

			foreach ($_POST['data']['inquiry_filters'] as $dat) {
				foreach ($dat as $filter) {
					if ($filter != 'inquiry_filters[]') {
						array_push($filters,$filter);
					}
				}
			}
		}*/

		if (isset($_POST['data']['inquiry_filters'])) {
			array_push($filters, $_POST['data']['inquiry_filters']);
			/*foreach ($_POST['data']['inquiry_filters'] as $dat) {
				foreach ($dat as $filter) {
					if ($filter != 'inquiry_filters[]') {
						array_push($filters,$filter);
					}
				}
			}*/
		}
		/**/


/**/
		//Add other filters to queue
		if (isset($_POST['data']['inquiry_other_filter'])) {

			foreach ($_POST['data']['inquiry_other_filter'] as $dat) {
				foreach ($dat as $filter) {
					if ($filter != 'other_filter[]') {
						array_push($filters_other,$filter);
					}
				}
			}
		}
/**/


	//Inquiry Text and Filters περιορισμοι???
/**/
		if (empty($filters_other) && empty($filters) && mb_strlen($_POST['data']['inquiry_text'],'UTF-8') == 0) {
			$response['status'] = 1;
			$response['message'] = 'You should add either an inquiry text or set a filter.:'.sizeof($filters);
			echo json_encode($response);
			wp_die();
		}

		if (empty($filters_other) && empty($filters) && mb_strlen($_POST['data']['inquiry_text'],'UTF-8') < 4 ) {
			$response['status'] = 1;
			$response['message'] = 'Inquiry text must be more than 4 characters.';
			echo json_encode($response);
			wp_die();
		}

		if (!empty($filters_other) && !empty($filters) && ($_POST['data']['inquiry_text'] != NULL && mb_strlen($_POST['data']['inquiry_text'],'UTF-8') < 4) ) {
			$response['status'] = 1;
			$response['message'] = 'Inquiry text must be more than 4 characters.';
			echo json_encode($response);
			wp_die();
		}


/**/
		/*'inquiry_product_category'		:	inquiry_product_category,
		'inquiry_product_quantities'	:	inquiry_product_quantities,
		'inquiry_max_price'						:	inquiry_max_price,
		'inquiry_start_date'					:	inquiry_start_date,
		'inquiry_end_date'						:inquiry_end_date	,
		'inquiry_text'								:	inquiry_text,
		'inquiry_areas'								: inquiry_areas,
		'inquiry_filters'							: inquiry_filters,
		'inquiry_other_filter'				: inquiry_other_filter,
		'inquiry_persons_quantities'	: inquiry_persons_quantities,
		'inquiry_children_quantities'	: inquiry_children_quantities,
		'inquiry_hotel_start_date'		: inquiry_hotel_start_date,
		'inquiry_hotel_end_date'			: inquiry_hotel_end_date
		*/
/**/

/*
'inquiry_product_category'		:	inquiry_product_category,
'inquiry_product_quantities'	:	inquiry_product_quantities,
'inquiry_max_price'						:	inquiry_max_price,
'inquiry_min_price'						:	inquiry_min_price,
'inquiry_start_date'					:	inquiry_start_date,
'inquiry_end_date'						:inquiry_end_date	,
'inquiry_text'								:	inquiry_text,
'inquiry_areas'								: inquiry_areas,
'inquiry_filters'							: inquiry_filters,
'inquiry_other_filter'				: inquiry_other_filter,
'inquiry_persons_quantities'	: inquiry_persons_quantities,
'inquiry_children_quantities'	: inquiry_children_quantities,
'inquiry_hotel_start_date'		: inquiry_hotel_start_date,
'inquiry_hotel_end_date'			: inquiry_hotel_end_date,
'inquiry_service_start_dates'	: inquiry_service_start_dates,
'inquiry_service_end_date'		: inquiry_service_end_date,
'inquiry_type'								: inquiry_type,
'inquiry_image'								:	inquiry_image
inquiry_double_rooms_quantities
inquiry_single_rooms_quantities
*/
		$data = array(
			'inquiry_product_category'			=>	(!empty($_POST['data']['inquiry_product_category'])) ? $data['inquiry_product_category'] : array(),
			'inquiry_status'								=>	'active',
			'inquiry_product_quantities'		=>	(!empty($_POST['data']['inquiry_product_quantities'])) ? esc_attr($_POST['data']['inquiry_product_quantities']) : NULL,
			'inquiry_children_quantities'		=>	(!empty($_POST['data']['inquiry_children_quantities'])) ? esc_attr($_POST['data']['inquiry_children_quantities']) : NULL,
			'inquiry_persons_quantities'		=>	(!empty($_POST['data']['inquiry_persons_quantities'])) ? esc_attr($_POST['data']['inquiry_persons_quantities']) : NULL,
			'inquiry_no_range'							=>	(!empty($_POST['data']['inquiry_no_range'])) ? esc_attr($_POST['data']['inquiry_no_range']) : 0,
			'inquiry_kids_age'							=>	(!empty($_POST['data']['inquiry_kids_age'])) ? esc_attr($_POST['data']['inquiry_kids_age']) : "",
			'inquiry_min_price'							=>	(!empty($_POST['data']['inquiry_min_price'])) ? esc_attr($_POST['data']['inquiry_min_price']) : NULL,
			'inquiry_max_price'							=>	(!empty($_POST['data']['inquiry_max_price'])) ? esc_attr($_POST['data']['inquiry_max_price']) : NULL,
			'inquiry_image'									=>	(!empty($_POST['data']['inquiry_image'])) ? esc_attr($_POST['data']['inquiry_image']) : NULL,
			'inquiry_start_date'						=>	(!empty($_POST['data']['inquiry_start_date'])) ? esc_attr($_POST['data']['inquiry_start_date']) : NULL,
			'inquiry_service_end_date'			=> 	(!empty($_POST['data']['inquiry_service_end_date'])) ? esc_attr($_POST['data']['inquiry_service_end_date']) : NULL,
			'inquiry_service_start_dates'		=> 	(!empty($_POST['data']['inquiry_service_start_dates'])) ? esc_attr($_POST['data']['inquiry_service_start_dates']) : NULL,
			'inquiry_hotel_end_date'				=> 	(!empty($_POST['data']['inquiry_hotel_end_date'])) ? esc_attr($_POST['data']['inquiry_hotel_end_date']) : NULL,
			'inquiry_hotel_start_date'			=> 	(!empty($_POST['data']['inquiry_hotel_start_date'])) ? esc_attr($_POST['data']['inquiry_hotel_start_date']) : NULL,
			'inquiry_end_date'							=>	(!empty($_POST['data']['inquiry_end_date'])) ? esc_attr($_POST['data']['inquiry_end_date']) : NULL,
			'inquiry_text'									=>	(!empty($_POST['data']['inquiry_text'])) ? esc_attr($_POST['data']['inquiry_text']) : NULL,
			'inquiry_areas'									=>	$areas, //(!empty($_POST['data']['inquiry_areas'])) ? array("0"=>$areas) : array(),
			'inquiry_longlat'									=> (!empty($_POST['data']['inquiry_longlat'])) ? esc_attr($_POST['data']['inquiry_longlat']) : NULL,
			'inquiry_filters'								=>	implode(",",array_merge($filters,$filters_other)),//(!empty($_POST['data']['inquiry_filters']))  ? $filters : array(),
			'inquiry_other_filter'					=>	(empty($_POST['data']['inquiry_other_filter'])) ? $filters_other : array(),
			'inquiry_double_rooms_quantities'=>(!empty($_POST['data']['inquiry_double_rooms_quantities'])) ? esc_attr($_POST['data']['inquiry_double_rooms_quantities']) : NULL,
			'inquiry_single_rooms_quantities'=>(!empty($_POST['data']['inquiry_single_rooms_quantities'])) ? esc_attr($_POST['data']['inquiry_single_rooms_quantities']) : NULL,

			/*,
			'inquiry_persons_quantities'		=> 	(!empty($_POST['data']['inquiry_persons_quantities'])) ? esc_attr($_POST['data']['inquiry_persons_quantities']) : NULL,
			'inquiry_children_quantities'		=> 	(!empty($_POST['data']['inquiry_children_quantities'])) ? esc_attr($_POST['data']['inquiry_children_quantities']) : NULL,
			'inquiry_hotel_start_date'			=>	(!empty($_POST['data']['inquiry_hotel_start_date'])) ? esc_attr($_POST['data']['inquiry_hotel_start_date']) : NULL,
			'inquiry_hotel_end_date'				=>	(!empty($_POST['data']['inquiry_hotel_end_date'])) ? esc_attr($_POST['data']['inquiry_hotel_end_date']) : NULL*/
			);
/*
inquiry_text
inquiry_service_end_date
*/
$categoryParents = get_post_ancestors($data['inquiry_product_category'][0]);
$isService = false;
$isProduct = false;
$isHotel = false;
if (in_array(SERVICE,$categoryParents)) {
	$isService = true;
}else if(in_array(PRODUCT,$categoryParents))
{
	$isProduct = true;
}else if(in_array(HOTEL,$categoryParents))
{
	$isHotel = true;
}



	if($isHotel)
	{
		if (isset($_POST['data']['inquiry_hotel_start_date'])) {
			if (!empty($_POST['data']['inquiry_hotel_start_date'])) {
				$data['inquiry_hotel_start_date']	=	$_POST['data']['inquiry_hotel_start_date'];
			}
		}

		if (isset($_POST['data']['inquiry_hotel_end_date'])) {
			if (!empty($_POST['data']['inquiry_hotel_end_date'])) {
				$data['inquiry_hotel_end_date']	=	$_POST['data']['inquiry_hotel_end_date'];
			}
		}

		if (isset($_POST['data']['inquiry_persons_quantities'])) {
			if (!empty($_POST['data']['inquiry_persons_quantities'])) {
				$data['inquiry_persons_quantities']	=	$_POST['data']['inquiry_persons_quantities'];
			}
		}

		if (isset($_POST['data']['inquiry_children_quantities'])) {
			if (!empty($_POST['data']['inquiry_children_quantities'])) {
				$data['inquiry_children_quantities']	=	$_POST['data']['inquiry_children_quantities'];
			}
		}

		/*
		inquiry_single_rooms_quantities
		inquiry_double_rooms_quantities
		*/


	}

	if($isService)
	{

		if (isset($_POST['data']['inquiry_service_start_dates'])) {

			if (!empty($_POST['data']['inquiry_service_start_dates'])) {
				$data['inquiry_service_start_dates']	=	$_POST['data']['inquiry_service_start_dates'];
			}
		}else {
			$data['inquiry_service_start_dates']	= NULL;
		}
	}


/**/

		if (isset($_POST['data']['inquiry_direct_seller'])) {
			if (!empty($_POST['data']['inquiry_direct_seller'])) {
				$data['inquiry_direct_seller']	=	$_POST['data']['inquiry_direct_seller'];
			}
		}




/**/
		if ($isProduct && !is_null($data['inquiry_product_quantities']) && number_format((float)$data['inquiry_product_quantities'], 2, '.', '') < 0) {
			$response['status'] = 1;
			$response['message'] = 'Το πεδίο τεμαχίων δεν πρέπει να είναι μικρότερο από 0.';
			echo json_encode($response);
			wp_die();
		}


		if($data['inquiry_no_range'] ==1)
		{
			if (!is_null($data['inquiry_max_price']) && number_format((float)$data['inquiry_max_price'], 2, '.', '') < 0) {
				$response['status'] = 1;
				$response['message'] = 'Το πεδίο μέγιστης τιμής δεν πρέπει να είναι μικρότερο από 0.';
				echo json_encode($response);
				wp_die();
			}

			if (!is_null($data['inquiry_min_price']) && number_format((float)$data['inquiry_min_price'], 2, '.', '') < 0) {
				$response['status'] = 1;
				$response['message'] = 'Το πεδίο ελάχιστης τιμής δεν πρέπει να είναι μικρότερο από 0.';
				echo json_encode($response);
				wp_die();
			}
		}


		if(number_format((float)$data['inquiry_min_price'], 2, '.', '') >  number_format((float)$data['inquiry_max_price'], 2, '.', ''))
		{
			$response['status'] = 1;
			$response['message'] = 'Το πεδίο ελάχιστης τιμής δεν πρέπει να είναι μεγαλύτερο απο  από το πεδίο μέγιστης τιμής.';
			echo json_encode($response);
			wp_die();
		}



		if ($isHotel && !is_null($data['inquiry_persons_quantities']) && number_format((float)$data['inquiry_persons_quantities'], 2, '.', '') < 1) {
			$response['status'] = 1;
			$response['message'] = 'Το πεδίο ενηλίκων δεν πρέπει να είναι μικρότερο από 1.';
			echo json_encode($response);
			wp_die();
		}

		if($isService && !is_null($data['inquiry_service_start_dates']) && $data['inquiry_service_start_dates']	=="")
		{
			$response['status'] = 1;
			$response['message'] = 'Πρέπει να ορίσετε χρόνο';
			echo json_encode($response);
			wp_die();
		}


/**/

/**/
		$startDate = new DateTime(str_replace('/','-',$data['inquiry_start_date']));
		$endDate = new DateTime(str_replace('/','-',$data['inquiry_end_date']));
		$diff = $startDate->diff($endDate);
		$diff = intval(str_replace('+','',$diff->format('%R%a')));

		if ($diff > 30) {
			$response['status'] = 1;
			$response['message'] = 'Ο χρόνος του αιτήματος δεν πρέπει να ξεπερνά τις 30 μέρες.';
			echo json_encode($response);
			wp_die();
		}

		if ($diff < 7) {
			$response['status'] = 1;
			$response['message'] = 'Ο χρόνος του αιτήματος δεν πρέπει να είναι λιγότερο από 7 μέρες.';
			echo json_encode($response);
			wp_die();
		}
/**/

/*
* inquiry_hotel_start_date
*/


		if($isHotel)
		{
			$startHotelDate = new DateTime(str_replace('/','-',$data['inquiry_hotel_start_date']));
			$endHotelDate = new DateTime(str_replace('/','-',$data['inquiry_hotel_end_date']));
			$diff = $startHotelDate->diff($endHotelDate);
			$diff = intval(str_replace('+','',$diff->format('%R%a')));



			if ($diff < 1) {
				$response['status'] = 1;
				$response['message'] = 'Ο χρόνος της διαμονης δεν πρέπει να είναι λιγότερο από 1 ημέρα- '.$data['inquiry_hotel_start_date'].' - '.$data['inquiry_hotel_start_date'];
				echo json_encode($response);
				wp_die();
			}
		}


		if($data['inquiry_no_range'] ==0)
		{
			if (strlen($data['inquiry_max_price']) != 0 && ! is_numeric($data['inquiry_max_price'])) {
				$response['status'] = 1;
				$response['message'] = 'Η τιμή πρέπει να είναι αριθμητικό στοιχείο.';
				echo json_encode($response);
				wp_die();
			}

			if (strlen($data['inquiry_min_price']) != 0 && ! is_numeric($data['inquiry_min_price'])) {
				$response['status'] = 1;
				$response['message'] = 'Η τιμή πρέπει να είναι αριθμητικό στοιχείο.';
				echo json_encode($response);
				wp_die();
			}
		}


		/*
		if (file_exists($data['inquiry_image'])) {
		}
		*/


/**/
		if ($isProducts) {
			if (strlen($data['inquiry_product_quantities']) != 0 && !ctype_digit($data['inquiry_product_quantities'])) {
				$response['status'] = 1;
				$response['message'] = 'Οι μονάδες πρέπει να είναι αριθμητικό στοιχείο.';
				echo json_encode($response);
				wp_die();
			}
		}


/**/

/**/

			if($isProduct)
			{
				$postTitle =$categoryNames; //floatval($data['inquiry_product_quantities']).' '.
			}else {
				$postTitle =$categoryNames;
			}

		$inquiryData = array(
			'post_title'    							=>	$postTitle , //'Inquiry from '.wp_get_current_user()->nickname. ' at '. date("Y-m-d H:i:s"),
			'post_type'										=>	'client_inquiry',
			'post_content'  							=>	$data['inquiry_text'],
			'post_status'   							=>	'publish',
			'post_author'   							=>	get_current_user_id()
		);

		$addInquiry = wp_insert_post( $inquiryData );

		if (!is_wp_error($addInquiry)) {
			update_field('field_595c26aa02d43',	$data['inquiry_product_category'],							$addInquiry);
			update_field('field_595c2987b2d14',	$data['inquiry_status'],												$addInquiry);
			if($isProduct)
			{
				update_field('field_595c3035ca5a1',	floatval($data['inquiry_product_quantities']),$addInquiry);
			}
/*inquiry_text
inquiry_service_end_date*/

		if($data['inquiry_no_range'] ==1)
		{
			$data['inquiry_min_price'] = "-2100";
			$data['inquiry_max_price'] = "2100";
		}
			update_field('field_595c304eca5a2',	floatval($data['inquiry_max_price']),						$addInquiry);
			update_field('field_5a55cac5c4c56',	floatval($data['inquiry_min_price']),						$addInquiry);
			update_field('field_5b1517acc0141',	$data['inquiry_text'],							$addInquiry);

			update_field('field_595c3071ca5a3',	$data['inquiry_start_date'],										$addInquiry);
			update_field('field_595c308eca5a4',	$data['inquiry_end_date'],											$addInquiry);
			//inquiry_filters
			update_field('field_5a82123a64463',	$data['inquiry_filters'],											$addInquiry);
			update_field('field_59791e5c5dc83',	$data['inquiry_areas'],													$addInquiry);
			update_field('field_597fbc4426828',	$data['inquiry_direct_seller'],									$addInquiry);
			update_field('field_5a81fea827774',	$data['inquiry_image'],													$addInquiry);

			update_field('field_5a2968ace8f4a',	NULL,																						$addInquiry);
			if($isHotel)
			{
				update_field('field_5a55cb16ac66e',	$data['inquiry_hotel_start_date'],						$addInquiry);
				update_field('field_5a55cb421b192',	$data['inquiry_hotel_end_date'],							$addInquiry);

				update_field('field_5a55cb8a37ff6',	$data['inquiry_persons_quantities'],					$addInquiry);
				update_field('field_5a55cbc0a3f0a',	$data['inquiry_children_quantities'],					$addInquiry);

				/*inquiry_single_rooms_quantities
				*/
				update_field('field_5a9546b0e411e',	$data['inquiry_single_rooms_quantities'],					$addInquiry);
				update_field('field_5a9546c5e411f',	$data['inquiry_double_rooms_quantities'],					$addInquiry);
			}

			if($isService)
			{
				//inquiry_service_start_dates
				update_field('field_5a55cbedf3b22',	$data['inquiry_service_start_dates'],						$addInquiry);
				update_field('field_5a953929fc4a6',	$data['inquiry_service_end_date'],						$addInquiry);

			}

			$response['status'] = 0;
			$message = "";


			if($isProduct)
			{
				$message = file_get_contents(get_template_directory().'/messages/success_addInquryProduct.html');
			}else if($isService)
			{
				$message = file_get_contents(get_template_directory().'/messages/success_addInquiryService.html');


			}else if($isHotel)
			{
				$message = file_get_contents(get_template_directory().'/messages/success_addInquiryHotel.html');

			}


			$categories = array();
			foreach ($data['inquiry_product_category'] as $category) {
				array_push($categories,get_post($category)->post_title);
			}
			$categoryNames = implode(', ',$categories);

			$areaNames = array();
			foreach ($areas as $area) {
				array_push($areaNames,get_post($area)->post_title);
			}
			$areaNames = implode(', ',$areaNames);

			$filterNames = array();
			foreach ($filters as $filter) {
				array_push($filterNames,$filter);//get_term($filter)->name);
			}

			foreach ($filters_other as $filter) {
				$response['status'] = 1;

				array_push($filterNames,$filter);
			}

			/*$response['message'] = '459 1='.$filter;//.var_dump($filter);//->value;
			echo json_encode($response);
			wp_die();*/

			$filterNames = implode(', ',$filterNames);



		/*	$price =$data['inquiry_max_price'];

			if(!is_null($data['inquiry_min_price']))
			{
				if($data['inquiry_min_price'] > 0)
				{
					$price = '&euro;'.$data['inquiry_min_price'] .' - &euro;'.$price ;
				}
			}else {
				$price ='Έως &euro;'.$data['inquiry_max_price'];
			}*/

			$image = "";

			if(	$data['inquiry_image'] != "")
			{
				$image = "<img src='http://pricebook.gr/pricebook/".$data['inquiry_image']."' />";
			}

			if($data['inquiry_no_range'] ==1)
			{
				$min_price =	$data['inquiry_min_price'];// = "-2100"

			}else{
				if($data['inquiry_min_price']  <=0)
				{
					$min_price = 0;
				}else {
					$min_price = $data['inquiry_min_price'];
				}
			}





			$url = '@(http)?(s)?(://)?(([a-zA-Z])([-\w]+\.)+([^\s\.]+[^\s]*)+[^,.\s])@';
			$string = preg_replace($url, '<a href="http$2://$4" target="_blank" title="$0">$0</a>', $data['inquiry_text']);
			$data['inquiry_text'] =  $string;

			if(trim($filterNames) !="")
			{
				$filterhidden = "-";
			}else {
				$filterhidden="hidden";
			}

			if($data['inquiry_text'] !="")
			{
				$texthidden = "";
			}else {
				$texthidden="hidden";
			}

			if($data['inquiry_no_range'] ==1)
			{
				$range_hidden="hidden";
				$no_range_hidden = "";
			}else {
				$range_hidden="";
				$no_range_hidden = "hidden";
			}

			$current = get_post($data['inquiry_product_category'][0]);
			//var_dump(get_object_vars($current));
			$categories_page = createPagination($current,3);
			$overtitle = '<div class="overtitle-transform"><div class="overtitle-shape">'.$categories_page.'</div></div>';

			$message = str_replace("@inquiry_product_category",		$categoryNames,												$message);
			$message = str_replace("@overtitle",		$overtitle,												$message);
			$message = str_replace("@no_range_hidden",		$no_range_hidden,												$message);
			$message = str_replace("@range_hidden",		$range_hidden,												$message);

			$message = str_replace("@inquiry_product_quantities",		$data['inquiry_product_quantities'],	$message);
			$message = str_replace("@inquiry_min_price",				$min_price,	$message);
			$message = str_replace("@inquiry_max_price",				$data['inquiry_max_price'],	$message);
			$message = str_replace("@inquiry_start_date",		$data['inquiry_start_date'],					$message);
			$message = str_replace("@inquiry_end_date",			$data['inquiry_end_date'],						$message);
			$message = str_replace("@inquiry_areas",	$areaNames,		$message);
			//inquiry_longlat
			$message = str_replace("@inquiry_longlat",	$data['inquiry_longlat'],			$message);
			$message = str_replace("@inquiry_filters",			$filterNames,													$message);
			$message = str_replace("@inquiry_text",			$data['inquiry_text'],						$message);
			$message = str_replace("@texthidden",	$texthidden,		$message);
			$message = str_replace("@filterhidden",	$filterhidden,		$message);
			$message = str_replace("@inquiry_image",			$image,						$message);
			if($isHotel)
			{


				$message = str_replace("@inquiry_hotel_start_date",		$data['inquiry_hotel_start_date'],	$message);
				$message = str_replace("@inquiry_hotel_end_date",			$data['inquiry_hotel_end_date'],		$message);
				$message = str_replace("@inquiry_persons_quantities",	$data['inquiry_persons_quantities'],$message);
				$message = str_replace("@inquiry_children_quantities",$data['inquiry_children_quantities'],$message);

				$inquiry_kids_age_hidden="hidden";
				if($data['inquiry_kids_age'] !="")
				{
						$inquiry_kids_age_hidden="";
				}
				$message = str_replace("@inquiry_kids_age_hidden",$inquiry_kids_age_hidden,$message);
				$message = str_replace("@inquiry_kids_age",$data['inquiry_kids_age'],$message);

				$message = str_replace("@inquiry_single_rooms_quantities",		$data['inquiry_single_rooms_quantities'],	$message);
				$message = str_replace("@inquiry_double_rooms_quantities",			$data['inquiry_double_rooms_quantities'],		$message);

			}

			if($isService)
			{
				if(	$data['inquiry_service_end_date'] =="")
				{
						$message = str_replace("@inquiry_service_end_date_hide",		"hidden",	$message);
						$message = str_replace("	@inquiry_service_range_date_hide",		"",	$message);

				}else {
					$message = str_replace("@inquiry_service_end_date_hide",		"",	$message);
					$message = str_replace("	@inquiry_service_range_date_hide",		"hidden",	$message);
				}

				$message = str_replace("@inquiry_service_start_dates",		$data['inquiry_service_start_dates'],	$message);
				$message = str_replace("@inquiry_service_end_date",		$data['inquiry_service_end_date'],	$message);
			}

//
			if($isProduct)
			{
				$postTitle = $categoryNames;
			}else {
				$postTitle =$categoryNames;
			}


			$updatedPost = wp_update_post(array(
				'ID'						=>	$addInquiry,
				'post_title'    =>	$postTitle ,//'Inquiry from '.wp_get_current_user()->nickname. ' at '. date("Y-m-d H:i:s"),
				'post_type'			=>	'client_inquiry',
				'post_content'  =>	$message,
				'post_status'   =>	'publish',
				'post_author'   =>	get_current_user_id()
			));

			if (!is_wp_error($updatedPost)) {
				$response['message'] = $message;//. " IMAGE : ".$data['inquiry_image'];
				//notify user

				$user_info = get_userdata(get_current_user_id());
				$user_nickname = $user_info->user_nicename;
				$link = '<a class="" href="'.get_permalink($addInquiry).'">'.get_post($addInquiry)->post_title.'</a>';

				$user_msg = $user_nickname.' το αίτημα σας  για '.$link.' δημιουργήθηκε με επιτυχία.';


				sendNotificationMessage(false,get_current_user_id(),false,$user_msg);

				//notify sellers for the new inquiryId
				$args = array(
					'blog_id'      => $GLOBALS['blog_id'],
					'role__in'     => array('sellers'),
				 );


//Assign new $addInquiry Inquiry to all sellers that are interested, by attaching it to open_requests.
			$addInquirytoSellerResult = "";
				$sellers = get_users( $args );
				foreach ($sellers as $seller) {

					$return = addInquirytoSeller($seller->ID,$addInquiry);

					$addInquirytoSellerResult = $addInquirytoSellerResult." ".$return;

				}

				//$response['message'] .=$addInquirytoSellerResult;

			}
		}
		else {
			$response['status'] = 1;
			$response['message'] = $addInquiry->get_error_message();
		}

		echo json_encode($response);
		wp_die();

		/**/
	}

}






function addInquirytoSeller($seller,$addInquiry) {



	$areas = getSellersAreas($seller);

	$sellersCategories = getSellerCategoriesById($seller);

	$postToAdd = get_post($addInquiry);

//	$query = new WP_Query($args);
	$requests = array();
	$inquiryBlacklist = array();

	$inquiryBlacklist = get_field('user_blacklist','user_'.get_current_user_id(),false);
	if (!is_array($inquiryBlacklist)) { $inquiryBlacklist = (array)$inquiryBlacklist; }

	$seller_blacklist = get_field('seller_blacklist','user_'.$seller,false);
	if (!is_array($seller_blacklist)) { $seller_blacklist = (array)$seller_blacklist; }

	$inquiry_areas = array();
	//$temp_inquiries = $query->posts;
	//$sellerId = (int) get_current_user_id();
	$inquiries = array();

	$msg_return = $seller.' : ';
	//if the user is also the seller exit

	if($postToAdd->post_author == $seller)
	{
		return $msg_return.'10'; //10 means post author is th seller
	}


	//filter inquiry's category - WORKS

		$temp_inquiryCategories = get_field('inquiry_product_category',$addInquiry, true);
		$inquiryCategories = $temp_inquiryCategories;

		if (count(array_intersect($sellersCategories,$inquiryCategories)) === 0) {
			return  ;//$msg_return.'9';  //9 means seller not in relevant categories


		}

	//filter inquiry's areas - WORKS

		$inquiryAreas = get_field('inquiry_areas',$addInquiry,false);
		if (count(array_intersect($areas,$inquiryAreas)) === 0) {
			return  $msg_return.'8'.implode(" - ",$areas)." > ".implode(" / ",$inquiryAreas);  //8 means seller not in relevant area
		}


	//filter for specific seller

		$hasSpecificSeller = get_field('inquiry_direct_seller',$addInquiry);

		if (!empty($hasSpecificSeller) && $hasSpecificSeller['ID'] != $seller) {
			return  $msg_return.'7';  //7 means seller is not the specific seller
		}


		$newOpenInquiries = array();
		//recreate open inquiries
		$currentOpenInquiries = get_field('sellers_open_requests','user_'.$seller,false);
		if (!empty($currentOpenInquiries)) {
			foreach ($currentOpenInquiries as $list) {
				if (intval($list) != intval($addInquiry)) {
					array_push($newOpenInquiries,$list);
				}
			}
			//add in the end

		}

		array_push($newOpenInquiries,$addInquiry);

		//return "-  679 - ";

		if (update_field('sellers_open_requests',$newOpenInquiries, 'user_'.$seller)) {


			if(!in_array($seller,$inquiryBlacklist) && !in_array(get_current_user_id(),$seller_blacklist))
			{
				$user_info = get_userdata(get_current_user_id());
				$user_nickname = $user_info->user_nicename;
				$link = '<a class="" href="'.get_permalink($addInquiry).'?seller='.$seller.'">'.get_post($addInquiry)->post_title.'</a>';
				$seller_msg = "Έχετε ένα νέο αίτημα για ".$link." από τον χρήστη ".$user_nickname.", ελέγξτε τα ανοικτά σας αιτήματα.";


				sendNotificationMessage(false,$seller,false,$seller_msg);
			}


			return 1; //succes

		}
		else {
			return 0; //failure
		}

		//return 3;

}


 ?>
