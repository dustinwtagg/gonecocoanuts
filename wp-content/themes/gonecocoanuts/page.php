<!-- page.php -->
<?php 

get_header();

	//loop through the posts and add them to the page
if (have_posts()) :
	while (have_posts()) : the_post(); ?>

    <article class="post page">
        <h2><?php the_title(); ?></h2>
        <?php the_content(); ?>
	</article>
    
	<?php endwhile;
	
	else :
		echo '<p>No content found.</p>';
		
	endif;
	
get_footer();
?>