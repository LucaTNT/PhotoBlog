<?php
/*
*  PhotoBlog
*  Simple PHP/MySQL Photoblogging platform
*
*  Author: Luca Zorzi <luca AT tuttoeniente DOT net>
*
*  PhotoBlog is free software, and it is released under the GNU/GPL license version 2 or above
*/

// Die if called directly
if(!defined('_IN_PHOTOBLOG_')){
	die();
}

class PhotoBlog{
	// Variables
	public $language, $template_dir, $module, $GET, $page_title, $page_description, $page_keywords, $page_author, $page_generator;
	private $time_start, $tpl_file, $cache;

	// Class constructor
	function __construct($no_mysql = 0){
		// Store microtime at class initialization to calculate page generation time
		$this->time_start = $this->get_time();
		
		// Disable MySQL connection setting $no_mysql to 1, useful if we need another instance of $PhotoBlog and the DB is already connected
		if($no_mysql != 1){
			$this->mysql_connect();
		}
		
		// Do some needed assignments and checks
		$this->check_permissions();
		$this->get_language();
		$this->get_template();
		$this->parse_url();
		
		$this->page_keywords = 'PhotoBlog, PHP, MySQL, photoblogging, free software, open source';
		$this->page_generator = 'PhotoBlog '.PHOTOBLOG_VERSION;
		
	}
	
	// Gets microtime, useful for page generation time
	private function get_time(){
		list($usec, $sec) = explode(' ',microtime());
		return ((float)$usec + (float)$sec);
	}
	
	// Call this to get page generation time
	function make_time(){
		$now = $this->get_time();
		$this->time_start;
		return round($now - $this->time_start, 2);
	}
	
	// Prints a nice (?) fatal error message and logs it if logging is enabled in config.php
	// Setting $nolog to 1 disables logging for this call
	function fatal_error($error, $nolog = 0){
		echo('<b>PhotoBlog: FATAL ERROR:</b> '.$error."<br />");
		if(LOG_FATAL_ERRORS == 1 && $nolog == 0){
			$open = @fopen(WRITABLE_DIR.'/error.log', 'a');
			if(!$open){
				$this->fatal_error('Unable to write error log, check permissions', 1);
			}else{
				fwrite($open, date('Y-m-d H:i:s').' - '.$_SERVER['REMOTE_ADDR'].' - '.$error."\n");
				fclose($open);
			}
		}
		die();
	}

	// MySQL connection and DB selection
	function mysql_connect(){
		if(!@mysql_connect(MYSQL_HOST, MYSQL_USERNAME, MYSQL_PASSWORD)){
			$this->fatal_error('Unable to connect to MySQL, check your config.php');
		}
		if(!mysql_select_db(MYSQL_DATABASE)){
			$this->fatal_error('Database not found, check your config.php');
		}
	}

	// Check permissions of some files/directories
	function check_permissions(){
		if(!is_writable(WRITABLE_DIR)){
			$this->fatal_error('Selected writable directory is not writable. Check your config.php and/or directory permissions');
		}
		if(!is_writable(WRITABLE_DIR.'/template_c')){
			$this->fatal_error('Smarty\'s compile directory (<i>/includes/template_c</i>) is not writable');
		}
	}

	// Retrive default language from config table
	function get_language(){
		$q_lang = mysql_query('SELECT config_value FROM '.CONFIG_TABLE." WHERE config_name='language'");
		if(mysql_num_rows($q_lang) != 1){
			$this->fatal_error('Corrupted '.CONFIG_TABLE.' table');
		}
		list($language) = mysql_fetch_row($q_lang);

		// Check if language exitsts
		if(!is_file(BASEPATH.'/language/lang_'.$language.'.php')){
			$this->fatal_error('Corrupted '.CONFIG_TABLE.' table: language '.$language.' missing in languages directory');
		}else{
			$this->language = $language;
		}
	}

