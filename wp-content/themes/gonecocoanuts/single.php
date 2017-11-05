<!-- single.php -->
<?php 

get_header();

	//loop through the posts and add them to the page
if (have_posts()) :
	while (have_posts()) : the_post(); ?>
    
    <article class="post">
        <h2><a href="<?php the_permalink(); ?>"> <?php the_title(); ?></a></h2>
		
		<p class="post-info"><?php the_time('F jS, Y g:i a'); ?></p>
		<?php the_post_thumbnail('baner-image'); ?>
        <?php the_content(); ?>
	</article>
    
	<?php endwhile;
	
	else :
		echo '<p>No content found</p>';
		
	endif;
	
get_footer();
?>