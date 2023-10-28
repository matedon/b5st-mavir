<?php
add_filter( 'the_content', 'b5st_custom_table' );

function b5st_custom_table($content) {
    return str_replace( '<table>', '<table class="table table-striped">', $content );
}