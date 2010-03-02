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

// Forces debug to be off
$smarty->debugging = false;

// Inform the browser that this is a CSS file
header('Content-type: text/css');

// Set the CSS file as template
$PhotoBlog->set_tpl('style.css');

// Tell Smarty some info about the template, PhotoBlog and the page
$PhotoBlog->tell_smarty($smarty);

// Display it
$smarty->display($PhotoBlog->get_tpl());

// Append LightBox's CSS
?>
#lightbox{	position: absolute;	left: 0; width: 100%; z-index: 100; text-align: center; line-height: 0;}
#lightbox img{ width: auto; height: auto;}
#lightbox a img{ border: none; }

#outerImageContainer{ position: relative; background-color: #fff; width: 250px; height: 250px; margin: 0 auto; }
#imageContainer{ padding: 10px; }

#loading{ position: absolute; top: 40%; left: 0%; height: 25%; width: 100%; text-align: center; line-height: 0; }
#hoverNav{ position: absolute; top: 0; left: 0; height: 100%; width: 100%; z-index: 10; }
#imageContainer>#hoverNav{ left: 0;}
#hoverNav a{ outline: none;}

#prevLink, #nextLink{ width: 49%; height: 100%; background-image: url(data:image/gif;base64,AAAA); /* Trick IE into showing hover */ display: block; }
#prevLink { left: 0; float: left;}
#nextLink { right: 0; float: right;}
#prevLink:hover, #prevLink:visited:hover { background: url(<?=$PhotoBlog->site_url; ?>/images/prevlabel.gif) left 15% no-repeat; }
#nextLink:hover, #nextLink:visited:hover { background: url(<?=$PhotoBlog->site_url; ?>/images/nextlabel.gif) right 15% no-repeat; }

#imageDataContainer{ font: 10px Verdana, Helvetica, sans-serif; background-color: #fff; margin: 0 auto; line-height: 1.4em; overflow: auto; width: 100%	; }

#imageData{	padding:0 10px; color: #666; }
#imageData #imageDetails{ width: 70%; float: left; text-align: left; }	
#imageData #caption{ font-weight: bold;	}
#imageData #numberDisplay{ display: block; clear: left; padding-bottom: 1.0em;	}			
#imageData #bottomNavClose{ width: 66px; float: right;  padding-bottom: 0.7em; outline: none;}	 	

#overlay{ position: absolute; top: 0; left: 0; z-index: 90; width: 100%; height: 500px; background-color: #000; }