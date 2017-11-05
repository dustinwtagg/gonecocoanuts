/*  
 * Ape Gallery			
 * Author:            	Wp Gallery Ape 
 * Author URI:        	https://wpape.net/
 * License:           	GPL-2.0+
 */
(function ($) {
	$('.wpape-gallery-manage').each(function() {
		var instance = this;
		var imgIdInput = $('.wpape-gallery-manage-value', instance);
		$('button', instance).click(function(event){
			event.preventDefault();
			var idList = imgIdInput.val();
			var gallerysc = '[gallery ids="' +idList+ '"]';
  			wp.media.gallery.edit(gallerysc).on('update', function(g){
				var id_array = [];
				var marginCount = 0;
				$.each(g.models, function(id, img) { ++marginCount; id_array.push(img.id); });
				imgIdInput.val(id_array.join(","));
			});
  			if(idList==' ' || idList=='' ){
  				$('.media-frame-menu .media-menu-item').eq(2).click();
  			}
  
		});

		if( $(this).data('open')===1 ){
			$('button', instance).click();
		}

	});
}(jQuery));