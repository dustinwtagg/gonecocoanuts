<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( );
global $TLPfoodmenu;
?>
<div class="tlp-container">
				<div class="tlp-row">
					<div class="tlp-col-1">
					   <div class="tlp-single-item">
				        <div class="total_category">
				            <h3 class="page-title"><?php echo single_cat_title("", false); ?></h3>
				        </div>
					  </div>
				    </div>
				</div>
		<?php
		$html = null;
		$settings = get_option($TLPfoodmenu->options['settings']);
		$col = (@$settings['general']['em_display_col'] ? @$settings['general']['em_display_col'] : 2);
		if($col == 1){
			$colClass = " col-full";
		}else{
			$colClass = null;
		}
		if ( have_posts() ) {
			$html .= '<div class="single-item-content">';
			$count = 0;
			while ( have_posts() ) : the_post();
				$type =  ($count % 2 == 0 ? "even" : "odd");
				$html .= '<div class="single-item '.$type.$colClass.'">';
				$html .= '<div class="menu-img img"><a href="' . get_permalink() . '" title="' . get_the_title() . '">';
				if ( has_post_thumbnail() ) {
					$html .= get_the_post_thumbnail( get_the_ID(), array( 175, 115 ) );
				} else {
					$html .= "<img src='" . $TLPfoodmenu->assetsUrl . 'images/demo-55x55.png' . "' alt='" . get_the_title() . "' />";
				}
				$html .= '</a></div>';
				$html .= '<div class="menu-mid">';
				$html .= '<div class="menu-mid-right">';
				   $html .= '<div class="menu-mid-top">';
				   $html .= '<h3><a href="' . get_permalink() . '" title="' . get_the_title() . '">' . get_the_title() . '</a></h3>';
				   $gTotal = $TLPfoodmenu->getPriceWithLabel();
				   $html .= '<div class="price">' . $gTotal . '</div>';
				   $html .= '</div>';
				   $html .= '<p class="des">' . $TLPfoodmenu->string_limit_words( get_the_content(), 5 ) . '</p>';

				   $html .= '</div>';
				$html .= '</div>';
				$html .= '</div>';
			$count++;
			endwhile;
			$html .= '</div>';
		}else{
			$html .= "<p>" . __( 'No food found.', 'tlp-food-menu' ) . "</p>";
		}
		echo $html;
		?>
</div>
<?php get_footer( ); ?>
