<?php
add_filter( 'logout_url', 'wpse_58453_logout_url' );
function wpse_58453_logout_url( $default ) {
	if (isset($_SESSION)) {
    session_destroy();
	}
    return get_home_url();
}
remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );

add_action('wp_head', 'myplugin_ajaxurl');

function myplugin_ajaxurl() {
  echo '<script type="text/javascript">var ajaxurl = "' . admin_url('admin-ajax.php') . '";</script>';
}
function array_flatten($array) {
  if (!is_array($array)) {
    return false;
  }
  $result = array();
  foreach ($array as $key => $value) {
    if (is_array($value)) {
      $result = array_merge($result, array_flatten($value));
    } else {
      $result[$key] = $value;
    }
  }
  return $result;
}

function array_key_unique($arr, $key) {
    $uniquekeys = array();
    $output     = array();
    foreach ($arr as $item) {
        if (!in_array($item[$key], $uniquekeys)) {
            $uniquekeys[] = $item[$key];
            $output[]     = $item;
        }
    }
    return $output;
}

function is_buyer($id = null) {
	$result = false;
	if (is_user_logged_in()) {
    if ($id) {
      $currentUser = get_userdata($id);
  		$roles = $currentUser->roles;
  		if (in_array('buyers',$roles)) {
  			$result = true;
  		}
    }
    else {
      $currentUser = wp_get_current_user();
  		$roles = $currentUser->roles;

  		if (in_array('buyers',$roles)) {
  			$result = true;
  		}
    }
	}
	else {
		$result = false;
	}

	return $result;
}


function is_seller($id = '') {
  $result = false;
	if (is_user_logged_in()) {
    if ($id) {
      $currentUser = get_userdata($id);
  		$roles = $currentUser->roles;

  		if (in_array('sellers',$roles)) {
  			$result = true;
  		}
    }
    else {
      $currentUser = wp_get_current_user();
  		$roles = $currentUser->roles;

  		if (in_array('sellers',$roles)) {
  			$result = true;
  		}
    }
	}
	else {
		$result = false;
	}
	return $result;
}
add_action( 'wp_ajax_getSubcategories', 'getSubcategories' );
add_action( 'wp_ajax_nopriv_getSubcategories', 'getSubcategories' );
function getSubcategories() {
	$id = $_POST['id'];

	$parent = '';
	if (!isset($id)) {
		$parent = 0;
	}
	elseif ($id == "all") {
		echo json_encode(array());
		wp_die();
	}
	else {
		$parent = $id;
	}
	$categories = get_posts(array(
		'post_type'		=>	'product_category',
		'post_parent'	=>	$id
	));

	$tip = get_field('category_tip',$id);

	if (!empty($tip)) {
		$categories['tip'] = get_post($tip[0])->post_content;
	}

	echo json_encode($categories);
	wp_die();
}
add_action( 'wp_ajax_getSubAreas', 'getSubAreas' );
add_action( 'wp_ajax_nopriv_getSubAreas', 'getSubAreas' );
function getSubAreas() {
	$id = $_POST['id'];

	$parent = '';
	if (!isset($id)) {
		$parent = 0;
	}
	elseif ($id == "all") {
		echo json_encode(array());
		wp_die();
	}
	else {
		$parent = $id;
	}
	$areas = get_posts(array(
		'post_type'		=>	'areas',
		'post_parent'	=>	$id
	));
	echo json_encode($areas);
	wp_die();
}
add_action( 'wp_ajax_getCategoryFilters', 'getCategoryFilters' );
add_action( 'wp_ajax_nopriv_getCategoryFilters', 'getCategoryFilters' );
function feedFilters($buffer) {
	return $buffer;
}
function getCategoryFilters() {
	$id = intval($_POST['id']);
	$result = array();

	$categories = wp_get_post_terms($id, 'filters', array("fields" => "all"));

	//$categories = get_terms('filters', array('hide_empty' => false));
	$categoryHierarchy = array();
	sort_terms_hierarchicaly($categories, $categoryHierarchy);

	ob_start('feedFilters');
	foreach ($categoryHierarchy as $category) {
		if ($category->parent == 0 && !empty($category->children)) {
			//echo '<h3 style="margin-top:0">'.$category->name.'</h3>';
			foreach ($category->children as $child) {
				if (!empty($child->children)) {
					$mandatory = get_field('filter_mandatory','filters_'.$child->term_id);
					if ($mandatory) {
						$mandatory = 1;
					}
					else {
						$mandatory = 0;
					}
					$child->isMandatory = $mandatory;
					echo '<h4>'.$child->name.'</h4><a href="#" class="clearFilter" data-filterId="'.$child->term_id.'">(Απαλοιφή)</a>';
					echo '<ul data-mandatory="'.$mandatory.'" style="padding-left:0" data-filterId="'.$child->term_id.'">';
					foreach ($child->children as $sub_child) {
						if (!empty($sub_child->children)) {
							$mandatory = get_field('filter_mandatory','filters_'.$sub_child->term_id);
							if ($mandatory) {
								$mandatory = 1;
							}
							else {
								$mandatory = 0;
							}
							echo '<h4>'.$sub_child->name.'</h4>';
							echo '<ul data-mandatory="'.$mandatory.'" style="padding-left:0">';
						}
						else {
							echo '<li><label><input type="checkbox" name="inquiry_filters[]" value="'.$sub_child->term_id.'">'.$sub_child->name.'</label></li>';
						}
					}
					echo '</ul>';
				}
				else {
					echo '<li><label><input type="checkbox" name="inquiry_filters[]" value="'.$child->term_id.'">'.$child->name.'</label></li>';
				}
			}
		}
	}
	ob_end_flush();

	//echo json_encode($data);
	wp_die();
}