	// Retrive default template from config table
	function get_template(){
		$q_tpl = mysql_query('SELECT config_value FROM '.CONFIG_TABLE." WHERE config_name='template'");
		if(mysql_num_rows($q_tpl) != 1){
			$this->fatal_error('Corrupted '.CONFIG_TABLE.' table');
		}
		list($template) = mysql_fetch_row($q_tpl);

		// Check if template exists
		if(!is_dir(BASEPATH.'/templates/'.$template)){
			$this->fatal_error('Corrupted '.CONFIG_TABLE.' table: template '.$template.' missing in templates directory');
		}else{
			$this->template_dir = $template;
		}
	}
	
	// Analyze URL
	function parse_url(){
		if(str_replace('index.php', '', $_SERVER['REQUEST_URI']) == str_replace('index.php', '', $_SERVER['SCRIPT_NAME'])){
			$this->module = 'index';
		}else{
			$parse_str = explode('/', str_replace($_SERVER['SCRIPT_NAME'].'/', '', $_SERVER['REQUEST_URI']));
			if(ereg('^[a-zA-Z]+$', $parse_str[0], $module)){
				$this->module = strtolower($module[0]);
			}
			
			foreach($parse_str as $k => $value){
				if($k > 0){
					if(strstr($value, '___')){
						$data = explode('___', $value);
						$this->GET[$data[0]] = $data[1];
					}else{
						$this->GET[] = $value;
					}
				}
			}
		}	
	}
	
	// Gets the value of a setting in the config table, and use cache if present
	function get_config_value($option, $fresh = 0){
		if(!isset($this->cache['config'][$option]) || $fresh == 1){
			$cfg = mysql_escape_string($option);
			$q_value = mysql_query('SELECT config_value FROM '.CONFIG_TABLE." WHERE config_name='$cfg'");
			if(mysql_num_rows($q_value) == 1){
				list($value) = mysql_fetch_row($q_value);
				return $this->cache['config'][$option] = $value;
			}else{
				return false;
			}
		}else{
			return $this->cache['config'][$option];
		}
	}
	
	// Set the tpl file to use (under $this->template_dir directory, but $this->template_dir is not used in this function because it's already set as Smarty's basedir so there's no need to specify it)
	// @TODO: Implement something that checks that the requested tpl exists
	function set_tpl($tpl){
		$this->tpl_file = basename($tpl).'.tpl';
	}
	
	// Gets the tpl file to use, mostly used in $smarty->display() calls
	function get_tpl(){
		if(!empty($this->tpl_file)){
			return $this->tpl_file;
		}else{
			return false;
		}
	}
	
	// Set some template-related variables in Smarty, whose object has to be passed to tell_smarty()
	function tell_smarty($smarty){
		// Tell Smarty some information about its template...
		$template = array('path_www'      => $this->get_config_value('photoblog_url').'templates/'.$this->template_dir,
		                  'path_absolute' => BASEPATH.'/templates/'.$this->template_dir);
		$smarty->assign('template', $template);

		// ...PhotoBlog...
		$photoblog_smarty = array('rss_feed_url'          => 'feed.rss',
		                          'rss_feed_comments_url' => 'comments-feed.rss',
		                          'home_url'              => $this->get_config_value('photoblog_url'),
		                          'site_name'             => $this->get_config_value('site_name'),
		                          'site_description'      => $this->get_config_value('site_description'),
		                          'PhotoBlog_site_url'    => 'http://photoblog.tuttoeniente.net/',
		                          'show_generation_time'  => $this->get_config_value('show_generation_time'));
		$smarty->assign('PhotoBlog', $photoblog_smarty);

		// ... and the page
		$page = array('encoding'    => $this->get_config_value('charset'),
		              'title'       => $this->page_title,
			      'description' => $this->page_description,
		              'keywords'    => $this->page_keywords,
		              'author'      => $this->page_author,
		              'generator'   => $this->page_generator,
		              'make_time'   => $this->make_time());
		$smarty->assign('page', $page);
	}
}
?>