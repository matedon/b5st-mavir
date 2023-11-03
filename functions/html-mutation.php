<?php
add_filter( 'the_content', 'b5st_custom_table' );

function b5st_custom_table($content) {
    $content = str_replace( '<table>', '<div class="table-responsive"><table class="table table-striped">', $content);
    $content = str_replace( '</table>', '</table></div>', $content);
    return $content;
}

add_filter( 'the_content', 'b5st_custom_list_ul' );
add_filter( 'the_content', 'b5st_custom_list_li' );

function b5st_custom_list_ul($content) {
    $content = str_replace( '<ul>', '<ul class="list-group list-group-flush">', $content);
    return $content;
}
function b5st_custom_list_li($content) {
    $content = str_replace( '<li>', '<li class="list-group-item"><i class="fa fa-fw fa-circle-o"></i>', $content);
    return $content;
}