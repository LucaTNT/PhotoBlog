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
define('BASEPATH', str_replace('/index.php', '', __FILE__));
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

// Include default language file
if(!@include('language/lang_'.$PhotoBlog->language.'.php')){
	die('PhotoBlog: FATAL ERROR: Unable to include '.$PhotoBlog->language.' language file, check your installation');
}

// Assign to Smarty the language array to be used in templates
$smarty->assign('lang', $lang);

// Include needed module
if(!@include('modules/'.basename($PhotoBlog->module).'.mod.php')){
	die('PhotoBlog: FATAL ERROR: Unable to load '.basename($PhotoBlog->module).' module, check your installation');
}

// Send page encoding to the browser
header('Content-Type: text/html;charset='.$PhotoBlog->get_config_value('charset'));

// Tell Smarty some info about the template, PhotoBlog and the page
$PhotoBlog->tell_smarty($smarty);

// Display Smarty's work
$smarty->display($PhotoBlog->get_tpl());

?>