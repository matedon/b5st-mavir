<!-- Carousel START -->
<?php if (of_get_option('b5st_slider_checkbox') == 1):
echo of_get_option('b5st_slider_autoplay_checkbox');
$query = new WP_Query(
  array(
    'cat' => of_get_option('b5st_slide_categories'),
    'posts_per_page' => of_get_option('b5st_slide_number'),
    'meta_query' => array(
      array(
        'key' => '_thumbnail_id',
        'compare' => 'EXISTS',
      ),
    ),
  )
);
$rows = [];
if ($query->have_posts()):
    while ($query->have_posts()):
        $query->the_post();
        $rows []= array(
            'title' => get_the_title(),
            'caption' => get_the_excerpt(),
            'src' => get_the_post_thumbnail_url(get_the_ID())
        );
    endwhile;
endif;
?>
<div class="b5st-carousel-cont container-fluid">
    <div class="b5st-carousel-cont-in">
        <div id="carouselExampleDark" <?=(of_get_option('b5st_slider_autoplay_checkbox') == 1 ? 'data-bs-ride="carousel"' : 'data-autoplay-off')?> class="carousel slide">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <?php foreach($rows as $key => $row): ?>
                <div class="carousel-item <?=($key == 0 ? 'active' : '')?>" data-bs-interval="<?=of_get_option('b5st_slider_autoplay_time')?>">
                    <img src="<?=$row['src']?>" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5><?=$row['title']?></h5>
                        <p><?=$row['caption']?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</div>
<?php endif; ?>
<!-- Carousel END -->