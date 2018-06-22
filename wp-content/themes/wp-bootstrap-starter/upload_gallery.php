<?php
/**
* Template Name: Upload Gallery
*/





  if(!get_current_user_id())
  {
    $response['status'] = 0;
    $response['message'] = "Error: Please select a valid file format";
    echo json_encode($response);
    wp_die();
  }



	$current_user = wp_get_current_user();
	$upload_dir   = wp_upload_dir();


	// Check if the form was submitted
	if($_SERVER["REQUEST_METHOD"] == "POST"){

		// Check if file was uploaded without errors

		if(is_array($_FILES)) {
			if(is_uploaded_file($_FILES['gallery_file']['tmp_name'])) {
				$sourcePath = $_FILES['gallery_file']['tmp_name'];


				$allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");

        $filename = $_FILES["gallery_file"]["name"];

        $filetype = $_FILES["gallery_file"]["type"];

        $filesize = $_FILES["gallery_file"]["size"];

				$ext = pathinfo($filename, PATHINFO_EXTENSION);

				if(!array_key_exists($ext, $allowed))
				{


					$response['status'] = 0;
					$response['message'] = "Error: Please select a valid file format";
					echo json_encode($response);
					wp_die();
				}


				        // Verify file size - 5MB maximum

				$maxsize = 1 * 1024 * 1024;

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



			$targetPath = $user_dirname."/".$_FILES['gallery_file']['name'];

			$filename_n = $_FILES['gallery_file']['name'];

			if ( file_exists( $targetPath ) ) {

				$filename_n = rand(1000,600000).$_FILES['gallery_file']['name'];

			 $targetPath = $user_dirname."/".$filename_n;
			}

				if(move_uploaded_file($sourcePath,$targetPath)) {

					$response['status'] = 1;
					$response['message'] = $targetPath;
					$response['image_url'] = "/wp-content/uploads/".$current_user->user_login."/".$filename_n;

					echo json_encode($response);
					wp_die();
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
