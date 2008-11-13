<div id="right">
<ul>
<?php if ( !function_exists('dynamic_sidebar')
        || !dynamic_sidebar(2) ) : ?>
			
<li><h2>Search</h2>
<?php include (TEMPLATEPATH . '/searchform.php'); ?>
</li>


<?php wp_list_pages('title_li=<h2>Pages</h2>' ); ?>


<li><h2>Meta</h2>
	<ul>
		<?php wp_register(); ?>
		<li><?php wp_loginout(); ?></li>
		<li><a href="http://validator.w3.org/check/referer" title="This page validates as XHTML 1.0 Transitional">Valid <abbr title="eXtensible HyperText Markup Language">XHTML</abbr></a></li>
		<li><a href="http://gmpg.org/xfn/"><abbr title="XHTML Friends Network">XFN</abbr></a></li>
		<li><a href="http://wordpress.org/" title="Powered by WordPress, state-of-the-art semantic personal publishing platform.">WordPress</a></li>
		<?php wp_meta(); ?>
	</ul>
</li>

<?php endif; ?>

</ul>

</div>

