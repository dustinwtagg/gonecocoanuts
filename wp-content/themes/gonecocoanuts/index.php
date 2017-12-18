<!-- index.php -->
<?php 

get_header();


	//loop through the posts and add them to the page
if (have_posts()) :
	while (have_posts()) : the_post(); ?>
    
	<article class="post <?php if(has_post_thumbnail()) { ?>has-thumbnail<?php } ?>">
		<!-- Post thumbnail -->
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('small-thumbnail'); ?></a>
		</div>
    
        <h2><a href="<?php the_permalink(); ?>"> <?php the_title(); ?></a></h2>
		<p class="post-info"><?php the_time('F jS, Y g:i a'); ?></p>
		
		<?php if($post->post_excerpt) { ?>
			<p>
				<?php echo get_the_excerpt(); ?>
				<a href="<?php the_permalink(); ?>">Read more&raquo;</a>
			</p>
		<?php } else {
			the_content();
		} ?>
	</article>
    
	<?php endwhile;
	
	else :
		echo '<p>No content found.</p>';
		
	endif;
	
get_footer();
?>