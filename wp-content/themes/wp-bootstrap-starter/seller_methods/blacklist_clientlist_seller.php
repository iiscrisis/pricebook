<?php

add_action( 'wp_ajax_BlacklistUser', 'BlacklistUser' );
add_action( 'wp_ajax_nopriv_BlacklistUser', 'BlacklistUser' );

function BlacklistUser() {

	if (!isset($_POST) || !isset($_POST['user'])) { return false; }

	$result = array();
	$currentBlacklist = get_field('seller_blacklist','user_'.get_current_user_id(),false);
	if (!is_array($currentBlacklist)) { $currentBlacklist = (array)$currentBlacklist; }
	$currentUserList = get_field('seller_clientlist','user_'.get_current_user_id(),false);



	if (!empty($currentBlacklist)) {
		foreach ($currentBlacklist as $blacklist) {
			if ($blacklist == $_POST['user']) {
				$result['status'] = 1;
				$result['message'] = "User is already in your blacklist.";
				echo json_encode($result);
				wp_die();
			}
		}
	}

		$user = array_push($currentBlacklist,$_POST['user']);
	//remove user from clients list
	$newUserList = array();
	foreach ($currentUserList as $user) {
		if ($user != $_POST['user']) {
			array_push($newUserList,$user);
		}
	}
	update_field('seller_clientlist',$newUserList,'user_'.get_current_user_id());



	if (update_field('seller_blacklist',$currentBlacklist, 'user_'.get_current_user_id())) {
		$result['status'] = 0;
		$result['message'] = "User added to blacklist.";


    filterOpenRequestsForRemoval(get_current_user_id(),$_POST['user']);


		echo json_encode($result);
		wp_die();
	}else {
		$result['status'] = 1;
		$result['message'] = "Something went wrong when adding user to blacklist.";
		echo json_encode($result);
		wp_die();
	}
}

function getSellersUserSummary() {

  $sellerId = (int) get_current_user_id();
  //echo "Entering 3375 = ".$sellerId;
  $users = get_field('seller_clientlist','user_'.$sellerId,false);

  if (!is_array($users)) {
    //echo "NONOJN";
    $users = (array)$users;
  }

  $users_array =   getUsersInfo($users);

  return $users_array;

}

function getSellersUserBlacklist() {

  $sellerId = (int) get_current_user_id();
  $users = get_field('seller_blacklist','user_'.$sellerId,false);
  if (!is_array($users)) {
    $users = (array)$users;
    //echo "NONOJN";
    //return 0;

  }

  $users_array =   getUsersInfo($users);

  return $users_array;

}


