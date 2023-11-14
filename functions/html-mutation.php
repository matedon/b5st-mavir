<?php

function b5st_custom_table($content) {
    $content = str_replace( '<table', '<div class="table-responsive bg-light"><table class="table table-striped"', $content);
    $content = str_replace( '</table>', '</table></div>', $content);
    return $content;
}
add_filter( 'the_content', 'b5st_custom_table' );

function b5st_custom_list_ul($content) {
    $content = str_replace( '<ul', '<ul class="list-group list-group-flush"', $content);
    return $content;
}
add_filter( 'the_content', 'b5st_custom_list_ul' );

function b5st_custom_list_ol($content) {
    $content = str_replace( '<ol', '<ol class="list-group list-group-flush list-group-numbered"', $content);
    $content = str_replace( ' start="', ' style="--list-start: ', $content);
    return $content;
}
add_filter( 'the_content', 'b5st_custom_list_ol' );

function b5st_custom_list_li($content) {
    $content = str_replace( '<li>', '<li class="list-group-item"><i class="fa fa-fw fa-circle-o"></i>', $content);
    return $content;
}
add_filter( 'the_content', 'b5st_custom_list_li' );

function b5st_custom_clear($content) {
    $content = str_replace( '&nbsp;', ' ', $content);
    $content = str_replace( '<p> </p>', '', $content);
    $content = str_replace( '<p>&nbsp;</p>', '', $content);
    $content = str_replace( '<em> </em>', '', $content);
    $content = str_replace( '<em>&nbsp;</em>', '', $content);
    return $content;
}
add_filter( 'the_content', 'b5st_custom_clear' );