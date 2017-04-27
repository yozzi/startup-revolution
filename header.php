<?php /** * The header for our theme. * * Displays all of the <head> section and everything up till
        <div id="content">
    * * @package StartUp Revolution */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />

<?php

require get_template_directory() . '/inc/theme-options.php';

if ($logo){$body_logo = 'logo-on';} else {$body_logo = 'logo-off';};
if ($navbar_transparent){$body_transparent = 'transparent-on';} else {$body_transparent = 'transparent-off';};

$body_position = NULL;
if ($navbar_position == 'navbar-static-top'){$body_position = 'static-top';};
if ($navbar_position == 'navbar-fixed-top'){$body_position = 'fixed-top';};
if ($navbar_position == 'navbar-fixed-slider'){$body_position = 'fixed-slider';};
if ($navbar_position == 'navbar-static-header'){$body_position = 'static-header';};
if ($navbar_position == 'navbar-fixed-header'){$body_position = 'fixed-header';};
if ($navbar_position == 'navbar-fixed-bottom'){$body_position = 'fixed-bottom';};
if ($navbar_position == 'navbar-normal'){$body_position = NULL;};

<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>

<?php get_template_part( 'template-parts/styles', 'header' ) ?>    

<?php get_template_part( 'template-parts/scripts', 'header' ) ?>
    
</head>
<body <?php body_class( array( $body_transparent, $body_position, $body_logo));?>>
    <?php if( $left_panel_on || $right_panel_on ){ ?>
        <div class="panel-page-container">
            <?php } ?>
            <div class="page-container">   
                
        <div id="page" class="hfeed site">
            
            <?php if( $left_panel_on ){ get_template_part( 'template-parts/panel', 'left' ); } ?>
            <?php if( $right_panel_on ){ get_template_part( 'template-parts/panel', 'right' ); } ?>
            
            <a class="skip-link screen-reader-text" href="#content">
                <?php esc_html_e( 'Skip to content', 'startup-revolution' ); ?>
            </a>

            <?php if(
                        (
                            $navbar_on
                            && $navbar_position != 'navbar-fixed-slider'
                            && $navbar_position != 'navbar-static-header'
                            && $navbar_position != 'navbar-fixed-header'
                        ) || (
                            $navbar_on
                            && !is_front_page()
                            && $navbar_position != 'navbar-static-header'
                            && $navbar_position != 'navbar-fixed-header'
                        )
                    ){ get_template_part( 'template-parts/navbar', 'primary' ); } ?>
        

            <div id="content" class="site-content">
                
                <?php if ( $header ){ ?><header id="head" role="banner"><?php echo do_shortcode(get_post($header)->post_content) ?></header><?php } ?>
                
                <?php if( $navbar_on && ($navbar_position == 'navbar-fixed-header' || $navbar_position == 'navbar-static-header' ) ){ get_template_part( 'template-parts/navbar', 'primary' ); } ?>