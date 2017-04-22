<?php

    require get_template_directory() . '/inc/theme-options.php';

    if (($blog_number) && ($blog_style != 'shuffle')) {$max = $blog_number;} else {$max = -1;};
    $args = array( 'post_type'=>'post', 'orderby' => 'date','order' => 'DESC', 'numberposts' => $max );
    $blog = get_posts( $args );   
?>

<section id="blog"<?php if ( $atts['bg'] ) { ?> style="background:<?php echo $atts['bg'] ?>"<?php } ?>>
    <?php if (is_front_page()) { ?><div class="container"><?php } ?>
        <?php if ( $blog_style == 'shuffle' && $blog_filter == 'buttons' ) { ?>
            <ul id="filter" class="nav nav-pills">
                <li><a class="active" href="#" data-group="all"><?php _e( 'All', 'startup-reloaded' ) ?></a></li>
                <?php 
                    $args = array( 'hide_empty' => 0 );
                    $myterms = get_terms( 'category', $args );
                    if ( ! empty( $myterms ) && ! is_wp_error( $myterms ) ){
                        foreach ( $myterms as $myterms ) {
                            echo '<li><a href="#" data-group="' . $myterms->slug . '">' . $myterms->name . '</a></li>';
                        }
                    }
                ?>
            </ul>

        <?php } elseif ( $blog_style == 'shuffle' && $blog_filter == 'dropdown' ) { ?>



        <div class="dropdown">
          <button class="btn btn-custom dropdown-toggle" type="button" id="filter-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <?php _e( 'Filter', 'startup-reloaded' ) ?>
            <span class="caret"></span>
          </button>
          <ul id="filter" class="dropdown-menu" aria-labelledby="filter-btn">
            <li><a class="active" href="#" data-group="all"><?php _e( 'All', 'startup-reloaded' ) ?></a></li>
            <?php 
                $args = array( 'hide_empty' => 0 );
                $myterms = get_terms( 'category', $args );
                if ( ! empty( $myterms ) && ! is_wp_error( $myterms ) ){
                    foreach ( $myterms as $myterms ) {
                        echo '<li><a href="#" data-group="' . $myterms->slug . '">' . $myterms->name . '</a></li>';
                    }
                }
            ?>
          </ul>
        </div>


         <?php } ?>






        <?php if ($blog_style == 'shuffle'){ ?>
            <div id="shuffle" class="row">
                <?php foreach ($blog as $key=> $post) {
                    $categories = get_the_terms( $post->ID, 'category' );
                    $image = get_the_post_thumbnail($post->ID, 'col-3-square');
                    $format = get_post_format($post->ID);
                    $link = get_post_meta( $post->ID, '_startup_reloaded_posts_link_url', true );
                    if ( $format == 'image' ) {
                        $icon = 'camera';
                    } else if ( $format == 'audio' ) {
                        $icon = 'music';
                    } else if ( $format == 'video' ) {
                        $icon == 'video-camera';
                    } else if ( $format == 'link' ) {
                        $icon = 'link';
                    } else {
                        $icon = 'pencil';
                    }
                ?>
                    <div class="item col-xs-12 col-sm-6 col-md-4 col-lg-3" data-groups='[<?php if ( $categories ) { foreach( $categories as $category ) { print '"' . $category->slug . '",'; unset($category); } } ?>"all"]'>
                        <div class="post">
                            <?php if ( $image ) { ?>
                                <div class="post-thumbnail">  
                                     <?php echo $image ?>
                                </div>
                            <?php } ?>
                            <div class="post-details">
                                <h4><?php if ( $icon ) { ?><i class="fa fa-<?php echo $icon ?>"></i><?php } ?><span class="pull-right"><?php the_time('d/m/Y') ?> <i class="fa fa-clock-o"></i></span></h4>
								<h3><?php echo $post->post_title ?></h3>
                                
                                                            <?php               
                                if( has_excerpt() ){
                                    $content = $post->post_excerpt;
                                } else {
                                    $content = $post->post_content;
                                } ?>
                                <p><?php echo $content ?></p>
                                    <a href="<?php echo get_permalink( $post->ID ) ?>" class="btn btn-custom btn-sm btn-block" role="button" target="_blank"><?php _e( 'Lire la suite', 'startup-reloaded' ) ?></a>
                            </div>        
                        </div>
                    </div>
                <?php } ?>
            </div>

        <?php } else { ?>
            <div id="grid" class="row no-gutters">
                <?php foreach ($blog as $key=> $post) {
                    $categories = get_the_terms( $post->ID, 'category' );
                    $image = get_the_post_thumbnail($post->ID, 'col-3-square');
                ?>
                    <div class="item col-xs-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="blog-item">
                            <div class="blog-item-thumbnail">  
                                <?php if ( $image ) { echo $image; } ?>
                                <div class="blog-item-details">
                                    <a href="<?php echo esc_url( get_permalink($post->ID) ) ?>"><div class="caption"><i class="fa fa-plus-circle fa-5x"></i></div></a>
                                </div>
                            </div>       
                        </div>
                    </div>
                <?php } // endforeach ?>
            </div>
        <?php } ?>
    
    
    <?php if (is_front_page()) { ?></div><?php } ?>
</section>