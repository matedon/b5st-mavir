<?php
  get_header(); 
  b5st_mainbody_before();
?>

<main id="site-main" class="b5st-index container">
  <div class="row">
    <div class="<?=(is_active_sidebar('sidebar-widget-area') ? 'col-xl-8' : '')?> col-12">
      <?php
        b5st_mainbody_start();
        get_template_part('loops/index-loop');
        b5st_mainbody_end();
      ?>
    </div>
    <?php if(is_active_sidebar('sidebar-widget-area')): ?>
    <aside class="col-xl-4 col-12 mt-4">
      <?php dynamic_sidebar('sidebar-widget-area'); ?>
    </aside>
    <?php endif; ?>
  </div>
</main>

<?php 
  b5st_mainbody_after();
  get_footer(); 
?>
