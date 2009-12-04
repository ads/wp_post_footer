=== WP Post Footer ===
Contributors: xenlab,adsdevshop,easilyamused
Donate Link: http://blog.adsdevshop.com/
Tags: content, posts, css, html, javascript, formatting, style, snippets, code
Requires at least: 2.8
Tested up to: 2.9
Stable tag: trunk

This plugin allows you to create a library of code snippets and easily include them at the bottom of Blog Posts on your WordPress powered blog.

== Description ==

Easily create a library of code snippets that can be inserted at the end of blog posts. Perfect for adding 'Call to Action' content at the end of a blog post to ask readers to take further action. By enabling you to maintain multiple Footer snippets, you will be able to associate different messages with different types of posts, for maximum effectiveness. Any normal HTML, CSS, or JavaScript can be entered into the body of your Post Footer content allowing you to easily integrate them into the look and feel of your theme.

== Installation ==

1. Download the wp-post-footer.zip file, unzip and upload the whole directory to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress.
1. Add this php snippet to the single.php template in your theme: <?php if (function_exists('wp_post_footer')) wp_post_footer(); ?>
1. To create a new Post Footer, navigate to the Post Footer Library page. Click Add New Post Footer.
1. Title the Post Footer, and Paste HTML, CSS, and/or JavaScript and/or PHP into the body, and click `Save`.
1. To associate a Post Footer snippet to a Post, select the Post Footer snippet from the list provided on the Add New Post screen. Save and publish the post as normal
1. Bask in the glory of your customized blog post!

== Frequently Asked Questions ==

= Why Would I Want This? =

This plugin is great for adding 'Call to Action' content at the end of specific blog posts as a way to convert readers into doers.

= I want to help with development of this Plugin! =

The project is now hosted on [github.com](http://github.com/ads/wp_post_footer). Just fork the project and send a pull request.

[New to git?](http://delicious.com/ericmarden/git)

== Changelog ==

= 1.0 =
* Initial Release

== Screenshots ==

1. Post Footer list in Add/Edit Post screen
2. Post Footer navigation links in Post menu
3. Add New Post Footer screen showing Rich Editor and Media Library integration
4. Add New Post Footer screen
5. Post Footer Library - A list of Post Footer snippets.

== License ==

The WP Post Footer plugin was developed by Eric Marden and James Tryon on behalf of Robert Dempsey and Atlantic Dominion Solutions, LLC and is provided with out warranty under the GPLv2 License. More info and other open source goodies at: http://adsdevshop.com/open-source

Copyright 2009 Robert Dempsey

This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 2 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program; if not, write to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA