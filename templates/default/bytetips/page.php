<?php get_header(); ?>

<?php include(TEMPLATEPATH."/left.php");?>

	<div id="content">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post" id="post-<?php the_ID(); ?>">
		<h2><?php the_title(); ?></h2>
			<br><hr><?php edit_post_link('(edit this page)', '<p>', '</p>'); ?>
<div class="entry">
				<?php the_content('<p>Continue reading &raquo;</p>'); ?>
	
				<?php //if page is split into more than one
					link_pages('<p>Pages: ', '</p>', 'number'); ?>
			</div>
		</div>
	  <?php endwhile; endif; ?>
	
	
	
</div>

<?php include(TEMPLATEPATH."/right.php");?>


<?php get_footer(); ?>