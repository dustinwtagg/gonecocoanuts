<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta name="viewport" content="width=device-width">
		<script src="wp-content/plugins/gestures-master/js/Tocca.js"></script>
		<title><?php bloginfo('name'); ?></title>
		<meta name="description" content="Come visit our beautiful paradise nestled in the jungle.  Its sets in the largest bay in the Caribbean (Chiriqui Bay) .This is a one of a kind lodge with a hint of chocolate.  Experience making chocolate with us!" />
		<meta name="google-site-verification" content="6oveF2LcIcaTY_EA0MzvxnQ34d7n8tucTz7QkUTwBYY" />
		<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW, NOARCHIVE" />
		<?php wp_head(); ?>
	</head>
	
<body <?php body_class(); ?>>

	<div class="banner">
		<!-- cocoa nut banner css defined -->
	</div>
	<!-- site-nav -->
	<nav class="directory">
		
		<!--<div id="hamburger-icon">
           <img src="wp-content/themes/gonecocoanuts/images/menu3_white.png" alt="" id="img_open" onclick="menuDisplay();"/>
            <img src="wp-content/themes/gonecocoanuts/images/menu4_white.png" alt="" id="img_close" onclick="menuDisplay();"/>
        </div>-->
		
	<?php	
		$args = array('theme_location' => 'global');
		?>
	<?php wp_nav_menu( $args ); ?>
	</nav>
	
	<div id="logo-spot2" style="display: none;">
		<img src="https://www.gonecocoanuts.com/wp-content/uploads/2017/01/e3cfb8_142bfa1158514cbdba6e8309d52e459a-mv2.png" alt=""/>
	</div>
	
	<!-- container -->
	<div class="container home">
		
		<header class="site-header">
			<nav class="site-nav">
				<?php $args = array('theme_location' => 'primary'); ?>
				<?php wp_nav_menu( $args ); ?>
			</nav>
			<img src="https://www.gonecocoanuts.com/wp-content/uploads/2017/01/e3cfb8_142bfa1158514cbdba6e8309d52e459a-mv2.png" alt="" id="logo"/>
		    <div id="home-banner-container">
				<img src="https://www.gonecocoanuts.com/wp-content/uploads/2017/01/IMG_2601.jpg" alt="" id="home-banner"/>
			</div>
			<div class="sale">
				<p>Rooms starting as low as </p><h3>$125.00</h3><p> per night!</p>
			</div>
		</header>
		
		
	<div class="slider-container">
		<?php echo do_shortcode("[metaslider id=96]"); ?>
	</div>
	<?php
	 
	if (have_posts()) :
	
		while (have_posts()) : the_post(); ?>
	
		<article class="post page">
			<h2><?php the_title(); ?></h2>
			<?php the_content(); ?>
		</article>
		
		<?php endwhile;
		
	else :
		echo '<p>No content found.</>';	
	endif;
	
	?>
		<h2 id="post-grid-header">Gone CocoaNuts Rooms and Villas</h2>
	<?php
	echo do_shortcode("[post_grid id='273']");
	
	get_footer();
	?>