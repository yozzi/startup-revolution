<?php
    
    require get_template_directory() . '/inc/theme-options.php';

    $this_post_header_visible = get_post_meta( get_the_ID(), '_startup_revolution_posts_header_visible', true );
    if ( !$this_post_header_visible ) { $this_post_header_visible = $page_header_visible; };
    $this_post_header_background_color = get_post_meta( get_the_ID(), '_startup_revolution_posts_header_background_color', true );
    if ( !$this_post_header_background_color ) { $this_post_header_background_color = $page_header_background_color; };
    $this_post_header_color = get_post_meta( get_the_ID(), '_startup_revolution_posts_header_color', true );
    if ( !$this_post_header_color ) { $this_post_header_color = $page_header_color; };
    $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
    $this_post_header_background = $thumb['0'];
    $this_post_header_background_position = get_post_meta( get_the_ID(), '_startup_revolution_posts_header_background_position', true );
    $this_post_header_padding = get_post_meta( get_the_ID(), '_startup_revolution_posts_header_padding', true );
    if ( !$this_post_header_padding ) { $this_post_header_padding = $page_header_padding; };
    $this_post_header_position = get_post_meta( get_the_ID(), '_startup_revolution_posts_header_position', true );
    if ( !$this_post_header_position ) { $this_post_header_position = $page_header_position; };
    $this_post_header_effect = get_post_meta( get_the_ID(), '_startup_revolution_posts_header_effect', true );
    $this_post_header_boxed = get_post_meta( get_the_ID(), '_startup_revolution_posts_header_boxed', true );
    if ( !$this_post_header_boxed ) { $this_post_header_boxed = $page_header_boxed; };
    $this_post_header_parallax = get_post_meta( get_the_ID(), '_startup_revolution_posts_header_parallax', true );

    if (!is_front_page() && !$this_post_header_visible ){?>
        <header class="entry-header <?php echo $this_post_header_position ?>" style="<?php if ( $this_post_header_color ){ echo 'color:' . $this_post_header_color . ';'; }; if ( $this_post_header_background && $this_post_header_parallax == '' ){  echo 'background: url(' . $this_post_header_background . '); background-size:cover; background-position: center ' . $this_post_header_background_position . ';';} elseif ( $this_post_header_background_color && $this_post_header_parallax == '' ) { echo 'background: ' . $this_post_header_background_color . ';' ?>" <?php if ( $this_post_header_parallax ){ echo 'data-parallax="scroll" data-image-src="' . $this_post_header_background[0] . '"'; } ?><?php } ?>>
            
            <div class="effect <?php echo $this_post_header_effect; ?>" style="<?php if ( $this_post_header_padding ){ echo 'padding-top:' . $this_post_header_padding . 'px;padding-bottom:' . $this_post_header_padding . 'px;'; } ?>">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <?php if ( $this_post_header_boxed ){ the_title( '<h1 class="entry-title boxed">', '</h1>' ); }  
                                    else { the_title( '<h1 class="entry-title">', '</h1>' ); } ?>                                                      
                                <?php if ( $this_post_header_boxed ){ ?><h2 class="boxed"><?php startup_revolution_posted_on(); ?></h2>
                                <?php } else { ?><h2><?php startup_revolution_posted_on(); ?></h2><?php } ?>
                            </div>
                        </div>

                    </div>

                </div>
        </header><!-- .entry-header -->
    <?php } else { ?>
        <header class="entry-header">
            <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

            <div class="entry-meta">
                <?php startup_revolution_posted_on(); ?>
            </div><!-- .entry-meta -->
	   </header><!-- .entry-header -->
    <?php } ?>