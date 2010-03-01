<?php
/*
*  PhotoBlog
*  Simple PHP/MySQL Photoblogging platform
*
*  Author: Luca Zorzi <luca AT tuttoeniente DOT net>
*
*  PhotoBlog is released under the BSD license
*/

// Die if called directly
if(!defined('_IN_PHOTOBLOG_')){
	die();
}

// Define PhotoBlog version
define('PHOTOBLOG_VERSION', '0.1');

// Define table names
define('CONFIG_TABLE', MYSQL_TABLE_PREFIX.'config');
define('PLUGIN_TABLE', MYSQL_TABLE_PREFIX.'plugin');
define('POSTS_TABLE', MYSQL_TABLE_PREFIX.'posts');
define('COMMENTS_TABLE', MYSQL_TABLE_PREFIX.'comments');
define('GALLERIES_TABLE', MYSQL_TABLE_PREFIX.'galleries');
define('IMAGES_TABLE', MYSQL_TABLE_PREFIX.'images');
?>