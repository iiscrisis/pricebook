<?php
/*define("SERVICE", "2742", true);
define("HOTEL", "1719", true);
define("PRODUCT", "1718", true);*/
add_action( 'wp_ajax_checklogged', 'checklogged' );
add_action( 'wp_ajax_nopriv_checklogged', 'checklogged' );

function checklogged() {

	$response = array();
	$response['status'] = get_current_user_id() ;

	echo json_encode($response);
	wp_die();

}


add_action( 'wp_ajax_checkLink', 'checkLink' );
add_action( 'wp_ajax_nopriv_checkLink', 'checkLink' );

function checkLink() {

	$response = array();

		if(isset($_POST['cat_id']))
		{
			$parent_id = intval($_POST['cat_id']);
		}else {
			$response['status'] = 0;
			$response['message'] = "error";

				echo json_encode($response);
			wp_die();
		}

		$children =  get_posts( array( 'numberposts' => -1, 'post_status' => 'publish', 'post_type' => 'product_category', 'post_parent' => $parent_id, 'suppress_filters' => false ));

		if(sizeof($children)>0)
		{
			$response['status'] = 3;
			$response['message'] = "";

		}else {


				if(get_current_user_id())
				{
					$response['status'] = 1;
					$response['message'] = "";


				}else {
					$response['status'] = 2;
					$response['message'] = "";
				}

		}

		echo json_encode($response);
		wp_die();

}


add_action( 'wp_ajax_getThesaurus', 'getThesaurus' );
add_action( 'wp_ajax_nopriv_getThesaurus', 'getThesaurus' );

function getThesaurus() {

	$response = array();

	$entries = array();

	$cats_posts = get_posts( array( 'numberposts' => -1, 'post_status' => 'publish', 'post_type' => 'product_category', 'suppress_filters' => false ));
	foreach ($cats_posts as $key => $spost) {
		# code...
		$entry = array();
		$entry['label'] = $spost->post_title;
		$entry['value'] = $spost->ID;

		array_push($entries,$entry);
	}



	$response['status'] = 0;
	$response['message'] = $entries;
	echo json_encode($response);
	wp_die();

}





add_action( 'wp_ajax_getFrontCategories', 'getFrontCategories' );
add_action( 'wp_ajax_nopriv_getFrontCategories', 'getFrontCategories' );

function getFrontCategories() {

	$response = array();

  $products = getCategory(PRODUCT);
  $services = getCategory(SERVICE);
  $hotels = getCategory(HOTEL);

  $response['status'] = 0;
	$response['message']['products'] = $products;
  $response['message']['services'] = $services;
  $response['message']['hotels'] = $hotels;
	echo json_encode($response);
	wp_die();

}

function getCategory($p_id)
{
  $cats = array();

  $cats_posts = get_posts( array( 'numberposts' => -1, 'post_status' => 'publish', 'post_type' => 'product_category', 'post_parent' => $p_id, 'suppress_filters' => false,'orderby' => 'menu_order', ));

  foreach ($cats_posts as $key => $spost) {
    # code...
    $cat = array();
    $cat['title'] = $spost->post_title;
    $cat['img'] =   get_the_post_thumbnail( $post = $spost->ID, $size = 'post-thumbnail', $attr = '' ) ;
    $cat['ID'] =    $spost->ID ;
    $cat['pagination'] = createPagination($spost->ID,2);
    $cat['subtitle'] = $spost->post_content;
    array_push($cats,$cat);
  }

  return $cats;
}

add_action( 'wp_ajax_getAllSubCats', 'getAllSubCats' );
add_action( 'wp_ajax_nopriv_getAllSubCats', 'getAllSubCats' );
function getAllSubCats()
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

  $children = get_posts_children($parent_id ,'product_category');

  $cats = array();

	foreach ($children as $key => $spost) {
		$parent_ar =  get_posts( array( 'numberposts' => -1, 'post_status' => 'publish', 'post_type' => 'product_category', 'post_parent' => $spost->ID, 'suppress_filters' => false ));
		if(sizeof($parent_ar) > 0)
		{
			continue;
		}
    $cat = array();
    $cat['title'] = $spost->post_title;//. " ".sizeof($parent_ar);
    $cat['img'] =   get_the_post_thumbnail_url( $post = $spost->ID, $size = 'large', $attr = '' ) ;
    $cat['ID'] =    $spost->ID ;
		$cat['parent'] = sizeof($parent_ar);
    $cat['pagination'] = createPagination($spost,1,'blue');
    $cat['subtitle'] = $spost->post_content;
    array_push($cats,$cat);
  }

  $response['status'] = 1;
  $response['message'] = $cats;
  echo json_encode($response);
  wp_die();


}

