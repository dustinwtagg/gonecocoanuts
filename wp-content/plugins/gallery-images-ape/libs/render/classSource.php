<?php
/*  
 * Ape Gallery			
 * Author:            	Wp Gallery Ape 
 * Author URI:        	https://wpape.net/
 * License:           	GPL-2.0+
 */

if ( ! defined( 'WPINC' ) )  die;
if ( ! defined( 'ABSPATH' ) ){ exit;  }

class apeGallerySource{
	
	public $id 			= 0;
	public $fromIds 	= '';

	public $imagesList	= array();
	public $categoriesList	= array();

	public $width 		= 0;
	public $height		= 0;
	public $thumbsource = '';
	public $orderby = '';
	public $lazyLoad = 1;


	function __construct($id, $fromIds = 0 ){
 		if( isset($id) && (int) $id ){
			$this->id = (int) $id;
 		}
 		$this->fromIds = $fromIds;
 		++$this->lazyLoad;
 	}

 	function setSize( $width , $height, $thumbsource, $orderby ){
 		$this->width 		= $width;
 		$this->height 		= $height;
 		$this->thumbsource 	= $thumbsource;
 		$this->orderby 		= $orderby;
 	}

 	function getImages(){
 		if(!$this->id) return false;

 		if(!$this->fromIds){
			$imgIds = get_post_meta( $this->id, WPAPE_GALLERY_NAMESPACE.'galleryImages', true );
 		} else{
			$imgIds = $this->fromIds;
		}
		
		if( isset($imgIds) && !is_array($imgIds)==1 && trim($imgIds)=='' ) $imgIds = array();
		
		if( isset($imgIds) && is_array($imgIds) && isset($imgIds[0]) && count($imgIds)==1 && trim($imgIds[0])=='' ) $imgIds = array();
		
		if( !get_post_meta( $this->id, WPAPE_GALLERY_NAMESPACE.'menuSelfImages', true ) ){
			$imgIds = array();
		}

		for ($i=0; $i < count($imgIds) ; $i++){
			$this->imagesList[] = array( 'id'=> $imgIds[$i], 'catid'=> $this->id );
		}

		$post = get_post($this->id);

		if( get_post_meta( $this->id, WPAPE_GALLERY_NAMESPACE.'menuSelf', true ) && !$this->fromIds ){
			$this->categoriesList[] = array( 
				'id'	=> $this->id, 
				'title'	=> $post->post_title, 
				'name'	=> $post->post_name, 
				'icon' 	=> get_post_meta( $this->id, WPAPE_GALLERY_NAMESPACE.'menuLabel', true ),
				'alter' => get_post_meta( $this->id, WPAPE_GALLERY_NAMESPACE.'menuLabelText', true ) 
			);
		}


		$my_wp_query = new WP_Query();
 		$all_wp_pages = $my_wp_query->query(array(
 				'post_type' => WPAPE_GALLERY_POST,
 				'orderby'   => array( 
 					'menu_order'	=> 'DESC', 
 					'order'			=> 'ASC', 
 					'title'			=> 'DESC' 
 				),
 				'posts_per_page' => $this->lazyLoad,
 		));

		$children = get_page_children( $this->id, $all_wp_pages );
		if($this->fromIds ) $children = '';

		$tempCatArray  = array();
		for($i=0;$i<count($children);$i++){
			$imgIds = get_post_meta( $children[$i]->ID, WPAPE_GALLERY_NAMESPACE.'galleryImages', true );
			if($imgIds && count($imgIds)){
				$post = get_post($children[$i]->ID); 
				$tempCatArray[] = array( 
						'id'	=> $children[$i]->ID,
						'title'	=> $post->post_title, 
						'name'	=> $post->post_name, 
						'icon' 	=> get_post_meta( $children[$i]->ID, WPAPE_GALLERY_NAMESPACE.'menuLabel', true ),
						'alter' => get_post_meta( $children[$i]->ID, WPAPE_GALLERY_NAMESPACE.'menuLabelText', true )
				);
				for ($j=0; $j < count($imgIds) ; $j++){
					$this->imagesList[] = array( 'id'=> $imgIds[$j], 'catid'=> $children[$i]->ID );
				}
			}
		}
		$tempCatArray = array_reverse ($tempCatArray);
		$this->categoriesList = array_merge($this->categoriesList, $tempCatArray );

		for($i=0;$i<count($this->imagesList);$i++){
			$img = $this->imagesList[$i];
			$thumb = wp_get_attachment_image_src( $img['id'] , $this->thumbsource);

			if( !is_array($thumb) || !count($thumb) ){
				unset($this->imagesList[$i]);	
			} else {
				$this->imagesList[$i]['image'] 		= 	wp_get_attachment_url( $img['id'] );
				$this->imagesList[$i]['thumb'] 		=	(isset($thumb) && count($thumb) ) ? $thumb[0] : '';
				$this->imagesList[$i]['sizeW']  	=	(isset($thumb[1]) && count($thumb)) ? $thumb[1] : $this->width;
				$this->imagesList[$i]['sizeH']  	= 	(isset($thumb[2]) && count($thumb)) ? $thumb[2] : $this->height;
				$this->imagesList[$i]['data'] 		=	get_post($img['id'] );
				$this->imagesList[$i]['link'] 		=	get_post_meta( $img['id'], WPAPE_GALLERY_NAMESPACE.'gallery_link', true );
				$this->imagesList[$i]['typelink'] 	= 	get_post_meta( $img['id'], WPAPE_GALLERY_NAMESPACE.'gallery_type_link', true );
				$this->imagesList[$i]['videolink']	= 	get_post_meta( $img['id'], WPAPE_GALLERY_NAMESPACE.'gallery_video_link', true );
				$this->imagesList[$i]['col'] 		=	get_post_meta( $img['id'], WPAPE_GALLERY_NAMESPACE.'gallery_col', true );
				$this->imagesList[$i]['effect'] 	=	get_post_meta( $img['id'], WPAPE_GALLERY_NAMESPACE.'gallery_effect', true );
				//print_r($this->imagesList[$i]['data']);
			}
			
		}	

		switch ( $this->orderby ) {
			case 'random':		shuffle ($this->imagesList);											break;

			case 'titleU':		usort($this->imagesList, array('apeGallerySource','sortTitleASC') );	break;
			case 'titleD':		usort($this->imagesList, array('apeGallerySource','sortTitleDESC') );	break;

			case 'dateU':		usort($this->imagesList, array('apeGallerySource','sortDateASC') );		break;
			case 'dateD':		usort($this->imagesList, array('apeGallerySource','sortDateDESC') );	break;

			case 'categoryU':	$this->imagesList = array_reverse($this->imagesList);					break;
			case 'categoryD':
			default:
				break;
		}
		
 	}

 	private static function sortTitleASC( $elem1, $elem2 ){
		return strcasecmp( $elem1['data']->post_title, $elem2['data']->post_title ) *-1;
	}

	private static function sortTitleDESC( $elem1, $elem2 ){
		return strcasecmp( $elem1['data']->post_title, $elem2['data']->post_title );
	}

	private static function sortDateASC( $elem1, $elem2 ){
		if( $elem1['data']->post_date == $elem2['data']->post_date ) return 0;
		if( $elem1['data']->post_date  > $elem2['data']->post_date ) return 1;
			else return -1;
	}

	private static function sortDateDESC( $elem1, $elem2 ){
		if( $elem1['data']->post_date == $elem2['data']->post_date ) return 0;
		if( $elem1['data']->post_date  > $elem2['data']->post_date ) return -1;
			else return 1;
	}
}