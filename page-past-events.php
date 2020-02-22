<?php get_header(); 
page_banner(array(
  'title' => 'Past Events',
  'subtitle' => 'See recap of all past the events.',
));
?>

<div class="container container--narrow page-section">
  <?php 
    $today = date('Ymd');
    $events = new WP_Query(
      array(
        'paged' => get_query_var( 'paged', 1 ),
        'post_type' => 'event',
        'posts_per_page' => 1,
        'orderby' => 'meta_value_num',
        'meta_key' => 'event_date',
        'meta_query' => array(
          array(
            'key' => 'event_date',
            'compare' => '<',
            'value' => $today,
            'type' => 'numeric'
          )
        ),
        
      )
    );
    while($events->have_posts()): $events->the_post(); 
      get_template_part( 'template-parts/content', 'event' );
    endwhile; 
      echo paginate_links(
        array(
          'total' => $events->max_num_pages
        )
      );
    ?>
  <div>

    <?php get_footer(); ?> 