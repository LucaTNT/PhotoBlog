<?php
/*
*  PhotoBlog
*  Simple PHP/MySQL Photoblogging platform
*
*  Author: Luca Zorzi <luca AT tuttoeniente DOT net>
*
*  PhotoBlog is released under the BSD license
*/

// Define some needed constants
define('_IN_PHOTOBLOG_', true);
define('BASEPATH', str_replace('/original.php', '', __FILE__));
session_start();

// Include config file
if(!@include('config.php')){
	die('PhotoBlog: FATAL ERROR: Unable to include "config.php", check your installation');
}

// Include constants
if(!@include('includes/const.inc.php')){
	die('PhotoBlog: FATAL ERROR: Unable to include "includes/const.inc.php", check your installation');
}

// Include PhotoBlog's main class and initialize it
if(!@include('includes/PhotoBlog.class.php')){
	die('PhotoBlog: FATAL ERROR: Unable to include "includes/PhotoBlog.class.php", check your installation');
}
$PhotoBlog = new PhotoBlog();

// Parse GET data
$image_id = mysql_escape_string($_GET['image_id']);
if(!is_numeric($image_id)){
	image_not_found();
}

// Function that outputs an image with just a 'NOT FOUND' text in it
function image_not_found(){
	// TODO: HIGH
	die;
}

// Get details about the image
$image = $PhotoBlog->image_get($image_id);

// Generate proper header
switch($image['filetype']){
	case 'jpg':
	case 'jpeg':
		header('Content-type: image/jpeg');
	break;
	case 'gif':
		header('Content-type: image/gif');
	break;
	case 'png':
		header('Content-type: image/png');
	break;
	case 'bmp':
		header('Content-type: image/vnd.wap.wbmp');
	break;
}

// Output image
// TODO: MID (We have to reduce this size because it must fit in the browser window
echo file_get_contents($image['path']);
?>