<?php

    require get_template_directory() . '/inc/theme-options.php';

    if (($portfolio_number) && ($portfolio_style != 'shuffle')) {$max = $portfolio_number;} else {$max = -1;};
    $args = array( 'post_type'=>'portfolio', 'orderby' => $portfolio_order,'order' => 'ASC', 'numberposts' => $max );
    $portfolio = get_posts( $args );
    $total_portfolio = count($portfolio);
?>

<section id="portfolio"<?php if ( $atts['bg'] ) { ?> style="background:<?php echo $atts['bg'] ?>"<?php } ?>>
    <?php if (is_front_page()) { ?><div class="container"><?php } ?>
        <?php if ($portfolio_style == 'shuffle'){ ?>
            <ul id="filter" class="nav nav-pills">
                <li><a class="active" href="#" data-group="all"><?php _e( 'All', 'startup-reloaded' ) ?></a></li>
                <?php 
                    $args = array( 'hide_empty' => 0 );
                    $myterms = get_terms( 'portfolio-category', $args );
                    if ( ! empty( $myterms ) && ! is_wp_error( $myterms ) ){
                        foreach ( $myterms as $myterms ) {
                            echo '<li><a href="#" data-group="' . $myterms->slug . '">' . $myterms->name . '</a></li>';
                        }
                    }
                ?>
            </ul>
        <?php } ?>

        <?php if ($portfolio_style == 'shuffle'){ ?>
            <div id="shuffle" class="row">
                <?php foreach ($portfolio as $key=> $portfolio_item) {
                    $thumbnail = wp_get_attachment_image( get_post_meta( $portfolio_item->ID, '_startup_cpt_portfolio_thumbnail_id', 1 ), 'col-3-full' );
                    $main_pic = wp_get_attachment_image( get_post_meta( $portfolio_item->ID, '_startup_cpt_portfolio_main_pic_id', 1 ), 'col-3-full' );
                    $detail_thumbnail = wp_get_attachment_image( get_post_meta( $portfolio_item->ID, '_startup_cpt_portfolio_main_pic_id', 1 ), 'col-8-full' );
                    $detail_pic = wp_get_attachment_image( get_post_meta( $portfolio_item->ID, '_startup_cpt_portfolio_main_pic_id', 1 ), 'col-8-full' );
                    $gallery  = get_post_meta( $portfolio_item->ID, '_startup_cpt_portfolio_gallery', true );
                    $short = get_post_meta( $portfolio_item->ID, '_startup_cpt_portfolio_short', true );
                    $description  = get_post_meta( $portfolio_item->ID, '_startup_cpt_portfolio_description', true );
                    $categories = get_the_terms( $portfolio_item->ID, 'portfolio-category' );
                    $client  = get_post_meta( $portfolio_item->ID, '_startup_cpt_portfolio_client', true );
                    $date  = get_post_meta( $portfolio_item->ID, '_startup_cpt_portfolio_date', true );
                    $url  = get_post_meta( $portfolio_item->ID, '_startup_cpt_portfolio_url', true );
                ?>
                    <div class="item col-xs-12 col-sm-6 col-md-4 col-lg-3" data-groups='[<?php if ( $categories ) { foreach( $categories as $category ) { print '"' . $category->slug . '",'; unset($category); } } ?>"all"]'>
                        <div class="portfolio-item">
                            <div class="portfolio-item-thumbnail">  
                                <?php if ( $thumbnail ) { $image = $thumbnail; }
                                elseif ( $main_pic ) { $image = $main_pic; }
                                else { $image = __( 'Image missing!', 'startup-reloaded' ); } ?>
                                <?php echo $image ?>
                            </div>
                            <div class="portfolio-item-details">
                                <h4><?php echo $portfolio_item->post_title ?></h4>

                                    <?php if ( $short ) { echo '<p>' . esc_html( $short ) . '</p>'; } ?>

                                    <a href="#" data-toggle="modal" data-target="#myModal-<?php echo $portfolio_item->ID ?>" class="btn btn-custom btn-lg btn-block" role="button"><?php _e( 'More information', 'startup-reloaded' ) ?></a>
                            </div>

                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade simple" id="myModal-<?php echo $portfolio_item->ID ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="container">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>     
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8 col-sm-offset-2">
                                          <div class="modal-header">
                                            <h2 class="modal-title" id="myModalLabel"><?php echo $portfolio_item->post_title ?></h2>
                                            <hr class="star-primary" />
                                          </div>
                                          <div class="modal-body">
                                            <?php if ( $gallery ) { ?>
                                                <div id="carousel-popup-<?php echo $portfolio_item->ID ?>" class="carousel slide" data-ride="carousel">
                                                    <!-- Wrapper for slides -->
                                                    <div class="carousel-inner">
                                                        <?php $x = 1;
                                                        foreach ( $gallery as $attachment_id => $img_portfolio_main_url ) { ?>
                                                            <div class="item <?php echo ( $x==1 ) ? 'active' : '' ?>">
                                                                <?php $image = wp_get_attachment_image($attachment_id, 'col-3-crop'); ?>
                                                                <a href="#carousel-popup-<?php echo $portfolio_item->ID ?>" role="button" data-slide="next"><?php echo $image ?></a>
                                                            </div>
                                                        <?php $x++;
                                                        } ?>                      
                                                    </div>
                                                        <!-- Controls -->
                                                        <div class="carousel-arrow left hvr-<?php echo $slider_arrows_hover ?> hidden-xs">                                       
                                                            <a class="left carousel-control" href="#carousel-popup-<?php echo $portfolio_item->ID ?>" role="button" data-slide="prev">
                                                                <i class="fa fa-chevron-left fa-lg"></i>
                                                            </a>                
                                                        </div>
                                                        <div class="carousel-arrow right hvr-<?php echo $slider_arrows_hover ?> hidden-xs">
                                                           <a class="right carousel-control" href="#carousel-popup-<?php echo $portfolio_item->ID ?>" role="button" data-slide="next">
                                                                <i class="fa fa-chevron-right fa-lg"></i>
                                                            </a>
                                                        </div>
                                                </div>
                                                <?php } elseif ( $detail_pic ) { $image = $detail_pic; }
                                                    elseif ( $detail_thumbnail ) { $image = $detail_thumbnail; }
                                                    else { $image = __( 'Image missing!', 'startup-reloaded' ); } ?>
                                            <?php echo $image ?>

                                            <div class="modal-description">  
                                            <?php if ( $description ) { 
                                                    if( $auto_format_off == 1 ){
                                                        echo '<p>' . $description . '</p>';
                                                    } else {
                                                        echo '<p>' . wpautop( $description ) . '</p>';
                                                    }
                                                } ?>

                                            </div>
                                          </div>
                                          <div class="modal-footer">
                                            <?php if ($client || $date){ ?>
                                                <div class="well well-sm">
                                                    <?php if($client) { ?><?php _e( 'Client', 'startup-reloaded' ) ?>: <strong><?php echo $client ?></strong><?php } ?> <?php if($date) { ?><?php _e( 'Date', 'startup-reloaded' ) ?>: <strong><?php echo gmdate("m/Y", $date) ?></strong><?php } ?>
                                                </div>
                                            <?php } ?>
                                            <?php if($url) { ?><a href="<?php echo $url ?>" class="btn btn-custom" target="_blank"><?php _e( 'Visit', 'startup-reloaded' ) ?></a><?php }?>
                                          </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>
                <?php } // endforeach ?>
            </div>
        <?php } else { ?>
            <div id="grid" class="row no-gutters">
                <?php foreach ($portfolio as $key=> $portfolio_item) {
                    $thumbnail = wp_get_attachment_image( get_post_meta( $portfolio_item->ID, '_startup_cpt_portfolio_thumbnail_id', 1 ), 'col-3-square' );
                    $main_pic = wp_get_attachment_image( get_post_meta( $portfolio_item->ID, '_startup_cpt_portfolio_main_pic_id', 1 ), 'col-3-square' );
                    $detail_thumbnail = wp_get_attachment_image( get_post_meta( $portfolio_item->ID, '_startup_cpt_portfolio_main_pic_id', 1 ), 'col-8-full' );
                    $detail_pic = wp_get_attachment_image( get_post_meta( $portfolio_item->ID, '_startup_cpt_portfolio_main_pic_id', 1 ), 'col-8-full' );
                    $gallery  = get_post_meta( $portfolio_item->ID, '_startup_cpt_portfolio_gallery', true );
                    $description  = get_post_meta( $portfolio_item->ID, '_startup_cpt_portfolio_description', true );
                    $client  = get_post_meta( $portfolio_item->ID, '_startup_cpt_portfolio_client', true );
                    $date  = get_post_meta( $portfolio_item->ID, '_startup_cpt_portfolio_date', true );
                    $url  = get_post_meta( $portfolio_item->ID, '_startup_cpt_portfolio_url', true );
                ?>
                    <div class="item col-xs-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="portfolio-item">
                            <div class="portfolio-item-thumbnail">  
                                <?php if ( $thumbnail ) { $image = $thumbnail; }
                                elseif ( $main_pic ) { $image = $main_pic; }
                                else { $image = __( 'Image missing!', 'startup-reloaded' ); } ?>
                                <?php echo $image ?>
                                <div class="portfolio-item-details">
                                    <a href="#" data-toggle="modal" data-target="#myModal-<?php echo $portfolio_item->ID ?>"><div class="caption"><i class="fa fa-plus-circle fa-5x"></i></div></a>
                                </div>
                            </div>       
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade simple" id="myModal-<?php echo $portfolio_item->ID ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="container">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times fa-2x"></i></span></button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8 col-sm-offset-2">
                                          <div class="modal-header">
                                            <h2 class="modal-title" id="myModalLabel"><?php echo $portfolio_item->post_title ?></h2>
                                            <hr class="star-primary" />
                                          </div>
                                          <div class="modal-body">

                                            <?php if ( $detail_pic ) { $image = $detail_pic; }
                                                    elseif ( $detail_thumbnail ) { $image = $detail_thumbnail; }
                                                    else { $image = __( 'Image missing!', 'startup-reloaded' ); } ?>
                                            <?php echo $image ;?>

                                            <div class="modal-description">  
                                            <?php if ( $description ) { 
                                                    if( $auto_format_off == 1 ){
                                                        echo '<p>' . $description . '</p>';
                                                    } else {
                                                        echo '<p>' . wpautop( $description ) . '</p>';
                                                    }
                                                } ?>

                                            </div>
                                          </div>
                                          <div class="modal-footer">
                                            <?php if ($client || $date){ ?>
                                                <div class="well well-sm">
                                                    <?php if($client) { ?><?php _e( 'Client', 'startup-reloaded' ) ?>: <strong><?php echo $client ?></strong><?php } ?> <?php if($date) { ?><?php _e( 'Date', 'startup-reloaded' ) ?>: <strong><?php echo gmdate("m/Y", $date) ?></strong><?php } ?>
                                                </div>
                                            <?php } ?>
                                            <?php if($url) { ?><a href="<?php echo $url ?>" class="btn btn-custom" target="_blank"><?php _e( 'Visit', 'startup-reloaded' ) ?></a><?php }?>
                                          </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>



                <?php } // endforeach ?>
            </div>
        <?php } ?>
    <?php if (is_front_page()) { ?></div><?php } ?>
</section>