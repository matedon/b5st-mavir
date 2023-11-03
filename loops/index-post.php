<?php
/*
 * The Index Post (or excerpt)
 * ===========================
 * Used by index.php, category.php and author.php
 */
$slug = get_post_field('post_name', get_post());
?>

<div id="<?=$slug?>" data-viewport-id>
<article role="article" id="post_<?php the_ID()?>" <?php post_class("entry-content"); ?>>
  <header>
    <?php the_post_thumbnail(); ?>
    <div class="index-post-category mb-3 text-muted d-none">
      <i class="bi bi-bookmark"></i> 
      <span class="text-uppercase"><?php the_category(', '); ?></span>
    </div>
    <h2 class="h1 mb-3 fw-bolder">
      <a href="<?php the_permalink(); ?>" class="d-inline-block ani_jackInTheBox">
        <?php the_title()?>
      </a>
    </h2>
  </header>

  <section>
    <?php if ( has_excerpt( $post->ID ) ) {
    the_excerpt();
    ?><a href="<?php the_permalink(); ?>">
    	<?php _e( 'Continue reading →', 'b5st' ) ?>
      </a>
  	<?php } else {
  	  the_content( __('Continue reading →', 'b5st' ) );
	  } ?>
  </section>

</article>
</div>
