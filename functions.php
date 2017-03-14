<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Genesis Sample Theme' );
define( 'CHILD_THEME_URL', 'http://www.studiopress.com/' );
define( 'CHILD_THEME_VERSION', '2.2.2' );

//* Enqueue Google Fonts
add_action( 'wp_enqueue_scripts', 'genesis_sample_google_fonts' );
function genesis_sample_google_fonts() {

	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Lato:300,400,700', array(), CHILD_THEME_VERSION );
    wp_enqueue_style( 'fontawesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css', array(), '4.3.0' );

}

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

//* Add Accessibility support
add_theme_support( 'genesis-accessibility', array( 'headings', 'drop-down-menu',  'search-form', 'skip-links', 'rems' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for custom background
add_theme_support( 'custom-background' );

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

//* Add support of WooCommerce
add_theme_support( 'genesis-connect-woocommerce' );

//* Enqueue JS
add_action( 'wp_enqueue_scripts', 'sk_enqueue_scripts' );
function sk_enqueue_scripts() {

    wp_enqueue_script( 'header-shrink',  get_stylesheet_directory_uri() . '/js/global.js', array( 'jquery' ), '1.0.0', true );
      //* Also include Dashicons for the iconography
      wp_enqueue_style( 'dashicons' );

}
// Add opening tag of a custom div to wrap .site-header and .nav-primary
add_action( 'genesis_before_header', 'sk_header_opening' );
function sk_header_opening() {
    echo '<div class="header">';
}

// Add closing tag of a custom div to wrap .site-header and .nav-primary
add_action( 'genesis_after_header', 'sk_header_closing' );
function sk_header_closing() {
    echo '</div>';
}

//* Remove the header right widget area
//unregister_sidebar( 'header-right' );

/* Register widget areas */
genesis_register_sidebar( array(
    'id'          => 'home-top',
    'name'        => __( 'Home Top', 'holistic-horse' ),
    'description' => __( 'This is the home top.', 'holistic-horse' ),
) );
genesis_register_sidebar( array(
    'id'          => 'front-page-2',
    'name'        => __( 'Front Page 2', 'holistic-horse' ),
    'description' => __( 'This is the front page 2 section.', 'holistic-horse' ),
) );
genesis_register_sidebar( array(
    'id'          => 'front-page-3',
    'name'        => __( 'Front Page 3', 'holistic-horse' ),
    'description' => __( 'This is the front page 3 section.', 'holistic-horse' ),
) );


/* Register utility bar widgets */
genesis_register_sidebar( array(
    'id'          => 'utility-bar-left',
    'name'        => __( 'Utility Bar Left', 'holistic-horse' ),
    'description' => __( 'This is the left utility bar section.', 'holistic-horse' ),
) );

genesis_register_sidebar( array(
    'id'          => 'utility-bar-right',
    'name'        => __( 'Utility Bar Right', 'holistic-horse' ),
    'description' => __( 'This is the right utility bar section.', 'holistic-horse' ),
) );

add_action( 'genesis_before_header', 'utility_bar' );
/**
 * Add utility bar above header.
 *
 * @author Carrie Dils
 * @copyright Copyright (c) 2013, Carrie Dils
 * @license GPL-2.0+
 */
function utility_bar() {

    echo '<div class="utility-bar"><div class="wrap">';

    genesis_widget_area( 'utility-bar-left', array(
        'before' => '<div class="utility-bar-left">',
        'after' => '</div>',
    ) );

    genesis_widget_area( 'utility-bar-right', array(
        'before' => '<div class="utility-bar-right">',
        'after' => '</div>',
    ) );

    echo '</div></div>';

}

// Move secondary nav
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_before', 'genesis_do_subnav', 1 );

function holistichorse_menu_attribute_add( $atts, $item, $args )
    {
      // Set the menu ID
      $menu_link = 4096;
      // Conditionally match the ID and add the attribute and value
      if ($item->ID == $menu_link) {
        $atts['class'] = 'menu-btn';
      }
      //Return the new attribute
      return $atts;
    }

add_action( 'genesis_header', 'ck_menu_button', 14 );
function ck_menu_button() {

  //* Only add the Menu button if a primary navigation is set. You can switch this for whatever menu you are dealing with
  if ( has_nav_menu( "secondary" ) ) {

    add_filter( 'nav_menu_link_attributes', 'holistichorse_menu_attribute_add', 10, 3 );

  }


}
//* Add the "Close Navigation" text to the Primary menu output.
add_filter( 'genesis_nav_items', 'ck_close_btn', 10, 2 );
add_filter( 'wp_nav_menu_items', 'ck_close_btn', 10, 2 );
function ck_close_btn($menu, $args) {

  $extras = '<a href="#" class="close-btn"><em>' . __( 'Close Navigation', 'CHILD_THEME_TEXT_DOMAIN' ) . '</em> <span class="dashicons dashicons-no"></span></a>';

  if ( $args->theme_location == "secondary" ) {

    return $extras . $menu;

  } else {

    return $menu;

  }

}

/**
  * Add the overlay div that will be used for clicking out of the active menu.
  * @author Calvin Koepke (@cjkoepke)
  * @link http://www.calvinkoepke.com/add-a-mobile-friendly-off-canvas-menu-in-genesis
*/
add_action( 'genesis_before', 'ck_site_overlay', 2 );
function ck_site_overlay() {

  echo '<div class="site-overlay"></div>';
}


function tachp_search_form($html)
{
    $html = str_replace('placeholder="Search this website', 'placeholder="Search for all natural products ', $html);

    return $html;
}
add_filter('get_search_form', 'tachp_search_form');

@ini_set( 'upload_max_size' , '64M' );
@ini_set( 'post_max_size', '64M');
@ini_set( 'max_execution_time', '300' );