function getCategoryFiltersArray($id) {
//	$id = intval($_POST['id']);
	$result = array();

	$categories = wp_get_post_terms($id, 'filters', array("fields" => "all"));
//print_r(array_values($categories));
	//$categories = get_terms('filters', array('hide_empty' => false));
	$categoryHierarchy = array();

	$filtersArray= array();

	sort_terms_hierarchicaly($categories, $categoryHierarchy);

	ob_start('feedFilters');

	// var_dump($catFilters);
	foreach ($categoryHierarchy as $category) {

		array_push($filtersArray,$category);
		//echo count($filtersArray);



	}

	return $filtersArray ;
	//ob_end_flush();

	//echo json_encode($data);
	//wp_die();
}
function getSubFilters() {
	$id = intval($_POST['filter_id']);
	$result = array();

	$temp_filters = get_field('connected_filters','filters_'.$id);
	if (!empty($temp_filters)) {
		if (sizeof($temp_filters) > 1) {
			//loop
		}
		else {
			$this_filter = get_term($temp_filters[0]);
			echo '<h4 data-parent="'.$id.'">'.$this_filter->name.'</h4>';

			$args = array(
		    'parent' => $temp_filters[0],
		    'orderby' => 'slug',
		    'hide_empty' => false
			);

			$child_terms = get_terms( 'filters', $args );

			$mandatory = get_field('filter_mandatory','filters_'.$this_filter->term_id);
			if ($mandatory) {
				$mandatory = 1;
			}
			else {
				$mandatory = 0;
			}

			echo '<ul data-mandatory="'.$mandatory.'" style="padding-left:0" class="subFilter" data-parent="'.$id.'">';
			foreach ($child_terms as $child) {
				echo '<li><label><input type="checkbox" name="inquiry_filters[]" value="'.$child->term_id.'">'.$child->name.'</label></li>';
			}
			echo '</ul>';
		}
	}
  else {
    return $result;
  }
	//echo json_encode($data);
	wp_die();
}
add_action( 'wp_ajax_getSubFilters', 'getSubFilters' );
add_action( 'wp_ajax_nopriv_getSubFilters', 'getSubFilters' );
function sort_terms_hierarchicaly( Array &$cats, Array &$into, $parentId = 0 ) {

	$count = 0;
	foreach ( $cats as $i => $cat ) {
		$count++;
		?>
		<?php
		//echo $count;
		?>

	<?php
		// var_dump($cat);
		if ( $cat->parent == $parentId ) {
			$into[$cat->term_id] = $cat;
			unset( $cats[$i] );
		}
	}

	foreach ( $into as $topCat ) {
		$topCat->children = array();
		sort_terms_hierarchicaly( $cats, $topCat->children, $topCat->term_id );
	}
}


