<?php
/*
*  PhotoBlog
*  Simple PHP/MySQL Photoblogging platform
*
*  Author: Luca Zorzi <luca AT tuttoeniente DOT net>
*
*  PhotoBlog is free software, and it is released under the GNU/GPL license version 2
*/

// Die if called directly
if(!defined('_IN_PHOTOBLOG_')){
	die();
}

// -- EDIT FROM HERE -- \\

// MySQL Settings
$mysql_host = 'localhost';          // MySQL Host, 99% is localhost
$mysql_username = 'photoblog';      // MySQL Username
$mysql_password = 'photoblog';      // MySQL Password
$mysql_database = 'photoblog';      // MySQL Database Name
$mysql_table_prefix = 'photoblog_'; // Table prefix for PhotoBlog. Unless special cases, leave default

// General Settings
$writable_dir = BASEPATH.'/includes/writable'; // A directory writable by the webserver.
                                               // Default leads to includes/writable in PhotoBlog's root directory

$log_fatal_errors = 1;                         // Logs fatal errors into $writable_dir/error.log

// -- DO NOT EDIT AFTER THIS POINT -- \\

// Assign user defined values to costants
define('MYSQL_HOST', $mysql_host);
define('MYSQL_USERNAME', $mysql_username);
define('MYSQL_PASSWORD', $mysql_password);
define('MYSQL_DATABASE', $mysql_database);
define('MYSQL_TABLE_PREFIX', $mysql_table_prefix);
define('WRITABLE_DIR', $writable_dir);
define('LOG_FATAL_ERRORS', $log_fatal_errors)
?>