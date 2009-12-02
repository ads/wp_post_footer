<?php
if (current_user_can('delete_others_posts')):
	if (isset($_GET['ID']) && is_numeric($_GET['ID'])):
		wp_delete_post($_GET['ID']);
		wp_redirect('edit.php?page=' . end(explode('/',dirname(__FILE__))) . '/wp-post-footer-library.php&pfmsg=del',303);
		exit();
	endif;
endif;
?>