add_action( 'wp_ajax_loginUser', 'loginUser' );
add_action( 'wp_ajax_nopriv_loginUser', 'loginUser' );
function loginUser() {
	$response = array();

	if ($_POST) {
    session_start();
		//We shall SQL escape all inputs
		$username = esc_attr($_REQUEST['data']['user_login']);
		$password = esc_attr($_REQUEST['data']['user_password']);

		$login_data = array();
		$login_data['user_login'] = $username;
		$login_data['user_password'] = $password;
		$login_data['remember'] = false;

    $userExists_buyer = get_user_by('login',$login_data['user_login'].'_1');
    $userExists_seller = get_user_by('login',$login_data['user_login'].'_2');

    if (!empty($userExists_buyer) && empty($userExists_seller)) {
      //user is buyer only
      $login_data['user_login'] = $userExists_buyer->user_login;
      $login_result = wp_signon($login_data);
      if (!is_wp_error($login_result)) {
        $response['status'] = 0;
        $response['message'] = "<script type='text/javascript'>window.location='".get_site_url()."/home-buyers/?inquiries=active'</script>";
				echo json_encode($response);
				wp_die();
      }
    }
    if (empty($userExists_buyer) && !empty($userExists_seller)) {
      //user is seller only
      $login_data['user_login'] = $userExists_seller->user_login;
      $login_result = wp_signon($login_data);
      if (!is_wp_error($login_result)) {
        $response['status'] = 0;
        $response['message'] = "<script type='text/javascript'>window.location='".get_site_url()."/home-sellers/?inquiries=active'</script>";
				echo json_encode($response);
				wp_die();
      }
    }
    if (!empty($userExists_buyer) && !empty($userExists_seller)) {
			$login_data['user_login'] = $userExists_seller->user_login;
      $login_result = wp_signon($login_data);
			if (is_wp_error($login_result)) {
				$response['status'] = 1;
				$response['message'] = "<span class='error'>Invalid username or password. Please try again!</span>";
				echo json_encode($response);
				wp_die();
			}
			else {
				//user has both accounts so let him choose
	      session_start();
	      $_SESSION['authed'] = 1;
	      $_SESSION['user_login'] = $username;
	  		$_SESSION['user_password'] = $password;

	      $response['status'] = 3;
	      $response['message'] = file_get_contents(dirname(__FILE__).'/views/role_form.php');
				echo json_encode($response);
				wp_die();
			}
    }
    if (empty($userExists_buyer) && empty($userExists_seller)) {
      //can't find user so show error
      $response['status'] = 1;
			$response['message'] = "<span class='error'>Invalid username or password. Please try again!</span>";
			echo json_encode($response);
			wp_die();
    }
	}
	else {
		$response['status'] = 2;
		$response['message'] = null;
	}

	$response = json_encode($response);
	echo $response;
	wp_die();
}
function changeRole() {
  session_start();
  $result = null;

  $authed = (isset($_SESSION['authed']) && $_SESSION['authed'] ? true : false);

  if (!isset($_POST) || !$authed) { return false; }

  $role = $_REQUEST['data']['role'];

  $result = array();
  $logindata = array();
  $login_data['user_login'] = $_SESSION['user_login'];
  $login_data['user_password'] = $_SESSION['user_password'];
  $login_data['remember'] = false;

  if ($role == 'Buyer') {
    $_SESSION['authed'] = true;
    $_SESSION['userRole'] = 'buyers';

    $login_data['user_login'] = $login_data['user_login'].'_1';
    $loginUser = wp_signon($login_data);

    if (!is_wp_error($loginUser)) {
      $result['status'] = 0;
      $result['message'] = get_bloginfo('url')."/home-buyers";
    }
  }
  elseif ($role == 'Seller') {
    $_SESSION['authed'] = true;
    $_SESSION['userRole'] = 'sellers';

    $login_data['user_login'] = $login_data['user_login'].'_2';
    $loginUser = wp_signon($login_data);

    if (!is_wp_error($loginUser)) {
      $result['status'] = 0;
      $result['message'] = get_bloginfo('url')."/home-sellers";
    }
  }
  else {
    $result['status'] = 0;
    $result['message'] = "Internal error";
  }

  echo json_encode($result);
  wp_die();
}
add_action( 'wp_ajax_changeRole', 'changeRole' );
add_action( 'wp_ajax_nopriv_changeRole', 'changeRole' );
function getMyAreas() {
  $areas = array();
  $my_areas = get_user_meta(get_current_user_id(), 'seller_areas', false);

  foreach ($my_areas[0] as $area) {
    array_push($areas,intval($area));
  }

	return $areas;
}

