<?php

$posts = _post_footer_snippets();

if (isset($_GET['pfmsg'])):
?>
<div id="message" class="updated fade"><p>Post Footer snippet deleted.</p></div>
<?php endif; ?>
<div class="wrap">
	<div id="icon-edit" class="icon32"></div>
	<h2>Post Footer Library <a class="button add-new-h2" href="edit.php?page=<?php echo end(explode('/',dirname(__FILE__))); ?>/add-wp-post-footer.php">Add New</a></h2>
	<p>Manage your Post Footer snippets</p>
	<div class="clear"></div>
	<table class="widefat post fixed" cellspacing="0">
		<thead>
			<tr>
				<th scope="col" id="title" class="manage-column column-title" style="">Post</th>
				<th scope="col" id="author" class="manage-column column-author" style="">Author</th>
				<th scope="col" id="date" class="manage-column column-date" style="">Date</th>
				<th scope="col"  class="manage-column column-date" style="">Remove?</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th scope="col"  class="manage-column column-title" style="">Post</th>
				<th scope="col"  class="manage-column column-author" style="">Author</th>
				<th scope="col"  class="manage-column column-date" style="">Date</th>
				<th scope="col"  class="manage-column column-date" style="">Remove?</th>
			</tr>
		</tfoot>
		
		<tbody>
			<?php foreach($posts as $post): 
				$userdata = get_userdata($post->post_author);
			?>
			<tr>
				<td class="post-title column-title"><a href="edit.php?page=<?php echo end(explode('/',dirname(__FILE__))); ?>/edit-wp-post-footer.php&amp;ID=<?php echo $post->ID; ?>"><?php echo $post->post_title; ?></a></td>
				<td><a href="edit.php?author=<?php echo $post->post_author; ?>"><?php echo $userdata->user_nicename; ?></a></td>
				<td>
					<?php 
						if ( '0000-00-00 00:00:00' == $post->post_date ) {
							$t_time = $h_time = __('Unpublished');
							$time_diff = 0;
						} else {
							$t_time = get_the_time(__('Y/m/d g:i:s A'));
							$m_time = $post->post_date;
							$time = get_post_time('G', true, $post);

							$time_diff = time() - $time;

							if ( $time_diff > 0 && $time_diff < 24*60*60 )
								$h_time = sprintf( __('%s ago'), human_time_diff( $time ) );
							else
								$h_time = mysql2date(__('Y/m/d'), $m_time);
						}
						echo '<abbr title="' . $t_time . '">' . apply_filters('post_date_column_time', $h_time, $post, 'date', 'list') . '</abbr>';
					?>
				</td>
				<td>
					<a href="edit.php?page=<?php echo end(explode('/',dirname(__FILE__))); ?>/delete-wp-post-footer.php&amp;ID=<?php echo $post->ID; ?>" class="delmsg">Delete</a>
				</td>
			</tr>
			<?php endforeach;?>
		</tbody>
	</table>
</div>
<script type="text/javascript" charset="utf-8">
	jQuery(document).ready(function($) {
		$('.delmsg').click(function() {
			ok = confirm("Are you sure you want to delete this Post Footer snippet?");
			if (!ok) {
				return false;
			}
		});
	})
</script>