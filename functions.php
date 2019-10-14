<?php
/**
 * *****************************************************************************
 * @package 	Wordpress
 * @subpackage 	wp-theme-skeleton
 * @author		Emre Can ÖZTAŞ <me@emrecanoztas.com>
 * @link 		https://emrecanoztas.com
 * @license 	http://opensource.org/licenses/MIT  MIT License
 * @version  	1.0
 * *****************************************************************************
 */

// *****************************************************************************
// VARIABLES
// *****************************************************************************
$theme_path 	= get_template_directory_uri();
$footer_text 	= '';

// *****************************************************************************
// ACTIONS
// *****************************************************************************
add_action('after_setup_theme', 'support_wp_theme');
add_action('wp_enqueue_scripts', 'add_theme_style_files');
add_action('wp_enqueue_scripts', 'add_theme_script_files');
add_action('widgets_init', 'create_theme_sidebars');
add_action('init', 'create_theme_menu');

// *****************************************************************************
// FILTER
// *****************************************************************************
add_filter('the_generator', 'remove_wp_version');
add_filter('show_admin_bar', 'show_admin_panel_logged_user');

// *****************************************************************************
// FUNCTIONS
// *****************************************************************************
if (!function_exists('support_wp_theme')) {
	/**
	 * Install all necessary options.
	 *
	 * @return void
	 */
	function support_wp_theme()
	{
		load_theme_textdomain('THEME-DOMAIN-NAME');
		add_editor_style();
		add_theme_support('editor-styles');
		add_theme_support('wp-block-styles');
		add_theme_support('responsive-embeds');
		add_theme_support('automatic-feed-links');
		add_theme_support('post-formats', array('aside', 'image', 'link', 'quote', 'status'));
		add_theme_support('post-thumbnails');
		set_post_thumbnail_size(624, 9999);
		add_theme_support('customize-selective-refresh-widgets');
		add_theme_support( 'custom-logo', array(
			'height'      => 100,
			'width'       => 400,
			'flex-height' => true,
			'flex-width'  => true,
			'header-text' => array('site-title', 'site-description'),
		) );
	}
}

if (!function_exists('add_theme_style_files')) {
	/**
	 * Add all style files of theme.
	 * $handle is simply the name of the stylesheet.
	 * $src is where it is located. The rest of the parameters are optional.
	 * $deps refers to whether or not this stylesheet is dependent on another stylesheet. If this is set, this stylesheet will not be loaded unless its dependent stylesheet is loaded first.
	 * $ver sets the version number.
	 * $media can specify which type of media to load this stylesheet in, such as ‘all’, ‘screen’, ‘print’ or ‘handheld.’
	 *
	 * @return void
	 */
	function add_theme_style_files()
	{
		global $theme_path;
		wp_enqueue_style($handle, $src, $deps, $ver, $media);
	}
}

if (!function_exists('add_theme_script_files')) {
	/**
	 * Add all script files of theme.
	 * $handle is the name for the script.
	 * $src defines where the script is located.
	 * $deps is an array that can handle any script that your new script depends on, such as jQuery.
	 * $ver lets you list a version number.
	 * $in_footer is a boolean parameter (true/false) that allows you to place your scripts in the footer of your HTML document rather then in the header, so that it does not delay the loading of the DOM tree.
	 *
	 * @return void
	 */
	function add_theme_script_files()
	{
		global $theme_path;
		wp_enqueue_script($handle, $src, $deps, $ver, $in_footer);
	}
}

if (!function_exists('create_theme_sidebars')) {
	/**
	 * Create sidebars for widgets.
	 *
	 * @return void
	 */
	function create_theme_sidebars()
	{
		register_sidebar(
			array(
				'name'          => __('SIDEBAR-NAME', 'THEMENAME'),
				'id'            => 'sidebar_name',
				'description'   => __('SIDEBAR-DESCRIPTION', 'THEMENAME'),
				'before_widget' => '<div class="col-md-4">',
				'after_widget'  => '</div>',
				'before_title'  => '<h5><b>',
				'after_title'   => '</b></h5>'
			)
		);
	}
}

if (!function_exists('remove_wp_version')) {
	/**
	 * Remove Wordpress version.
	 *
	 * @return void
	 */
	function remove_wp_version()
	{
		return ('');
	}
}

if (!function_exists('show_admin_panel_logged_user')) {
	/**
	 * Show admin panel logged user.
	 *
	 * @return void
	 */
	function show_admin_panel_logged_user()
	{
		return (!(current_user_can('manage_options')) ? false : true);
	}
}

if (!function_exists('create_theme_menu')) {
	/**
	 * Create custom theme menu
	 *
	 * @return void
	 */
	function create_theme_menu()
	{
  		register_nav_menu('primary',__('Primary Menu'));
	}
}