function get_posts_final_children($parent_id ,$post_type){
    $children = array();
    // grab the posts children
    $posts = get_posts( array( 'numberposts' => -1, 'post_status' => 'publish', 'post_type' => $post_type, 'post_parent' => $parent_id, 'suppress_filters' => false ));
    // now grab the grand children
    foreach( $posts as $child ){
        // recursion!! hurrah
        $gchildren = get_posts_final_children($child->ID,$post_type);
        // merge the grand children into the children array
        if( !empty($gchildren) ) {
            $children = array_merge($children, $gchildren);
        }
    }
    // merge in the direct descendants we found earlier
    $children = array_merge($children,$posts);
    return $children;
}



add_action( 'wp_ajax_getAllCatChildren', 'getAllCatChildren' );
add_action( 'wp_ajax_nopriv_getAllCatChildren', 'getAllCatChildren' );
function getAllCatChildren()
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

	 getAllChildren($parent_id,'product_category');

}

function getAllChildren($parent_id,$post_type)
{

	$children = get_posts_children($parent_id ,$post_type);

	$allChildren = getAllChildrenCreateJSON($children);

	$response['status'] = 1;
	$response['message'] = $parent_id;//json_encode($allChildren) 	;
	$response['children'] = $allChildren;
	echo json_encode($response);
	wp_die();

}

function getAllChildrenCreateJSON($children)
{
	$allChildren= array();
	foreach($children as $child)
	{
		if(has_children($child))
		{
			continue;
		}

		$post_id = $child->ID;
		$post_parent = $child->post_parent;
		$post_parent_title = get_post($child->post_parent)->post_title;
		$post_title =  $child->post_title;

		$single_child['post_id'] = $post_id ;
		$single_child['post_parent'] = $post_parent ;
		$single_child['post_parent_title'] = $post_parent_title ;
		$single_child['post_title'] = $post_title ;

		 $schild['child'] = $single_child;

		array_push($allChildren,$schild);
	}
	return $allChildren;
}


	function get_posts_children($parent_id ,$post_type){
	    $children = array();
	    // grab the posts children
	    $posts = get_posts( array( 'numberposts' => -1, 'post_status' => 'publish', 'post_type' => $post_type, 'post_parent' => $parent_id, 'suppress_filters' => false ));
	    // now grab the grand children
	    foreach( $posts as $child ){
	        // recursion!! hurrah
	        $gchildren = get_posts_children($child->ID,$post_type);
	        // merge the grand children into the children array
	        if( !empty($gchildren) ) {
	            $children = array_merge($children, $gchildren);
	        }
	    }
	    // merge in the direct descendants we found earlier
	    $children = array_merge($children,$posts);
	    return $children;
	}




	add_action( 'wp_ajax_getSingleCategory', 'getSingleCategory' );
	add_action( 'wp_ajax_nopriv_getSingleCategory', 'getSingleCategory' );

	function getSingleCategory() {

			$response = array();

		if(isset($_POST['cat']))
		{
			$parent_id = intval($_POST['cat']);
		}else {
			$response['status'] = 0;
		 	$response['message'] = "error";

		 		echo json_encode($response);
		 	wp_die();
		}


		$parent_cat = get_post($parent_id);
		$category= array();
		$category['title']= $parent_cat->post_title;
		$category['subtitle'] = $parent_cat->content;


		$children =  get_posts( array( 'numberposts' => -1, 'post_status' => 'publish', 'post_type' => 'product_category', 'post_parent' => $parent_id, 'suppress_filters' => false, 'orderby'=>'menu_order' ));

		$cats = array();

		foreach ($children as $key => $spost) {

			$parent_ar =  get_posts( array( 'numberposts' => -1, 'post_status' => 'publish', 'post_type' => 'product_category', 'post_parent' => $spost->ID, 'suppress_filters' => false ));

			$cat = array();
			$cat['title'] = $spost->post_title;//. "  > ".sizeof($parent_ar);
			$cat['img'] =   get_the_post_thumbnail_url( $post = $spost->ID, $size = 'large', $attr = '' ) ;
			$cat['ID'] =    $spost->ID ;

			$cat['parent'] = sizeof($parent_ar);
			if( sizeof($parent_ar) > 0)
			{
				$child_str = "";
				$k=0;;
				foreach($parent_ar as $par)
				{
					$k++;
					if($k==3 )
					{
						if($k < sizeof($parent_ar))
						{
								$child_str .="...";
						}
						break;
					}else if($k> 1)
					{
							$child_str .=", ".$par->post_title;
					}else {
							$child_str .=$par->post_title;
					}



				}

					$cat['parent']  = $child_str;

			}

			$cat['subtitle'] = $spost->post_content;
			array_push($cats,$cat);
		}


	  $response['status'] = 1;
		$response['message']['pagination'] = createPagination($parent_cat,3,'blue');
		$response['message']['category'] = $category;
	  $response['message']['children'] = $cats;

		echo json_encode($response);
		wp_die();

	}




?>
