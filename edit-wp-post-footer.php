<?php
//	print_r($submenu);
	if (current_user_can('delete_others_posts')):
		if (isset($_GET['ID']) && is_numeric($_GET['ID'])):
			$post = get_post($_GET['ID']);
			$title = 'Edit Post Footer';
			$post_footer_form = 'edit';
			$form_extra = "<input type='hidden' id='post_ID' name='temp_ID' value='" . esc_attr($post->ID) . "' />";
			include('inc/wp-post-footer-form.php');
		else:
		$redirect = 'edit.php?page=' . end(explode('/',dirname(__FILE__))) . '/wp-post-footer-library.php';
?>
			<noscript>
				ID Missing. <a href="<?php echo $redirect; ?>">Return to library</a>
			</noscript>
			<script type="text/javascript" charset="utf-8">
				jQuery(document).ready(function() {
					window.location = '<?php echo $redirect; ?>';
				})
			</script>
<?php
		endif;
	endif;
?>