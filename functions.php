<?php 

function ficuni_enqueue_scripts(){

  wp_enqueue_style( 'fciuni-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i', null, '1.0.1', 'all' );
  wp_enqueue_style( 'fciuni-fontawesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', null, '1.0.1', 'all' );
  wp_enqueue_style( 'ficuni-style', get_stylesheet_uri() );
  wp_enqueue_style( 'ficuni-app', get_stylesheet_directory_uri().'/assets/css/app.min.css', null, '1.0.1', 'all' );

  wp_enqueue_script( 'ficuni-app', get_stylesheet_directory_uri().'/assets/js/app.min.js', null, '1.0.1', true );

}

add_action( 'wp_enqueue_scripts', 'ficuni_enqueue_scripts');

function ficuni_theme_features(){
  
  $navmenu = array(
    'footer_menu_one' => __( ' Footer Menu 1', 'ficuni' ),
    'footer_menu_two' => __( 'Footer Menu 2', 'ficuni' ),
  );
  
  register_nav_menus( 
    $navmenu
  );

  add_theme_support( 'title-tag' );
}

add_action('after_setup_theme', 'ficuni_theme_features');