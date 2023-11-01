<?php
/*
 * Enqueues
 */

if ( ! function_exists('b5st_enqueues') ) {
	function b5st_enqueues() {

		// Styles

		wp_register_style('bootstrap5', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css', false, '5.2.3', null);
		wp_enqueue_style('bootstrap5');

		wp_register_style('bootstrapIcons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css', false, '1.10.2', null);
		wp_enqueue_style('bootstrapIcons');

		wp_register_style('fontAwesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css');
		wp_enqueue_style('fontAwesome');

		wp_register_style('googleFont2', 'https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700');
		wp_enqueue_style('googleFont2');

		wp_register_style('googleFont3', 'https://fonts.googleapis.com/css2?family=Kaushan+Script');
		wp_enqueue_style('googleFont3');

		wp_enqueue_style( 'gutenberg-blocks', get_template_directory_uri() . '/theme/css/blocks.css' );

		wp_register_style('theme', get_template_directory_uri() . '/theme/css/b5st.css', false, '20231031_1132');
		wp_enqueue_style('theme');

		// Scripts

		wp_register_script('bootstrap5', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js', false, '5.2.3', true);
		wp_enqueue_script('bootstrap5');

		wp_register_script('jquery3', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js', false, '3.7.1', true);
		wp_enqueue_script('jquery3');

		wp_register_script('jquery-animate-enhance', 'https://cdn.jsdelivr.net/gh/benbarnett/jQuery-Animate-Enhanced@1.2.0/jquery.animate-enhanced.min.js', false, '1.2.0', true);
		wp_enqueue_script('jquery-animate-enhance');

		wp_register_script('theme', get_template_directory_uri() . '/theme/js/b5st.js', '20231031_1132', null, true);
		wp_enqueue_script('theme');

		if (is_singular() && comments_open() && get_option('thread_comments')) {
			wp_enqueue_script('comment-reply');
		}
	}
}
add_action('wp_enqueue_scripts', 'b5st_enqueues', 100);
