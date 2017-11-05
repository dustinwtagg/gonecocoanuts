<!-- footer-special-template.php -->
<?php 
/*
 Template Name: Footer Pages Layout
 */
get_header();
	//loop through the posts and add them to the page
if (have_posts()) :
	while (have_posts()) : the_post(); ?>

    <article class="post page">
        <h2><?php the_title(); ?></h2>
        <!--Info-Box-->
        <div class="info-box">
            <h4>Disclaimer</h4>
            <p style="text-indent: 0;">But I must explain to you how all this mistaken idea of denouncing
            pleasure and praising pain was born and I will give you a complete
            account of the system, and expound the actual
            teachings of the great explorer of the truth,
            the master-builder of human happiness. </p>
        </div>
        <?php the_content(); ?>
	</article>
    
    <?php endwhile;
	
else :
	echo '<p>No content found.</p>';	
endif;
	
get_footer();
?>