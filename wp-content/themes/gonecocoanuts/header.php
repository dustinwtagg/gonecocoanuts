<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta name="viewport" content="width=device-width">
		<script type="text/javascript" src="jquery-3.1.1.min.js"></script>
		<title><?php bloginfo('name'); ?></title>
		<meta name="description" content="Come visit our beautiful paradise nestled in the jungle.  Its sets in the largest bay in the Caribbean (Chiriqui Bay) .This is a one of a kind lodge with a hint of chocolate.  Experience making chocolate with us!" />
		<meta name="google-site-verification" content="6oveF2LcIcaTY_EA0MzvxnQ34d7n8tucTz7QkUTwBYY" />
		<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW, NOARCHIVE" />
		<?php wp_head(); ?>
		<script>
			$('robots:before').css('display','none');
		</script>
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
	
	<?php
	/* Determines what style to apply to the pages */
	$awe = true;
	$pages = get_pages(); 

	//if the current page is a admin created page its not a awebooking generated page
	if(is_page($page)) {
		$awe = false;
	}
	//specifically if its a home page then it will or will not be awe themed
	if ( is_front_page() && is_home() ) {
		// Default homepage
		$awe = false;
	  } elseif ( is_front_page() ) {
		// static homepage
		$awe = false;
	  } elseif ( is_home() ) {
		// blog page wont get the theme!
		$awe = false;
	  }
	//set it as a awe themed page if it was a real awe page in_pages()
	if(is_page('awe-booking-check') || is_page('awe-room-list')
		|| is_page('awe-checkout') || is_page('checkout') 
		|| is_page('cart') || is_page('my-account')) {
		$awe = true;
	}
	//if its a post page in a blog dont set awe theme
	if(is_singular('post')) {
		$awe = false;
	}
	
	//now using the boolean it will decide what template to assign the page
	if($awe) { ?>
		<!-- Cant figure out how to insert into awe-booking-template.php? -->
		<div class="container awe-page">
		<!-- site-header -->
		<header class="site-header">
			<nav class="site-nav">
				<?php $args = array('theme_location' => 'primary'); ?>
				<?php wp_nav_menu( $args ); ?>
			</nav>
			<!--<h1><?php //bloginfo('name'); ?></h1>-->
			<img src="https://www.gonecocoanuts.com/wp-content/uploads/2017/01/e3cfb8_142bfa1158514cbdba6e8309d52e459a-mv2.png" alt="" class="logo-thumb"/>
			<h5><?php bloginfo('description'); ?></h5>
		</header>
	<?php }
	else {
		
		//if its home page add the banner
		if(is_page('home')) { 
			//moved to page-home.php
		} ?>
	
		<!-- container -->
		<div class="container">
		<header class="site-header">
			<!--<h1><?php //bloginfo('name'); ?></h1>-->
			<img src="https://www.gonecocoanuts.com/wp-content/uploads/2017/01/e3cfb8_142bfa1158514cbdba6e8309d52e459a-mv2.png" alt="" class="logo-thumb"/>
			<h5><?php bloginfo('description'); ?></h5>
			<?php if(is_page('home')) { ?>
				<nav class="site-nav">
					<?php $args = array('theme_location' => 'primary'); ?>
					<?php wp_nav_menu( $args ); ?>
				</nav>
			<?php } ?>
		</header>
	<?php } ?>
	
