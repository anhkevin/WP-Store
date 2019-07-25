<?php

/**
 * Function: get_attachment_url_by_slug
 * Get attachment featured url by name
 *
 * @return string
 * @author tien_anh
 */
if ( ! function_exists( 'get_attachment_url_by_slug' ) ) {
	function get_attachment_url_by_slug( $slug ) {
		$args = array(
		  'post_type' => 'attachment',
		  'name' => sanitize_title($slug),
		  'posts_per_page' => 1,
		  'post_status' => 'inherit',
		);
		$_header = get_posts( $args );
		$header = $_header ? array_pop($_header) : null;
		return $header ? wp_get_attachment_url($header->ID) : '';
	}
}
