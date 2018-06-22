<?php
/*
Plugin Name: Pricebook User Registration
Plugin URI: blah
Description: Pricebook User Registration
Version: 2.0
Author: Pixelschaos is a fuckin prick
Author URI:
*/

class SellerRegistration {
	// form properties

	private $subscription;
	private $email;
	private $companyName;
	private $companyName_receipt;
	private $password;
	private $username;
	private $fysiko;
	private $ctype;
	private $afm;
	private $receipt_type;
	private $area;
	private $address;
	private $city;
	private $doy;
	private $email_receipt;
	private $activities;
	private $post_code;
	private $contactPhone;
	private $terms;

	private $registration_date;
 	private $renew_date;
	private $representative;


	/*private $areas;
	private $childrenCategories;
	private $payment;
	private $complete;*/

	function __construct() {
		add_shortcode('seller_registration', array($this, 'shortcode'));
		wp_enqueue_script('seller_registration',plugins_url('user-registration/user-registration.js'),array( 'jquery' ));
	}

	function validation() {





		$error="";
		if(empty($this->username) || $this->username != $this->email	 )
		{
			$error .="Email is missing or has invalid characters <br/>";
		}

		if((empty($this->password) || empty($this->password2)) || $this->password != $this->password2)
		{
			$error.="Passwords do not match or invalid characters where used<br/>";
		}

		if (!is_email($this->email)) {
			$error.="Email is not valid";
		}

		if (email_exists($this->email)) {
			//return new WP_Error('email', 'Email Already in use');

			$error.="This Email is being used, please choose another one.<br/>";
		}

		if (!is_email($this->email_receipt)) {
			$error.="Email is not valid";
		}



		/*if (strlen($this->username) < 4) {
			return new WP_Error('username_length', 'Username too short. At least 4 characters is required');
		}*/

		if (strlen($this->password) < 5) {
			$error.= 'Password length must be greater than 5';
		}



		/*if (strlen($this->contactPhone) < 14 || substr($this->contactPhone, 0, 4) != '+30.' || !ctype_digit(explode('+30.',$this->contactPhone)[1]) ) {
			return new WP_Error('contactPhone', 'Incorrect contact phone');
		}*/

		if (strlen($this->companyName) <3) {
			$error.='Company Name length must be greater than 3';
		}

		if (strlen($this->companyName_receipt) <3) {
			$error.='Company Name length must be greater than 3';
		}


		if($this->fysiko!=1 && $this->fysiko!=0)
		{
			$error.='Something is wrong with φυσικο πρόσωπο';
		}

		if(strlen($this->receipt_type)!=1)
		{
			$error.='Something is wrong with φυσικο πρόσωπο';
		}

		if(!get_post($this->subscription))
		{
			$error.='Something is wrong with subscription choice';
		}

		/*if(($this->renew_date))
		{
			$error.='Something is wrong with subscription length';
		}*/

		if(strlen($this->area)<2)
		{
			$error.='Something is wrong with Area';
		}

		if(strlen($this->address)<2)
		{
			$error.='Something is wrong with address';
		}

		if(strlen($this->city)<2)
		{
			$error.='Something is wrong with address';
		}

		if(strlen($this->doy)<2)
		{
			$error.='Something is wrong with address';
		}

		if(strlen($this->activities)<2)
		{
			$error.='Something is wrong with address';
		}
		if(strlen(trim(str_replace(" ","",$this->post_code)))!=5)
		{
			$error.='Something is wrong with post_code';
		}

		if (!isset($this->terms) || $this->terms != "accepted") {
			$error.='Yo Accept the terms';
		}



		if($error != "")
		{
			return new WP_Error('registration_error', $error);
		}

		/*
		if (strlen($this->afm) > 4) {
		$afm = $this->afm;

		$result = null;
		$client = file_get_contents("https://www.papaki.com/ajax/json.aspx?f=get_afm_info&afm=".$this->afm);
		$result = json_decode($client,true);

		if ($result && strlen($result['data']['ERRORCODE']) == 0) {
		return true;
	}
	else {
	return new WP_Error('afm', 'VAT is incorrect');
}
}
else {
return new WP_Error('afm', 'VAT is incorrect');
}
*/

$user = get_user_by('login', $this->email);
//input email exists as user, so test login so we can promote him to seller
if ($user) {
	$testdata = array();
	$testdata['user_login'] =	$this->email;
	$testdata['user_password']	= $this->password;
	$testdata['remember'] = false;

	$testSignOn = wp_signon($testdata);
	if (is_wp_error($testSignOn)) {
		return new WP_Error('password', 'Password entered does not belong to the existing user.');
		wp_die();
	}
}
}

function registration() {

	$userdata = array(
	'user_login'	=> esc_attr($this->username),
	'user_email'	=> esc_attr($this->email),
	'user_pass'		=> esc_attr($this->password),
	'role'				=> 'sellers'
	);

	if (is_wp_error($this->validation())) {
		echo '<div style="margin-bottom: 6px" class="btn btn-block btn-lg btn-danger">';
			echo '<strong>' . $this->validation()->get_error_message() . '</strong>';
			echo '</div>';
		}
		else {
			$userdata['user_login'] = $userdata['user_login'];
			$userdata['user_email'] = $userdata['user_email'];




			$register_user = wp_insert_user($userdata);

			/*

			$this->subscription			=		$_POST['reg_subscription'];
			$this->username 				=	sanitize_email($_POST['reg_email']);
			$this->email						=	$_POST['reg_email']	;  //if the same email is valid else sths wrong
			$this->companyName			=	sanitize_text_field($_POST['reg_companyName']);
			$this->password					=	sanitize_text_field($_POST['reg_pass']); //if the same password is valid else sth wrong
			$this->password2				=	$_POST['reg_pass2'];
			$this->fysiko						=	$_POST['reg_fysiko'];
			$this->ctype						=	sanitize_text_field($_POST['reg_ctype']);
			$this->afm							=	sanitize_text_field($_POST['reg_afm']);
			$this->receipt_type			=	$_POST['reg_receipt_type'];
			$this->area							=	sanitize_text_field($_POST['reg_area']);
			$this->address					=	sanitize_text_field($_POST['reg_address']);
			$this->post_code				=	sanitize_text_field($_POST['reg_pc']);
			$this->contactPhone			=	sanitize_text_field($_POST['reg_contactPhone']);
			$this->terms

			*/


			if (!is_wp_error($register_user)) {
				wp_update_user( array( 'ID' => $register_user, 'user_registered' => date("Y-m-d H:i:s") ) );
				$newSeller = 'user_'.$register_user;



				$newFields = array(

				'seller_companyName'				=> esc_attr($this->companyName),
				'sellers_company_receipt'				=> esc_attr($this->companyName_receipt),
				'seller_details_subscription_id'	=> 		$this->subscription,
				'seller_details_company'				=> esc_attr($this->fysiko),
				'seller_details_receipt'				=> esc_attr($this->receipt_type),
				'seller_details_afm'								=> $this->afm,
				'seller_details_address'						=> esc_attr($this->address),
				'seller_details_doy'						=> esc_attr($this->doy),
				'seller_details_email_receipt'	=> esc_attr($this->email_receipt),
				'seller_details_city'						=> esc_attr($this->city),
				'seller_details_activities'						=> esc_attr($this->activities),
				'seller_details_area'						=> esc_attr($this->area),
				'seller_details_postcode'				=> esc_attr($this->post_code),
				'seller_details_ctype'				=> esc_attr($this->ctype),
				'seller_details_telephone'		=> esc_attr($this->contactPhone),
				'seller_details_registration_date'	=> $this->registration_date,
				'seller_details_renew_date'	=> 	$this->renew_date
				//'seller_details_representative'				=> $this->representative;
				);

				$tmpl_post_types =array('2751'=>'tmpl_products','2752'=>'tmpl_hotels','2750'=>array(0=>'tmpl_products',1=>'tmpl_services'));
				$tmpl_post_type = "";
				if($this->subscription == '2750')
				{
					$tmpl_post_type = $tmpl_post_types['2750'][$this->fysiko];
				}else {
					$tmpl_post_type = $tmpl_post_types[$this->subscription];
				}

				echo "<br/>  : $this->subscription - TEMPLATE : ".$tmpl_post_type;
				//seller_details_subscription_tmpl_id
				$postTitle = "Δεδομένα για $tmpl_post_type - ".$this->email;

				$sellerData = array(
					'post_title'    							=>	$postTitle , //'Inquiry from '.wp_get_current_user()->nickname. ' at '. date("Y-m-d H:i:s"),
					'post_type'										=>	$tmpl_post_type,
					'post_content'  							=>	"",
					'post_status'   							=>	'publish',
					'post_author'   							=>	$newSeller
				);

				$sellerDataId = wp_insert_post( $sellerData );
				echo "<br/>-TMPL ID : ".$sellerDataId;
				$seller_post_tmpl = get_post($sellerDataId);
				update_field('seller_data_userid',	$register_user,$sellerDataId);

				echo "<br/> //// $this->subscription : Registration date  $this->registration_date + 	$this->renew_date //// ";
				update_field('seller_companyName',							$newFields['seller_companyName'],		$newSeller);
				update_field('sellers_company_receipt',							$newFields['sellers_company_receipt'],		$newSeller);
				update_field('seller_details_subscription_id',	$newFields['seller_details_subscription_id'],				$newSeller);
				update_field('seller_details_subscription_tmpl_id',	$sellerDataId ,				$newSeller);
				update_field('seller_details_company',					$newFields['seller_details_company'],		$newSeller);
				update_field('seller_details_receipt',					$newFields['seller_details_receipt'],		$newSeller);
				update_field('seller_details_afm',							$newFields['seller_details_afm'],		$newSeller);
				update_field('seller_details_address',					$newFields['seller_details_address'],				$newSeller);
				update_field('seller_details_city',					$newFields['seller_details_city'],				$newSeller);
				update_field('seller_details_doy',					$newFields['seller_details_doy'],				$newSeller);
				update_field('seller_details_email_receipt',					$newFields['seller_details_email_receipt'],				$newSeller);
				update_field('seller_details_activities',					$newFields['seller_details_activities'],				$newSeller);
				update_field('seller_details_area',							$newFields['seller_details_area'],				$newSeller);
				update_field('seller_details_postcode',					$newFields['seller_details_postcode'],				$newSeller);
				update_field('seller_details_ctype',						$newFields['seller_details_ctype'],				$newSeller);
				update_field('seller_details_telephone',				$newFields['seller_details_telephone'],				$newSeller);
				update_field('seller_details_renew_date',				$newFields['seller_details_renew_date'],				$newSeller);
				update_field('seller_details_registration_date',$newFields['seller_details_registration_date'],				$newSeller);
				//seller_details_subscription_tmpl_id
				//echo '<div style="margin-bottom: 6px" class="btn btn-block btn-lg btn-success">';
				//echo '<strong>Registration complete. Goto <a href="' . wp_login_url() . '">login page</a></strong>';
				//echo '</div>';

				//send welcome email
				echo "<br/>sending email";
				$mail_sent = sendMail('welcome-sellers', $userdata['user_email']);
				if (!$mail_sent) {
						echo "<br/>sending email : fail";
					sendMail(false, 'jomous@gmail.com','Mail not sent to '.$userdata['user_email'],'');
				}
				else {
					echo "<br/>sending email : success";
					sendMail(false, 'jomous@gmail.com','New shop '.$userdata['user_email'],'');
				}

				$login_data = array();
				$login_data['user_login'] = $userdata['user_login'];
				$login_data['user_password'] = $userdata['user_pass'];
				$login_data['remember'] = false;
				echo "<br/>Signing in";
				$user_verify = wp_signon( $login_data, true );
				if ( is_wp_error($user_verify)) {
					echo "<br/>Not logged in";
					echo '<div style="margin-bottom: 6px" class="btn btn-block btn-lg btn-success">';
						echo '<strong>Registration complete. Goto <a href="' . get_home_url() . '">login page</a></strong>';
						echo '</div>';
					}
					else {
						echo "<br/><br/>Logged in";
					//	wp_safe_redirect(get_home_url());
						exit();
					}

				}
				else {
					echo '<div style="margin-bottom: 6px" class="btn btn-block btn-lg btn-danger">';
						echo '<strong>' . $register_user->get_error_message() . '</strong>';
						echo '</div>';
					}
				}
			}

