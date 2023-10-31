<!-- Carousel START -->
<?php if (of_get_option('b5st_slider_checkbox') == 1):
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
$sac = of_get_option('b5st_slider_autoplay_checkbox');
$autoplay = ($sac == 1 || $sac === false) ? 'data-bs-ride="carousel"' : 'data-autoplay-off';
?>
<div class="b5st-carousel-cont container-fluid" style="background-image: url('<?=$rows[0]['src']?>');">
    <div class="b5st-carousel-cont__bg1"></div>
    <div class="b5st-carousel-cont__bg2"></div>
    <div class="b5st-carousel-cont-in">
        <div id="b5stCarousel" <?php echo $autoplay; ?> class="carousel slide">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#b5stCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#b5stCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#b5stCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
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
            <button class="carousel-control-prev" type="button" data-bs-target="#b5stCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#b5stCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</div>
<script>
(function ($) {
console.log('carousel on')
$('#b5stCarousel').on('slide.bs.carousel', function () {
    const $this = $(this)
    const $par = $this.closest('.b5st-carousel-cont')
    const $bg1 = $par.find('.b5st-carousel-cont__bg1')
    const activeImg = $this.find('.carousel-item').filter('.active').find('img').attr('src')
    $bg1.css({'background-image': 'url(' + activeImg + ')', 'opacity': 1}).delay(0).animate({'opacity': 0.0001}, 1500)
    console.log('carousel slide')
})
$('#b5stCarousel').on('slid.bs.carousel', function () {
    const $this = $(this)
    const $par = $this.closest('.b5st-carousel-cont')
    const $bg1 = $par.find('.b5st-carousel-cont__bg1')
    const activeImg = $this.find('.carousel-item').filter('.active').find('img').attr('src')
    $par.css('background-image', 'url(' + activeImg + ')')
    console.log('carousel slid')
})
})(jQuery)
</script>
<?php endif; ?>
<!-- Carousel END -->