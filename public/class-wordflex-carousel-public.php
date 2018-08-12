<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Wordflex_Carousel
 * @subpackage Wordflex_Carousel/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Wordflex_Carousel
 * @subpackage Wordflex_Carousel/public
 * @author     Awran5 <awran5@yahoo.com>
 */
class Wordflex_Carousel_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		
	}

	/**
	 * Check if the style is included in a theme
	 * @see   wp_style_is()
	 * @return Bool
	 */
	public function is_style( $style ) {
		return wp_style_is( $style );
	}

	/**
	 * Check if the script is included in a theme
	 * @see   wp_script_is()
	 * @return Bool
	 */
	public function is_script( $script ) {
		return wp_script_is( $script );
	}

	/**
	 * Check plugin option for bootstrap
	 * @return Bool
	 */
	public function is_bootstrap() {
		return self::option('cmb_carousel_load_bootstrap');
	}

	/**
	 * Check plugin option for animate
	 * @return Bool
	 */
	public function is_animate() {
		return self::option('cmb_carousel_load_animate');
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * Enqueue Animate.css style only if not loaded
		 */
		if( $this->is_animate() === 'yes' ) {
			wp_enqueue_style( 
				$this->plugin_name . '-animate', 
				plugin_dir_url( __FILE__ ) . 'css/animate.min.css', 
				array(), 
				$this->version, 
				'all'
			);
		}
		/**
		 * Enqueue bootstrap style only if not loaded
		 */
		if( $this->is_bootstrap() === 'yes' ) {
			wp_enqueue_style( 
				$this->plugin_name . '-bootstrap', 
				plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css', 
				array(), 
				$this->version, 
				'all' 
			);
		}
		/**
		 * Enqueue Public stylesheet
		 */
		wp_enqueue_style( 
			$this->plugin_name, 
			plugin_dir_url( __FILE__ ) . 'css/wordflex-carousel-public.css', 
			array(), 
			$this->version, 
			'all' 
		);
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * Enqueue bootstrap script only if not loaded
		 */
		if( $this->is_bootstrap() === 'yes' ) {
			wp_enqueue_script( 
				$this->plugin_name . '-bootstrap', 
				plugin_dir_url( __FILE__ ) . 'js/bootstrap.min.js', 
				array( 'jquery' ), 
				$this->version, 
				true 
			);
		}
		/**
		 * Enqueue Public script
		 */
		wp_enqueue_script( 
			$this->plugin_name, 
			plugin_dir_url( __FILE__ ) . 'js/wordflex-carousel-public.js', 
			array( 'jquery' ), 
			$this->version, 
			true 
		);
	}

	/**
	 * Wrapper function around cmb2_get_option
	 * @since  0.1.0
	 * @param  string $key     Options array key
	 * @param  mixed  $default Optional default value
	 * @return mixed           Option value
	 */
	public static function option( $key = '', $default = false ) {
	    if ( function_exists( 'cmb2_get_option' ) ) {
	        // Use cmb2_get_option as it passes through some key filters.
	        return cmb2_get_option( 'wordflex_carousel_options', $key, $default );
	    }
	    // Fallback to get_option if CMB2 is not loaded yet.
	    $opts = get_option( 'wordflex_carousel_options', $default );
	    $val = $default;
	    if ( 'all' == $key ) {
	        $val = $opts;
	    } 
	    elseif ( is_array( $opts ) && array_key_exists( $key, $opts ) && false !== $opts[ $key ] ) {
	        $val = $opts[ $key ];
	    }
	    return $val;
	}

}
