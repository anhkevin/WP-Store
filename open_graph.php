<?php
/**
 * Function: add_opengraph_doctype
 * Adding the Open Graph in the Language Attributes
 *
 * @return string
 * @author tien_anh
 */
function add_opengraph_doctype( $output ) {
	return $output . ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
}
add_filter('language_attributes', 'add_opengraph_doctype');

/**
 * Function: insert_og_in_head
 * Lets add Open Graph Meta Info
 *
 * @return string
 * @author tien_anh
 */
function insert_og_in_head() {
	// defaults
    $title 		= get_bloginfo('title');
    $img_src 	= get_template_directory_uri() . '/assets/img/logo.svg';
    $excerpt 	= get_bloginfo('description');
	$permalink 	= "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; // for non posts/pages, like /blog, just use the current URL

	if(is_single() || is_page()) {
		global $post;

		$title = get_the_title();
		if($excerpt = $post->post_excerpt) {
			$excerpt = strip_tags($post->post_excerpt);
			$excerpt = str_replace("", "'", $excerpt);
		}
		$permalink 	= get_the_permalink();
		if(has_post_thumbnail($post->ID)) {
			$img_src = get_the_post_thumbnail_url(get_the_ID(),'full');
		} else {
			$img_src = get_template_directory_uri() . '/assets/img/logo.svg';
		}
	}
	?>
	<meta property="og:title" content="<?= $title; ?>"/>
	<meta property="og:description" content="<?= $excerpt; ?>"/>
	<meta property="og:type" content="article"/>
	<meta property="og:url" content="<?= $permalink; ?>"/>
	<meta property="og:site_name" content="<?= $img_src; ?>"/>
	<?php
}
add_action('wp_head', 'insert_og_in_head', 5);
