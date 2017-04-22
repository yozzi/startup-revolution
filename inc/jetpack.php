<?php
/**
 * Jetpack Compatibility File
 * See: https://jetpack.me/
 *
 * @package StartUp Revolution
 */

/**
 * Add theme support for Infinite Scroll.
 * See: https://jetpack.me/support/infinite-scroll/
 */
function startup_revolution_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'startup_revolution_infinite_scroll_render',
		'footer'    => 'page',
	) );
} // end function startup_revolution_jetpack_setup
add_action( 'after_setup_theme', 'startup_revolution_jetpack_setup' );

function startup_revolution_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content', get_post_format() );
	}
} // end function startup_revolution_infinite_scroll_render