<?php
/*
	Plugin Name:	WP Post Footer Library
	Version:		1.1
	Plugin URI:		http://www.adsdevshop.com/open-source/
	Description:	This plugin allows you to create a library of code snippets and easily include them at the bottom of Blog Posts on your WordPress powered blog.
	Author:			Atlantic Dominion Solutions
	Author URI:		http://adsdevshop.com/

	Copyright 2009 Robert Dempsey

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 2 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

add_action('admin_menu', 'post_footer_menus', 10, 1);
add_action('admin_menu', 'post_footer_meta_box', 11, 1);
add_action('admin_enqueue_scripts', 'post_footer_scripts', 10, 1);
add_action('admin_head', 'post_footer_scrub_menus');
add_action('save_post', 'post_footer_save'); 

function post_footer_menus()
{
	add_posts_page('Add New Post Footer', 'Add New Post Footer', 'delete_others_posts', dirname(__FILE__) . '/add-wp-post-footer.php');
	add_posts_page('Edit Post Footer', 'Edit Post Footer', 'delete_others_posts', dirname(__FILE__) . '/edit-wp-post-footer.php');
	add_posts_page('Delete Post Footer', 'Delete Post Footer', 'delete_others_posts', dirname(__FILE__) . '/delete-wp-post-footer.php');
	add_posts_page('Post Footer Library', 'Post Footer Library', 'delete_others_posts', dirname(__FILE__) . '/wp-post-footer-library.php');
}

function post_footer_scrub_menus()
{
	global $submenu;
	foreach($submenu['edit.php'] as $key => $val):
		if ($val[2] == end(explode('/',dirname(__FILE__))) . '/edit-wp-post-footer.php' OR $val[2] == end(explode('/',dirname(__FILE__))) . '/delete-wp-post-footer.php'):
			unset($submenu['edit.php'][$key]);
		endif;
	endforeach;
}

function post_footer_scripts($hook)
{
	if ($hook == end(explode('/',dirname(__FILE__))).'/add-wp-post-footer.php' OR $hook == end(explode('/',dirname(__FILE__))).'/edit-wp-post-footer.php'):
		$handles = explode(',','post,editor,media-upload,word-count,thickbox');

		foreach($handles as $handle):
			wp_enqueue_script( $handle );
		endforeach;
		wp_enqueue_style( 'thickbox' );
	endif;
}

function post_footer_meta_box()
{
	if ( current_user_can('delete_others_posts') ):
		if ( function_exists( 'add_meta_box' )):
    		add_meta_box( 'post_footer_meta_box', 'Post Footer', 'post_footer_meta_box_content', 'post', 'normal', 'high' );
		endif;
	endif;
}

function post_footer_meta_box_content()
{
	if ( isset($_GET['post']) ):
		$post = $_GET['post'];
	else:
		$post = '-'.time();
	endif;

	$_post_footer_id = get_post_meta($post, '_post_footer_id', true);
	$snippets = _post_footer_snippets();
?>
	<?php wp_nonce_field('wp_post_footer_nonce','wp_post_footer_nonce'); ?>
	<label for="_post_footer_id">Post Footer snippet:</label>
	<select name="_post_footer_id" id="post_footer_id">
		<option value="">Choose&hellip;</option>
		<?php foreach($snippets as $snippet): 
			$selected = ($snippet->ID == $_post_footer_id) ? 'selected="selected"' : '';
		?>
			<option value="<?php echo $snippet->ID; ?>" <?php echo $selected; ?>><?php echo $snippet->post_title?></option>
		<?php endforeach; ?>
	</select>	
<?php
}

function _post_footer_snippets()
{
	$args = array(
		'post_type' => 'post-footer',
		'numberposts' => -1,
	);

	$posts = get_posts($args);
	return $posts;
}

function post_footer_save( $post_id )
{
	global $post;

		if ( !wp_verify_nonce( $_POST['wp_post_footer_nonce'], 'wp_post_footer_nonce' ) ):
			return $post_id;  
		endif;

		if ( !current_user_can( 'edit_post', $post_id ) ):
			return $post_id;  
		endif;

		$_post_footer_id = $_POST['_post_footer_id'];

		if ( get_post_meta($post_id, '_post_footer_id') == "" ):
			add_post_meta($post_id, '_post_footer_id', $_post_footer_id, true);
		elseif ($_post_footer_id != get_post_meta($post_id, '_post_footer_id', true) ):
			update_post_meta($post_id, '_post_footer_id', $_post_footer_id);
		elseif($_post_footer_id == ""):
			delete_post_meta($post_id, '_post_footer_id', get_post_meta($post_id, '_post_footer_id', true));
		endif;	
}

function wp_post_footer()
{
	global $post;
	$post_footer_id = get_post_meta($post->ID, '_post_footer_id', true);
	if (is_numeric($post_footer_id)):
		$post_footer = get_post($post_footer_id);
		if (is_object($post_footer)):
			echo '<div id="wp_post_footer">';
			echo $post_footer->post_content;
			echo '</div>';
		else:
			delete_post_meta($post->ID, '_post_footer_id', get_post_meta($post->ID, '_post_footer_id', true));
			echo '<!-- this post footer has been removed from the system, and so the association has been deleted -->';
		endif;
	else:
		echo '<!-- there is no wp_post_footer on this post -->';
	endif;
}

?>