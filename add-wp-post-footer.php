<?php
	$post = get_default_post_to_edit();
	$post->post_type = 'post-footer';
	$title = 'Add New Post Footer';
	$post_footer_form = 'add';
	$temp_ID = -1 * time(); // don't change this formula without looking at wp_write_post()
	$form_extra = "<input type='hidden' id='post_ID' name='temp_ID' value='" . esc_attr($temp_ID) . "' />";
	include('inc/wp-post-footer-form.php');
?>