function getUsersInfo($users)
{
  $users_array = array();

  $completed_inquiries = get_field('sellers_successful_offers','user_'.get_current_user_id(),false);
  $closed_inquiries = get_field('sellers_closed_offers','user_'.get_current_user_id(),false);
  $seller_open_inquiries = get_field('sellers_open_requests','user_'.get_current_user_id(),false);

  //var_dump($seller_open_inquiries);
  //$completed_inquiries = get_field('user_successful_inquiries','user_'.get_current_user_id(),false);

  foreach($users as $user)
  {

    $common_completed_array = array();
    $common_closed_array = array();
    $common_open_array = array();

    //echo 'Open user_'.$user.'  > ';
    //print_r($seller_open_inquiries);
    $newquery= array();

    # Get all Users posts that are same as all of sellers inquiries
    $args = array(
    'author' => $user, //get_current_user_id(),
    'post_status'     => 'publish',
    'posts_per_page'  => -1,
    'p'    => $seller_open_inquiries,
    'post_type'			=> 'client_inquiry',
    );

    $query = new WP_Query( $args);

    //sellers_successful_offers
    $newquery=$query->get_posts();
    $newqueryIds = array();
    //  var_dump($newquery);
    if(!is_array($newquery) || empty($newquery))
    {
      $newquery=(array)$newquery;
    }

    foreach($newquery as $post_s)
    {
      //  echo "- POST ID - $post_s->ID";
      array_push($newqueryIds,$post_s->ID);
    }




  //  var_dump($newqueryIds);

    if(is_array($seller_open_inquiries) && !empty($seller_open_inquiries))
    {



      if(is_array($newqueryIds) && !empty($newqueryIds))
      {
        //echo "Open $user ";
      //  var_dump($seller_open_inquiries);

        $common_open_array=array_intersect($newqueryIds,$seller_open_inquiries);
      }
      //sellers_successful_offers
      //var_dump($common_open_array);
    }


    if(is_array($completed_inquiries) && !empty($completed_inquiries))
    {

      $user_completed_inquiries = get_field('user_successful_inquiries','user_'.$user,false);

      if(is_array($newqueryIds) && !empty($newqueryIds))
      {
        //echo "Completed $user ";
      //  var_dump($completed_inquiries);

        $common_completed_array=array_intersect($completed_inquiries,$newqueryIds);
      }
      //sellers_successful_offers

    }



    if(is_array($closed_inquiries) && !empty($closed_inquiries))
    {
      $user_closed_inquiries = get_field('user_closed_inquiries','user_'.$user,false);
      //	//echo $seller_closed_inquiries;

      if(is_array($newqueryIds) && !empty($newqueryIds))
      {
        //echo "Closed $user ";
        //var_dump($closed_inquiries);

        $common_closed_array=array_intersect($closed_inquiries,$newqueryIds);
      }
      //sellers_successful_offers

    }


    $single_user = array("ID"=>$user,"completed"=>$common_completed_array, "closed"=>$common_closed_array,"open"=>$common_open_array);

    array_push($users_array,$single_user);

  }


  return $users_array;

}

/*Client */


add_action( 'wp_ajax_BlacklistSeller', 'BlacklistSeller' );
add_action( 'wp_ajax_nopriv_BlacklistSeller', 'BlacklistSeller' );
function BlacklistSeller() {
	if (!isset($_POST) || !isset($_POST['seller'])) {
		$result['status'] = 0;
		$result['message'] = "No seller";
		echo json_encode($result);
		wp_die();


	 }


  $result =  addSellerToUsersBlackList($_POST['seller'],get_current_user_id());

  echo json_encode($result);
  wp_die();
}


function addSellerToUsersBlackList($seller,$user)
{


  $result = array();
  $currentBlacklist = get_field('user_blacklist','user_'.$user,false);

  if (!is_array($currentBlacklist)) { $currentBlacklist = (array)$currentBlacklist; }


  $newBlacklist = array();
  if (!empty($currentBlacklist)) {
    foreach ($currentBlacklist as $blacklist) {
      if ($blacklist == $seller) {
        $result['status'] = 1;
        $result['message'] = "Seller $seller is already in your blacklist - user_".$user;
        return $result;
      }	else {
        array_push($newBlacklist,$blacklist);

      }

    }
      array_push($newBlacklist,$seller);

  }
  else {
    $newBlacklist[] = intval($seller);
  }

  $currentMerchantsList = get_field('user_sellerlist','user_'.$user,false);
  //remove seller from merchants list
  $newMerchantList = array();

  if (!empty($currentMerchantsList)) {
    foreach ($currentMerchantsList as $merchant) {
      if ($merchant != $seller) {
        array_push($newMerchantList,$merchant);
      }
    }
  }

  update_field('user_sellerlist',$newMerchantList,'user_'.$user);

  //$user = $seller;

  if (update_field('user_blacklist',$newBlacklist, 'user_'.$user)) {
    $result['status'] = 0;
    $result['message'] = "Seller added to blacklist.";

      $result['message'] .= "SELLER ".$seller;

      $result['message'] .=   filterOpenRequestsForRemoval($seller,$user);

    return $result;
  }
  else {
    $result['status'] = 1;
    $result['message'] = "Something went wrong when adding seller to blacklist.";
    return $result;

  }

}




function getUserSellersList($userId = null) {
	$result = array();

	if (empty($userId)) {
		$userId = get_current_user_id();
	}
	$sellers = get_field('user_sellerlist','user_'.$userId,false);

	if (!is_array($sellers)) { $result = (array) $sellers; } else { $result = $sellers; }

	return $result;
}



