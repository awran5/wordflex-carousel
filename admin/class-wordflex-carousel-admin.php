<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Wordflex_Carousel
 * @subpackage Wordflex_Carousel/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wordflex_Carousel
 * @subpackage Wordflex_Carousel/admin
 * @author     Awran5 <awran5@yahoo.com>
 */
class Wordflex_Carousel_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->load_admin_panel();
	}


	public function load_admin_panel() {
		/**
		 * Include CMB2 library
		 * @link https://github.com/WebDevStudios/CMB2
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/lib/cmb2/init.php';
		/**
		 * CMB2 Animation
		 * @link https://github.com/rubengc/cmb2-field-animation
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes//lib/cmb2-custom/cmb2-animation/cmb2-field-animation.php';
		/**
		 * Include CMB2 Slider
		 * @link https://github.com/improy/CMB2-slider-field
		 */
		// require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/lib/cmb2-custom/cmb2-slider/cmb2-field-slider.php';
		/**
		 * Load Admin page HTML Header
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/wordflex-carousel-admin-display.php';
		/**
		 * Load carousel shortcode
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/wordflex-carousel-shortcode.php';
	}


	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * An instance of this class should be passed to the run() function
		 * defined in Wordflex_Carousel_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wordflex_Carousel_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( 
			$this->plugin_name, 
			plugin_dir_url( __FILE__ ) . 'css/wordflex-carousel-admin.css', 
			array(), 
			$this->version, 
			'all' 
		);
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * An instance of this class should be passed to the run() function
		 * defined in Wordflex_Carousel_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wordflex_Carousel_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		// CMB2 conditional
		wp_enqueue_script( 
			$this->plugin_name . 'cmb2-conditional-logic', 
			plugin_dir_url( __FILE__ ) . 'js/cmb2-conditional-logic.js', 
			array( 'jquery' ), 
			$this->version, 
			true 
		);
		// Plugin script
		wp_enqueue_script( 
			$this->plugin_name, 
			plugin_dir_url( __FILE__ ) . 'js/wordflex-carousel-admin.js', 
			array( 'jquery' ),
			$this->version, 
			true 
		);
	}

	/**
	 * Register a custom post type called "wordflex-carousel".
	 *
	 * @see wordflex-carousel-admin-display for register_meta_box_cb
	 */
	public function create_post_type() {
	    
	    $labels = array(
	        'name'              => _x('WordFlex Carousel', 'wordflex-carousel'),
	        'singular_name'     => _x('WordFlex Carousel', 'wordflex-carousel'),
	        'add_new'           => _x('New Carousel', 'wordflex-carousel'),
	        'all_items'         => __('All Carousels', 'wordflex-carousel'),
	        'add_new_item'      => __('Add Carousel', 'wordflex-carousel'),
	        'edit_item'         => __('Edit Carousel', 'wordflex-carousel'),
	        'new_item'          => __('New Carousel', 'wordflex-carousel'),
	        'view_item'         => __('View carousel', 'wordflex-carousel'),
	        'search_items'      => __('Search Carousels', 'wordflex-carousel'),
	        'not_found'         => __('No carousels found', 'wordflex-carousel'),
	        'not_found_in_trash'=> __('No carousels found in trash', 'wordflex-carousel'),
	        'parent_item_colon' => __('Parent carousel', 'wordflex-carousel'),
	    );

	    $args = array(
	        'labels'                => $labels,
	        'public'                => false,  
	        'publicly_queryable'    => false,
	        'exclude_from_search'   => true,
	        'show_in_nav_menus'     => false,
	        'show_ui'               => true,
	        'show_in_menu'          => true,
	        'show_in_admin_bar'     => true,         
	        'can_export'            => true,
	        'hierarchical'          => false,
	        'has_archive'           => false,
	        'query_var'             => false,
	        'capability_type'       => 'page',
	        'map_meta_cap'          => true,
	        'menu_icon'             => 'dashicons-format-gallery',
	        'menu_position'         => 101,
	        'supports'              => array( 'title' ),
	        'register_meta_box_cb'  => 'WordFlex_Carousel_admin_metabox', // callback
	    );
	    register_post_type( 'wordflex-carousel', $args );
	}

	/**
	 * Disable cmb2 default styles
	 * @return Empty
	 */
	public function disable_cmb2_styles() {}

}

