<?php
/**
* Template Name: Portfolio */

get_header();

require get_template_directory() . '/inc/theme-options.php';

?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
            
            <?php while ( have_posts() ) : the_post(); ?>
                <?php get_template_part( 'template-parts/title', 'page' ); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <div class="entry-content">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php get_template_part( 'template-parts/content', 'portfolio' ); ?>
                                </div>
                            </div>
                       </div>
                    </div><!-- .entry-content -->
                </article><!-- #post-## -->

			<?php endwhile; // end of the loop. ?>
            
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>