function getUserBlacklistClientsSummary($blacklist) {

	if($blacklist)
	{
		$request_fields ="user_blacklist";
	}else {
		$request_fields ="user_sellerlist";
	}

	$buyerId = (int) get_current_user_id();
	$sellers = get_field($request_fields,'user_'.$buyerId,false);
	if (!is_array($sellers)) { $sellers = (array)$sellers;

		//echo "3177";
		return 0;

	}

	$sellers_array = array();

	$completed_inquiries = get_field('user_successful_inquiries','user_'.get_current_user_id(),false);
//	var_dump($completed_inquiries);
	$closed_inquiries = get_field('user_closed_inquiries','user_'.get_current_user_id(),false);
//	var_dump($closed_inquiries);
	//$completed_inquiries = get_field('user_successful_inquiries','user_'.get_current_user_id(),false);

	foreach($sellers as $seller)
	{

		$common_completed_array = array();
		$common_closed_array = array();
		if(is_array($completed_inquiries) && !empty($completed_inquiries))
		{
				$seller_completed_inquiries = get_field('sellers_successful_offers','user_'.$seller,false);
				//echo $seller_completed_inquiries;



				if(is_array($seller_completed_inquiries) && !empty($seller_completed_inquiries))
				{
					$common_completed_array=array_intersect($completed_inquiries,$seller_completed_inquiries);
				}
				//sellers_successful_offers

		}

		if(is_array($closed_inquiries) && !empty($closed_inquiries))
		{
				$seller_closed_inquiries = get_field('sellers_closed_offers','user_'.$seller,false);
				//echo $seller_completed_inquiries;



				if(is_array($seller_closed_inquiries) && !empty($seller_closed_inquiries))
				{
					$common_closed_array=array_intersect($closed_inquiries,$seller_closed_inquiries);
				}
				//sellers_successful_offers

		}else {
			$closed_inquiries= array();
		}






				$seller_open_inquiries = get_field('sellers_open_requests','user_'.$seller,false);

				//echo 'user_'.$seller.'  > ';
				//print_r($seller_open_inquiries);
				$newquery= array();
				if(!is_array($seller_open_inquiries) || empty($seller_open_inquiries))
				{

				}else {
					# code...
					$args = array(
										 'author' => get_current_user_id(),
										 'post_status'     => 'publish',
										 'posts_per_page'  => -1,
										 'p'    => $seller_open_inquiries,
										 'post_type'			=> 'client_inquiry',
									 );

							$query = new WP_Query( $args);


				/*	if(is_array($seller_closed_inquiries) && !empty($seller_closed_inquiries))
					{
						$common_open_array=array_intersect($closed_inquiries,$seller_closed_inquiries);
					}*/
					//sellers_successful_offers
					$open_posts=$query->get_posts();

					if(!is_array($open_posts) || empty($open_posts))
					{
					//	$newquery=array();
					}else {
						foreach($open_posts as $post_s)
						{
							//echo "- 3239 - $post_s->ID";
						//	print_m($post_s->ID);
							if(in_array($post_s->ID,$seller_open_inquiries))
							{
									array_push($newquery,$post_s->ID);
							}
						}
				/*		print_m(get_current_user_id());
						var_dump($newquery);*/

					}


				}




		$single_seller = array("ID"=>$seller,"completed"=>$common_completed_array, "closed"=>$common_closed_array,"open"=>$newquery);

		array_push($sellers_array,$single_seller);

	}


		return $sellers_array;

}