function getSellersAreas($seller) {
  $areas = array();
  $my_areas = get_user_meta($seller, 'seller_areas', false);

  foreach ($my_areas[0] as $area) {
    array_push($areas,intval($area));
  }

	return $areas;
}


function sendMail($post_slug = false, $to = false, $subject = false, $message = false) {
	$result = false;
	$mail_sent = false;
	if (!$to) {
		$result = false;
		return $result;
	}
	else {
		if ($post_slug) {
			$post = get_posts('name='.$post_slug)[0];
			if ($post) {
				$subject = $post->post_title;
				$message = $post->post_content;

				$mail_sent = wp_mail($to, $subject, $message);
			}
		}
		else {
			if (empty($subject) || empty($message)) {
				$result = false;
				return $result;
			}
			else {
				$mail_sent = wp_mail($to, $subject, $message);
			}
		}
		//check if sent
		if ($mail_sent) {
			$result = true;
			return $result;
		}
		else {
			$result = false;
			return $result;
		}
	}
	return $result;
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
				sendNotificationMessage(false,get_post($post)->post_author,false,'Έχετε ένα νέο σχόλιο για το <a href="'. get_permalink($post) .'?seller='.get_current_user_id().'">αίτημα</a> σας.');
			}
			if (is_buyer()) {
				//notify user*
				sendNotificationMessage(false,$_POST['seller'],false,'Έχετε ένα νέο σχόλιο για το <a href="'. get_permalink($post) .'?seller='.$_POST['seller'].'">αίτημα</a> που ενδιαφέρεστε.');
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
function checkIfSameUser($userId = null) {
	if (!$userId) { return false; }
	$result = false;
	$user = get_user_by('ID',$userId);
	$me = get_user_by('ID',get_current_user_id());

	if ($user) {
		$cleanUserUsername = str_replace('_2','', str_replace('_1','',get_userdata($user->ID)->user_login) );
		$cleanMeUsername = str_replace('_2','',str_replace('_1','',get_userdata($me->ID)->user_login));

		if ($cleanUserUsername == $cleanMeUsername) {
			$result = true;
		}
		else {
			$result = false;
		}
	}
	else {
		$result = false;
	}
	return $result;
}
function getMyMessages($page_no) {
	$args = array(
		'post_type'				=>	'user_messages',
		'nopaging'				=>	false,
		'posts_per_page'	=>	20,
		'paged'						=>	$page_no,
		'meta_query'			=>	array(
			'relation'			=>	'AND',
			array(
				'key'					=>	'user_messages_recipient',
				'value'				=>	get_current_user_id()
			)
		)
	);


	$mymessages = new WP_Query($args);

	$total = $mymessages->get_posts();

	return $mymessages;
}
add_action( 'wp_ajax_getNewMessagesCount', 'getNewMessagesCount' );
function getNewMessagesCount() {
	$args = array(
		'post_type'				=>	'user_messages',
		'nopaging'				=>	true,
		'meta_query'			=>	array(
			'relation'			=>	'AND',
			array(
				'key'		=>	'user_messages_isRead',
				'value'	=>	'1',
				'compare'	=> '!='
			),
			array(
				'key'	 	=>	'user_messages_recipient',
				'value'	=>	get_current_user_id()
			)
		)
	);

	$mymessages = new WP_Query($args);

	$total = $mymessages->post_count;

	echo $total;
	wp_die();
}
function sendNotificationMessage($from = false, $to = false, $type = false, $message = false) {
	if (!$to) { return false; }
	//if from is not specify default to user id 77 which is System
	if (!$from) { $from = 77; }
	if (!$type) { $type = 'system_message'; }
	$result = array();

	//create message data
	$newMessageData = array(
	  'post_title'    => 'New message',
	  'post_content'  => $message,
	  'post_status'   => 'publish',
	  'post_author'   => $from,
	  'post_type' 		=> 'user_messages'
	);

	$newMessage = wp_insert_post( $newMessageData );

	if (is_wp_error($newMessage )) {
		return false;
	}
	else {
		update_field('user_messages_isRead', 0,	$newMessage);
		//since our new message was created update its recipient field with the value supplied (if it did)
		if (!update_field('user_messages_recipient', $to,	$newMessage)) {
			return false;
		}
		else {
			//since recipient field was updated start updating the message type (if supplied)
			if (!$type) {
				return true;
			}
			else {
				if (!update_field('user_messages_type',	$type,	$newMessage)) {
					return false;
				}
				else {
					return true;
				}
			}
		}
	}
}
function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}
add_action( 'wp_ajax_forgotPass', 'forgotPass' );
add_action( 'wp_ajax_nopriv_forgotPass', 'forgotPass' );
function forgotPass() {
	if (!isset($_POST) || !isset($_POST['user_email'])) { return false; }

	$email = esc_attr($_POST['user_email']);
	$result = array();

	$userExistsAsBuyer = get_user_by('login',$email.'_1');
	$userExistsAsSeller = get_user_by('login',$email.'_2');
	$newHash = randomPassword();

	if ($userExistsAsBuyer || $userExistsAsSeller) {
		$the_slug = 'email-forgot-password';
		$args = array( 'name'=> $the_slug );
		$template = get_posts($args)[0];
		$template_content = $template->post_content;
		$template_content = str_replace('@newpass',$newHash,$template_content);
		if ( $template ) {
			mail($email,$template->post_title,$template_content);
		}
	}
	//user doesnt exist at all
	if (!$userExistsAsBuyer && !$userExistsAsSeller) {
		$result['status'] = 1;
		$result['message'] = 'Δεν υπάρχει χρήστης με τα στοιχεία που δώσατε.';
		echo json_encode($result);
		wp_die();
	}

	//user is buyer
	if ($userExistsAsBuyer && !$userExistsAsSeller) {
		wp_set_password( $newHash, $userExistsAsBuyer->ID );

		$result['status'] = 0;
		$result['message'] = 'Ο νεός σας κωδικός εστάλη στο email σας.';
		echo json_encode($result);
		wp_die();
	}

	//user is seller
	if (!$userExistsAsBuyer && $userExistsAsSeller) {
		wp_set_password( $newHash, $userExistsAsSeller->ID );

		$result['status'] = 0;
		$result['message'] = 'Ο νεός σας κωδικός εστάλη στο email σας.';
		echo json_encode($result);
		wp_die();
	}

	//user is both
	if ($userExistsAsBuyer && $userExistsAsSeller) {
		wp_set_password( $newHash, $userExistsAsBuyer->ID );
		wp_set_password( $newHash, $userExistsAsSeller->ID );

		$result['status'] = 0;
		$result['message'] = 'Ο νεός σας κωδικός εστάλη στο email σας.';
		echo json_encode($result);
		wp_die();
	}
}
?>
