<?php

	if (!function_exists('m413_options')) {
		// Admin functions
		require_once(get_template_directory() . '/admin/admin-functions.php');
		require_once(get_template_directory() . '/admin/admin-interface.php');
		require_once(get_template_directory() . '/admin/theme-settings.php');
		require_once(get_template_directory() . '/admin/admin-custom-functions.php');
	}

	if ( ! class_exists( 'cmb_Meta_Box' ) ) {
		// register metaboxes
		require_once(get_template_directory() . '/functions/post-metabox.php');
		require_once(get_template_directory() . '/functions/page-metabox.php');
	}

	//add shortcodes functions
	require_once(get_template_directory() . '/functions/shortcodes.php');

	if(!class_exists('AQ_Page_Builder')) {
		//Register Aqua Page Builder 
		require_once(get_template_directory() . '/functions/aqua-page-builder/aq-page-builder.php');
	}

	if ( class_exists( 'MarketPress' ) ) {
		//Register MarketPress related functions
		require_once(get_template_directory() . '/functions/mp-functions.php');
		require_once(get_template_directory() . '/functions/mp-metabox.php');
		require_once(get_template_directory() . '/functions/mp-widgets.php');
	}

	// Register Custom Navigation Walker
	require_once(get_template_directory() . '/functions/twitter_bootstrap_nav_walker.php');

	// register CSS 
	function mpt_register_style() {
		wp_enqueue_style('prettyphoto-style', get_template_directory_uri() . '/css/prettyPhoto.css', null, null);
	}
	add_action('wp_enqueue_scripts', 'mpt_register_style');

	// register JS
	function mpt_register_js(){
		wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.js', array('jquery'));
		wp_enqueue_script('filterablejs', get_template_directory_uri() . '/js/filterable.js', array('jquery'));
		wp_enqueue_script('prettyphotojs', get_template_directory_uri() . '/js/jquery.prettyPhoto.js', array('jquery'));
		wp_enqueue_script('waypoints', get_template_directory_uri() . '/js/waypoints.min.js', array('jquery'));
	}
	add_action('wp_enqueue_scripts', 'mpt_register_js');


	if ( class_exists( 'MarketPress' ) ) {
		// register marketpress css
		function mpt_enqueue_mp_css() {
			wp_deregister_style('mp-store-theme');
			wp_enqueue_style('mp-flexmarket-css', get_template_directory_uri() . '/css/mp.css', null, null);
		}

		add_action('wp_enqueue_scripts', 'mpt_enqueue_mp_css');
	}

	// register menu
	if(function_exists('register_nav_menus')){
		register_nav_menus(array(
		'mainmenu' => 'Main Menu'
				)
			);
	}

	// add sidebar
	if(function_exists('register_sidebar')){
			register_sidebar(array(
				'name' => 'Sidebar',
				'id' => 'sidebar',
				'description' => 'Widgets in this area will be shown on the right-hand side.',
				'before_widget' => '<div class="well well-small">',
				'after_widget' => '</div>',
				'before_title' => '<h4 class="page-header">',
				'after_title' => '</h4>'
			)
		);

			register_sidebar(array(
				'name' => 'Footer One',
				'id' => 'footer-one',
				'description' => 'First Footer Widget',
				'before_widget' => '',
				'after_widget' => '',
				'before_title' => '<h4 class="page-header"><span>',
				'after_title' => '</span></h4>'
			)
		);
			register_sidebar(array(
				'name' => 'Footer Two',
				'id' => 'footer-two',
				'description' => 'Second Footer Widget',
				'before_widget' => '',
				'after_widget' => '',
				'before_title' => '<h4 class="page-header"><span>',
				'after_title' => '</span></h4>'
			)
		);
			register_sidebar(array(
				'name' => 'Footer Three',
				'id' => 'footer-three',
				'description' => 'Three Footer Widget',
				'before_widget' => '',
				'after_widget' => '',
				'before_title' => '<h4 class="page-header"><span>',
				'after_title' => '</span></h4>'
			)
		);				
	}
	
	// add post type support to page and post
	add_action( 'init', 'add_extra_metabox' );
	function add_extra_metabox() {
		 add_post_type_support( 'page', 'excerpt' );
		 add_post_type_support( 'page', 'thumbnail' );
		 add_post_type_support( 'post', 'excerpt');
		 add_post_type_support( 'post', 'custom-fields');
		 add_post_type_support( 'post', 'comments');
	}

	// add comment function to Product Page
	if ( class_exists( 'MarketPress' ) ) {
		add_action( 'init', 'allow_comments_marketpress' );
		
		function allow_comments_marketpress() {
			add_post_type_support( 'product', 'comments' );
		}
	}
	
	// add thumbnail support to theme
	if ( function_exists( 'add_theme_support' ) ) {
		add_theme_support( 'post-thumbnails' );
	}

	// add additional image size
	if ( function_exists( 'add_image_size' ) ) { 
		add_image_size( 'tb-360', 360, 270, true );
		add_image_size( 'tb-860', 860, 300, true );
	}

	// set excerpt lenght to custom character length
	function the_excerpt_max_charlength($charlength) {
		$excerpt = get_the_excerpt();
		$charlength++;

		if ( mb_strlen( $excerpt ) > $charlength ) {
			$subex = mb_substr( $excerpt, 0, $charlength - 5 );
			$exwords = explode( ' ', $subex );
			$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
			if ( $excut < 0 ) {
				echo mb_substr( $subex, 0, $excut );
			} else {
				echo $subex;
			}
			echo '[...]';
		} else {
			echo $excerpt;
		}
	}
		

 	// Initialize the metabox class.
	add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );
	function cmb_initialize_cmb_meta_boxes() {

		if ( ! class_exists( 'cmb_Meta_Box' ) )
			require_once(get_template_directory() . '/functions/metabox/init.php');

	}

	// call for product listing functions
	add_action('flexmarket_product_listing_page' , 'flexmarket_list_products' , 10 , 2);
	add_action('flexmarket_category_page' , 'flexmarket_list_products' , 10 , 2);
	add_action('flexmarket_tag_page' , 'flexmarket_list_products' , 10 , 2);
	add_action('flexmarket_taxonomy_page' , 'flexmarket_list_products' , 10 , 2);

	function flexmarket_list_products( $unique_id = '' , $context = '' ) {

		$btnclass = mpt_load_mp_btn_color();
		$iconclass = mpt_load_whiteicon_in_btn();
		$tagcolor = mpt_load_icontag_color();
		$span = mpt_load_product_listing_layout();
		$counter = mpt_load_product_listing_counter();
		$entries = get_option('mpt_mp_listing_entries');
		$advancedsoft = mpt_enable_advanced_sort();
		$advancedsoftbtnposition = mpt_advanced_sort_btn_position();

		echo flexmarket_advance_product_sort( $unique_id , $advancedsoft , $advancedsoftbtnposition , $context , false , true , '' , $entries, '', '', '' , '' , $counter, $span, $btnclass, $iconclass, $tagcolor);		

	}

	// MP Dynamic Grid Integration
	if( class_exists('MPDG') ) {

		// if 'enable dynamic grid' option is selected
		if (get_option('mpt_mpdg_enable_dg') == 'true') {

			// remove exisitng action hooks
			remove_action('flexmarket_product_listing_page' , 'flexmarket_list_products' , 10 , 2);
			remove_action('flexmarket_category_page' , 'flexmarket_list_products' , 10 , 2);
			remove_action('flexmarket_tag_page' , 'flexmarket_list_products' , 10 , 2);
			remove_action('flexmarket_taxonomy_page' , 'flexmarket_list_products' , 10 , 2);

			// add mpdg action hooks
			add_action('flexmarket_product_listing_page' , 'mpdg_list_products' , 11 , 2);
			add_action('flexmarket_category_page' , 'mpdg_list_products' , 11 , 2);
			add_action('flexmarket_tag_page' , 'mpdg_list_products' , 11 , 2);
			add_action('flexmarket_taxonomy_page' , 'mpdg_list_products' , 11 , 2);	
		}


		if (!function_exists('mpdg_list_products')) {

			function mpdg_list_products( $unique_id = '' , $context = '' ) {

				$column = get_option('mpt_mpdg_listing_layout');
				$btncolor = get_option('mpt_mpdg_btn_color');
				$tagcolor = get_option('mpt_mpdg_icon_tag_color');
				$pricelabel = get_option('mpt_mpdg_price_tag_color');
				$entries = get_option('mpt_mpdg_listing_entries');
				$showcategory = ( $context == 'list' ? 'yes' : 'no');

				switch ($column) {
					case '2 Columns':
						$span = 'span6';
						break;
					case '3 Columns':
						$span = 'span4';
						break;
					case '4 Columns':
						$span = 'span3';
						break;
					case '5 Columns':
						$span = 'span2';
						break;		

					default:
						$span = 'span4';
						break;
				}

				switch ($btncolor) {
					case 'Grey':
						$btnclass = '';
						$iconclass = '';
						break;
					case 'Blue':
						$btnclass = ' btn-primary';
						$iconclass = ' icon-white';
						break;
					case 'Light Blue':
						$btnclass = ' btn-info';
						$iconclass = ' icon-white';
						break;
					case 'Green':
						$btnclass = ' btn-success';
						$iconclass = ' icon-white';
						break;
					case 'Yellow':
						$btnclass = ' btn-warning';
						$iconclass = ' icon-white';
						break;
					case 'Red':
						$btnclass = ' btn-danger';
						$iconclass = ' icon-white';
						break;
					case 'Black':
						$btnclass = ' btn-inverse';
						$iconclass = ' icon-white';
						break;

					default:
						$btnclass = '';
						$iconclass = '';
						break;
					
				}

				switch ($tagcolor) {
					case 'White':
						$tagclass = ' icon-white';
						break;
					case 'Blue':
						$tagclass = ' icon-blue';
						break;
					case 'Light Blue':
						$tagclass = ' icon-lightblue';
						break;
					case 'Green':
						$tagclass = ' icon-green';
						break;
					case 'Yellow':
						$tagclass = ' icon-yellow';
						break;
					case 'Red':
						$tagclass = ' icon-red';
						break;
					case 'Black':
						$tagclass = '';
						break;

					default:
						$tagclass = '';
						break;
					
				}

				switch ($pricelabel) {
					case 'Grey':
						$labelclass = '';
						break;
					case 'Light Blue':
						$labelclass = ' label-info';
						break;
					case 'Green':
						$labelclass = ' label-success';
						break;
					case 'Yellow':
						$labelclass = ' label-warning';
						break;
					case 'Red':
						$labelclass = ' label-important';
						break;
					case 'Black':
						$labelclass = ' label-inverse';
						break;

					default:
						$labelclass = ' label-info';
						break;
					
				}	

				wp_enqueue_script('mpdg', MPDG_DIR . 'js/mpdg.js', array('jquery'));
				add_action('wp_footer' , 'mpdg_add_js_to_footer');

				echo mpdg_dynamic_grid(false , true , '', $entries , '' , '' , '' , '' , $showcategory , false , $span , 'full' , $btnclass, $iconclass, $tagclass, $labelclass );
			}
		}

	}