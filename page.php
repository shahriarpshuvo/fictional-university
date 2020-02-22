<?php 
  get_header(); 
  while(have_posts()): the_post();
    page_banner(array(
      'subtitle' => 'Hello'
    ));
?>

<div class="container container--narrow page-section">
  <?php
    $has_parent_page_ID = wp_get_post_parent_id(get_the_ID()); 
    if($has_parent_page_ID):  ?>
    <div class="metabox metabox--position-up metabox--with-home-link">
      <p><a class="metabox__blog-home-link" href="<?php echo get_permalink($has_parent_page_ID)?>">
        <i class="fa fa-home" aria-hidden="true"></i>
        <?php echo get_the_title($has_parent_page_ID);?></a>
        <span class="metabox__main"><?php the_title(); ?></span>
      </p>
    </div>
  <?php endif; ?>

  <?php 
    $has_child_pages = get_pages(array(
      'child_of' => get_the_ID(),
    ));
    if($has_parent_page_ID || $has_child_pages ):
  ?>
  <div class="page-links">
    <h2 class="page-links__title">
      <a href="<?php echo get_permalink($has_parent_page_ID); ?>"><?php echo get_the_title($has_parent_page_ID); ?></a>
    </h2>
    <ul class="min-list">
      <?php
        $child_of_ID = $has_parent_page_ID ? $has_parent_page_ID : get_the_ID();
        $page_list_args = array(
          'title_li' => null,
          'child_of' => $child_of_ID
        );
        wp_list_pages($page_list_args);
      ?>
    </ul>
  </div>
  <?php endif; ?>

  <div class="generic-content">
    <?php the_content(); ?>
  </div>
</div>


<?php 
  endwhile; 
  get_footer(); 
?>