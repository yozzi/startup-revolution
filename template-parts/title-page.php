<?php

    require get_template_directory() . '/inc/theme-options.php';

    $this_page_header_visible = get_post_meta( get_the_ID(), '_startup_revolution_pages_header_visible', true );
    if ( !$this_page_header_visible ) { $this_page_header_visible = $page_header_visible; };
    $this_page_header_background_color = get_post_meta( get_the_ID(), '_startup_revolution_pages_header_background_color', true );
    if ( !$this_page_header_background_color ) { $this_page_header_background_color = $page_header_background_color; };
    $this_page_header_color = get_post_meta( get_the_ID(), '_startup_revolution_pages_header_color', true );
    if ( !$this_page_header_color ) { $this_page_header_color = $page_header_color; };
    $this_page_header_subtitle = get_post_meta( get_the_ID(), '_startup_revolution_pages_header_subtitle', true );
    $this_page_header_background = wp_get_attachment_image_src( get_post_meta( get_the_ID(), '_startup_revolution_pages_header_background_id', 1 ), 'large' );
    $this_page_header_background_position = get_post_meta( get_the_ID(), '_startup_revolution_pages_header_background_position', true );
    $this_page_header_padding = get_post_meta( get_the_ID(), '_startup_revolution_pages_header_padding', true );
    if ( !$this_page_header_padding ) { $this_page_header_padding = $page_header_padding; };
    $this_page_header_position = get_post_meta( get_the_ID(), '_startup_revolution_pages_header_position', true );
    if ( !$this_page_header_position ) { $this_page_header_position = $page_header_position; };
    $this_page_header_effect = get_post_meta( get_the_ID(), '_startup_revolution_pages_header_effect', true );
    $this_page_header_boxed = get_post_meta( get_the_ID(), '_startup_revolution_pages_header_boxed', true );
    if ( !$this_page_header_boxed ) { $this_page_header_boxed = $page_header_boxed; };
    $this_page_header_parallax = get_post_meta( get_the_ID(), '_startup_revolution_pages_header_parallax', true );

    if (!is_front_page() && !$this_page_header_visible ){?>
        <header class="entry-header <?php echo $this_page_header_position ?>" style="<?php if ( $this_page_header_color ){ echo 'color:' . $this_page_header_color . ';'; }; if ( $this_page_header_background && $this_page_header_parallax == '' ){  echo 'background: url(' . $this_page_header_background[0] . '); background-size:cover; background-position: center ' . $this_page_header_background_position . ';';} elseif ( $this_page_header_background_color && $this_page_header_parallax == '' ) { echo 'background: ' . $this_page_header_background_color . ';'; ?>" <?php if ( $this_page_header_parallax ){ echo 'data-parallax="scroll" data-image-src="' . $this_page_header_background[0] . '"'; } ?><?php } ?>>
            <div class="effect <?php echo $this_page_header_effect; ?>" style="<?php if ( $this_page_header_padding ){ echo 'padding-top:' . $this_page_header_padding . 'px;padding-bottom:' . $this_page_header_padding . 'px;'; } ?>">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                        <?php if ( $this_page_header_boxed ){ the_title( '<h1 class="entry-title boxed">', '</h1>' ); }  
                                            else { the_title( '<h1 class="entry-title">', '</h1>' ); } ?>                                                      
                                        <?php if ( $this_page_header_subtitle && $this_page_header_boxed ){ echo '<h2 class="boxed">' . $this_page_header_subtitle . '</h2>'; }  
                                            else if ( $this_page_header_subtitle ){ echo '<h2>' . $this_page_header_subtitle . '</h2>'; } ?>
                            </div>
                        </div>
                    </div>
            </div>
        </header><!-- .entry-header -->
<?php } ?>