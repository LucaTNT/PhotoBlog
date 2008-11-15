<?php
/*
*  PhotoBlog
*  Simple PHP/MySQL Photoblogging platform
*
*  Author: Luca Zorzi <luca AT tuttoeniente DOT net>
*
*  PhotoBlog is free software, and it is released under the GNU/GPL license version 2 or above
*/

/*
*        ** SECURITY WARNING **
*   DELETE THIS SCRIPT IN A PRODUCTION ENVIRONMENT!
*/

// Define some needed constants
define('_IN_PHOTOBLOG_', true);
define('BASEPATH', str_replace('/tmp/db_backup.php', '', __FILE__));

// Include config file
if(!@include('../config.php')){
	die('PhotoBlog: FATAL ERROR: Unable to include "config.php", check your installation');
}

system('mysqldump -h "'.MYSQL_HOST.'" -u "'.MYSQL_USERNAME.'" --password="'.MYSQL_PASSWORD.'" "'.MYSQL_DATABASE.'" > "'.WRITABLE_DIR.'/db_dump.sql"');

echo 'Backup (should be) done';
?>