<?php get_header(); 
    page_banner(array(
        'title' => 'Programs',
        'subtitle' => 'See what we teaches at our university.'
    ));
?>

<div class="container container--narrow page-section">
  
  <ul class="link-list min-list">
  <?php while(have_posts()):the_post();?>
    <li><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></li>
  <?php endwhile; ?>
  </ul>
<div>

<?php get_footer(); ?>