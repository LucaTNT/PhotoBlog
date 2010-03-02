<?php /* Smarty version 2.6.19, created on 2010-03-02 12:58:12
         compiled from /var/www/PhotoBlog/templates/default/footer.tpl */ ?>
  </div>
  <div id="footer">
   <p>Copyright &copy; 2008 <a href="<?php echo $this->_tpl_vars['PhotoBlog']['home_url']; ?>
"><?php echo $this->_tpl_vars['PhotoBlog']['site_name']; ?>
</a> | <?php echo $this->_tpl_vars['lang']['theme_design_by']; ?>
 <a href="http://www.bytetips.com">Bytetips</a> | <?php echo $this->_tpl_vars['lang']['Feeds']; ?>
 <span class="rss"><a href="<?php echo $this->_tpl_vars['PhotoBlog']['rss_feed_url']; ?>
"><?php echo $this->_tpl_vars['lang']['entries']; ?>
</a></span> <?php echo $this->_tpl_vars['lang']['and']; ?>
 <span class="rss"><a href="<?php echo $this->_tpl_vars['PhotoBlog']['rss_feed_comments_url']; ?>
"><?php echo $this->_tpl_vars['lang']['Comments']; ?>
</a></span> | <?php if ($this->_tpl_vars['PhotoBlog']['show_generation_time'] == '1'): ?><?php echo $this->_tpl_vars['lang']['page_generated_in']; ?>
 <?php echo $this->_tpl_vars['page']['make_time']; ?>
 <?php echo $this->_tpl_vars['lang']['seconds']; ?>
 | <?php endif; ?><?php echo $this->_tpl_vars['lang']['powered_by']; ?>
 <a href="<?php echo $this->_tpl_vars['PhotoBlog']['PhotoBlog_site_url']; ?>
" >PhotoBlog</a></p>
  </div>
 </body>
</html>