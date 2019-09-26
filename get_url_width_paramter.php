<?php

/**
 * Get url current with parameter
 *
 * @return string
 * @author tien_anh
 */
if ( ! function_exists( 'get_url_with_paramter' ) ) {
	function get_url_width_paramter() {
		global $wp;
		return add_query_arg( $_SERVER['QUERY_STRING'], '', home_url( $wp->request ) );
	}
}
