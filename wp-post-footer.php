<?php
/*
	Plugin Name:	WP Post Footer Library
	Version:		1.0
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

add_action('admin_menu', 'post_footer_menus');
function post_footer_menus()
{
	add_posts_page('Add New Post Footer', 'Add New Post Footer', 'editor', dirname(__FILE__) . '/add-wp-post-footer.php');
	add_posts_page('Post Footer Library', 'Post Footer Library', 'editor', dirname(__FILE__) . '/wp-post-footer-library.php');
}

?>