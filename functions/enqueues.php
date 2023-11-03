<?php
/*
 * Enqueues
 */

if ( ! function_exists('b5st_enqueues') ) {
	function b5st_enqueues() {
		/**
		 * Styles and Scripts
		 * Register and enqueue assets. Generate local asset versions by file last modified time for caching.
		 * 
		 * Old methods examples:
		 * wp_register_style('bootstrap5', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css', false, '5.2.3', null
		 * wp_enqueue_style('bootstrap5');
		 * wp_register_script('bootstrap5', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js', false, '5.2.3', true);
		 * wp_enqueue_script('bootstrap5');
		 * 
		 * Use $assets array instead!
		 * $assets[0] = 'css' or 'js'
		 * $assets[1] = 'external source' or 'local source' (!) relative to the template folder
		 * $assets[2] = 'dependencies'
		 * $assets[3] = 'version' which is overwritten to file last modification time when 'local source' detected
		 * $assets[4] = 'media'
		 */

		$assets = [
			'bootstrap5css' => ['css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css', false, '5.2.3', null],
			'bootstrapIcons' => ['css', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css', false, '1.10.2', null],
			'fontAwesome' => ['css', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css'],
			'googleFont1' => ['css', 'https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700'],
			'googleFont2' => ['css', 'https://fonts.googleapis.com/css2?family=Kaushan+Script'],
			'gutenberg-blocks' => ['css', '/theme/css/blocks.css'],
			'b5st-theme' => ['css', '/theme/css/b5st.css'],
			'animation' => ['css', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css'],
			'bootstrap5js' => ['js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js', false, '5.2.3', true],
			'jquery' => ['js', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js', false, '3.7.1', true],
			'jquery-animate-enhance' => ['js', 'https://cdn.jsdelivr.net/gh/benbarnett/jQuery-Animate-Enhanced@1.2.0/jquery.animate-enhanced.min.js', false, '1.2.0', true],
			'jquery-viewport' => ['js', 'https://cdnjs.cloudflare.com/ajax/libs/is-in-viewport/3.0.4/isInViewport.min.js', false, '3.0.4', true],
			'b5st-script' => ['js', '/theme/js/b5st.js'],
			'animation-dynamic' => ['js', 'https://cdn.jsdelivr.net/gh/KodingKhurram/animate.css-dynamic@main/animate.min.js'],
		];

		foreach ($assets as $key => $val) {
			$type = $val[0];
			array_shift($val);
			array_unshift($val, $key);
			$src = $val[1];
			$isExternal = str_starts_with($src, 'https://') || str_starts_with($src, 'http://') || str_starts_with($src, '//');
			if (!$isExternal) {
				$dir = get_template_directory() . $src;
				$src = get_template_directory_uri() . $src;
				$ver = filemtime($dir);
				$val[1] = $src;
				if (!array_key_exists(2, $val)) {
					$val[2] = false;
				}
				$val[3] = $ver;
			}
			if ($type == 'css') {
				call_user_func_array('wp_register_style', $val);
				wp_enqueue_style($key);
			}
			if ($type == 'js') {
				call_user_func_array('wp_register_script', $val);
				wp_enqueue_script($key);
			}
		}

		if (is_singular() && comments_open() && get_option('thread_comments')) {
			wp_enqueue_script('comment-reply');
		}
	}
}
add_action('wp_enqueue_scripts', 'b5st_enqueues', 100);
