<?php /* Smarty version 2.6.19, created on 2010-03-02 12:58:12
         compiled from /var/www/PhotoBlog/templates/default/header.tpl */ ?>
<?php echo '<?xml'; ?>
 version='1.0' encoding='<?php echo $this->_tpl_vars['page']['encoding']; ?>
'<?php echo '?>'; ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it">
 <head>
  <title><?php echo $this->_tpl_vars['page']['title']; ?>
</title>
  <meta http-equiv="Content-Type" content="text/html; charset=<?php echo $this->_tpl_vars['page']['encoding']; ?>
" />
  <meta name="description" content="<?php echo $this->_tpl_vars['page']['description']; ?>
" />
  <meta name="keywords" content="<?php echo $this->_tpl_vars['page']['keywords']; ?>
" />
  <meta name="author" content="<?php echo $this->_tpl_vars['page']['author']; ?>
" />
  <meta name="generator" content="<?php echo $this->_tpl_vars['page']['generator']; ?>
" />
  <script type="text/javascript" src="js/prototype.js"></script>
  <script type="text/javascript" src="js/scriptaculous.js?load=effects,builder"></script>
  <script type="text/javascript" src="js/lightbox.js"></script>
  <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php echo $this->_tpl_vars['PhotoBlog']['rss_feed_url']; ?>
" />
  <link rel='stylesheet' href='<?php echo $this->_tpl_vars['PhotoBlog']['home_url']; ?>
style.css.php' type='text/css' />
  <link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen" />
 </head>
 <body>
  <div id="container">
   <div id="header">
    <h1><a href="<?php echo $this->_tpl_vars['PhotoBlog']['home_url']; ?>
"><?php echo $this->_tpl_vars['PhotoBlog']['site_name']; ?>
</a></h1>
    <h2><?php echo $this->_tpl_vars['PhotoBlog']['site_description']; ?>
</h2>
   </div>
   <div id="menu">
    <ul>
     <li class="current_page_item"><a href="<?php echo $this->_tpl_vars['PhotoBlog']['home_url']; ?>
" title="Home">Home</a></li>
    </ul>
   </div>
   <!-- End of common header -->