<?php
/**
 * All filter rest api
 */

namespace App;

/*
 * rest_prepare_{post_type}
 */
function get_all_posts( $data, $post, $context ) {
  // echo print_r($data);
  // $data->data['acf']['test_text'] = 'hello world';
	return $data;
}
// add_filter( 'rest_prepare_post', __NAMESPACE__ . '\\get_all_posts', 10, 3 );

function get_all_pages( $data, $post, $context ) {
  // echo print_r($data);
  // $data->data['acf']['test_text'] = 'hello world';
	return $data;
}
// add_filter( 'rest_prepare_page', __NAMESPACE__ . '\\get_all_pages', 10, 3 );