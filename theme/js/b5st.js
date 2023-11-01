/*!
 * b5st JS
 */
(function ($) {
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

const $viewPortId = $('[data-viewport-id]')
const $viewPortHref = $('[data-viewport-href]')
let timeScroll
$(window).on('scroll', function() {
    clearTimeout(timeScroll)
    timeScroll = setTimeout(function () {
        $viewPortId.isInViewport({ tolerance: 100 }).each(function () {
            const $this = $(this)
            const id = $this.attr('id')
            console.log(id)
            $viewPortHref.removeClass('active')
            $viewPortHref.each(function () {
                const $th = $(this)
                if ($th.attr('href').indexOf('#' + id) == -1) return this
                $th.addClass('active')
            })
        })
    }, 200)
})
})(jQuery)