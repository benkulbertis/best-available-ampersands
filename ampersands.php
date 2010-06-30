<?php
/*
Plugin Name: Best Available Ampersands
Plugin URI: http://codezroz.com/downloads/wordpress-plugins/best-available-ampersands/
Description: Automatically replaces all ampersands in post titles and content with ones styled using Dan Cederholm's "<a href="http://simplebits.com/notebook/2008/08/14/ampersands-2/">Use the Best Available Ampersand</a>" technique.
Author: Ben Kulbertis
Version: 0.1
Author URI: http://codezroz.com/
*/

function replace_ampersand_title($title) {
	$title = html_entity_decode($title, ENT_QUOTES, "UTF-8");
	$title = htmlspecialchars($title, ENT_NOQUOTES, "UTF-8");
	$pattern = '(\&amp\;)';
	$title = preg_replace("/$pattern/u", '<span class="amp">$1</span>', $title);
	return $title;
}

add_filter('the_title', 'replace_ampersand_title');

function replace_ampersand_content($content){
	$content = html_entity_decode($content, ENT_QUOTES, "UTF-8");
	$content = htmlspecialchars($content, ENT_NOQUOTES, "UTF-8");
	$pattern = '(\&amp\;)';
	$content = preg_replace("/$pattern/u", '<span class="amp">$1</span>', $content);
	$content = html_entity_decode($content, ENT_QUOTES, "UTF-8");
	return $content;
}

add_filter('the_content', 'replace_ampersand_content');

function amp_style() {
	echo "
	<style type='text/css'>
		.amp {
			font-family: Baskerville, 'Palatino Linotype', Palatino, Constantia, Georgia, 'Book Antiqua', 'Times New Roman', serif;
			font-style: italic;
		}
	</style>
	";
}

add_action('wp_head', 'amp_style');
?>