/*!
 * b5st JS
 */
(function ($) {
console.log('carousel on')
$('[data-b5st-carousel]').each(function () {
    const $par = $(this)
    const $me = $par.find('[data-b5st-carousel-me]')
    const $bg1 = $par.find('[data-b5st-carousel-bg1]')
    $me.on('slide.bs.carousel', function () {
        if ($bg1.width() == $me.width()) {
            return this
        }
        const activeImg = $me.find('.carousel-item').filter('.active').find('img').attr('src')
        $bg1.css({'background-image': 'url(' + activeImg + ')', 'opacity': 1}).delay(0).animate({'opacity': 0.0001}, 1500)
    })
    $me.on('slid.bs.carousel', function () {
        if ($bg1.width() == $me.width()) {
            return this
        }
        const activeImg = $me.find('.carousel-item').filter('.active').find('img').attr('src')
        $par.css('background-image', 'url(' + activeImg + ')')
    })  
})
})(jQuery)