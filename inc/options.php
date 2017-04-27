<?php
function optionsframework_option_name() {
	// Change this to use your theme slug
	return 'startup-revolution';
}

function optionsframework_options() {
    //*****************************************************************************
    //*****************************************************************************
    //
    // General
    //
    //*****************************************************************************
    //*****************************************************************************
    
    $options[] = array(
		'name' => __( 'General', 'startup-revolution' ),
		'type' => 'heading'
	);
    
    $options[] = array(
		'name' => __( 'Image Logo', 'startup-revolution' ),
		'id' => 'general-logo',
		'type' => 'upload'
	);
    
    // Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages( 'sort_column=post_parent,menu_order' );
	$options_pages[''] = __( 'None', 'startup-revolution' );
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}
    
    $options[] = array(
		'name' => __( 'Header', 'startup-revolution' ),
		'desc' => __( 'Choose a page to use as site header', 'startup-revolution' ),
		'id' => 'general-header',
		'type' => 'select',
        'class' => 'mini', //mini, tiny, small
		'options' => $options_pages
	);
    
	$home_page_type = array(
		'default' => __( 'Default', 'startup-revolution' ),
		'login' => __( 'Login', 'startup-revolution' ),
	);
    
	$options[] = array(
		'name' => __( 'Front page', 'startup-revolution' ),
		'id' => 'front-page',
		'std' => 'default',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $home_page_type
	);
    
	$options[] = array(
		'name' => __( 'Options', 'startup-revolution' ),
		'type' => 'info'
	);
    
	$options[] = array(
		'desc' => __( 'Back to top button', 'startup-revolution' ),
		'id' => 'general-back-to-top',
		'std' => '1',
		'type' => 'checkbox'
	);
    
	$options[] = array(
		'desc' => __( 'Activate YTPlayer', 'startup-revolution' ),
		'id' => 'general-ytplayer',
		'std' => '0',
		'type' => 'checkbox'
	);
    
    $options[] = array(
		'name' => __( 'Footer content', 'startup-revolution' ),
		'id' => 'general-footer',
		'std' => 'Website powered with Startup by <a href="http://yozz.net" target="_blank">yozz.net</a>',
		'type' => 'textarea'
	);
    
    $options[] = array(
		'name' => __( 'Google Analytics ID', 'startup-revolution' ),
		'desc' => __( 'Provided by Google in the form UA-XXXXXXX-XX', 'startup-revolution' ),
		'id' => 'general-ga',
		'std' => '',
		'type' => 'text'
	);
    
    //*****************************************************************************
    //*****************************************************************************
    //
    // Style
    //
    //*****************************************************************************
    //*****************************************************************************
    
    $options[] = array(
		'name' => __( 'Style', 'startup-revolution' ),
		'type' => 'heading'
	);
    
    // Style Stylesheets

    /**
     * Returns an array of all files in $directory_path of type $filetype.
     *
     * The $directory_uri + file name is used for the key
     * The file name is the value
     */

    function options_stylesheets_get_file_list( $directory_path, $filetype, $directory_uri ) {
        $alt_stylesheets = array();
        $alt_stylesheet_files = array();
        if ( is_dir( $directory_path ) ) {
            $alt_stylesheet_files = glob( $directory_path . "*.$filetype");
            foreach ( $alt_stylesheet_files as $file ) {
                $file = str_replace( $directory_path, "", $file);
                $alt_stylesheets[ $directory_uri . $file] = $file;
            }
        }
        return $alt_stylesheets;
    }

    // Generated list of stylesheets in the "CSS" directory
    // Use template_directory paths if you're using a parent theme

    $alt_stylesheets = options_stylesheets_get_file_list(
        get_stylesheet_directory() . '/css/', // $directory_path
        'css', // $filetype
        get_stylesheet_directory_uri() . '/css/' // $directory_uri
    );

    $options[] = array( "name" => "User stylesheet",
        "desc" => 'Load additional stylesheet from the /css theme directory. Choose _none.css to ignore.',
        "id" => "auto_stylesheet",
        "type" => "select",
        "options" => $alt_stylesheets );
    
    $options[] = array(
		'name' => __( 'Custom button', 'startup-revolution' ),
        'desc' => __( 'Corner radius in px', 'startup-revolution' ),
		'id' => 'button-radius',
		'std' => '6',
		'type' => 'text',
        'class' => 'mini'
	);
    
    $options[] = array(
        'desc' => __( 'Background', 'startup-revolution' ),
		'id' => 'button-background',
		'std' => '#323232',
		'type' => 'color'
	);
    
    $options[] = array(
        'desc' => __( 'Text', 'startup-revolution' ),
		'id' => 'button-text',
		'std' => '#ffffff',
		'type' => 'color'
	);
    
    $options[] = array(
        'desc' => __( 'Hover, focus, active background', 'startup-revolution' ),
		'id' => 'button-hover-background',
		'std' => '#000000',
		'type' => 'color'
	);
    
    $options[] = array(
        'desc' => __( 'Hover, focus, active text', 'startup-revolution' ),
		'id' => 'button-hover-text',
		'std' => '#ffffff',
		'type' => 'color'
	);
    
	$options[] = array(
		'name' => __( 'Pages & posts header', 'startup-revolution' ),
        'desc' => __( 'Hide the header. Or not. Overrides individual page setting if ckecked.', 'startup-revolution' ),
		'id' => 'page-header-hidden',
		'std' => '0',
		'type' => 'checkbox'
	);
    
    $options[] = array(
		'desc' => __( 'Background', 'startup-revolution' ),
		'id' => 'page-header-background-color',
		'std' => '#323232',
		'type' => 'color'
	);
    
    $options[] = array(
		'desc' => __( 'Text', 'startup-revolution' ),
		'id' => 'page-header-text-color',
		'std' => '#ffffff',
		'type' => 'color'
	);
    
    $options[] = array(
        'desc' => __( 'Padding in px', 'startup-revolution' ),
		'id' => 'page-header-padding',
		'std' => '50',
		'type' => 'text',
        'class' => 'mini'
	);
    
	$page_header_positions = array(
		'left' => __( 'Left', 'startup-revolution' ),
		'center' => __( 'Center', 'startup-revolution' ),
		'right' => __( 'Right', 'startup-revolution' )
	);
    
	$options[] = array(
		'desc' => __( 'Content position', 'startup-revolution' ),
		'id' => 'page-header-position',
		'std' => 'left',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $page_header_positions
	);
    
	$options[] = array(
        'desc' => __( 'Put the text inside a box', 'startup-revolution' ),
		'id' => 'page-header-boxed',
		'std' => '0',
		'type' => 'checkbox'
	);
    
    $options[] = array(
		'name' => __( 'Footer', 'startup-revolution' ),
		'id' => 'footer-color',
		'std' => '#323232',
		'type' => 'color'
	);
    
    $options[] = array(
		'name' => __( 'Custom CSS', 'startup-revolution' ),
		'id' => 'custom-css',
		'type' => 'textarea'
	);
    
    //*****************************************************************************
    //*****************************************************************************
    //
    // Navigation
    //
    //*****************************************************************************
    //*****************************************************************************
    
    $options[] = array(
		'name' => __( 'Navigation', 'startup-revolution' ),
		'type' => 'heading'
	);

	$navbar_position = array(
		'navbar-fixed-top'    => __( 'Fixed top', 'startup-revolution' ),
        'navbar-fixed-header' => __( 'Fixed under header', 'startup-revolution' ),
	);
    
	$options[] = array(
		'desc' => __( 'Position', 'startup-revolution' ),
		'id' => 'navbar-position',
		'std' => 'navbar-fixed-top',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $navbar_position
	);
    
	$options[] = array(
		'desc' => __( 'Transparent on homepage. Available for fixed top navbar only.', 'startup-revolution' ),
		'id' => 'navbar-transparent',
		'std' => '1',
		'type' => 'checkbox'
	);
    
    $options[] = array(
		'desc' => __( 'Translucent background on hover. For transparent navbar only.', 'startup-revolution' ),
		'id' => 'navbar-translucent',
		'std' => '1',
		'type' => 'checkbox'
	);
    
    $options[] = array(
		'id' => 'navbar-color',
		'std' => '#323232',
		'type' => 'color'
	);
    
    $navbar_logo_positions = array(
		'navbar-left' => __( 'Left', 'startup-revolution' ),
		'navbar-right' => __( 'Right', 'startup-revolution' ),
        '' => __( 'Hidden', 'startup-revolution' )
	);
    
	$options[] = array(
		'desc' => __( 'Logo Position', 'startup-revolution' ),
		'id' => 'navbar-logo-position',
		'std' => 'navbar-left',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $navbar_logo_positions
	);
    
    $navbar_item_positions = array(
		'navbar-left' => __( 'Left', 'startup-revolution' ),
		'navbar-right' => __( 'Right', 'startup-revolution' )
	);
    
    $options[] = array(
		'desc' => __( 'Menu Position', 'startup-revolution' ),
		'id' => 'navbar-menu-position',
		'std' => 'navbar-right',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $navbar_item_positions
	);
    
    $options[] = array(
		'desc' => __( 'Hamburger Position', 'startup-revolution' ),
		'id' => 'navbar-hamburger-position',
		'std' => 'navbar-right',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $navbar_item_positions
	);

	$options[] = array(
		'desc' => __( 'Inverse style', 'startup-revolution' ),
		'id' => 'navbar-inverse',
		'std' => '1',
		'type' => 'checkbox'
	);
    
    $options[] = array(
		'name' => __( 'Fullscreen panel', 'startup-revolution' ),
        'desc' => __( 'Activate. Use <strong>data-toggle="modal" data-target="#fullscreen-panel"</strong> on any button / link or activate navbar hamburger below to make the magic happen.', 'startup-revolution' ),
		'id' => 'fullscreen-panel-on',
		'std' => '0',
		'type' => 'checkbox'
	);
    
    $options[] = array(
        'desc' => __( 'Activate navbar hamburger.', 'startup-revolution' ),
		'id' => 'fullscreen-panel-hamburger',
		'std' => '0',
		'type' => 'checkbox'
	);
    
    $options[] = array(
        'desc' => __( 'Override hamburger icon with a text.', 'startup-revolution' ),
		'id' => 'fullscreen-panel-hamburger-text',
        'type' => 'text',
        'class' => 'mini'
	);
    
	$options[] = array(
		'name' => __( 'Left panel', 'startup-revolution' ),
        'desc' => __( 'Activate. Use <strong>#left-panel</strong> on any link / menu item or activate navbar hamburger below to make the magic go on.', 'startup-revolution' ),
		'id' => 'left-panel-on',
		'std' => '0',
		'type' => 'checkbox'
	);
    
    $options[] = array(
        'desc' => __( 'Activate navbar hamburger.', 'startup-revolution' ),
		'id' => 'left-panel-hamburger',
		'std' => '0',
		'type' => 'checkbox'
	);
    
    $options[] = array(
        'desc' => __( 'Override hamburger icon with a text.', 'startup-revolution' ),
		'id' => 'left-panel-hamburger-text',
        'type' => 'text',
        'class' => 'mini'
	);
    
    $options[] = array(
        'desc' => __( 'Push page content', 'startup-revolution' ),
		'id' => 'left-panel-push',
		'std' => '1',
		'type' => 'checkbox'
	);
    
    $options[] = array(
		'id' => 'left-panel-color',
        'std' => '#323232',
		'type' => 'color'
	);
    
	$options[] = array(
		'desc' => __( 'Theme', 'startup-revolution' ),
		'id' => 'left-panel-theme',
		'std' => 'theme-dark',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => array(
            'theme-light' => __( 'Light', 'startup-revolution' ),
            'theme-dark' => __( 'Dark', 'startup-revolution' )
        )
	);
    
	$options[] = array(
		'desc' => __( 'Mode', 'startup-revolution' ),
		'id' => 'left-panel-mode',
		'std' => 'default',
        'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => array(
            'default' => __( 'Default', 'startup-revolution' ),
            'tileview' => __( 'Tileview', 'startup-revolution' )
        )
	);
    
    $options[] = array(
        'desc' => __( 'Slide items (optional for default mode only)', 'startup-revolution' ),
		'id' => 'left-panel-slide',
		'std' => '1',
		'type' => 'checkbox'
	);
     
	$options[] = array(
		'name' => __( 'Right panel', 'startup-revolution' ),
        'desc' => __( 'Activate. Use <strong>#right-panel</strong> on any link / menu item or activate navbar hamburger below to make the fantasy happen.', 'startup-revolution' ),
		'id' => 'right-panel-on',
		'std' => '0',
		'type' => 'checkbox'
	);
    
    $options[] = array(
        'desc' => __( 'Activate navbar hamburger.', 'startup-revolution' ),
		'id' => 'right-panel-hamburger',
		'std' => '0',
		'type' => 'checkbox'
	);
    
    $options[] = array(
        'desc' => __( 'Override hamburger icon with a text.', 'startup-revolution' ),
		'id' => 'right-panel-hamburger-text',
        'type' => 'text',
        'class' => 'mini'
	);
    
    $options[] = array(
        'desc' => __( 'Push page content', 'startup-revolution' ),
		'id' => 'right-panel-push',
		'std' => '1',
		'type' => 'checkbox'
	);
    
    $options[] = array(
		'id' => 'right-panel-color',
        'std' => '#323232',
		'type' => 'color'
	);
    
	$options[] = array(
		'desc' => __( 'Theme', 'startup-revolution' ),
		'id' => 'right-panel-theme',
		'std' => 'theme-dark',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => array(
            'theme-light' => __( 'Light', 'startup-revolution' ),
            'theme-dark' => __( 'Dark', 'startup-revolution' )
        )
	);
    
	$options[] = array(
		'desc' => __( 'Mode', 'startup-revolution' ),
		'id' => 'right-panel-mode',
		'std' => 'default',
        'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => array(
            'default' => __( 'Default', 'startup-revolution' ),
            'tileview' => __( 'Tileview', 'startup-revolution' )
        )
	);
    
    $options[] = array(
        'desc' => __( 'Slide items (optional for default mode only)', 'startup-revolution' ),
		'id' => 'right-panel-slide',
		'std' => '1',
		'type' => 'checkbox'
	);
    
    //*****************************************************************************
    //*****************************************************************************
    //
    // Slider
    //
    //*****************************************************************************
    //*****************************************************************************
    
    if (is_plugin_active('startup-cpt-slider/startup-cpt-slider.php')){
    
	$options[] = array(
		'name' => __( 'Slider', 'startup-revolution' ),
		'type' => 'heading'
	);
    
	$options[] = array(
		'desc' => __( 'Activate on homepage', 'startup-revolution' ),
		'id' => 'slider-on',
		'std' => '1',
		'type' => 'checkbox'
	);
        
    $options[] = array(
        'desc' => __( 'Display order', 'startup-revolution' ),
		'id' => 'slider-order',
		'std' => 'menu_order',
		'type' => 'select',
        'class' => 'mini',
        'options' => array(
		  'rand' => __( 'Random', 'startup-revolution' ),
		  'menu_order' => __( 'Menu order', 'startup-revolution' )
            )
	);
        
    $options[] = array(
		'desc' => __( 'Max number of items to show. Leave empty for unlimited.', 'startup-revolution' ),
		'id' => 'slider-number',
		'std' => '',
		'type' => 'text',
		'class' => 'mini'
	);
    
    $options[] = array(
		'desc' => __( 'Height in px. "100%" for full viewport height', 'startup-revolution' ),
		'id' => 'slider-height',
		'std' => '400',
		'type' => 'text',
        'class' => 'mini'
	);
    
    $options[] = array(
		'desc' => __( 'Interval in ms or false', 'startup-revolution' ),
		'id' => 'slider-interval',
		'std' => '4000',
		'type' => 'text',
        'class' => 'mini'
	);
    
    $slider_transition = array(
		'carousel-slide' => __( 'Slide', 'startup-revolution' ),
		'carousel-fade' => __( 'Fade', 'startup-revolution' )
	);
    
    $options[] = array(
		'desc' => __( 'Transition', 'startup-revolution' ),
		'id' => 'slider-transition',
		'std' => 'carousel-fade',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $slider_transition
	);
    
	$options[] = array(
		'desc' => __( 'Show arrows if more than one slide', 'startup-revolution' ),
		'id' => 'slider-arrows',
		'std' => '1',
		'type' => 'checkbox'
	);
    
    require get_template_directory() . '/inc/hover-css.php';
    
    $options[] = array(
		'desc' => __( 'Arrows hover effect', 'startup-revolution' ),
		'id' => 'slider-arrows-hover',
		'std' => 'float',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $hover_css
	);
    
    $slider_navigation= array(
        'slider_no_nav' => __( 'None', 'startup-revolution' ),
		'slider_pagination' => __( 'Pagination', 'startup-revolution' ),
		'slider_content_arrow' => __( 'Content arrow', 'startup-revolution' )
	);
    
    $options[] = array(
		'desc' => __( 'Navigation type', 'startup-revolution' ),
		'id' => 'slider-navigation',
		'std' => 'slider_content_arrow',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $slider_navigation
	);
    
    }
    //*****************************************************************************
    //*****************************************************************************
    //
    // Post types
    //
    //*****************************************************************************
    //*****************************************************************************
    
	$options[] = array(
		'name' => __( 'Post types', 'startup-revolution' ),
		'type' => 'heading'
	);
    
    if (is_plugin_active('startup-cpt-home/startup-cpt-home.php')){
    $options[] = array(
		'name' => __( 'Home', 'startup-revolution' ),
        'desc' => __( 'Generate home content with Home plugin custom post sections. If not, use a classic page with the Home template.', 'startup-revolution' ),
		'id' => 'home-type',
		'std' => '0',
		'type' => 'checkbox'
	);
    }
        
    $blog_styles = array(
		'grid' => __( 'Grid', 'startup-revolution' ),
		'shuffle' => __( 'Shuffle', 'startup-revolution' )
	);
    
	$options[] = array(
		'name' => __( 'Blog', 'startup-revolution' ),
        'desc' => __( 'Style', 'startup-revolution' ),
		'id' => 'blog-style',
		'std' => 'shuffle',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $blog_styles
	);
    
    $blog_filters = array(
		'buttons' => __( 'Buttons', 'startup-revolution' ),
		'dropdown' => __( 'Dropdown', 'startup-revolution' )
	);
    
    $options[] = array(
        'desc' => __( 'Shuffle filter type', 'startup-revolution' ),
		'id' => 'blog-filter',
		'std' => 'dropdown',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $blog_filters
	);
    
    $options[] = array(
		'desc' => __( 'Max number of items to show for grid style. Leave empty for unlimited.', 'startup-revolution' ),
		'id' => 'blog-number',
		'std' => '8',
		'type' => 'text',
		'class' => 'mini'
	);
    
    if (is_plugin_active('startup-cpt-portfolio/startup-cpt-portfolio.php')){
    $portfolio_styles = array(
		'grid' => __( 'Grid', 'startup-revolution' ),
		'shuffle' => __( 'Shuffle', 'startup-revolution' )
	);
    
	$options[] = array(
		'name' => __( 'Portfolio', 'startup-revolution' ),
        'desc' => __( 'Style', 'startup-revolution' ),
		'id' => 'portfolio-style',
		'std' => 'grid',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $portfolio_styles
	);
        
    $options[] = array(
        'desc' => __( 'Display order', 'startup-revolution' ),
		'id' => 'portfolio-order',
		'std' => 'menu_order',
		'type' => 'select',
        'class' => 'mini',
        'options' => array(
		  'rand' => __( 'Random', 'startup-revolution' ),
		  'menu_order' => __( 'Menu order', 'startup-revolution' )
            )
	);
    
    $options[] = array(
		'desc' => __( 'Max number of items to show for grid style. Leave empty for unlimited.', 'startup-revolution' ),
		'id' => 'portfolio-number',
		'std' => '8',
		'type' => 'text',
		'class' => 'mini'
	);
    }
    
    if (is_plugin_active('startup-cpt-testimonials/startup-cpt-testimonials.php')){
    $options[] = array(
		'name' => __( 'Testimonials', 'startup-revolution' ),
        'desc' => __( 'Display order', 'startup-revolution' ),
		'id' => 'testimonials-order',
		'std' => 'rand',
		'type' => 'select',
        'class' => 'mini',
        'options' => array(
		  'rand' => __( 'Random', 'startup-revolution' ),
		  'menu_order' => __( 'Menu order', 'startup-revolution' )
            )
	);
    $options[] = array(
		'desc' => __( 'Max number of items to show. Leave empty for unlimited.', 'startup-revolution' ),
		'id' => 'testimonials-number',
		'std' => '',
		'type' => 'text',
		'class' => 'mini'
	);
    }

    if (is_plugin_active('startup-cpt-partners/startup-cpt-partners.php')){
    $options[] = array(
		'name' => __( 'Partners', 'startup-revolution' ),
        'desc' => __( 'Display order', 'startup-revolution' ),
		'id' => 'partners-order',
		'std' => 'menu_order',
		'type' => 'select',
        'class' => 'mini',
        'options' => array(
		  'rand' => __( 'Random', 'startup-revolution' ),
		  'menu_order' => __( 'Menu order', 'startup-revolution' )
            )
	);
    $options[] = array(
		'desc' => __( 'Max number of items to show. Leave empty for unlimited.', 'startup-revolution' ),
		'id' => 'partners-number',
		'std' => '',
		'type' => 'text',
		'class' => 'mini'
	);
    }
    
    if (is_plugin_active('startup-cpt-milestones/startup-cpt-milestones.php')){
    $options[] = array(
		'name' => __( 'Milestones', 'startup-revolution' ),
        'desc' => __( 'Display order', 'startup-revolution' ),
		'id' => 'milestones-order',
		'std' => 'menu_order',
		'type' => 'select',
        'class' => 'mini',
        'options' => array(
		  'rand' => __( 'Random', 'startup-revolution' ),
		  'menu_order' => __( 'Menu order', 'startup-revolution' )
            )
	);
    $options[] = array(
		'desc' => __( 'Max number of items to show. Leave empty for unlimited.', 'startup-revolution' ),
		'id' => 'milestones-number',
		'std' => '',
		'type' => 'text',
		'class' => 'mini'
	);
    }
    
    if (is_plugin_active('startup-cpt-products/startup-cpt-products.php')){
    $options[] = array(
		'name' => __( 'Products', 'startup-revolution' ),
        'desc' => __( 'Display order', 'startup-revolution' ),
		'id' => 'products-order',
		'std' => 'menu_order',
		'type' => 'select',
        'class' => 'mini',
        'options' => array(
		  'rand' => __( 'Random', 'startup-revolution' ),
		  'menu_order' => __( 'Menu order', 'startup-revolution' )
            )
	);
    $options[] = array(
		'desc' => __( 'Max number of items to show. Leave empty for unlimited.', 'startup-revolution' ),
		'id' => 'products-number',
		'std' => '',
		'type' => 'text',
		'class' => 'mini'
	);
    }
    
    if (is_plugin_active('startup-cpt-projects/startup-cpt-projects.php')){
    $options[] = array(
		'name' => __( 'Projects', 'startup-revolution' ),
        'desc' => __( 'Display order', 'startup-revolution' ),
		'id' => 'projects-order',
		'std' => 'menu_order',
		'type' => 'select',
        'class' => 'mini',
        'options' => array(
		  'rand' => __( 'Random', 'startup-revolution' ),
		  'menu_order' => __( 'Menu order', 'startup-revolution' )
            )
	);
    $options[] = array(
		'desc' => __( 'Max number of items to show. Leave empty for unlimited.', 'startup-revolution' ),
		'id' => 'projects-number',
		'std' => '',
		'type' => 'text',
		'class' => 'mini'
	);
    }
    
    if (is_plugin_active('startup-cpt-services/startup-cpt-services.php')){
    $options[] = array(
		'name' => __( 'Services', 'startup-revolution' ),
        'desc' => __( 'Display order', 'startup-revolution' ),
		'id' => 'services-order',
		'std' => 'menu_order',
		'type' => 'select',
        'class' => 'mini',
        'options' => array(
		  'rand' => __( 'Random', 'startup-revolution' ),
		  'menu_order' => __( 'Menu order', 'startup-revolution' )
            )
	);
    $options[] = array(
		'desc' => __( 'Max number of items to show. Leave empty for unlimited.', 'startup-revolution' ),
		'id' => 'services-number',
		'std' => '',
		'type' => 'text',
		'class' => 'mini'
	);
    }
    
    if (is_plugin_active('startup-cpt-team/startup-cpt-team.php')){
    $options[] = array(
        'name' => __( 'Team', 'startup-revolution' ),
		'desc' => __( 'Carousel if more than 4', 'startup-revolution' ),
		'id' => 'team-slider',
		'std' => '1',
		'type' => 'checkbox'
	);
    $options[] = array(
        'desc' => __( 'Display order', 'startup-revolution' ),
		'id' => 'team-order',
		'std' => 'menu_order',
		'type' => 'select',
        'class' => 'mini',
        'options' => array(
		  'rand' => __( 'Random', 'startup-revolution' ),
		  'menu_order' => __( 'Menu order', 'startup-revolution' )
            )
	);
    $options[] = array(
		'desc' => __( 'Max number of items to show. Leave empty for unlimited.', 'startup-revolution' ),
		'id' => 'team-number',
		'std' => '',
		'type' => 'text',
		'class' => 'mini'
	);
    }

    //*****************************************************************************
    //*****************************************************************************
    //
    // Advanced
    //
    //*****************************************************************************
    //*****************************************************************************
    
	$options[] = array(
		'name' => __( 'Advanced', 'startup-revolution' ),
		'type' => 'heading'
	);
    
	$options[] = array(
		'name' => __( 'Mise en forme automatique', 'startup-revolution' ),
		'desc' => __( 'Cocher pour <strong>desactiver</strong> la mise en forme automatique de l\'editeur WordPress. Evite les br, p, et suppression de lignes vides, etc...', 'startup-revolution' ),
		'id' => 'auto-format-off',
		'std' => '0',
		'type' => 'checkbox'
	);
    
	return $options;
}

function exampletheme_options_after() { ?>
    <p>Content after the options panel!</p>
<?php }

//add_action('optionsframework_after','exampletheme_options_after', 100);