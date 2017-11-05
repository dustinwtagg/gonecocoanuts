/*  
 * Ape Gallery			
 * Author:            	Wp Gallery Ape 
 * Author URI:        	https://wpape.net/
 * License:           	GPL-2.0+
 */

/* 
 Show shortcode information block in gallery list
*/

function wpApeGalleryCopyToClipboard(text, type){
	var msgText = 'Use this shortcode in posts or pages';
	if(type==1) msgText =  'Use this function in php files';
    window.prompt( msgText, text);
  }

jQuery(function(){
	jQuery('a[href="edit.php?post_type=wpape_gallery_type&page=wpape-gallery-support"]').click( function(event ){
		event.preventDefault();
		window.open("https://wpape.net/open.php?type=gallery&action=support", "_blank");
	});
	jQuery('a[href="edit.php?post_type=wpape_gallery_type&page=wpape-gallery-demo"]').click( function(event ){
		event.preventDefault();
		window.open("https://wpape.net/open.php?type=gallery&action=demo", "_blank");
	});
	jQuery('a[href="edit.php?post_type=wpape_gallery_type&page=wpape-gallery-guides"]').click( function(event ){
		event.preventDefault();
		window.open("https://wpape.net/open.php?type=gallery&action=guides", "_blank");
	});
	jQuery('.column-wpape_gallery span').click( function(){
		wpApeGalleryCopyToClipboard( jQuery(this).text(), 0 );

	});
	jQuery('.column-wpape_gallery_code span').click( function(){
		wpApeGalleryCopyToClipboard( jQuery(this).text(), 1 );

	})

	
});