<?php get_header(); ?>
<?php include(TEMPLATEPATH."/left.php");?>
	
	<div id="content">			
  	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
		<div class="post" id="post-<?php the_ID(); ?>">

		<div class="clear"></div>
			<h2><a href="<?php echo get_permalink() ?>" rel="bookmark" title="Permanent Link: <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
			<br><hr><small><b>By</b> <?php the_author() ?> ~ <?php the_time('F jS, Y') ?>. <b>Filed under:</b> <?php the_category(', ') ?>. <?php edit_post_link('(edit)'); ?></small>
	
			<div class="entry">
				<?php the_content('<p>Continue reading &raquo;</p>'); ?>
				<p class="postmetadata"><?php the_tags('<b>Tags:</b> ', ', ', ''); ?></p>
	
			<div class="navigation">
				<div class="alignleft"><?php previous_post_link('&laquo; %link') ?></div>
				<div class="alignright"><?php next_post_link('%link &raquo;') ?></div>
			</div>
		

	
			</div>
		</div>
		
		<?php comments_template(); ?>

	<?php endwhile; else: ?>
	
	<p>Sorry, no posts matched your criteria.</p>
	
	<?php endif; ?>
	
	</div>
	

	<?php include(TEMPLATEPATH."/right.php");?>



<?php get_footer(); ?>
