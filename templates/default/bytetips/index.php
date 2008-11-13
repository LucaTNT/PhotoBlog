<?php get_header(); ?>

<?php include(TEMPLATEPATH."/left.php");?>
	
<div id="content">
	<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>
				
		<div class="post" id="post-<?php the_ID(); ?>">
			<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
			<br><hr><small><b>By</b> <?php the_author() ?> ~ <?php the_time('F jS, Y') ?>. <b>Filed under:</b> <?php the_category(', ') ?>. <?php edit_post_link('(edit)'); ?></small>
				
			<div class="entry">
				<?php the_content('Continue reading &raquo;'); ?>
			</div>
		
			<p class="postmetadata"><?php the_tags('<b>Tags:</b> ', ', ', ''); ?> | <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></p>
			</div>
	
		<?php endwhile; ?>

		<div class="navigation">
 
    <div class="alignleft">
 
      <?php next_posts_link('&larr; Previous Entries') ?>
 
    </div>
 
    <div class="alignright">
 
      <?php previous_posts_link('Next Entries &rarr;') ?>
    </div>
</div>
		
		<?php else : ?>

		<h2>Not Found</h2>
		<p>Sorry, but you are looking for something that isn't here.</p>
		<?php include (TEMPLATEPATH . "/searchform.php"); ?>

	<?php endif; ?>
	
</div>

<?php include(TEMPLATEPATH."/right.php");?>


<?php get_footer(); ?>
