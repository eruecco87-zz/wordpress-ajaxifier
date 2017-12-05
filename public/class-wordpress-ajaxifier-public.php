<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://oscarviquez.com/wordpress-ajaxifier
 * @since      1.0.0
 *
 * @package    Wordpress_Ajaxifier
 * @subpackage Wordpress_Ajaxifier/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Wordpress_Ajaxifier
 * @subpackage Wordpress_Ajaxifier/public
 * @author     Oscar Viquez <hola@oscarviquez.com>
 */
class Wordpress_Ajaxifier_Public {

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
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wordpress_Ajaxifier_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wordpress_Ajaxifier_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wordpress-ajaxifier-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wordpress_Ajaxifier_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wordpress_Ajaxifier_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

    if(!wp_script_is( 'jquery' )) {

      wp_enqueue_script('jquery');

    }

    wp_enqueue_script( 'history-js', plugin_dir_url( __FILE__ ) . 'js/history.min.js', array( 'jquery' ), $this->version, false );
    wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wordpress-ajaxifier-public.js', array( 'jquery', 'history-js' ), $this->version, false );

    $wordpress_ajaxifier_localized_data = array(
      'url' 		            => site_url() . '/',
      'consoleLogs'         => get_option('wordpress_ajaxifier_console_logs'),
      'mainSelector'        => get_option('wordpress_ajaxifier_main_selector'),
      'navigationSelector'  => get_option('wordpress_ajaxifier_navigation_selector'),
      'searchFormSelector'  => get_option('wordpress_ajaxifier_search_form_selector'),
      'manualSelectors'     => get_option('wordpress_ajaxifier_manual_selectors'),
      'excludedSelectors'   => get_option('wordpress_ajaxifier_excluded_selectors'),
      'loaderImage'         => get_option('wordpress_ajaxifier_loader_image'),
      'loaderMarkup'        => get_option('wordpress_ajaxifier_loader_markup'),
      'scrollTop'           => get_option('wordpress_ajaxifier_scroll_top'),
      'effect'              => get_option('wordpress_ajaxifier_effect'),
    );

    wp_localize_script($this->plugin_name, 'wordpress_ajaxifier_localized_data', $wordpress_ajaxifier_localized_data);

	}

}