add_action( 'wp_ajax_addToMySellers', 'addToMySellers' );
add_action( 'wp_ajax_nopriv_addToMySellers', 'addToMySellers' );
function addToMySellers() {

	if (!isset($_POST) || !isset($_POST['seller'])) { return false; }

	$result = array();
	$currentSellerlist = get_field('user_sellerlist','user_'.get_current_user_id(),false);

	if (!is_array($currentSellerlist)) { $currentSellerlist = (array)$currentSellerlist; }
	$user = $_POST['seller'];

	if (in_array($_POST['seller'],$currentSellerlist)) {
		$result['status'] = 1;
		$result['message'] = "Seller is already in your list.";
		echo json_encode($result);
		wp_die();
	}
	else {
		array_push($currentSellerlist, intval($user));
	}


	//remove from blackliste
	$currentBlacklist = get_field('user_blacklist','user_'.get_current_user_id(),false);

	//remove seller from merchants list
	$newBlackList = array();

	if (!empty($currentBlacklist)) {
		foreach ($currentBlacklist as $merchant) {
			if ($merchant != $user) {
				array_push($newBlackList,$merchant);
			}
		}
	}
	update_field('user_blacklist',$newBlackList,'user_'.get_current_user_id());

	if (update_field('user_sellerlist',$currentSellerlist, 'user_'.get_current_user_id())) {
		$result['status'] = 0;
		$result['message'] = "Seller added to your list.";
		echo json_encode($result);
		wp_die();
	}
	else {
		$result['status'] = 1;
		$result['message'] = "Something went wrong when adding seller to your list.";
		echo json_encode($result);
		wp_die();
	}
}



function getUserSellersSummary()
{

	$buyerId = (int) get_current_user_id();
	$sellers = get_field('user_sellerlist','user_'.$buyerId,false);
	if (!is_array($sellers)) { $sellers = (array)$sellers;

		return 0;

	}

	$sellers_array = array();

	$completed_inquiries = get_field('user_successful_inquiries','user_'.get_current_user_id(),false);
	$closed_inquiries = get_field('user_closed_inquiries','user_'.get_current_user_id(),false);
	//$completed_inquiries = get_field('user_successful_inquiries','user_'.get_current_user_id(),false);

	foreach($sellers as $seller)
	{

		$common_completed_array = array();
		$common_closed_array = array();
		if(is_array($completed_inquiries) && !empty($completed_inquiries))
		{
				$seller_completed_inquiries = get_field('sellers_successful_offers','user_'.$seller,false);
				//echo $seller_completed_inquiries;

				if(is_array($seller_completed_inquiries) && !empty($seller_completed_inquiries))
				{
				//	$common_completed_array=array_intersect($completed_inquiries,$seller_completed_inquiries);
				}
				//sellers_successful_offers
		}

		if(is_array($closed_inquiries) && !empty($closed_inquiries))
		{
				$seller_closed_inquiries = get_field('sellers_closed_offers','user_'.$seller,false);
				//echo $seller_closed_inquiries;

				if(is_array($seller_closed_inquiries) && !empty($seller_closed_inquiries))
				{
					// #ΕRROR TO FIX
				//	$common_closed_array=array_intersect($closed_inquiries,$seller_closed_inquiries);
				}
				//sellers_successful_offers
		}

				$seller_open_inquiries = get_field('sellers_open_requests','user_'.$seller,false);

			//	echo 'user_'.$seller.'  > ';
				//print_r($seller_open_inquiries);
				$newquery= array();
				if(!is_array($seller_open_inquiries) || empty($seller_open_inquiries))
				{

				}else {
					# code...
					$args = array(
										 'author' => get_current_user_id(),
										 'post_status'     => 'publish',
										 'posts_per_page'  => -1,
										 'p'    => $seller_open_inquiries,
										 'post_type'			=> 'client_inquiry',
									 );

							$query = new WP_Query( $args);


				/*	if(is_array($seller_closed_inquiries) && !empty($seller_closed_inquiries))
					{
						$common_open_array=array_intersect($closed_inquiries,$seller_closed_inquiries);
					}*/
					//sellers_successful_offers
					$newquery=$query->get_posts();

					if(!is_array($newquery) || empty($newquery))
					{
						$newquery=array();
					}

					foreach($newquery as $post_s)
					{
					//	echo "- 3239 - $post_s->ID";
							array_push($newquery,$post_s->ID);
					}
				}

		$single_seller = array("ID"=>$seller,"completed"=>$common_completed_array, "closed"=>$common_closed_array,"open"=>$newquery);
		array_push($sellers_array,$single_seller);
	}
	return $sellers_array;
}
?>
