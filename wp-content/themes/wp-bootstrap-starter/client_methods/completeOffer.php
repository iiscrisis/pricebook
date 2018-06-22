<?php
//				sendNotificationMessage(false,get_current_user_id(),false,'Το αίτημα σας ανανεώθηκε και λήγει '.$newDate.'.');

add_action( 'wp_ajax_notifyUserOnComment', 'notifyUserOnComment' );
add_action( 'wp_ajax_nopriv_notifyUserOnComment', 'notifyUserOnComment' );

function notifyUserOnComment() {



	if (!isset($_POST) ||   !isset($_POST['user']) ||   !isset($_POST['comment']) ||   !isset($_POST['post_id'])) {

		$response['status'] = 1;
		$response['message'] = 'Error';
		echo json_encode($response);
		wp_die();

	 }
	 $sendEmail = 1;
	 if(isset($_POST['sendemail']))
	 {
		 	$sendEmail = intval($_POST['sendemail']);
	 }



	$seller = intval($_POST['user']);
	$post_id = intval($_POST['post_id']);
	$link =  get_permalink($post_id).'?seller='.get_current_user_id();

	$user_nickname  = get_field('seller_companyName',get_current_user_id());
	if($user_nickname == "")
	{   $user_info = get_userdata(get_current_user_id());
			$user_nickname = $user_info->nickname;
	}

	$text='Έχετε νέο μήνυμα στο αίτημα σας για <a href="'.$link.'">'.get_post($post_id)->post_title.'</a> από τον '.$user_nickname.' : '.sanitize_text_field($_POST['comment']);;
	//$text = 'Το αίτημα <a href="'.$link.'">'.get_post($post_id)->post_title.'</a> έχει νέο σχόλιο : <br/>'.sanitize_text_field($_POST['comment']);
	if($sendEmail == 1)
	{
		sendNotificationMessage(false,$seller,false, $text,$sendEmailFlag);
	}


	$response = array();
	$response['status'] = 1;
	$response['message'] = 'OK';
	echo json_encode($response);
	wp_die();
}



add_action( 'wp_ajax_notifySellerOnComment', 'notifySellerOnComment' );
add_action( 'wp_ajax_nopriv_notifySellerOnComment', 'notifySellerOnComment' );

function notifySellerOnComment() {



	if (!isset($_POST) ||   !isset($_POST['seller']) ||   !isset($_POST['comment']) ||   !isset($_POST['post_id'])) {

		$response['status'] = 1;
		$response['message'] = 'Error';
		echo json_encode($response);
		wp_die();

	 }



	$seller = intval($_POST['seller']);
	$post_id = intval($_POST['post_id']);
	$link =  get_permalink($post_id);

	$user_nickname  = get_field('seller_companyName',get_current_user_id());
	if($user_nickname == "")
	{   $user_info = get_userdata(get_current_user_id());
			$user_nickname = $user_info->nickname;
	}

	$text='Έχετε νέο μήνυμα στο αίτημα <a href="'.$link.'">'.get_post($post_id)->post_title.'</a> από τον '.$user_nickname.' : '.sanitize_text_field($_POST['comment']);;
	//$text = 'Το αίτημα <a href="'.$link.'">'.get_post($post_id)->post_title.'</a> έχει νέο σχόλιο : <br/>'.sanitize_text_field($_POST['comment']);

	sendNotificationMessage(false,$seller,false, $text);

	$response = array();
	$response['status'] = 1;
	$response['message'] = 'OK';
	echo json_encode($response);
	wp_die();
}


add_action( 'wp_ajax_markOfferComplete', 'markOfferComplete' );
add_action( 'wp_ajax_nopriv_markOfferComplete', 'markOfferComplete' );

function markOfferComplete() {

	if (!isset($_POST) || !isset($_POST['inquiryId']) || !isset($_POST['seller'])) { return false; }


	$id = $_POST['inquiryId'];
	$seller = $_POST['seller'];

	$result = completeOfferAction($id, $seller);


	echo json_encode($result);
	wp_die();

}

