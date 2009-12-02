<!-- begin add-wp-post-footer.php -->
<?php
$parent_file = 'edit.php';
$editing = true;
add_thickbox(); 
$post = get_default_post_to_edit();
$temp_ID = -1 * time(); // don't change this formula without looking at wp_write_post()
$form_extra = "<input type='hidden' id='post_ID' name='temp_ID' value='" . esc_attr($temp_ID) . "' />";
require_once('includes/meta-boxes.php');
add_meta_box('submitdiv', __('Publish'), 'post_submit_meta_box', 'post', 'side', 'core');
$screen_layout_columns = 2;
if (function_exists('wp_tiny_mce')) wp_tiny_mce();
?>
<div class="wrap">
	<div id="icon-edit" class="icon32"></div>
	<h2><?php echo esc_html($title); ?></h2>
	
	<form name="post" action="" method="post" id="add-wp-post-footer">
		<?php wp_nonce_field('add-post-footer'); ?>
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
						<h3 class='hndle'><span>Publish</span></h3>
						<div class="inside">
							<div class="submitbox" id="submitpost">
								<div id="major-publishing-actions">
									<div id="delete-action"></div>

									<div id="publishing-action">
										<input name="original_publish" type="hidden" id="original_publish" value="Publish" />
										<input name="publish" type="submit" class="button-primary" id="publish" tabindex="5" accesskey="p" value="Publish" />
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
							<label class="screen-reader-text" for="title">Title</label>
							<input type="text" name="post_title" size="30" tabindex="1" value="" id="title" autocomplete="off" />
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

<script type="text/javascript" charset="utf-8">
	jQuery(document).ready(function($) {
		$('.thickbox').each(function() {
			newhref = '<?php echo WP_SITEURL.'/wp-admin/'; ?>'+$(this).attr('href');
			$(this).attr('href',newhref);
		});
	});
</script>

<!-- end add-wp-post-footer.php -->