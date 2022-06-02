<div class="item-post-block">
  <a href="<?php the_permalink();?>">
 <div class="post-thumbnail">
   <?php the_post_thumbnail(); ?>
 </div>
 </a>
 <div class="post-content">
   <a href="<?php the_permalink();?>">
       <h3 class="post_title"> <?php the_title(); ?></h3>
   </a>
   <div class="post-excerpt">
     <?php the_excerpt(); ?>
   </div>
   <a href="#">Action link <i class="fa-solid fa-chevron-right"></i></a>
 </div>
</div>
