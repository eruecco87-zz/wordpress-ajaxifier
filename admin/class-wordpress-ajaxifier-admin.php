<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://oscarviquez.com/wordpress-ajaxifier
 * @since      1.0.0
 *
 * @package    Wordpress_Ajaxifier
 * @subpackage Wordpress_Ajaxifier/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wordpress_Ajaxifier
 * @subpackage Wordpress_Ajaxifier/admin
 * @author     Oscar Viquez <hola@oscarviquez.com>
 */
class Wordpress_Ajaxifier_Admin {

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

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wordpress-ajaxifier-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wordpress-ajaxifier-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function add_admin_page() {

    add_menu_page(
      __('WP Ajaxifier Settings', 'wordpress-ajaxifier'),
      __('WP Ajaxifier', 'wordpress-ajaxifier'),
      'manage_options',
      $this->plugin_name,
      [$this, 'display_admin_page']
    );

  }

  public function display_admin_page() {

    include_once 'partials/wordpress-ajaxifier-admin-display.php';

	}

	public function register_admin_options() {

    register_setting( 'wordpress-ajaxifier-settings', 'wordpress_ajaxifier_main_selector' );
    register_setting( 'wordpress-ajaxifier-settings', 'wordpress_ajaxifier_navigation_selector' );
    register_setting( 'wordpress-ajaxifier-settings', 'wordpress_ajaxifier_search_form_selector' );
    register_setting( 'wordpress-ajaxifier-settings', 'wordpress_ajaxifier_manual_selectors' );
    register_setting( 'wordpress-ajaxifier-settings', 'wordpress_ajaxifier_excluded_selectors' );
    register_setting( 'wordpress-ajaxifier-settings', 'wordpress_ajaxifier_loader_image' );
    register_setting( 'wordpress-ajaxifier-settings', 'wordpress_ajaxifier_loader_markup' );
    register_setting( 'wordpress-ajaxifier-settings', 'wordpress_ajaxifier_scroll_top' );
    register_setting( 'wordpress-ajaxifier-settings', 'wordpress_ajaxifier_effect' );
    register_setting( 'wordpress-ajaxifier-settings', 'wordpress_ajaxifier_console_logs' );

  }

}
