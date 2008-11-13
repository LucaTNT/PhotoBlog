{*Smarty*}
<?xml version='1.0' encoding='{$page.encoding}'?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it">
 <head>
  <title>{$page.title}</title>
  <meta http-equiv="Content-Type" content="text/html; charset={$page.encoding}" />
  <meta name="description" content="{$page.description}" />
  <meta name="keywords" content="{$page.keywords}" />
  <meta name="author" content="{$page.author}" />
  <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="{$PhotoBlog.rss_feed_url}" />
  <link rel='stylesheet' href='{$PhotoBlog.home_url}style.css.php' type='text/css' />
 </head>
 <body>
  <div id="container">
   <div id="header">
    <h1><a href="<?php echo get_settings('home'); ?>/"><?php bloginfo('name'); ?></a></h1>
    <h2><?php bloginfo('description'); ?></h2>
   </div>
   <div id="menu">
    <ul>
     <li class="current_page_item"><a href="{$PhotoBlog.home_url}" title="Home">Home</a></li>
    </ul>
   </div>

