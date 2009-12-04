<?php
$parent_file = 'edit.php';
$editing = true;
$screen_layout_columns = 2;
if (function_exists('add_thickbox')) add_thickbox(); 
if (function_exists('wp_tiny_mce')) wp_tiny_mce();

if ( !empty($_POST ) ) :
	check_admin_referer('wp_post_footer_nonce','wp_post_footer_nonce');	
	if ($post_footer_form == 'add'):
		$posta = array(
			'post_title' => $_POST['post_title'],
			'post_content' => $_POST['content'],
			'post_status' => 'publish', 
			'post_type' => $_POST['post_type'],
			'ping_status' => 'closed',
		);
		wp_insert_post($posta);
		$msg = 'Post Footer Snippet Added To The Library!';
		unset($post);
		$post = get_default_post_to_edit();
		$post->post_type = 'post-footer';
		$post->post_content = '';
		$post->post_title = '';
	elseif($post_footer_form == 'edit'):
		$post = get_post($_POST['temp_ID']);
		$post->post_title = stripslashes($_POST['post_title']);
		$post->post_content = stripslashes($_POST['content']);
		wp_update_post($post);
		$msg = 'Post Footer Snippet Updated!';
	endif;
?>
<div id="message" class="updated fade"><p><?php echo $msg; ?></p></div>
<?php endif; ?>
<!-- begin wp-post-footer-form.php -->
<div class="wrap">
	<div id="icon-edit" class="icon32"></div>
	<h2><?php echo esc_html($title); ?></h2>
	
	<form name="post" action="" method="post" id="<?php echo $post_footer_form; ?>-wp-post-footer">
		<?php wp_nonce_field('wp_post_footer_nonce','wp_post_footer_nonce'); ?>
		<input type="hidden" id="user-id" name="user_ID" value="<?php echo (int) $user_ID ?>" />
		<input type="hidden" id="hiddenaction" name="action" value="" />
		<input type="hidden" id="originalaction" name="originalaction" value="" />
		<input type="hidden" id="post_author" name="post_author" value="<?php echo esc_attr( $post->post_author ); ?>" />
		<input type="hidden" id="post_type" name="post_type" value="<?php echo esc_attr($post->post_type) ?>" />
		<input type="hidden" id="original_post_status" name="original_post_status" value="<?php echo esc_attr($post->post_status) ?>" />
		<input name="referredby" type="hidden" id="referredby" value="<?php echo esc_url(stripslashes(wp_get_referer())); ?>" />
		<?php echo $form_extra; ?>

		<div id="poststuff" class="metabox-holder<?php echo 2 == $screen_layout_columns ? ' has-right-sidebar' : ''; ?>">
			<div id="side-info-column" class="inner-sidebar">
				<div id="side-sortables" class="meta-box-sortables">
					<div id="submitdiv" class="postbox " >
						<div class="handlediv" title="Click to toggle"><br /></div>
						<h3 class='hndle'><span><?php echo ucfirst($post_footer_form);?> Post Footer Snippet</span></h3>
						<div class="inside">
							<div class="submitbox" id="submitpost">
								<div id="major-publishing-actions">
									<div id="delete-action"></div>

									<div id="publishing-action">
										<input name="original_publish" type="hidden" id="original_publish" value="Publish" />
										<input name="publish" type="submit" class="button-primary" id="publish" tabindex="5" accesskey="p" value="Save" />
									</div> <!-- #publishing-action -->
									<div class="clear"></div>
								</div> <!-- #major-publishing-actions -->
							</div> <!-- #submitpost -->
						</div> <!-- .inside -->
					</div> <!-- #submitdiv -->
				</div> <!-- #side-sortables -->
			</div> <!-- #side-info-column -->

			<div id="post-body">
				<div id="post-body-content">
					<div id="titlediv">
						<div id="titlewrap">
							<label class="screen-reader-text" for="title">Title (<?php echo $post->post_title; ?>)</label>
							<input type="text" name="post_title" size="30" tabindex="1" value="<?php echo esc_attr( htmlspecialchars( $post->post_title ) ); ?>" id="title" autocomplete="off" />
						</div>
					</div>
					
					<div id="<?php echo user_can_richedit() ? 'postdivrich' : 'postdiv'; ?>" class="postarea">
						
						<?php the_editor($post->post_content); ?>
					
						<table id="post-status-info" cellspacing="0">
							<tbody>
								<tr>
									<td id="wp-word-count"></td>
									<td class="autosave-info">&nbsp;</td>
								</tr>
							</tbody>
						</table>
					</div> <!-- #postdivrich -->

				</div> <!-- #post-body-content -->
			</div> <!-- #post-body -->
			<br class="clear" />
		</div> <!-- #poststuff -->
	</form>
</div><!-- #wrap -->

<?php if ((isset($post->post_title) && '' == $post->post_title) || (isset($_GET['message']) && 2 > $_GET['message'])) : ?>
<script type="text/javascript">
try{document.post.title.focus();}catch(e){}
</script>
<?php endif; ?>

<!-- end wp-post-footer-form.php -->