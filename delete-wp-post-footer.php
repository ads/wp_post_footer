<?php
if (current_user_can('delete_others_posts')):
	if (isset($_GET['ID']) && is_numeric($_GET['ID'])):
		wp_delete_post($_GET['ID']);
		$redirect = 'edit.php?page=' . end(explode('/',dirname(__FILE__))) . '/wp-post-footer-library.php&pfmsg=del';
	endif;
?>		

	<noscript>
		<a href="<?php echo $redirect; ?>">Return to library</a>
	</noscript>
	<script type="text/javascript" charset="utf-8">
		jQuery(document).ready(function() {
			window.location = '<?php echo $redirect; ?>';
		})
	</script>
<?php endif; ?>