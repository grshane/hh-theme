<?php
/**
 * Front Page template for Holistic theme. Optionally adds widget areas to be used in addition
 * to a static home page.
 *
 * With help from @link http://robincornette.com/
 * @author  Macchaito Marketing
 * @license GPL-2.0+
 * @link    http://macchiatomarketing.com/
 */
add_action( 'genesis_meta', 'holistic_horse_front_page_meta' );
function holistic_horse_front_page_meta() {
    if ( is_active_sidebar( 'home-top' ) || ( ( is_active_sidebar( 'home-left' ) && is_active_sidebar( 'home-right' ) ) ) ) { // check for active home widgets. if using right/left, both must have content. for balance.
        if ( is_singular() ) { // check if the home page is a static page
            remove_action( 'genesis_entry_header', 'genesis_do_post_title' ); // if it is, remove the page title.
            add_action( 'genesis_entry_header', 'holistic_horse_home_featured_image' ); // if it is, display the featured image in the page header
        }
        else {
            remove_action( 'genesis_loop', 'genesis_do_loop' ); // if it's not a static page and widget areas are active, remove the loop (latest posts)
        }
        add_action( 'genesis_before_loop', 'holistic_horse_home_widgets' ); // regardless, show the widgets.
    }
}
function holistic_horse_home_featured_image() { // display the featured image for the front page. Large, please.
    global $post;
    $image = get_the_post_thumbnail( $post->ID, 'original', array( 'alt' => the_title_attribute( 'echo=0' ), 'title' => the_title_attribute( 'echo=0' ) ) );
    echo $image;
}
function holistic_horse_home_widgets() {
    if ( is_active_sidebar( 'home-top' ) ) {
        echo '<div class="home-top">';
            genesis_widget_area( 'home-top' );
        echo '</div>';
    }
    if ( is_active_sidebar( 'front-page-2' ) ) {
        echo '<div class="front-page-2">';
            genesis_widget_area( 'front-page-2' );
        echo '</div>';
    }
    if ( is_active_sidebar( 'front-page-3' ) ) {
        echo '<div class="front-page-3">';
        genesis_widget_area( 'front-page-3' );
        echo '</div>';
    }
    if ( is_active_sidebar( 'home-left' ) && is_active_sidebar( 'home-right' ) ) { // both left and right widget areas need to have content. balance.
        echo '<div class="home-left one-half first">';
            genesis_widget_area( 'home-left' );
        echo '</div>';
        echo '<div class="home-right one-half">';
            genesis_widget_area( 'home-right' );
        echo '</div>';
    }
}
genesis();