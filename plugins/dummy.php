<?php
/*
*  PhotoBlog
*  Simple PHP/MySQL Photoblogging platform
*
*  Author: Luca Zorzi <luca AT tuttoeniente DOT net>
*
*  PhotoBlog is released under the BSD license
*/

// Useless plugin

function dummy___doit(){
	echo "Yes, I am useless";
}

function add_hook_actions($PhotoBlog){
	$PhotoBlog->add_action_to_hook('dummy', 'dummy___doit');
}

?>