<?php
/*
*  PhotoBlog
*  Simple PHP/MySQL Photoblogging platform
*
*  Author: Luca Zorzi <luca AT tuttoeniente DOT net>
*
*  PhotoBlog is free software, and it is released under the GNU/GPL license version 2 or above
*/

// Define some needed constants
define('_IN_PHOTOBLOG_', true);
define('BASEPATH', str_replace('/thumbnail.php', '', __FILE__));
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
$image_size = strtolower($_GET['size']);
if($image_size != 'big' && $image_size != 'small'){
	image_not_found();
}

// Function that outputs an image with just a 'NOT FOUND' text in it
function image_not_found(){
	// TODO: HIGH
}

// Get details about the image
$image = $PhotoBlog->image_get($image_id);

// Get the thumb name to save it or to get it if already created
$thumb_name = WRITABLE_DIR.'/thumbs/'.$image_id.'_'.$image_size.'.'.$image['filetype'];

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

// Check if the thumb already exists and output it if so
if(is_file($thumb_name) && is_readable($thumb_name)){
	echo file_get_contents($thumb_name);
}else{
	// Copy the source image
	switch($image['filetype']){
		case 'jpg':
		case 'jpeg':
			$original_img = imagecreatefromjpeg($image['path']);
		break;
		case 'gif':
			$original_img = imagecreatefromgif($image['path']);
		break;
		case 'png':
			$original_img = imagecreatefrompng($image['path']);
		break;
		case 'bmp':
			$original_img = imagecreatefromwbmp($image['path']);
		break;
	}
	
	// Get image size
	list($width, $height) = getimagesize($image['path']);
	
	// Get thumb size from DB
	if(isset($_GET['size']) && $_GET['size'] == 'small'){
		$size = $PhotoBlog->get_config_value('small_thumb_size');
	}else{
		$size = $PhotoBlog->get_config_value('big_thumb_size');
	}
	
	// Calculate new size
	if($height < $width){
		$new_width = (int) $size;
		$ratio = $height / $width;
		$new_height = (int) $new_width * $ratio;
	}else{
		$new_height  = (int) $size;
		$ratio = $width / $height;
		$new_width = (int) $new_height * $ratio;
	}
	
	// Create the thumbnail
	$thumb = imagecreatetruecolor($new_width, $new_height);
	
	if($PhotoBlog->get_config_value('resample_thumbnails') == 1){
		imagecopyresampled($thumb, $original_img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
	}else{
		imagecopyresized($thumb, $original_img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
	}
	
	// Save the thumbnail...
	switch($image['filetype']){
		case 'jpg':
		case 'jpeg':
			imagejpeg($thumb, $thumb_name, $PhotoBlog->get_config_value('thumbnail_quality'));
		break;
		case 'gif':
			imagegif($thumb, $thumb_name);
		break;
		case 'png':
			imagepng($thumb, $thumb_name);
		break;
		case 'bmp':
			imagewbmp($thumb, $thumb_name);
		break;
	}
	
	// ...and display it
	echo file_get_contents($thumb_name);
}
?>