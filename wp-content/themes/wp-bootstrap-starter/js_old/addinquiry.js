function addInquiry() {
	//alert("addInquiry 8 -pb_functions");
	$response = array();
	if (isset($_POST)) {
		$data['inquiry_product_category'] = array();
		if (isset($_POST['data']['inquiry_product_category'])) {
			$data['inquiry_product_category'] = explode(',',$_POST['data']['inquiry_product_category']);
		}

		$areas = array();
		if (isset($_POST['data']['inquiry_areas']) && $_POST['data']['inquiry_areas'] != NULL) {
			foreach ($_POST['data']['inquiry_areas'] as $dat) {
				foreach ($dat as $val) {
					if ($val != 'inquiry_areas[]') {
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
					}
				}
			}
		}
		else {
			$response['status'] = 1;
			$response['message'] = 'Areas must be set.';
			echo json_encode($response);
			wp_die();
		}

		$filters = array();
		$other_filters = array();
		if (isset($_POST['data']['inquiry_filters'])) {

			foreach ($_POST['data']['inquiry_filters'] as $dat) {
				foreach ($dat as $filter) {
					if ($filter != 'inquiry_filters[]') {
						array_push($filters,$filter);
					}
				}
			}
		}

		//Add other filters to queue
		if (isset($_POST['data']['inquiry_other_filter'])) {

			foreach ($_POST['data']['inquiry_other_filter'] as $dat) {
				foreach ($dat as $filter) {
					if ($filter != 'inquiry_other_filter[]') {
						array_push($filters,$filter);
					}
				}
			}
		}

		if (empty($filters) && mb_strlen($_POST['data']['inquiry_text'],'UTF-8') == 0) {
			$response['status'] = 1;
			$response['message'] = 'You should add either an inquiry text or set a filter.';
			echo json_encode($response);
			wp_die();
		}

		if (empty($filters) && mb_strlen($_POST['data']['inquiry_text'],'UTF-8') < 4 ) {
			$response['status'] = 1;
			$response['message'] = 'Inquiry text must be more than 4 characters.';
			echo json_encode($response);
			wp_die();
		}

		if (!empty($filters) && ($_POST['data']['inquiry_text'] != NULL && mb_strlen($_POST['data']['inquiry_text'],'UTF-8') < 4) ) {
			$response['status'] = 1;
			$response['message'] = 'Inquiry text must be more than 4 characters.';
			echo json_encode($response);
			wp_die();
		}

		$data = array(
			'inquiry_product_category'			=>	(!empty($_POST['data']['inquiry_product_category'])) ? $data['inquiry_product_category'] : array(),
			'inquiry_status'								=>	'active',
			'inquiry_product_quantities'		=>	(!empty($_POST['data']['inquiry_product_quantities'])) ? esc_attr($_POST['data']['inquiry_product_quantities']) : NULL,
			'inquiry_max_price'							=>	(!empty($_POST['data']['inquiry_max_price'])) ? esc_attr($_POST['data']['inquiry_max_price']) : NULL,
			'inquiry_start_date'						=>	(!empty($_POST['data']['inquiry_start_date'])) ? esc_attr($_POST['data']['inquiry_start_date']) : NULL,
			'inquiry_end_date'							=>	(!empty($_POST['data']['inquiry_end_date'])) ? esc_attr($_POST['data']['inquiry_end_date']) : NULL,
			'inquiry_text'									=>	(!empty($_POST['data']['inquiry_text'])) ? esc_attr($_POST['data']['inquiry_text']) : NULL,
			'inquiry_areas'									=>	(!empty($_POST['data']['inquiry_areas'])) ? $areas : array(),
			'inquiry_filters'								=>	(!empty($_POST['data']['inquiry_filters'])) ? $filters : array(),
		);

		if (isset($_POST['data']['inquiry_direct_seller'])) {
			if (!empty($_POST['data']['inquiry_direct_seller'])) {
				$data['inquiry_direct_seller']	=	$_POST['data']['inquiry_direct_seller'];
			}
		}

		$categoryParents = get_post_ancestors($data['inquiry_product_category'][0]);
		$isServiceCategory = false;
		if (in_array(376,$categoryParents)) {
			$isServiceCategory = true;
		}

		foreach ($data as $key=>$val) {
			if (empty($val) && $key != 'inquiry_max_price' && $key != 'inquiry_filters' && !$isServiceCategory && $key != 'inquiry_text') {
				$response['status'] = 1;
				$response['message'] = $key . ' empty';
				echo json_encode($response);
				wp_die();
			}
		}

		if (!is_null($data['inquiry_product_quantities']) && number_format((float)$data['inquiry_product_quantities'], 2, '.', '') < 0) {
			$response['status'] = 1;
			$response['message'] = 'Το πεδίο τεμαχίων δεν πρέπει να είναι μικρότερο από 0.';
			echo json_encode($response);
			wp_die();
		}

		if (!is_null($data['inquiry_max_price']) && number_format((float)$data['inquiry_max_price'], 2, '.', '') < 0) {
			$response['status'] = 1;
			$response['message'] = 'Το πεδίο τιμής δεν πρέπει να είναι μικρότερο από 0.';
			echo json_encode($response);
			wp_die();
		}

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

		if (!$isService) {
			if (strlen($data['inquiry_product_quantities']) != 0 && !ctype_digit($data['inquiry_product_quantities'])) {
				$response['status'] = 1;
				$response['message'] = 'Οι μονάδες πρέπει να είναι αριθμητικό στοιχείο.';
				echo json_encode($response);
				wp_die();
			}
			if (strlen($data['inquiry_max_price']) != 0 && !ctype_digit($data['inquiry_max_price'])) {
				$response['status'] = 1;
				$response['message'] = 'Η τιμή πρέπει να είναι αριθμητικό στοιχείο.';
				echo json_encode($response);
				wp_die();
			}
		}

		$postTitle = floatval($data['inquiry_product_quantities']).' '.get_post($category)->post_title;

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
			update_field('field_595c3035ca5a1',	floatval($data['inquiry_product_quantities']),	$addInquiry);
			update_field('field_595c304eca5a2',	floatval($data['inquiry_max_price']),						$addInquiry);
			update_field('field_595c3071ca5a3',	$data['inquiry_start_date'],										$addInquiry);
			update_field('field_595c308eca5a4',	$data['inquiry_end_date'],											$addInquiry);
			update_field('field_59791e5c5dc83',	$data['inquiry_areas'],													$addInquiry);
			update_field('field_597fbc4426828',	$data['inquiry_direct_seller'],									$addInquiry);
			update_field('field_5a2968ace8f4a',	NULL,																						$addInquiry);

			$response['status'] = 0;
			$message = file_get_contents(get_template_directory().'/messages/success_addInqury.html');

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
				array_push($filterNames,get_term($filter)->name);
			}
			$filterNames = implode(', ',$filterNames);

			$message = str_replace("@categories",		$categoryNames,												$message);
			$message = str_replace("@quantities",		$data['inquiry_product_quantities'],	$message);
			$message = str_replace("@price",				$data['inquiry_max_price'],						$message);
			$message = str_replace("@startdate",		$data['inquiry_start_date'],					$message);
			$message = str_replace("@enddate",			$data['inquiry_end_date'],						$message);
			$message = str_replace("@areas",				$areaNames,														$message);
			$message = str_replace("@filters",			$filterNames,													$message);

			$postTitle =$data['inquiry_product_quantities'].' '.$categoryNames;

			$updatedPost = wp_update_post(array(
				'ID'						=>	$addInquiry,
				'post_title'    =>	$postTitle ,//'Inquiry from '.wp_get_current_user()->nickname. ' at '. date("Y-m-d H:i:s"),
				'post_type'			=>	'client_inquiry',
				'post_content'  =>	$message,
				'post_status'   =>	'publish',
				'post_author'   =>	get_current_user_id()
			));

			if (!is_wp_error($updatedPost)) {
				$response['message'] = $message;
				//notify user
				sendNotificationMessage(false,get_current_user_id(),false,'Το αίτημα σας δημιουργήθηκε με επιτυχία.');

				//notify sellers for the new inquiryId
				$args = array(
					'blog_id'      => $GLOBALS['blog_id'],
					'role__in'     => array('sellers'),
				 );
				$sellers = get_users( $args );
				foreach ($sellers as $seller) {
					$inquiries = getOpenSpecificSellerInquiries($seller->ID);
					foreach ($inquiries as $inquiry) {
						if (intval($inquiry->ID) == intval($addInquiry)) {
							sendNotificationMessage(false,$seller->ID,false,'Δημιουργήθηκε μια νέα προσφορά που σας ενδιαφέρει. Για να την δείτε κάντε κλικ <a href="'.get_permalink($addInquiry).'">εδώ</a>');
						}
					}
				}

			}
		}
		else {
			$response['status'] = 1;
			$response['message'] = $addInquiry->get_error_message();
		}

		echo json_encode($response);
		wp_die();
	}

}// end add inquiry
