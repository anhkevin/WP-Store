<?php
/**
 * Widget API: WP_Widget_Media_Image_Slide class
 *
 * @package WordPress
 * @subpackage Widgets
 * @since 4.8.0
 */

/**
 * Core class that implements an image widget.
 *
 * @since 4.8.0
 *
 * @see WP_Widget
 */
class WP_Widget_Media_Image_Slide extends WP_Widget {

	/**
	 * Constructor.
	 *
	 * @since 4.8.0
	 */
	public function __construct() {
		parent::__construct (
			'slide_widget', // id
			'Slider Widget', // name
	   
			array(
				'description' => 'Displays an slider.'
			)
		);
	}

	/**
	 * widget
	 */
    function widget($args, $instance) {
        echo $before_widget;
	?>

    <img src="<?php echo esc_url($instance['image_uri']); ?>" />
	<img src="<?php echo esc_url($instance['image_uri_text']); ?>" />

	<?php
        echo $after_widget;
    }

	/**
	 * update
	 */
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
		$instance['image_uri'] = strip_tags( $new_instance['image_uri'] );
		$instance['image_uri_text'] = strip_tags( $new_instance['image_uri_text'] );
        return $instance;
    }

	/**
	 * form
	 */
    function form($instance) {
	?>
    <p>
        <label for="<?= $this->get_field_id( 'image_uri' ); ?>" style="font-weight: bold;">Image Background :</label>
        <img class="<?= $this->id ?>1_img" src="<?= (!empty($instance['image_uri'])) ? $instance['image_uri'] : ''; ?>" style="margin:0;padding:0;max-width:100%;display:block"/>
        <input type="text" class=" <?= $this->id ?>1_url" name="<?= $this->get_field_name( 'image_uri' ); ?>" value="<?= $instance['image_uri']; ?>" style="margin-top:5px;" />
        <input type="button" id="<?= $this->id ?>1" class="button button-primary js_custom_upload_media" value="Upload Image" style="margin-top:5px;" />
    </p>
	<hr>
	<p>
        <label for="<?= $this->get_field_id( 'image_uri_text' ); ?>" style="font-weight: bold;">Image Text :</label>
        <img class="<?= $this->id ?>2_img" src="<?= (!empty($instance['image_uri_text'])) ? $instance['image_uri_text'] : ''; ?>" style="margin:0;padding:0;max-width:100%;display:block"/>
        <input type="text" class=" <?= $this->id ?>2_url" name="<?= $this->get_field_name( 'image_uri_text' ); ?>" value="<?= $instance['image_uri_text']; ?>" style="margin-top:5px;" />
        <input type="button" id="<?= $this->id ?>2" class="button button-primary js_custom_upload_media" value="Upload Image" style="margin-top:5px;" />
    </p>
	<?php
    }
}

/**
 * Function: ctup_wdscript
 * Enqueue additional admin scripts
 *
 * @return string
 * @author tien_anh
 */
add_action('admin_enqueue_scripts', 'ctup_wdscript');
function ctup_wdscript() {
    wp_enqueue_media();
    wp_enqueue_script('ads_script', get_template_directory_uri() . '/assets/js/widget.js', false, '1.0.0', true);
	
// 	jQuery(document).ready(function ($) {
//     function media_upload(button_selector) {
//       var _custom_media = true,
//           _orig_send_attachment = wp.media.editor.send.attachment;
//       $('body').on('click', button_selector, function () {
//         var button_id = $(this).attr('id');
//         wp.media.editor.send.attachment = function (props, attachment) {
//           if (_custom_media) {
//             $('.' + button_id + '_img').attr('src', attachment.url);
//             $('.' + button_id + '_url').val(attachment.url).change();
//           } else {
//             return _orig_send_attachment.apply($('#' + button_id), [props, attachment]);
//           }
//         }
//         wp.media.editor.open($('#' + button_id));
//         return false;
//       });
//     }
//     media_upload('.js_custom_upload_media');
// });
	
}

/**
 * Function: box_register_widget
 * register widget
 *
 * @return string
 * @author tien_anh
 */
function box_register_widget() {
	register_widget( 'WP_Widget_Media_Image_Slide' );
}
add_action( 'widgets_init', 'box_register_widget' );
