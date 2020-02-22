<?php 
  get_header(); 
  page_banner(array(
    'title' => 'University Events',
    'subtitle' => 'See all the events of our university.'
  ));
?>

<div class="container container--narrow page-section">
  <?php 
  while(have_posts()):the_post(); 
    get_template_part( 'template-parts/content', 'event' );
  endwhile; echo paginate_links(); ?>

  <hr class="section-break">
  <h3>Looking of recap of the past events. <a href="<?php echo site_url('/past-events')?>">Check Here &raquo;</a></h3>
<div>

<?php get_footer(); ?>