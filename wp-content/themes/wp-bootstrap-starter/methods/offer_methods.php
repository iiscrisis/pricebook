<?php

add_action( 'wp_ajax_placeOffer', 'placeOffer' );
function placeOffer() {
  if (!isset($_POST['action']) || empty($_POST['inquiryId'])) { return false; }

  $result = array();
  $inquiryId = $_POST['inquiryId'];

	if (isset($_POST['inquiry_shipping_cost']) && !ctype_digit($_POST['inquiry_shipping_cost']) && number_format((float)$_POST['inquiry_shipping_cost'], 2, '.', '') < 0) {
		$result['status'] = 1;
		$result['message'] = "Το πεδίο μεταφορικών δεν είναι έγκυρο.";

		echo json_encode($result);
		wp_die();
	}
	if (isset($_POST['inquiry_quantity']) && !ctype_digit($_POST['inquiry_quantity']) && number_format((float)$_POST['inquiry_quantity'], 2, '.', '') < 0) {
		$result['status'] = 1;
		$result['message'] = "Το πεδίο τεμαχίων δεν είναι έγκυρο.";

		echo json_encode($result);
		wp_die();
	}
	if (isset($_POST['inquiry_cashondelivery_cost']) && !ctype_digit($_POST['inquiry_cashondelivery_cost']) && number_format((float)$_POST['inquiry_cashondelivery_cost'], 2, '.', '') < 0) {
		$result['status'] = 1;
		$result['message'] = "Το πεδίο αντικαταβολής δεν είναι έγκυρο.";

		echo json_encode($result);
		wp_die();
	}
	if (isset($_POST['inquiry_seller_unit_cost']) && !ctype_digit($_POST['inquiry_seller_unit_cost']) && number_format((float)$_POST['inquiry_seller_unit_cost'], 2, '.', '') <= 0) {
		$result['status'] = 1;
		$result['message'] = "Το πεδίο τιμής δεν είναι έγκυρο.";

		echo json_encode($result);
		wp_die();
	}



  $offer = array(
    'field_598537ec1b336' => get_current_user_id(),
    'field_598538221b337' => 'pending',
    'field_59f6fa9f43b43' => $_POST['inquiry_seller_unit_cost'],
    'field_59f6fa4c43b41' => (isset($_POST['inquiry_shipping_cost']) ? $_POST['inquiry_shipping_cost'] : null),
    'field_59f6fab743b44' => (isset($_POST['inquiry_quantity']) ? $_POST['inquiry_quantity'] : null),
    'field_59f6fa8743b42'	=> (isset($_POST['inquiry_cashondelivery_cost']) ? $_POST['inquiry_cashondelivery_cost'] : null),
		'field_5a296409633ea'	=> date('Y-m-d H:i:s')
  );

	$offerExists = getOffer($_POST['inquiryId'], get_current_user_id());

  if (empty($offerExists['pending'])) {
		if (add_row('field_598537c81b335',$offer,$_POST['inquiryId'])) {

			//notify user




      $seller_msg = 'Έχετε μία νέα προσφορά για το αίτημα σας για <a href="'.get_permalink($_POST['inquiryId']).'?seller='.get_current_user_id().'">'.get_post($_POST['inquiryId'])->post_title.'</a>.';
			sendNotificationMessage(false,get_post_field( 'post_author', $inquiryId ),false,$seller_msg);

			$result['status'] = 100;
			$result['message'] = "Offer placed.";
			echo json_encode($result);
			wp_die();
		}
		else {
			$result['status'] = 1;
			$result['message'] = "Error while placing offer.";
			echo json_encode($result);
			wp_die();
		}
  }
  else {
		//find seller's offer and update it
		$existingOffers = get_field('inquiry_offers',$_POST['inquiryId']);
		$len = 1;

		foreach ($existingOffers as $key => $val) {
			if ($val['inquiry_seller']['ID'] == get_current_user_id() && $val['inquiry_status'] == 'pending') {
				if (update_row('field_598537c81b335',$len,$offer,$inquiryId)) {

					//notify user

          $user_nickname  = get_field('seller_companyName',get_current_user_id());
          if($user_nickname == "")
          {   $user_info = get_userdata(get_current_user_id());
              $user_nickname = $user_info->nickname;
          }


          $seller_msg = 'Έχετε μία ανανεωμένη προσφορά για το αίτημα σας για';
          $seller_msg .= '<a href="'.get_permalink($_POST['inquiryId']).'?seller='.get_current_user_id().'">'.get_post($_POST['inquiryId'])->post_title.'</a> απο '.$user_nickname.'.';
          sendNotificationMessage(false,get_post_field( 'post_author', $inquiryId ),false,$seller_msg);

				//	sendNotificationMessage(false,get_post_field( 'post_author', $inquiryId ),false,'Έχετε μία ανανεωμένη προσφορά για το αίτημα σας. Κάντε κλικ <a href="'.get_permalink($_POST['inquiryId']).'?seller='.get_current_user_id().'">εδώ</a> για να την δείτε.');

					$result['status'] = 0;
					$result['message'] = "Offer updated.";

					echo json_encode($result);
					wp_die();
					//send notification to seller
				}
				else {
					$result['status'] = 1;
					$result['message'] = "Error when updating the offer. Please contact the admin";
					echo json_encode($result);
					wp_die();
				}
			}
			$len++;
		}

  }
}

add_action( 'wp_ajax_postComment', 'postComment' );
function postComment() {
  $result = array();
	if (isset($_POST) && is_user_logged_in()) {
		$thread = (isset($_POST['thread']) ? $_POST['thread'] : 0);
    $message = $_POST['text'];
    $post = $_POST['post'];

    $args = array(
      'comment_author'        => get_userdata(get_current_user_id())->user_login,
      'comment_author_email'  => get_userdata(get_current_user_id())->user_email,
      'comment_post_ID'       => $post,
      'comment_content'       => $message,
      'comment_parent'        => $thread,
      'user_id'               => get_current_user_id(),
      'comment_approved'      => 1
    );

    $response = wp_insert_comment($args);

    if (!is_wp_error($response)) {
      $result['status'] = 0;

			if (is_seller()) {

        //IF seller add one to messages total for thread. IF a buyer responds we can compare that to total and calcualte the nu,ber of new messages
      $offers =  get_field("inquiry_offers",$post);
      $count = 0;
        foreach ($offers as $offer) {
          $count++;
          if ($offer['inquiry_seller']['ID'] == get_current_user_id()) {
            $counter = 1;
            if($offer['inquiry_seller_lastmessage'] != "")
            {
                $msgs = getInquiryConversation($post,get_post($post)->post_author);
                $counter = count($msgs['messages']) + 1;
            }

            update_sub_field(array('field_598537c81b335',$count,'field_5a60c8a8e7c30'),$counter, $post);
          }
        }

			//	sendNotificationMessage(false,get_post($post)->post_author,false,'Έχετε ένα νέο σχόλιο για το <a href="'. get_permalink($post) .'?seller='.get_current_user_id().'">αίτημα</a> σας.');
			}
			if (is_buyer()) {
				//notify user*
			//	sendNotificationMessage(false,$_POST['seller'],false,'Έχετε ένα νέο σχόλιο για το <a href="'. get_permalink($post) .'?seller='.$_POST['seller'].'">αίτημα</a> που ενδιαφέρεστε.');
			}

			$result['status'] = 0;
			echo json_encode($result);
			wp_die();
    }
    else {
      $result['status'] = 1;
			echo json_encode($result);
			wp_die();
    }
  }
  else {
    $result['status'] = 1;
		echo json_encode($result);
		wp_die();
  }
}

?>