			function shortcode() {
				ob_start();
				if (isset($_POST['reg_submit'])) {

					$isFysiko = 0;
					if( $_POST['reg_fysiko'] == 1)
					{
						$isFysiko = 1;
					}

					$this->subscription			=		$_POST['reg_subscription'];
					$this->username 				=	sanitize_email($_POST['reg_email']);
					$this->email						=	$_POST['reg_email']	;  //if the same email is valid else sths wrong
					$this->companyName			=	sanitize_text_field($_POST['reg_companyName']);
					$this->companyName_receipt			=	sanitize_text_field($_POST['reg_companyName_receipt']);

					$this->password					=	sanitize_text_field($_POST['reg_pass']); //if the same password is valid else sth wrong
					$this->password2				=	$_POST['reg_pass2'];
					$this->fysiko						=	$isFysiko;
					$this->ctype						=	sanitize_text_field($_POST['reg_ctype']);
					$this->afm							=	sanitize_text_field($_POST['reg_afm']);
					$this->receipt_type			=	$_POST['reg_receipt_type'];
					$this->area							=	sanitize_text_field($_POST['reg_area']);
					$this->address					=	sanitize_text_field($_POST['reg_address']);
					$this->city					=	sanitize_text_field($_POST['reg_city']);
					$this->doy					=	sanitize_text_field($_POST['reg_doy']);
					$this->email_receipt					=	sanitize_text_field($_POST['reg_email_receipt']);
					$this->activities					=	sanitize_text_field($_POST['reg_activities']);
					$this->post_code				=	sanitize_text_field($_POST['reg_pc']);
					$this->contactPhone			=	sanitize_text_field($_POST['reg_contactPhone']);
					$this->terms						=	$_POST['reg_terms'];

					$this->renew_date				= sanitize_text_field($_POST['reg_subscriptionlength']);

					$this->registration_date = date("d/m/Y");


					echo "<br/> ".$this->subscription;
					echo "<br/> ".$this->username 	;		//	=	sanitize_email($_POST['reg_email']);
					echo "<br/> ".$this->email			;		//	=	$_POST['reg_email']	;  //if the same email is valid else sths wrong
					echo "<br/> ".$this->companyName	;
					echo "<br/> ".$this->companyName_receipt	;
						//	=	sanitize_text_field($_POST['reg_companyName']);
					echo "<br/> ".$this->password	;			//	=	sanitize_text_field($_POST['reg_pass']); //if the same password is valid else sth wrong
					echo "<br/> ".$this->password2	;		//	=	$_POST['reg_pass2'];
					echo "<br/> ".$this->fysiko		;		//		=	$_POST['reg_fysiko'];
					echo "<br/> ".$this->ctype		;				//=	sanitize_text_field($_POST['reg_ctype']);
					echo "<br/> ".$this->afm			;			//	=	sanitize_text_field($_POST['reg_afm']);
					echo "<br/> ".$this->receipt_type	;	//	=	$_POST['reg_receipt_type'];
					echo "<br/> ".$this->area		;				//	=	sanitize_text_field($_POST['reg_area']);
					echo "<br/> ".$this->address		;			//=	sanitize_text_field($_POST['reg_address']);
					echo "<br/> ".$this->city		;
					echo "<br/> ".$this->doy		;
					echo "<br/> ".$this->email_receipt		;
					echo "<br/> ".$this->activities		;
					echo "<br/> ".$this->post_code		;		//=	sanitize_text_field($_POST['reg_pc']);
					echo "<br/> ".$this->contactPhone	;	//	=	sanitize_text_field($_POST['reg_contactPhone']);
					echo "<br/> ".$this->terms			;			//=	$_POST['reg_terms'];
					echo "<br/> ".$this->registration_date;
					echo "<br/> ".$this->renew_date;

					$this->representative;

					$valid = $this->validation();;

					$error = 0;
					if(isset($valid))
					{
						print_r($valid->get_error_messages('registration_error') );
						echo "<br/>print error messages";
						$error = 1;
					}else {
						echo "<br/>registering";
						$this->registration();
					}

					if($error==1)
					{
						//$this->registration_form();
					}else {
						//take me to log in page
						echo "<br/>OK DOKEY";
					}


				//
			}else {
				$this->registration_form();
			}

				return ob_get_clean();
			}

