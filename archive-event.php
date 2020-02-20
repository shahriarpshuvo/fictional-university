<?php get_header(); ?>

<div class="page-banner">
  <div class="page-banner__bg-image"
    style="background-image: url(<?php echo get_theme_file_uri('/assets/img/ocean.jpg'); ?>);">
  </div>
  <div class="page-banner__content container container--narrow">
    <h1 class="page-banner__title">University Events</h1>
    <div class="page-banner__intro">
      <p>See all the events of our university.</p>
    </div>
  </div>
</div>

<div class="container container--narrow page-section">
  <?php


    while(have_posts()):the_post(); 
  ?>

  <div class="event-summary">
    <a class="event-summary__date t-center" href="<?php the_permalink(); ?>">
    <?php $event_date = new DateTime(get_field('event_date'));?>
      <span class="event-summary__month"><?php echo $event_date->format('M'); ?></span>
      <span class="event-summary__day"><?php echo $event_date->format('d'); ?></span>
    </a>
    <div class="event-summary__content">
      <h5 class="event-summary__title headline headline--tiny"><a
          href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
      <p><?php echo wp_trim_words(get_the_content(), 20)?> <a href="<?php the_permalink(); ?>"
          class="nu gray">Learn more</a></p>
    </div>
  </div>

  <?php endwhile; 
      echo paginate_links();
    ?>

    <hr class="section-break">
    <h3>Looking of recap of the past events. <a href="<?php echo site_url('/past-events')?>">Check Here &raquo;</a></h3>
  <div>

    <?php get_footer(); ?>