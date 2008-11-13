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
define('BASEPATH', str_replace('/style.css.php', '', __FILE__));
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

// Include Smarty Template Engine and initialize it
if(!@include('includes/Smarty/Smarty.class.php')){
	$PhotoBlog->fatal_error('Unable to include "includes/const.inc.php", check your installation');
}

// Inizialize Smarty and set work directories
$smarty = new Smarty;
$smarty->template_dir = BASEPATH.'/templates/'.$PhotoBlog->template_dir;
$smarty->compile_dir = BASEPATH.'/includes/writable/template_c/'.$PhotoBlog->template_dir;

// Set the CSS file as template
$PhotoBlog->set_tpl('style.css');

// Display it
$smarty->display($PhotoBlog->get_tpl());
?>