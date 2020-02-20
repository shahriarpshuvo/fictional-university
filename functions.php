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


function ficuni_custom_post_types(){
  register_post_type( 'event', array(
    'public' => true,
    'supports' => array(
      'title', 'editor', 'excerpt'
    ),
    'has_archive' => true,
    'labels' => array(
      'name' => 'Events',
      'add_new_item' => 'Add new Event',
      'edit_item' => 'Edit Event',
      'all_items' => 'All Events',
      'singular_name' => 'Event',
    ),
    'menu_icon' => 'dashicons-calendar',
    'rewrite' => array(
      'slug' => 'events'
    ),
  ));

}
add_action('init', 'ficuni_custom_post_types');



function ficuni_adjust_quaries($query){
  if(!is_admin() && is_post_type_archive('event') && $query->is_main_query()){
    $today = date('Ymd');
    $query->set('order', 'ASC');
    $query->set('orderby', 'meta_value_num');
    $query->set('meta_key', 'event_date');
    $query->set('meta_query', array(
      array(
        'key' => 'event_date',
        'compare' => '>=',
        'value' => $today,
        'type' => 'numeric'
      )
    ));
  }
}

add_action('pre_get_posts', 'ficuni_adjust_quaries');