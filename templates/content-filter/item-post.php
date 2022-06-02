<?php
$post_id = get_the_ID();
?>
<div class="item-content-filter post-faq">
  <div class="__info">
    <a href="<?php the_permalink(); ?>"><h3 class="__title"><?php the_title(); ?></h3></a>
    <div class="__content">
      <?php the_excerpt(); ?>
    </div>
    <a href="<?php the_permalink(); ?>" class="btn-readmore"><?php echo __('Action link','bearsthemes-addons'); ?><i class="fa-solid fa-chevron-right"></i></a>
  </div>
</div>
<?php
