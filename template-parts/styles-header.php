<?php

require get_template_directory() . '/inc/theme-options.php';

?>

<style>
    <?php
    // On définit l'opacité de la navbar
    if ($navbar_transparent && $navbar_position == 'navbar-fixed-top' ){ ?>
    @media (min-width: 768px){
      body.home #site-navigation.navbar{
        background-color: transparent !important;
      }
      <?php if ( $navbar_translucent ){ ?>
          body.home #site-navigation.navbar:hover{
            background-color: rgba(0, 0, 0, 0.25) !important;
          }
      <?php } ?>
    }
    <?php }
    if ($left_panel_on){
        if ($left_panel_color){ ?>
            #left-panel.mm-menu{
              background: <?php echo $left_panel_color ?>;
            }
        <?php }
    }    
    if ($right_panel_on){
        if ($right_panel_color){ ?>
            #right-panel.mm-menu{
              background: <?php echo $right_panel_color ?>;
            }
        <?php }
    } ?>
    

    /* Navbar */
    #site-navigation.navbar{
      background: <?php echo $navbar_color ?>;
    }

    
    /* Menu class helpers */
    <?php if ( is_user_logged_in () ) { ?>
    .logged-out{
      display: none !important;
    }
    <?php } else { ?>
    .logged-in{
      display: none !important;
    }
    <?php } ?>
        
    /* Custom buttons */
    .btn{
      border-radius: <?php echo $bt_radius ?>px;
    }    
        
    .btn-custom {
      color: <?php echo $bt_text ?>;
      background-color: <?php echo $bt_background ?>;
    }
    .btn-custom:hover,
    .btn-custom:focus,
    .btn-custom:active,
    .btn-custom.active{
      color: <?php echo $bt_hover_text ?>;
      background-color: <?php echo $bt_hover_background ?>;
    }

    <?php if ($custom_css) {echo $custom_css;}?>
    

    body.home #site-navigation.navbar.top-nav-collapse {
      background-color: <?php echo $navbar_color ?> !important;
    }
    
    /* Footer & colophon */
    #secondary-bg,
    #colophon-bg {
      background-color: <?php echo $footer_color ?>;
    }
</style>