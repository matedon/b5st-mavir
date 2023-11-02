<?php
add_filter( 'the_content', 'b5st_custom_table' );

function b5st_custom_table($content) {
    $content = str_replace( '<table>', '<div class="table-responsive"><table class="table table-striped">', $content);
    $content = str_replace( '</table>', '</table></div>', $content);
    return $content;
}