function completeOfferAction($id, $seller)
{


	//$rating = $_POST['rating'];
	$getRating=0;


	$offer_endDate =  date("Y-m-d H:i:s",strtotime(str_replace('/','-',get_field('inquiry_end_date',$id))));
	$offer_status = get_field('inquiry_status',$id);
	$today = date("Y-m-d H:i:s");

	$offers = getOffer($id,$seller);


	//getAllOffers($id)
	$sellerExists = false;
	$result['status'] = 0;
	$result['message'] = "";

	//check if inquiry status is incorrect
	if (!in_array($offer_status,array('active','waiting_approval','approved_waiting_rank'))) {

		$result['status'] = 1;
		$result['message'] = "Offer already marked complete";

		return $result;

	}

	//check if the seller really has placed an offer
	if (empty($offers) || (!empty($offers['pending'][0]) && $offers['pending'][0]['inquiry_seller']['ID'] != $seller)) {
		$sellerExists = false;
		$result['status'] = 1;
		$result['message'] = "Seller hasn't placed an offer";

		return $result;

	}



	//IF SELLER PLACED AN OFFER COMPLETE ACTION

	$sellerExists = true;
	$existingOffers = get_field('inquiry_offers',$id);
	$done = false;
	$len = 1;

	foreach ($existingOffers as $key => $val) {

		if ($val['inquiry_status'] == 'pending') {



			if (intval($val['inquiry_seller']['ID']) == intval($seller)) { //USER IS SUCCESSFULL SELLER

				//add seller's offer as succeeded & update inquiry's status
				if (update_sub_field(array('field_598537c81b335',$len,'field_598538221b337'),'succeeded', $id) && update_field('inquiry_status','complete',$id) && update_field('inquiry_completion_date',date('Y-m-d H:i:s'), $id)) {

					$result['message'] .= 'Η προσφορά ολοκληρώθηκε';
					//NOTIFY seller
					sendNotificationMessage(false,$val['inquiry_seller']['ID'],false,'Το αίτημα ολοκληρώθηκε και η προσφορά σας έγινε δεκτή.');

					//add seller to inquiry owner's sellerlist
					$userSellersList = get_field('user_sellerlist','user_'.get_current_user_id(),false);
					if (!is_array($userSellersList)) { $userSellersList = (array)$userSellersList; }
					//A
					$isSellerListed = false;
					if (!empty($userSellersList)) {
						foreach ($userSellersList as $sel) {
							if (intval($val['inquiry_seller']['ID']) == intval($sel)) {
								$isSellerListed = true;
								$result['message'] .= 'Χρηστης στην λίστα.';
								break;
							}
						}
					}




					if (!$isSellerListed) {
					//	$result['message'] = "1750 ";
						//$userSellersList = array($val['inquiry_seller']['ID']);
						array_push($userSellersList,intval($val['inquiry_seller']['ID']));

						if (!update_field('user_sellerlist',$userSellersList,'user_'.get_current_user_id())) {
							$result['status'] = 1;
							$result['message'] .= 'Δημιουργήθηκε σφάλμα κατά την εισαγωγή του πωλητή στην λίστα του χρήστη.';

						}else {
							$result['message'] .= 'Επιτυχής εισαγωγή του πωλητή στην λίστα του χρήστη.';
						}

					}



					//add user to seller's userlist
					$sellerUserList = get_field('seller_clientlist','user_'.$val['inquiry_seller']['ID'],false);
					if (!is_array($sellerUserList)) { $sellerUserList = (array)$sellerUserList; }

					$isUserListed = false;
					if (!empty($sellerUserList)) {
						foreach ($sellerUserList as $sel) {
							if (intval(get_current_user_id()) == intval($sel)) {
								$isUserListed = true;
								break;
							}
						}
					}

					if (!$isUserListed) {
					//	$sellerUserList = array(get_current_user_id());
						array_push($sellerUserList,intval(get_current_user_id()));
						if (!update_field('seller_clientlist', $sellerUserList, 'user_'.$val['inquiry_seller']['ID'] )) {
							$result['status'] = 1;
							$result['message'] .= 'Δημιουργήθηκε σφάλμα κατά την εισαγωγή του χρήστη στην λίστα του πωλητή.';

						}else {

								$result['message'] .= 'Επιτυχής εισαγωγή του χρήστη στην λίστα του πωλητή.';

						}
					}



					//UPDATE SELLERS SUCCESSFULL OFFERS
					$successful_orders = get_field('sellers_successful_offers','user_'.$seller,false);
					$newsuccesful_orders = array();
					if (!is_array($successful_orders)) { $successful_orders = (array)$successful_orders; }

					foreach($successful_orders as $succesful_order)
					{

						if(intval($succesful_order) != intval($id))
						{
							//$result['message'] .= 'error 1812 '.$succesful_order->post_title.' - '.$succesful_order->ID.'  ';
							array_push($newsuccesful_orders,$succesful_order);
						}
					}
					array_push($newsuccesful_orders,$id);
					//$result['status'] = 1;
					if (!update_field('sellers_successful_offers', $newsuccesful_orders, 'user_'.$seller )) {
						$result['status'] = 1;
						$result['message'] .= 'Δημιουργήθηκε σφάλμα κατα την ενημέρωση του πωλητή .';
					}

					//Move inquiry off sellers open offers
					remove_inquiry_from_open_seller($id,$seller);



					//Move inquiry to users completed_offers
					$user_successful_orders = get_field('user_successful_inquiries','user_'.get_current_user_id(),false);
					if((empty($user_successful_orders)))
					{
						$user_successful_orders= array();
					}
					$user_newsuccesful_orders = array();
					foreach($user_successful_orders as $user_successful_order)
					{

						if(intval($user_successful_order) != intval($id))
						{

							array_push($user_newsuccesful_orders,$user_successful_order);
						}
					}
					array_push($user_newsuccesful_orders,$id);

					if (!update_field('user_successful_inquiries', $user_newsuccesful_orders, 'user_'.get_current_user_id() )) {
						$result['status'] = 1;
						$result['message'] .= 'Δημιουργήθηκε σφάλμα κατά την μεταφορα στη λιστα ολοκληρωμενων για του χρηστη.';

					}

				}
				else {
					$result['status'] = 1;
					$result['message'] .= "Error when marking the offer. Please contact the admin";
					return $result;
				}
			}	else {
				$result['message'] .= ' -# USER '.$val['inquiry_seller']['ID'];

				$notSeller = $val['inquiry_seller']['ID'];
				remove_inquiry_from_open_seller($id,$notSeller);
				move_inquiry_to_closed_seller($id,$notSeller);
				if (!update_sub_field(array('field_598537c81b335',$len,'field_598538221b337'),'failed', $id)) {
					$result['status'] = 1;
					$result['message'] .= "Η προσφορά ολοκληρώθηκε αλλά δημιουργήθηκε σφάλμα κατά την αλλαγή των αποτυχημένων προσφορών.";
					return $result;
				}
				else {
					//notify user
					sendNotificationMessage(false,$val['inquiry_seller']['ID'],false,'Το αίτημα ολοκληρώθηκε αλλά δυστηχώς η προσφορά σας δεν έγινε δεκτή.');
				}
			}
			$len++;
		}
	}
	if($result['status'] == 1)
	{
		$result['message'] = 'Η προσφορά ΔΕΝ ολοκληρώθηκε Προβλημα .'.$result['message'];
	}else {
		$result['message'] .= 'Η προσφορά  ολοκληρώθηκε : '.$result['message'];;
	}

	return $result;

}





