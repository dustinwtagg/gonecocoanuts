<!-- awe-booking-template.php -->
<?php
/*
 Template Name: Awebooking Pages Layout
 */
//if (is_page('awe-booking-check') or is_page('awe-checkout') or is_page('awe-room-list')) {
get_header();
?>

<?php
	//loop through the posts and add them to the page
if (have_posts()) :
	while (have_posts()) : the_post(); ?>

    <article class="post page">
        <h2><?php the_title(); ?></h2>
        <!--Info-Box-->

        <?php the_content(); ?>
	</article>
    
	<?php endwhile;
	
	else :
		echo '<p>No content found.</p>';
		
	endif;
	
get_footer();
?>