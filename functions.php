<?php
/**
 * StartUp Revolution functions and definitions
 *
 * @package StartUp Revolution
 */
//Include this to check if a plugin is activated with is_plugin_active
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

if ( ! function_exists( 'startup_revolution_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function startup_revolution_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on StartUp Revolution, use a find and replace
	 * to change 'startup-revolution' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'startup-revolution', get_template_directory() . '/languages' );

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
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in three locations.
	register_nav_menus( array(
		'navbar-primary' => esc_html__( 'Navbar Primary', 'startup-revolution' ),
        'navbar-primary-non-collapsing' => esc_html__( 'Navbar Primary non-collapsing', 'startup-revolution' ),
        'navbar-secondary' => esc_html__( 'Navbar Secondary', 'startup-revolution' ),
        'left-panel' => esc_html__( 'Left Panel', 'startup-revolution' ),
        'right-panel' => esc_html__( 'Right Panel', 'startup-revolution' ),
        'fullscreen-panel' => esc_html__( 'Fullscreen Panel', 'startup-revolution' ),
        'navbar-bottom' => esc_html__( 'Navbar Bottom', 'startup-revolution' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
//	add_theme_support( 'post-formats', array(
//		'image', 'video', 'audio', 'link',
//	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'startup_revolution_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // startup_revolution_setup
add_action( 'after_setup_theme', 'startup_revolution_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function startup_revolution_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'startup_revolution_content_width', 640 );
}
add_action( 'after_setup_theme', 'startup_revolution_content_width', 0 );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
require get_template_directory() . '/inc/sidebars.php';

/**
 * Register theme images.
 */
require get_template_directory() . '/inc/images.php';

/**
 * Enqueue scripts and styles.
 */
require get_template_directory() . '/inc/enqueues.php';

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

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
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Charger le navwalker qui permet d'intégrer les menus WordPress à Bootstrap.
 */
require get_template_directory() . '/lib/wp_bootstrap_navwalker.php';

/**
 * Charger les Metaboxes.
 */
require get_template_directory() . '/inc/metaboxes.php';

/**
 * Charger TGM pour inclure des plugins.
 */
require get_template_directory() . '/inc/plugins.php';

/**
 * Charger mon Array avec toutes les classes animate.css
 */
//require get_template_directory() . '/inc/animate-css.php';

/**
 * Loads the Options Panel
 *
 */

add_filter('options_framework_location','startup_revolution_options_framework_location_override');

function startup_revolution_options_framework_location_override() {
	return array('/inc/options.php');
}

define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/lib/options-framework/' );
require_once dirname( __FILE__ ) . '/lib/options-framework/options-framework.php';
$optionsfile = locate_template( '/inc/options.php' );
load_template( $optionsfile );

require get_template_directory() . '/inc/theme-options.php';

/**
 * Désactiver les pages avec noms des auteurs
 */
function bwp_template_redirect() {
    if (is_author()) {
        wp_redirect( home_url() ); exit;
    }
}
add_action('template_redirect', 'bwp_template_redirect');

 /* 
 * The CSS file selected in the options panel 'stylesheet' option
 * is loaded on the theme front end
 */
 
function options_stylesheets_alt_style()   {
    require get_template_directory() . '/inc/theme-options.php';
	if ( $user_style && $user_style != get_stylesheet_directory_uri() . '/css/_none.css' ) {
		wp_enqueue_style( 'options_stylesheets_alt_style', $user_style, array(), null );
	}
}
add_action( 'wp_enqueue_scripts', 'options_stylesheets_alt_style' );

//Adverts
if (is_plugin_active('wpadverts/wpadverts.php')){
    // Ajouter CPF aux annonces
    function startup_revolution_add_adverts_currency($list) {
        $list[] = array(
            "code"=>"XPF", // ISO 4217 currency code, see http://en.wikipedia.org/wiki/ISO_4217
            "sign"=>"CFP", // currency prefix or postfix
            "label"=>"Franc CFP" // currency long name
        );
        return $list;
    }

    add_filter("adverts_currency_list", "startup_revolution_add_adverts_currency");

    // Limiter les annonces à une seule catégorie
    function startup_revolution_limit_category_selection( $form ) {
        if($form["name"] != 'advert' || is_admin()) {
            return $form;
        }
        $count = count( $form["field"] );
        for( $i = 0; $i < $count; $i++ ) {
            if($form["field"][$i]["name"] == "advert_category") {
                $form["field"][$i]["max_choices"] = 1;
            }
        }
        return $form;
    }

    add_filter("adverts_form_load", "startup_revolution_limit_category_selection");
}

// Page slug priority over archive
function startup_revolution_page_priority_init() {
    $GLOBALS['wp_rewrite']->use_verbose_page_rules = true;
}

add_action( 'init', 'startup_revolution_page_priority_init' );

function startup_revolution_page_priority_collect_page_rewrite_rules( $page_rewrite_rules )
{
    $GLOBALS['startup_revolution_page_priority_page_rewrite_rules'] = $page_rewrite_rules;
    return array();
}

add_filter( 'page_rewrite_rules', 'startup_revolution_page_priority_collect_page_rewrite_rules' );

function startup_revolution_page_priority_prepend_page_rewrite_rules( $rewrite_rules )
{
    return $GLOBALS['startup_revolution_page_priority_page_rewrite_rules'] + $rewrite_rules;
}

add_filter( 'rewrite_rules_array', 'startup_revolution_page_priority_prepend_page_rewrite_rules' );

// Style de Tiny MCE
function startup_revolution_editor_styles() {
    add_editor_style();
    //add_editor_style( 'custom-editor-style.css' );
}

add_action( 'admin_init', 'startup_revolution_editor_styles' );

// Disable smart quotes
//add_filter( 'run_wptexturize', '__return_false' );

// Show current template file for dev purpose
//
// Usage:
// startup_revolution_get_current_template()
function startup_revolution_define_current_template( $template ) {
    $GLOBALS['current_theme_template'] = basename($template);

    return $template;
}
add_action('template_include', 'startup_revolution_define_current_template', 1000);

function startup_revolution_get_current_template( $echo = false ) {
    if ( !isset( $GLOBALS['current_theme_template'] ) ) {
        trigger_error( '$current_theme_template has not been defined yet', E_USER_WARNING );
        return false;
    }
    if ( $echo ) {
        echo $GLOBALS['current_theme_template'];
    }
    else {
        return $GLOBALS['current_theme_template'];
    }
}