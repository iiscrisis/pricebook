<?php
	date_default_timezone_set('Europe/Athens');

	/**
	 * WP Bootstrap Starter functions and definitions
	 *
	 * @link https://developer.wordpress.org/themes/basics/theme-functions/
	 *
	 * @package WP_Bootstrap_Starter
	 */

	 require(get_template_directory().'/includes/libraries/smart_resize_image.function.php');
	 require(get_template_directory().'/includes/recaptcha-master/src/autoload.php');
	 require(get_template_directory().'/pb_functions.php');
	 require(get_template_directory().'/methods/offer_methods.php');
	 require(get_template_directory().'/client_methods/addInquiry.php');
	 require(get_template_directory().'/front_methods/front_ajax.php');
	 require(get_template_directory().'/client_methods/completeOffer.php');
	require(get_template_directory().'/seller_methods/blacklist_clientlist_seller.php');
	require(get_template_directory().'/seller_methods/seller_settings.php');
	add_filter('show_admin_bar', '__return_false');
	if ( ! function_exists('wp_bootstrap_starter_setup')):
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function wp_bootstrap_starter_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on WP Bootstrap Starter, use a find and replace
		 * to change 'wp-bootstrap-starter' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'wp-bootstrap-starter', get_template_directory().'/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'wp-bootstrap-starter' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'wp_bootstrap_starter_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

	    function wp_boostrap_starter_add_editor_styles() {
	        add_editor_style( 'custom-editor-style.css' );
	    }
	    add_action( 'admin_init', 'wp_boostrap_starter_add_editor_styles' );

	}
	endif;
	//add_action( 'after_setup_theme', 'wp_bootstrap_starter_setup' );
	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet.
	 *
	 * Priority 0 to make it available to lower priority callbacks.
	 *
	 * @global int $content_width
	 */
	function wp_bootstrap_starter_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'wp_bootstrap_starter_content_width', 1170 );
	}
	add_action( 'after_setup_theme', 'wp_bootstrap_starter_content_width', 0 );
	/**
	 * Register widget area.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
	 */
	function wp_bootstrap_starter_widgets_init() {
		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar', 'wp-bootstrap-starter' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'wp-bootstrap-starter' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
	    register_sidebar( array(
	        'name'          => esc_html__( 'Footer 1', 'wp-bootstrap-starter' ),
	        'id'            => 'footer-1',
	        'description'   => esc_html__( 'Add widgets here.', 'wp-bootstrap-starter' ),
	        'before_widget' => '<section id="%1$s" class="widget %2$s">',
	        'after_widget'  => '</section>',
	        'before_title'  => '<h3 class="widget-title">',
	        'after_title'   => '</h3>',
	    ) );
	    register_sidebar( array(
	        'name'          => esc_html__( 'Footer 2', 'wp-bootstrap-starter' ),
	        'id'            => 'footer-2',
	        'description'   => esc_html__( 'Add widgets here.', 'wp-bootstrap-starter' ),
	        'before_widget' => '<section id="%1$s" class="widget %2$s">',
	        'after_widget'  => '</section>',
	        'before_title'  => '<h3 class="widget-title">',
	        'after_title'   => '</h3>',
	    ) );
	    register_sidebar( array(
	        'name'          => esc_html__( 'Footer 3', 'wp-bootstrap-starter' ),
	        'id'            => 'footer-3',
	        'description'   => esc_html__( 'Add widgets here.', 'wp-bootstrap-starter' ),
	        'before_widget' => '<section id="%1$s" class="widget %2$s">',
	        'after_widget'  => '</section>',
	        'before_title'  => '<h3 class="widget-title">',
	        'after_title'   => '</h3>',
	    ) );
	}
	add_action( 'widgets_init', 'wp_bootstrap_starter_widgets_init' );
	/**
	 * Enqueue scripts and styles.
	 */
	function wp_bootstrap_starter_scripts() {

		//Loaded by  YaNo

		wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/lib/bootstrap.min.css' );
		wp_enqueue_style( 'normalize-css', get_template_directory_uri() . '/lib/normalize.css' );
		wp_enqueue_style( 'checkboxes-css', get_template_directory_uri() . '/lib/checkboxes.min.css' );
		wp_enqueue_style( 'awesomplete-css','http://pricebook.gr/assets/css/awesomplete.base.css' );
		wp_enqueue_style( 'searchbar-css','http://pricebook.gr/assets/css/searchbar.css' );
		wp_enqueue_style( 'wp-bootstrap-starter-bootstrap-css', get_template_directory_uri() . '/css/general.css' );
		wp_enqueue_style( 'mCustomScrollbar-css', get_template_directory_uri() . '/lib/jquery.mCustomScrollbar.min.css' );
		wp_enqueue_style( 'dashboard-css', get_template_directory_uri() . '/css/dashboard.css' );
		wp_enqueue_style( 'dropzone-css', get_template_directory_uri() . '/lib/dropzone.css' );
		wp_enqueue_style( 'labelauty-css', get_template_directory_uri() . '/lib/labelbeauty/jquery-labelauty.css' );
		wp_enqueue_style( 'menu-css', get_template_directory_uri() . '/css/menu.css' );
		wp_enqueue_style( 'selectize-css', get_template_directory_uri() . '/lib/selectize.js-master/dist/css/selectize.css' );
		wp_enqueue_style( 'pretty-checkbox-css', get_template_directory_uri() . '/css/pretty-checkbox.min.css' );
		wp_enqueue_style( 'wenk-css', get_template_directory_uri() . '/lib/wenk/wenk.min.css' );
		wp_enqueue_style( 'style-css', get_template_directory_uri() . '/css/style.css' );
		wp_enqueue_style( 'custom-select-css', get_template_directory_uri() . '/css/custom-select.css' );
		wp_enqueue_style( 'greycolors-css', get_template_directory_uri() . '/css/greycolors.css' );
		wp_enqueue_style( 'theme_0-css', get_template_directory_uri() . '/css/theme_0.css' );

		wp_enqueue_style( 'responsive-css', get_template_directory_uri() . '/css/responsive.css' );


		//End loaded by Yano

		// load bootstrap css
		//wp_enqueue_style( 'wp-bootstrap-starter-bootstrap-css', get_template_directory_uri() . '/css/bootstrap.min.css' );
		wp_enqueue_style( 'jquery-ui-css', 'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css' );
		wp_enqueue_style( 'chosen-ui-css', get_template_directory_uri() . '/css/chosen.min.css' );
		// load bootstrap css
		//wp_enqueue_style( 'wp-bootstrap-starter-font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', false, '4.1.0' );
		// load AItheme styles
		// load WP Bootstrap Starter styles
		wp_enqueue_style( 'wp-bootstrap-starter-style', get_template_directory_uri().'/style.css?v'.date('dmYHs'));


		  // Internet Explorer HTML5 support
		  wp_enqueue_script( 'html5hiv',get_template_directory_uri().'/js/html5.js', array(), '3.7.0', false );
		  wp_script_add_data( 'html5hiv', 'conditional', 'lt IE 9' );

			// load bootstrap js
		  wp_enqueue_script('wp-bootstrap-starter-tether', get_template_directory_uri() . '/js/tether.min.js', array() );
		//	wp_enqueue_script('wp-bootstrap-starter-bootstrapjs', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array() );
		//  wp_enqueue_script('wp-bootstrap-starter-themejs', get_template_directory_uri() . '/js/theme-script.js', array() );
			wp_enqueue_script('wp-bootstrap-starter-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
			wp_enqueue_script('jquery-ui', 'https://code.jquery.com/ui/1.12.1/jquery-ui.js', array('jquery') );
			wp_enqueue_script('jquery-ui-el', get_template_directory_uri() . '/js/jquery.ui.datepicker-el.js');

			wp_enqueue_script('jquery','https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js');
			wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/lib/bootstrap.min.js' );
			wp_enqueue_script( 'dropzone-js', get_template_directory_uri() . '/lib/dropzone.js' );
			//wp_enqueue_script( 'chosen-ui-js', get_template_directory_uri() . '/js/chosen.jquery.min.js' );
			wp_enqueue_script( 'masonry-ui-js', get_template_directory_uri() . '/lib/masonry.pkgd.min.js' );
				wp_enqueue_script( 'selectize-js', get_template_directory_uri() . '/lib/selectize.js-master/dist/js/standalone/selectize.min.js' );
				wp_enqueue_script( 'labelauty-js', get_template_directory_uri() . '/lib/labelbeauty/jquery-labelauty.js' );
			wp_enqueue_script( 'waypoints-ui-js', get_template_directory_uri() . '/lib/jquery.waypoints.min.js' );
			wp_enqueue_script( 'TweenMax-js', get_template_directory_uri() . '/lib/greensock-js/src/minified/TweenMax.min.js' );
			wp_enqueue_script( 'TimelineMax-js', get_template_directory_uri() . '/lib/greensock-js/src/minified/TimelineMax.min.js' );
			wp_enqueue_script( 'validator-js',  get_template_directory_uri() . '/lib/validator.js' );
			wp_enqueue_script( 'zxcvbn-js',  get_template_directory_uri() . '/lib/zxcvbn.js' );
			wp_enqueue_script( 'custom_select-js',  get_template_directory_uri() . '/lib/custom_select.js' );
			wp_enqueue_script( 'Sortable-js', "//rubaxa.github.io/Sortable/Sortable.js" );
			wp_enqueue_script( 'imagesloaded-js', get_template_directory_uri() . '/lib/imagesloaded.pkgd.min.js' );
			wp_enqueue_script( 'mCustomScrollbar-ui-js', get_template_directory_uri() . '/lib/jquery.mCustomScrollbar.concat.min.js' );
			//  <script src="assets/js/awesomplete.min.js"></script>
			wp_enqueue_script( 'awesomplete-js','http://pricebook.gr/assets/js/awesomplete.min.js' );
			wp_enqueue_script( 'appmap-js', get_template_directory_uri() . '/js/appmap.js' );
			wp_enqueue_script( 'offer_actions-js', get_template_directory_uri() . '/js/offer_actions.js' );
			wp_enqueue_script( 'script-js', get_template_directory_uri() . '/js/script.js' );










		if (is_user_logged_in() && is_buyer()) {
			wp_enqueue_script('buyerActions', get_template_directory_uri() . '/js/buyer.actions.js?'.date('dmYHs'), array() );
		}
		if (is_user_logged_in() && is_seller()) {
			wp_enqueue_script('sellerActions', get_template_directory_uri() . '/js/seller.actions.js', array() );
		}
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
	add_action( 'wp_enqueue_scripts', 'wp_bootstrap_starter_scripts' );
	/**
	 * Implement the Custom Header feature.
	 */
	require get_template_directory() . '/inc/custom-header.php';
	/**
	 * Custom template tags for this theme.
	 */
	require get_template_directory() . '/inc/template-tags.php';
	/**
	 * Custom functions that act independently of the theme templates.
	 */
	require get_template_directory() . '/inc/extras.php';
	/**
	 * Customizer additions.
	 */
	require get_template_directory() . '/inc/customizer.php';
	/**
	 * Load plugin compatibility file.
	 */
	require get_template_directory() . '/inc/plugin-compatibility/plugin-compatibility.php';
	/**
	 * Load pricebook common functions.
	 */
	require get_template_directory() . '/pb_common_functions.php';
	if ( ! class_exists( 'wp_bootstrap_navwalker' )) {
	    require_once(get_template_directory() . '/inc/wp_bootstrap_navwalker.php');
	}
