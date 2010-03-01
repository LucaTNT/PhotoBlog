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
	#die();
}

class PhotoBlog{
	// Variables
	public $language, $template_dir, $module, $GET, $page_title, $page_description, $page_keywords, $page_author, $page_generator, $site_url, $pagination;
	private $time_start, $tpl_file, $cache, $hook_actions;

	// Class constructor
	function __construct($no_mysql = 0, $safe_mode = 0){
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
		
		// If $safe_mode is set to 1 plugins aren't loaded
		if($safe_mode == 0){
			$this->load_plugins();
		}
		
		// Parse the URL to find out what we have to do
		$this->parse_url();
		
		$this->page_keywords = 'PhotoBlog, PHP, MySQL, photoblogging, free software, open source';
		$this->page_generator = 'PhotoBlog '.PHOTOBLOG_VERSION;
		
		$this->site_url = 'http://'.$_SERVER['HTTP_HOST'].$this->get_root();
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
			if(ereg('^[a-zA-Z\-]+$', $parse_str[0], $module)){
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

	// This gets the root of this PhotoBlog installation (not in the filesystem, but in the webserver)
	function get_root(){
		return ereg_replace('([a-zA-Z0-9\.]*)\.php', '', $_SERVER['SCRIPT_NAME']);
	}
	
	// Set some template-related variables in Smarty, whose object has to be passed to tell_smarty()
	function tell_smarty($smarty){
		// Tell Smarty some information about its template...
		$template = array('path_www'      => $this->site_url.'templates/'.$this->template_dir,
		                  'path_absolute' => BASEPATH.'/templates/'.$this->template_dir);
		$smarty->assign('template', $template);

		// ...PhotoBlog...
		$photoblog_smarty = array('rss_feed_url'          => 'feed.rss',
		                          'rss_feed_comments_url' => 'comments-feed.rss',
		                          'home_url'              => $this->site_url,
		                          'site_name'             => $this->get_config_value('site_name'),
		                          'site_description'      => $this->get_config_value('site_description'),
		                          'PhotoBlog_site_url'    => 'http://photoblog.tuttoeniente.net/',
		                          'show_generation_time'  => $this->get_config_value('show_generation_time'),
					  'date_format'           => $this->get_config_value('date_format'),
					  'time_format'           => $this->get_config_value('time_format'));
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
	
	// Executes a hook
	function hook($hook){
		if(isset($GLOBALS['hook_actions'][$hook])){
			foreach($GLOBALS['hook_actions'][$hook] as $function){
				$function();
			}
			return true;
		}else{
			return false;
		}
	}
	
	// Adds a function to be executed at a hook
	function add_action_to_hook($hook, $function){
		$GLOBALS['hook_actions'][$hook][] = $function;
		return true;
	}
	
	// Activates a plugin
	function activate_plugin($plugin_filename){
		if(@include(BASENAME.'/plugins/'.$plugin_filename)){
			add_hook_actions(&$this);
			return true;
		}else{
			return false;
		}
	}
	
	// Activates all enabled plugins
	function load_plugins(){
		$q_plugins = mysql_query('SELECT filename FROM '.PLUGIN_TABLE." WHERE enabled='1'");
		while($plugin = mysql_fetch_row($q_plugins)){
			list($plugin_filename) = $plugin;
			if(@include(BASEPATH.'/plugins/'.$plugin_filename)){
				add_hook_actions(&$this);
				return true;
			}else{
				return false;
			}
		}
	}
	
	// Adds something to the cache
	// $sub_id is needed for those arrays that might grow like posts: cache['posts']['post_id'] = array(ALL_POST_DATA)
	function add_to_cache($index, $sub_id = '', $data){
		// TODO: There is no check at all on this data, maybe we should
		//       implement some kind of validation and/or security here
		if(empty($sub_id)){
			$this->cache[$index] = $data;
		}else{
			$this->cache[$index][$sub_id] = $data;
		}
		return true;
	}
	
	//
	// POST FUNCTIONS
	// These functions deal with posts
	//
	
	// Gets a post and saves it to cache, unless explicitly requested not to save it setting $nosave to 1
	function post_get($post_id, $nosave = 0){
		if(is_numeric($post_id)){
			$post_id = mysql_escape_string($post_id);
			$q_post = mysql_query('SELECT * FROM '.POSTS_TABLE." WHERE id='$post_id'");
			if(mysql_num_rows($q_post) > 0){
				$post = mysql_fetch_array($q_post);
				if($nosave == 0){
					$this->cache['posts'][$post_id] = $post;
				}
				return $post;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	
	// Generates the post's permalink according to the scheme saved in the DB
	// See documentation for scheme explaination
	function post_make_link($post_id){
		if(is_numeric($post_id)){
			if(!isset($this->cache['posts'][$post_id])){
				$this->post_get($post_id);
			}
			$post = $this->cache['posts'][$post_id];
			$scheme = $this->get_config_value('permalink_scheme');
			$find = array('%date_year',
			              '%date_month',
				      '%date_day',
				      '%date_hour',
				      '%date_minute',
				      '%date_second',
				      '%post_title',
				      '%post_id');
			$replace = array(strftime('%Y', $post['date']),
			                 strftime('%m', $post['date']),
					 strftime('%d', $post['date']),
					 strftime('%H', $post['date']),
					 strftime('%i', $post['date']),
					 strftime('%s', $post['date']),
					 $this->post_string_for_permalink($post['title']),
					 $post['id']);
			$permalink = str_replace($find, $replace, $scheme);
			return $this->site_url.$permalink;
		}else{
			return false;
		}
	}
	
	// Makes a string a suitable part of the permalink (i.e.: urlencode, no spaces...)
	function post_string_for_permalink($string){
		// TODO: accents and so on, needs a lot of work. Maybe should borrow from WordPress
		$find    = array(' ', '_', '#', '.', ',', ':', ';', '*', '!', '?');
		$replace = array('-', '',  '',  '',  '',  '',  '',  '',  '',  '');
		return urlencode(str_replace($find, $replace, strtolower($string)));
	}
	
	// Parses the text and creates galleries when their code is found
	function parse_post_text($text, $post_id = 0){
		if(!empty($text)){
			function pass_to_gallery($id){
				$PhotoBlog = new PhotoBlog(1, 1);
				$result = $PhotoBlog->make_gallery_for_index($id);
				unset($PhotoBlog);
				return $result;
			}
			$text = nl2br($text);
			$text = preg_replace('#\[GALLERY=([0-9]+)\]#eisU', "pass_to_gallery('$1');", $text);
			if($post_id != 0){
				$post_id = mysql_escape_string($post_id);
				$text_for_query = mysql_escape_string($text);
				// TODO: Enable this
				#mysql_query('UPDATE '.POSTS_TABLE." SET html='$text_for_query' WHERE id='$post_id'");
			}
			return $text;
		}else{
			return false;
		}
	}
	
	// Creates the HTML code of the gallery to be shown in the index
	function make_gallery_for_index($gallery_id){
		global $smarty;
		if($this->gallery_has_images($gallery_id)){
			// Get the number of images in the gallery, the images themselves and determine the cover image
			$images_number = $this->gallery_images_number($gallery_id);
			$images = $this->gallery_get_images($gallery_id);
			$cover_id = $this->gallery_get_cover($gallery_id);
			// Retrive the number of rows and cols defined in config table
			$rows = $this->get_config_value('small_thumb_rows_in_index');
			$cols = $this->get_config_value('small_thumb_per_row_in_index');
			$current_col = 1;
			// Calculate the maximum number of thumbs to be shown
			$thumb_number = $rows * $cols;
			
			// If the total number of images in the gallery is less than the maximum for the index page show them all (of course)
			if($images_number <= $thumb_number){
				$thumb_number = $images_number;
				$show_link_for_gallery = 0;
			}else{
				// If the images in the gallery are more than the few we show, we must tell Smarty to show a link to the whole gallery
				$smarty->assign('gallery_link', $this->gallery_get_link($gallery_id));
				$show_link_for_gallery = 1;
			}
			
			// Prepare images for Smarty
			$images_for_smarty = array();
			for($n = 0; $n < $thumb_number; $n++){
				// Perform this check to tell smarty when he has to
				// create a new line in our gallery
				if($images[$n]['id'] != $cover_id){
					if($current_col < $cols){
						$current_col++;
					}else{
						$images[$n]['last_in_row'] = 1;
					}
				}
				$images[$n]['image_link'] = $this->image_get_link($images[$n]['id']);
				$images_for_smarty[] = $images[$n];
			}
			
			// Assign variables to Smarty
			$smarty->assign(array('rows'                  => $rows,
			                      'cols'                  => $cols,
					      'thumb_number'          => $thumb_number,
			                      'gallery_cover'         => array('image_url' => $this->image_get_big_thumb_url($cover_id), 'image_link' => $this->image_get_link($cover_id), 'description' => $cache['images'][$cover_id]['caption']),
			                      'images'                => $images_for_smarty,
					      'lightbox'              => $this->get_config_value('lightbox'),
					      'gallery_id'            => $gallery_id,
					      'show_link_for_gallery' => $show_link_for_gallery));
			
			return $smarty->fetch('gallery_for_index.tpl');
		}else{
			return false;
		}
	}
	
	// Checks if a gallery exists in the DB (even with no images). It saves the gallery details in the cache.
	function gallery_exist($gallery_id){
		$gallery_id = mysql_escape_string($gallery_id);
		if(isset($this->cache['galleries'][$gallery_id])){
			return true;
		}else{
			$q_gallery = mysql_query('SELECT * FROM '.GALLERIES_TABLE." WHERE id='$gallery_id'");
			if(mysql_num_rows($q_gallery) > 0){
				$gallery = mysql_fetch_array($q_gallery);
				$this->cache['galleries'][$gallery_id] = $gallery;
				return true;
			}else{
				return false;
			}
		}
	}
	
	// Checks if a gallery has at least one image in it. If so, it saves a 'images_number' index in the cache.
	function gallery_has_images($gallery_id){
		if($this->gallery_exist($gallery_id)){
			if(isset($this->cache['galleries'][$gallery_id]['images_number'])){
				return true;
			}else{
				$gallery_id = mysql_escape_string($gallery_id);
				$q_images = mysql_query('SELECT COUNT(id) FROM '.IMAGES_TABLE." WHERE gallery_id='$gallery_id'");
				if(mysql_num_rows($q_images) > 0){
					list($images_number) = mysql_fetch_row($q_images);
					$this->cache['galleries'][$gallery_id]['images_number'] = $images_number;
					return true;
				}else{
					return false;
				}
			}
		}else{
			return false;
		}
	}
	
	// Gets the number of images in a gallery, returns it and saves it to the cache
	function gallery_images_number($gallery_id){
		if(isset($this->cache['galleries'][$gallery_id]['images_number'])){
			return $this->cache['galleries'][$gallery_id]['images_number'];
		}else{
			if($this->gallery_has_images($gallery_id)){
				return $this->cache['galleries'][$gallery_id]['images_number'];
			}else{
				return false;
			}
		}
	}
	
	// Gets the images in the gallery and saves the array in the cache
	function gallery_get_images($gallery_id){
		if($this->gallery_has_images($gallery_id)){
			$gallery_id = mysql_escape_string($gallery_id);
			$q_images = mysql_query('SELECT * FROM '.IMAGES_TABLE." WHERE gallery_id='$gallery_id'");
			while($image = mysql_fetch_array($q_images)){
				if($image['gallery_cover'] == 1){
					$this->cache['galleries'][$gallery_id]['cover'] = $image['id'];
					$cover_found = 1;
				}
				$image['small_thumb_url'] = $this->image_get_small_thumb_url($image['id']);
				$this->cache['galleries'][$gallery_id]['images'][] = $image;
				$this->cache['images'][$image['id']] = $image;
			}
			if(!isset($cover_found)){
				$this->cache['galleries'][$gallery_id]['cover'] = 0;
			}
			return $this->cache['galleries'][$gallery_id]['images'];
		}else{
			return false;
		}
	}
	
	// Gets the image to be used as album cover (through gallery_get_images)
	function gallery_get_cover($gallery_id){
		if(!isset($this->cache['galleries'][$gallery_id]['cover'])){
			$this->gallery_get_images($gallery_id);
		}
		return $this->cache['galleries'][$gallery_id]['cover'];
	}
	
	function gallery_get_name($gallery_id){
		$gallery_id = mysql_escape_string($gallery_id);
		if($this->gallery_exist($gallery_id)){
			return $this->cache['galleries'][$gallery_id]['name'];
		}else{
			return false;
		}
	}
	
	// Get the link for the requested gallery
	function gallery_get_link($gallery_id){
		$gallery_id = mysql_escape_string($gallery_id);
		if($this->gallery_exist($gallery_id)){
			return $this->site_url.'gallery/'.$gallery_id.'/'.$this->post_string_for_permalink($this->gallery_get_name($gallery_id)).'/';
		}else{
			return false;
		}
	}
	
	// Checks if an image exists and, if so, inserts its details in the cache
	function image_exist($image_id){
		$image_id = mysql_escape_string($image_id);
		if(isset($this->cache['images'][$image_id])){
			return true;
		}else{
			$q_image = mysql_query('SELECT * FROM '.IMAGES_TABLE." WHERE id='$image_id'");
			if(mysql_num_rows($q_image) > 0){
				$image = mysql_fetch_array($q_image);
				$this->cache['images'][$image_id] = $image;
				return true;
			}else{
				return false;
			}
		}
	}
	
	// Gets the details of an image and saves them into the cache
	function image_get($image_id){
		$image_id = mysql_escape_string($image_id);
		if($this->image_exist($image_id)){
			return $this->cache['images'][$image_id];
		}else{
			return false;
		}
	
	}
	
	// Gets the caption of an image
	function image_get_caption($image_id){
		$image_id = mysql_escape_string($image_id);
		if($this->image_exist($image_id)){
			return $this->cache['images'][$image_id]['caption'];
		}else{
			return false;
		}
	}
	
	// Gets the small thumbnail URL
	function image_get_small_thumb_url($image_id){
		$image = $this->image_get($image_id);
		$gallery_id = $image['gallery_id'];
		$this->gallery_exist($gallery_id);
		$gallery_name = $this->post_string_for_permalink($this->gallery_get_name($gallery_id));
		$image_name = $this->post_string_for_permalink($this->image_get_caption($image_id));
		return $this->site_url.'thumbnails/'.$image_id.'/'.$gallery_name.'/small/'.$image_name.'.'.$image['filetype'];
	}
	
	// Gets the big thumbnail URL
	function image_get_big_thumb_url($image_id){
		$image = $this->image_get($image_id);
		$gallery_id = $image['gallery_id'];
		$this->gallery_exist($gallery_id);
		$gallery_name = $this->post_string_for_permalink($this->gallery_get_name($gallery_id));
		$image_name = $this->post_string_for_permalink($this->image_get_caption($image_id));
		return $this->site_url.'thumbnails/'.$image_id.'/'.$gallery_name.'/big/'.$image_name.'.'.$image['filetype'];
	}
	
	// Gets the link to see the big image
	function image_get_link($image_id){
		$image = $this->image_get($image_id);
		$gallery_id = $image['gallery_id'];
		$this->gallery_exist($gallery_id);
		$gallery_name = $this->post_string_for_permalink($this->gallery_get_name($gallery_id));
		$image_name = $this->post_string_for_permalink($this->image_get_caption($image_id));
		return $this->site_url.'image-big/'.$image_id.'/'.$gallery_name.'/'.$image_name.'/';
	}
}
?>
