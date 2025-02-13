<?php
/*
 * b5st Action Hooks
 * =================
 * Designed to be used by a child theme, but they can also be used directly 
 * in your development of b5st. Example usage:
 *    -- See “Dimox Breadcrumbs Insertion” below.
 *    -- See “Mainbody Widgets 1 Insertion” below.
 */

// Navbar (in `header.php`)

function b5st_navbar_before() {
  do_action('navbar_before');
}

function b5st_navbar_after() {
  do_action('navbar_after');
}
function b5st_navbar_brand() {
  if ( ! has_action('navbar_brand') ) {
    ?>
    <div class="b5st-nav-brand">
      <a class="navbar-brand" href="<?php echo esc_url( home_url('/') ); ?>" title="<?php bloginfo('name'); ?>">
        <span class="h1">Ma<span class="text-color-6">V</span><span class="text-color-5">ir</span></span>
        <img class="b5st-nav-brand-logo" src="<?=get_template_directory_uri()?>/theme/img/logo-toll.png" alt="">
      </a>
    </div>
    <?php
  } else {
		do_action('navbar_brand');
	}
}
function b5st_navbar_search() {
  if ( ! has_action('navbar_search') ) {
    ?>
    <form class="ms-1 md-flex" role="search" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
      <div class="input-group">
        <input class="form-control border-secondary" type="text" value="<?php echo get_search_query(); ?>"
        placeholder="<?=esc_html__('Search', 'b5st')?>..." name="s" id="s">
        <button type="submit" id="searchsubmit" value="<?php esc_attr_x('Search', 'b5st') ?>" class="btn btn-outline-secondary">
          <i class="bi bi-search"></i>
        </button>
      </div>
    </form>
    <?php
  } else {
		do_action('navbar_search');
	}
}

// Mainbody

function b5st_mainbody_before() {
  do_action('mainbody_before');
}
function b5st_mainbody_after() {
  do_action('mainbody_after');
}

function b5st_mainbody_start() {
  do_action('mainbody_start');
}
function b5st_mainbody_end() {
  do_action('mainbody_end');
}

/*
 * Dimox Breadcrumbs Insertion
 * ===========================
 * An example for how to insert something via an action hook -- 
 * but inserting it only on single posts, using `is_single()`.
 */

function b5st_dimox_single_post() {
  if ( is_single() ) { ?>
    <?php if (function_exists('dimox_breadcrumbs')) { ?>
      <?php dimox_breadcrumbs(); ?>
    <?php } ?>
  <?php }
};

add_action( 'mainbody_before', 'b5st_dimox_single_post' );

/*
 * Mainbody Widgets 1 Insertion
 * ============================
 * An example for how to insert something via an action hook -- 
 * this will appear on every page (if you have widgets in this area).
 */

function b5st_mainbody_widgets_1() {
  if(is_active_sidebar('mainbody-widget-area-1')): ?>
    <section class="container-xxl my-5">
      <div class="row">
        <?php dynamic_sidebar('mainbody-widget-area-1'); ?>
      </div>
    </section>
  <?php endif;
};
add_action( 'mainbody_end', 'b5st_mainbody_widgets_1' );

// Footer (in `footer.php`)

function b5st_footer_before() {
  do_action('footer_before');
}
function b5st_footer_after() {
  do_action('footer_after');
}
function b5st_bottomline() {
	if ( ! has_action('bottomline') ) {
		?>
    <div class="container-xxl">
      <div class="row pt-3">
        <div class="col-sm">
          <p class="text-center text-sm-start">&copy; <?php echo date('Y'); ?> <a href="<?php echo home_url('/'); ?>"><?php bloginfo('name'); ?></a></p>
        </div>
      </div>
    </div>
		<?php		
	} else {
		do_action('bottomline');
	}
}
