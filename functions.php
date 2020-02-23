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
  add_theme_support( 'post-thumbnails' );
  add_image_size( 'professor-protrait',  480, 680, true );
  add_image_size( 'professor-landscape',  400, 250, true );
  add_image_size( 'page-banner',  1500, 300, true );
}
add_action('after_setup_theme', 'ficuni_theme_features');


function ficuni_adjust_quaries($query){
  if(!is_admin() && is_post_type_archive('program') && $query->is_main_query()){
    $query->set('order', 'ASC');
    $query->set('orderby', 'title');
    $query->set('posts_per_page', -1);
  }

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

function acf_google_map_api( $api ){
	$api['key'] = 'AIzaSyA07Dtq_l8CmBggm61kmXeh1ewyj2oeD2I';
	return $api;
}

add_filter('acf/fields/google_map/api', 'acf_google_map_api');


// Custom Functionality
function page_banner($args = null){
  if(!$args['title']) $args['title'] = get_the_title();
  if(!$args['subtitle']) $args['subtitle'] = get_field('page_banner_subtitle');
  if(!$args['bg-image']){
    if(get_field('page_banner_image')){
      $args['bg-image'] = get_field('page_banner_image');
    } else $args['bg-image'] = get_stylesheet_directory_uri(  ).'/assets/img/ocean.jpg';
  };
  ?>
  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo $args['bg-image']; ?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title"><?php echo $args['title']; ?></h1>
      <div class="page-banner__intro">
        <p><?php echo $args['subtitle']; ?></p>
      </div>
    </div>
  </div>
  <?php
}


/**
 * Custom Post Types
 */
function ficuni_custom_post_types(){
  //Event Post Types
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
  //Program Post Types
  register_post_type( 'program', array(
    'public' => true,
    'supports' => array(
      'title', 'editor'
    ),
    'has_archive' => true,
    'labels' => array(
      'name' => 'Programs',
      'add_new_item' => 'Add new Program',
      'edit_item' => 'Edit Program',
      'all_items' => 'All Programs',
      'singular_name' => 'Program',
    ),
    'menu_icon' => 'dashicons-awards',
    'rewrite' => array(
      'slug' => 'programs'
    ),
  ));

  //Profe Post Types
  register_post_type( 'professor', array(
    'public' => true,
    'supports' => array(
      'title', 'editor', 'thumbnail'
    ),
    'labels' => array(
      'name' => 'Professor',
      'add_new_item' => 'Add Professor',
      'edit_item' => 'Edit Professor',
      'all_items' => 'All Professors',
      'singular_name' => 'Professor',
    ),
    'menu_icon' => 'dashicons-welcome-learn-more',
  ));
  //Event Post Types
  register_post_type( 'campus', array(
    'public' => true,
    'supports' => array(
      'title', 'editor', 'excerpt'
    ),
    'has_archive' => true,
    'labels' => array(
      'name' => 'Campuses',
      'add_new_item' => 'Add new Campus',
      'edit_item' => 'Edit Campus',
      'all_items' => 'All Campuses',
      'singular_name' => 'Campus',
    ),
    'menu_icon' => 'dashicons-location-alt',
    'rewrite' => array(
      'slug' => 'campuses'
    ),
  ));

}
add_action('init', 'ficuni_custom_post_types');

