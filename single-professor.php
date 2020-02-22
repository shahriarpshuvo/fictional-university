<?php get_header(); 
  page_banner();
?>
<?php while(have_posts()):the_post(); ?>

<div class="container container--narrow page-section">

    <div class="generic-content">
      <div class="row group">
        <div class="one-third">
            <?php the_post_thumbnail('professor-protrait'); ?>
        </div>
        <div class="two-thirds">
            <?php the_content(); ?>
        </div>
      </div>
    </div>
    
    <?php
      $relatedPrograms = get_field('related_programs');
      if($relatedPrograms): ?>
      <hr class="section-break">
      <h3 class="headline headline--medium">Subject(s) Taught:</h3>
      <ul class="link-list min-list">
        <?php foreach($relatedPrograms as $program):?>
          <li><a href="<?php echo get_the_permalink($program); ?>">
            <?php echo get_the_title($program); ?></a>
          </li> 
        <?php endforeach; ?>
      </ul>  
    <?php endif; ?>
<div>
<?php endwhile; ?>
<?php get_footer(); ?>