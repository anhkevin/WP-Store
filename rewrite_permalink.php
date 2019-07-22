<?php
/**
 * Function: eg_add_rewrite_rules
 * Change url by new rules
 *
 * @return string
 * @author tien_anh
 */
function eg_add_rewrite_rules() {
    global $wp_rewrite;
 
    $new_rules = array(
		// Add param type in category taste
        'category-taste/(.+)/([^/]+)' => 'index.php?category-taste='.$wp_rewrite->preg_index(2).'&type='.$wp_rewrite->preg_index(1).''
	);
    $wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
}
add_action( 'generate_rewrite_rules', 'eg_add_rewrite_rules' );