//remove from sellers open inquiry
function remove_inquiry_from_open_seller($id,$seller)
{
	$result['status'] = 1;
	$result['message'] = 'Η προσφορά ολοκληρώθηκε';
							//Move inquiry off sellers open offers
							$open_requests = get_field('sellers_open_requests','user_'.$seller,false);
							if (!is_array($open_requests)) { $open_requests = (array)$open_requests; }

							if(in_array($id,$open_requests))
							{


								$new_open = array();
								foreach($open_requests as $key => $request)
								{
										if (intval($request) == intval($id)) {
											continue;
										}else {
											//	$result['message'] .= 'error 1846 '.$request->post_title.' - '.$request->ID.'  ';
											array_push($new_open,$request);
										}
								}

								if (!update_field('sellers_open_requests', $new_open, 'user_'.$seller )) {
									$result['status'] = 0;
									$result['message'] = 'Η προσφορά ολοκληρώθηκε αλλά δημιουργήθηκε σφάλμα κατά την 1795.';

								}else {

								}


							}else {
								$result['status'] = 0;
								$result['message'] = 'Δεν βρισκόταν στην λιστα των ανοιχτων για επαγγελματια.';
							}

							return $result;
}

add_action( 'wp_ajax_generatePurchaseCert', 'generatePurchaseCert' );
add_action( 'wp_ajax_nopriv_generatePurchaseCert', 'generatePurchaseCert' );
function generatePurchaseCert() {

		require('tcpdf/tcpdf_import.php');
		class MYPDF extends TCPDF {

			//Page header
	     public function Header() {
	         // Logo
	         $image_file = K_PATH_IMAGES.'logo_small.png';
	         $this->Image($image_file, 15, 10, 20, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
	         // Set font
	         $this->SetFont('dejavusans', 'B', 8);
	         // Title
	         $this->Cell(0, 15, $title, 0, false, 'C', 0, '', 0, false, 'M', 'M');
	     }
		    // Page footer
		    public function Footer() {
		        // Position at 15 mm from bottom
		        $this->SetY(-15);
		        // Set font
		        $this->SetFont('helvetica', 'I', 8);
		        // Page number
		        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
		    }
		}

	$inquiryId = $_POST['inquiryId'];
	//$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	$pdf->SetCreator('Pricebook');
	$pdf->SetAuthor('Pricebook');
	$pdf->SetTitle('Πιστοποιητικό Έρευνας Αγοράς');
	$pdf->SetSubject('Πιστοποιητικό Έρευνας Αγοράς');
	$pdf->SetKeywords('');
	$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
	$pdf->setFooterData(array(0,64,0), array(0,64,128));
	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);


// remove default header/footer
	$pdf->setPrintHeader(false);
	$pdf->setPrintFooter(false);

	// set image scale factor
	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
	$pdf->setFontSubsetting(true);
	$pdf->SetFont('freesans', '', 10, '', true);
	//$pdf->SetFont(‘times’, ‘BI’, 20, “, ‘false’);
	$pdf->AddPage();

	$pdf->setTextShadow(array('enabled'=>false, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
	//echo K_PATH_IMAGES;
	$pdf->Image(K_PATH_IMAGES.'logo.png', 50, 40, 100, '', '', '', '', false, 300);



	// print a block of text using Write()
	//$pdf->writeHTML($title, true, true, true, false, '');
	//$pdf->Image('../..//images/logo.png', 50, 50, 100, '', '', '', '', false, 300);
	$pdf->Image(K_PATH_IMAGES.'cert.png', 80, 110, 40, '', '', '', '', true, 300);
	// remove default header/footer
		$pdf->setPrintHeader(true);
		$pdf->setPrintFooter(true);
	$pdf->AddPage();




	$offers = getAllOffers($inquiryId);
	$status = get_field('inquiry_status',$inquiryId);
	$totalOffersCount = 0;
	if($status == "complete")
	{
		$completed = "<h3>Ολοκληρωμένη Προσφορά</h3>";//get_field('inquiry_completion_date',$inquiryId);
		$certificateTitle = "Πιστοποιητικό Έρευνας Αγοράς";
		$totalOffersCount = (sizeof($offers['succeeded'])+sizeof($offers['failed']));
	}else {
		$completed = " Η έρευνα αγοράς δεν έχει ολοκληρωθεί - Δεν έχετε αποδεχτεί καμία προσφορά";
		$certificateTitle = "Πιστοποιητικό Έρευνας Αγοράς";
		$totalOffersCount = (sizeof($offers['pending'])+sizeof($offers['interesting'])+sizeof($offers['best']));
	}




		$templateHead  ="<h1>".get_post($inquiryId)->post_title." ( ref : ".$inquiryId.")</h1>";
		$pdf->SetTextColor(0,155, 214);
	//	$html = $templateHead;
		$pdf->writeHTML($templateHead, true, false, true, false, '');

		//$templateHead = "";//file_get_contents(dirname(__FILE__).'/template-parts/purchaseCertificateHeader.php');
		get_pdf_general_data($certificateTitle,$totalOffersCount,$completed,$inquiryId,$pdf);

		$templateGeneral =	 "";





		$templateList="";
		$templateBestOffer = "";
		$templateInterestingOffers="";
		$templatePendingOffers="";

		if($status != 'complete')
		{
			if (!empty($offers['best']) ) {


					$pdf->SetTextColor(0,155, 214);
				//	$html = $templateHead;
					$pdf->writeHTML("<h2>Καλύτερη Προσφορά</h2>", true, false, true, false, '');
					$pdf->SetTextColor(99,99,99);
					$templateList = certificateOffersRow($offers['best'],$templateOfferRow);
					$pdf->writeHTML($templateList, true, false, true, false, '');
			}

			if (!empty($offers['interesting']) ) {


									$pdf->SetTextColor(0,155, 214);
								//	$html = $templateHead;
									$pdf->writeHTML("<h2>Ενδιαφέρουσες Προσφορές</h2>", true, false, true, false, '');
									$pdf->SetTextColor(99,99,99);
									$templateList = certificateOffersRow($offers['interesting'],$templateOfferRow);
									$pdf->writeHTML($templateList, true, false, true, false, '');
				//	$templateList.= "<h2>Ενδιαφέρουσες Προσφορές</h2>".certificateOffersRow($offers['interesting'],$templateOfferRow);

			}


			if (!empty($offers['pending']) ) {
				$pdf->SetTextColor(0,155, 214);
			//	$html = $templateHead;
				$pdf->writeHTML("<h2>Λοιπές Προσφορές</h2>", true, false, true, false, '');
				$pdf->SetTextColor(99,99,99);
				$templateList = certificateOffersRow($offers['pending'],$templateOfferRow);
				$pdf->writeHTML($templateList, true, false, true, false, '');
				//	$templateList .="<h2>Λοιπές Προσφορές</h2>". certificateOffersRow($offers['pending'],$templateOfferRow);

			}

		}else {
			# code...
			if (!empty($offers['succeeded']) ) {

				//	$templateList .="<h2>Aγορά Από</h2>". certificateOffersRow($offers['succeeded'],$templateOfferRow);

					$pdf->SetTextColor(0,155, 214);
				//	$html = $templateHead;
					$pdf->writeHTML("<h2>Aγορά Από</h2>", true, false, true, false, '');
					$pdf->SetTextColor(99,99,99);
					$templateList = certificateOffersRow($offers['succeeded'],$templateOfferRow);
					$pdf->writeHTML($templateList, true, false, true, false, '');

			}

			if (!empty($offers['failed']) ) {

				$pdf->SetTextColor(0,155, 214);
			//	$html = $templateHead;
				$pdf->writeHTML("<h2>Λοιπές Προσφορές</h2>", true, false, true, false, '');
				$pdf->SetTextColor(99,99,99);
				$templateList = certificateOffersRow($offers['failed'],$templateOfferRow);
				$pdf->writeHTML($templateList, true, false, true, false, '');

				//	$templateList .= "<h2>Λοιπές Προσφορές</h2>".certificateOffersRow($offers['failed'],$templateOfferRow);

			}
		}




		$templateChats="";


		$template = "";$templateList;////.$templateChats.$templateFooter;


		$pdf->writeHTML($template, true, false, true, false, '');

		// TODO: ADD FAILED OFFERS HERE
		$pdffile = '/certificates/purchaseCert_S'.rand().$inquiryId.'B'.get_current_user_id().'.pdf';




		//dirname(__FILE__)
		$file =  get_home_path().$pdffile;

		ob_clean();

		$pdf_res = $pdf->Output($file,'F');

		ob_end_clean();



		$result = array();
		$result['status'] = 0;
		$result['message_container'] = $template;
		$result['message'] = get_home_url().$pdffile;
		echo json_encode($result);
		wp_die();

}


function certificateOffersRow($offers,$templateOfferRow)
{
		$template = "";

		foreach($offers as $offer)
		{
			$templatetempRow = $templateOfferRow;
			$sellerAvatar =  get_avatar($offer['inquiry_seller']['ID']);
			$sellerName = get_field('seller_companyName','user_'.$offer['inquiry_seller']['ID']);
			$lastOffer =   date('d-m-Y', strtotime($offer['inquiry_seller_actiondate']));
			$priceUnit = isset($offer['inquiry_seller_unit_cost']) ? $offer['inquiry_seller_unit_cost'] : NULL;
			$quantity = isset($offer['inquiry_seller_quantity']) ? $offer['inquiry_seller_quantity'] : NULL;
			$shippingCost = isset($offer['inquiry_seller_delivery_cost']) ? $offer['inquiry_seller_delivery_cost'] : NULL;
			$upfrontPay = isset($offer['inquiry_seller_cashondelivery_cost']) ? $offer['inquiry_seller_cashondelivery_cost'] : NULL;
			$lastAnswer = "";

			if ($isService) { $offer['inquiry_seller_quantity'] = 1; }
			$total = (number_format((float)$offer['inquiry_seller_delivery_cost'], 2, '.', '') + number_format((float)$offer['inquiry_seller_quantity'], 2, '.', '') * number_format((float)$offer['inquiry_seller_unit_cost'], 2, '.', ''));
			$total += number_format((float)$offer['inquiry_seller_cashondelivery_cost'], 2, '.', '') ;
			$totalPrice = '€'.$total;

			if(isset($offer['inquiry_seller_lastmessage']) )
			{
				if($offer['inquiry_seller_lastmessage'] !="")
				{
					$lastAnswer= $offer['inquiry_seller_lastmessage'];// date('d-m-Y', strtotime($offer['inquiry_seller_lastmessage']));
				}
			}

			$sellerRating = "";
			//get rating
			$user = 'user_'.$offer['inquiry_seller']['ID'];
			$totalrating = $newRating = get_field('seller_rank_1',$user) ;
			$newRating_numbers = get_field('seller_rank_2',$user) ;

			if($newRating_numbers >= 1)
			{
				$rating = $totalrating/$newRating_numbers;


				$rating = round($rating,1);
				$wholeIntegers = floor($rating);
				$decimal = $rating - $wholeIntegers;
				$counter = 0;
				for($i=0;$i<$wholeIntegers;$i++)
				{  $counter++;

					$sellerRating .= '<div class="seller-rating circle yellow active"></div>';

				}

				if($decimal>0.2 && $decimal <0.7)
				{$counter++;

					$sellerRating .='<div class="seller-rating  yellow active halfcircle"></div>';

				}else if($decimal >= 0.7)
				{$counter++;


					$sellerRating .=' <div class="seller-rating circle yellow active"></div>';

				}


				for($i=$counter;$i<5;$i++)
				{

					$sellerRating .='<div class="seller-rating circle white5"></div>';

				}

			} // end rating if


		//	$templatetempRow = "<h2></h2>$selleravatar></div>";// str_replace('@selleravatar',$selleravatar,$templatetempRow);
			$templatetempRow ="<p><h2>$sellerName</h2>" ;
			$templatetempRow .= "<div><strong>Tελευταία Προσφορά : </strong>$lastOffer</div>";
			$templatetempRow .= "<div><strong>Tελευταία Απάντηση :</strong> $lastAnswer</div>";
			$templatetempRow .= "<div><strong>Τιμή Μονάδος : </strong>$priceUnit</div>" ;
			$templatetempRow .= "<div><strong>Μεταφορικά : </strong>$shippingCost </div>"  ;
			$templatetempRow .= "<div><strong>Aντικαταβολή : </strong> $upfrontPay </div>";
			$templatetempRow .="<div><strong>Σύνολο : </strong>$totalPrice</div></p> <hr>" ;



			$template.=$templatetempRow;
		}


		return $template;
}

function get_pdf_general_data($certificateTitle,$totalOffersCount,$completed,$inquiryId,&$pdf)
{


	$pdf->SetTextColor(0,155, 214);
	$html = "<h6>$completed</h6>";
	$pdf->writeHTML($html, true, false, true, false, '');
	$pdf->SetTextColor(99,99, 99);
	$html = "<h4>Ημερομηνία υποβολής αιτήματος προσφοράς : ".get_field('inquiry_start_date',$inquiryId)."</h4>";
 	$html .= "<h4>Το αίτημα υποβλήθηκε από τον χρήστη : ".get_user_by('ID',get_post($inquiryId)->post_author)->nickname."</h4>";
	$html .= "<h6>Ημερομηνία εκτύπωσης πιστοποιητικού :". date('d/m/Y')."</h6>";
	$pdf->writeHTML($html, true, false, true, false, '');

	$qty = get_field('inquiry_product_quantities',$inquiryId);
	$max = get_field('inquiry_max_price',$inquiryId);
	$min = get_field('inquiry_min_price',$inquiryId);
	$areas = get_field('inquiry_areas',$inquiryId);

	$min = $min !="" ? $min." - " : "";


		$pdf->SetTextColor(0,155, 214);
			$html ="<br/><h2>Αίτημα</h2>";
		$pdf->writeHTML($html, true, false, true, false, '');

		$pdf->SetTextColor(99,99, 99);
		$html ="<p><div><strong>Ποσότητα :</strong>$qty</div>";
		$html .="<div><strong>Περιοχή :</strong>".get_post($areas[0])->post_title."</div>";
		$html .="<div><strong>Τιμη :</strong>$min $max</div></p><hr />";

		$pdf->writeHTML($html, true, false, true, false, '');

	//return $html;
}



?>