			public function registration_form() {
				include('include/register_form.php');
				}
			}

			new SellerRegistration;

			class BuyerRegistration {
				// form properties
				private $email;
				private $username;
				private $password;
				private $password2;
				private $website;
				private $nickname;

				function __construct() {
					add_shortcode('buyer_registration', array($this, 'shortcode'));
					//wp_enqueue_script('buyer_registration',plugins_url('user-registration/user-registration.js'),array( 'jquery' ));
				}

				function validation() {
					if (empty($this->password) || empty($this->email) || empty($this->nickname)) {
						return new WP_Error('field', 'Required form field is missing');
					}

					if (strlen($this->nickname) < 4) {
						return new WP_Error('nickname', 'Nickname too short. At least 4 characters is required');
					}

					if (strlen($this->password) < 5) {
						return new WP_Error('password', 'Password length must be greater than 5');
					}

					if (strlen($this->password2) < 5) {
						return new WP_Error('password2', 'Password verification length must be greater than 5');
					}

					if ($this->password != $this->password2) {
						return new WP_Error('password2', 'Passwords do not match');
					}
					if (!is_email($this->email)) {
						return new WP_Error('email_invalid', 'Email is not valid');
					}

					if (email_exists($this->email)) {
						//return new WP_Error('email', 'Email Already in use');
					}
				}

				function newUserSuccessEmail($userID,$email) {
					if (empty($userID) || empty($email)) { return false; }

					if (wp_mail($email,$subject,$message)) {
						return true;
					}
					else {
						return false;
					}
				}

				function registration() {
					$userdata = array(
					'user_login'		=> esc_attr($this->email),
					'user_email'		=> esc_attr($this->email),
					'user_pass'			=> esc_attr($this->password),
					'role'					=> 'buyers',
					'nickname'			=> esc_attr($this->nickname),
					'user_nicename'	=> esc_attr($this->nickname),
					'first_name'		=> esc_attr($this->nickname)
					);

					if (is_wp_error($this->validation())) {
						echo '<div style="margin-bottom: 6px" class="btn btn-block btn-lg btn-danger">';
							echo '<strong>' . $this->validation()->get_error_message() . '</strong>';
							echo '</div>';
						}
						else {
							if (email_exists($this->email)) {
								//since user exists check if he's already a user _1 = buyer _2 = seller
								$user = get_user_by('email', $this->email);
								if (!empty($user) && is_seller($user->ID)) {
									$userdata['user_login'] = $userdata['user_login'];
									$userdata['user_email'] = $userdata['user_email'];
								}
							}
							else {
								$userdata['user_login'] = $userdata['user_login'];
								$userdata['user_email'] = $userdata['user_email'];
							}

							$register_user = wp_insert_user($userdata);
							//SEND MAIL HERE DUDE
							if (!is_wp_error($register_user)) {
								wp_update_user( array( 'ID' => $register_user, 'user_registered' => date("Y-m-d H:i:s") ) );
								//echo '<div style="margin-bottom: 6px" class="btn btn-block btn-lg btn-success">';
								//echo '<strong>Registration complete. Goto <a href="' . wp_login_url() . '">login page</a></strong>';
								//echo '</div>';

								//send welcome email
								$mail_sent = sendMail('welcome-buyers', $userdata['user_email']);
								if (!$mail_sent) {
									sendMail(false, 'jomous@gmail.com','Mail didnt send on '.$userdata['user_email'],'');
								}
								else {
									sendMail(false, 'jomous@gmail.com','New shop '.$userdata['user_email'],'');
								}
								$login_data = array();
								$login_data['user_login'] = $userdata['user_login'];
								$login_data['user_password'] = $userdata['user_pass'];
								$login_data['remember'] = false;

								$user_verify = wp_signon( $login_data, true );
								if ( is_wp_error($user_verify)) {
									echo '<div style="margin-bottom: 6px" class="btn btn-block btn-lg btn-success">';
										echo '<strong>Registration complete. Goto <a href="' . get_home_url() . '">login page</a></strong>';
										echo '</div>';
									}
									else {
										wp_safe_redirect(get_home_url());
										exit;
									}
								}
								else {
									echo '<div style="margin-bottom: 6px" class="btn btn-block btn-lg btn-danger">';
										echo '<strong>' . $register_user->get_error_message() . '</strong>';
										echo '</div>';
									}
								}
							}

							function shortcode() {
								ob_start();
								if (isset($_POST['reg_submit'])) {
									$this->username		= $_POST['reg_nickname'];
									$this->email			= $_POST['reg_email'];
									$this->password		= $_POST['reg_password'];
									$this->password2	= $_POST['reg_password_2'];
									$this->nickname		= $_POST['reg_nickname'];

									$this->validation();
									$this->registration();
								}

								$this->registration_form();
								return ob_get_clean();
							}

							public function registration_form() {
								?>
								<form method="post" action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>">
									<div class="login-form">
										<div class="col-md-6">
											<input name="reg_nickname" type="text" class="form-control login-field"
											value="<?php echo(isset($_POST['reg_nickname']) ? $_POST['reg_nickname'] : null); ?>"
											placeholder="ΟΝΟΜΑ ΧΡΗΣΤΗ" id="reg-nickname" required/>
											<label class="login-field-icon fui-user" for="reg-name"></label>
										</div>

										<div class="col-md-6">
											<input name="reg_email" type="email" class="form-control login-field"
											value="<?php echo(isset($_POST['reg_email']) ? $_POST['reg_email'] : null); ?>"
											placeholder="ΤΟ EMAIL ΣΟΥ" id="reg-email" required/>
											<label class="login-field-icon fui-mail" for="reg-email"></label>
										</div>

										<div class="col-md-6">
											<input name="reg_password" type="password" class="form-control login-field"
											value="<?php echo(isset($_POST['reg_password']) ? $_POST['reg_password'] : null); ?>"
											placeholder="ΚΩΔΙΚΟΣ" id="reg-pass" required/>
											<label class="login-field-icon fui-lock" for="reg-pass"></label>
										</div>

										<div class="col-md-6">
											<input name="reg_password_2" type="password" class="form-control login-field"
											value="<?php echo(isset($_POST['reg_password_2']) ? $_POST['reg_password_2'] : null); ?>"
											placeholder="ΚΩΔΙΚΟΣ ΕΠΑΝΑΛΗΨΗ" id="reg-pass_2" required/>
											<label class="login-field-icon fui-lock" for="reg-pass_2"></label>
										</div>

										<input class="btn btn-primary btn-lg btn-block" type="submit" name="reg_submit" value="ΕΓΓΡΑΦΗ"/>
									</div>
								</form>
								<?php
							}
						}

						new BuyerRegistration;

						?>
