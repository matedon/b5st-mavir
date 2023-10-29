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

		wp_register_style('googleFonts', 'https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap');
		wp_enqueue_style('googleFonts');

		wp_enqueue_style( 'gutenberg-blocks', get_template_directory_uri() . '/theme/css/blocks.css' );

		wp_register_style('theme', get_template_directory_uri() . '/theme/css/b5st.css', false, null);
		wp_enqueue_style('theme');

		// Scripts

		wp_register_script('bootstrap5', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js', false, '5.2.3', true);
		wp_enqueue_script('bootstrap5');

		// wp_register_script('theme', get_template_directory_uri() . '/theme/js/b5st.js', false, null, true);
		// wp_enqueue_script('theme');

		if (is_singular() && comments_open() && get_option('thread_comments')) {
			wp_enqueue_script('comment-reply');
		}
	}
}
add_action('wp_enqueue_scripts', 'b5st_enqueues', 100);
