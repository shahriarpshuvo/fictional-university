<?php get_header(); ?>
<?php while(have_posts()):the_post(); ?>

<div class="page-banner">
  <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/assets/img/ocean.jpg'); ?>);"></div>
  <div class="page-banner__content container container--narrow">
    <h1 class="page-banner__title"><?php the_title(); ?></h1>
    <!-- <div class="page-banner__intro">
      <p>Keep up with our latest news.</p>
    </div> -->
  </div>
</div>

<div class="container container--narrow page-section">

    <div class="metabox metabox--position-up metabox--with-home-link">
      <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('event');?>">
        <i class="fa fa-home" aria-hidden="true"></i> Events Home</a>
        <span class="metabox__main"><?php $event_date = new DateTime(get_field('event_date')); echo $event_date->format('M d, Y')?></span>
      </p>
    </div>
  
    <div class="generic-content">
      <?php the_content(); ?>
    </div>

<div>
<?php endwhile; ?>
<?php get_footer(); ?>