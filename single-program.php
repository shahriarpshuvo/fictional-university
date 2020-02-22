<?php get_header(); 
  page_banner();
?>
<?php while(have_posts()):the_post(); ?>
<div class="container container--narrow page-section">

    <div class="metabox metabox--position-up metabox--with-home-link">
        <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('program');?>">
            <i class="fa fa-home" aria-hidden="true"></i> Programs Home</a>
            <span class="metabox__main"><?php the_time('M d, Y');?></span>
        </p>
    </div>

    <div class="generic-content">
      <?php the_content(); ?>
    </div>

    <?php
        $professors = new WP_Query(array(
          'post_type' => 'professor',
          'posts_per_page' => -1,
          'order' => 'ASC',
          'orderby' => 'title',
          'meta_query' => array(
            array(
                'key' => 'related_programs',
                'compare' => 'LIKE',
                'value' => '"'. get_the_ID() .'"',
            ),
          )
        
        ));
        
        if($professors->have_posts()):?>

    <hr class="section-break">
    <h3 class="headline headline--medium"><?php the_title(); ?> Professors:</h3>
    <br>
    
    <ul class="professor-cards">
    <?php while($professors->have_posts()): $professors->the_post();?>
        <li class="professor-card__list-item">
            <a class="professor-card" href="<?php the_permalink(); ?>">
                <img class="professor-card__image" src="<?php the_post_thumbnail_url('professor-landscape'); ?>">
                <span class="professor-card__name"><?php the_title(); ?></span>
            </a>
        </li> 
        <?php endwhile;?>
    </ul>
    <?php endif; wp_reset_postdata(); ?>

    <?php
        $today = date('Ymd');
        $events = new WP_Query(array(
          'post_type' => 'event',
          'posts_per_page' => 2,
          'order' => 'ASC',
          'orderby' => 'meta_value_num',
          'meta_key' => 'event_date',
          'meta_query' => array(
            array(
              'key' => 'event_date',
              'compare' => '>=',
              'value' => $today,
              'type' => 'numeric'
            ),

            array(
                'key' => 'related_programs',
                'compare' => 'LIKE',
                'value' => '"'. get_the_ID() .'"',
            ),
          )
        
        ));
        
        if($events->have_posts()):?>
            <hr class="section-break">
            <h3 class="headline headline--medium">Upcoming Event(s):</h3>
            <br>
            <?php while($events->have_posts()): $events->the_post();
                get_template_part( 'template-parts/content', 'event' );
            endwhile; endif; wp_reset_postdata(); ?>

<div>
<?php endwhile; ?>
<?php get_footer(); ?>