;(function ($, undefined){
    

    function DialogEdit() {
        this.$element = $('.wrapper-nestable-list');
        this.$nestableList = this.$element.find('.nestable-list');
        this.$nestableList.nestable({group: 1, maxDepth: 100});

        this.init();
    }
    DialogEdit.prototype = {
        init: function() {
            var self = this;
            $('.save_category').click(function(event) {
         		event.preventDefault();
         		self.save()	;
        	 });
        },

        save : function () {
            var self = this,
                hierarchyPosts = this.$nestableList.nestable('serialise');

            self.spinner(true);
            $.ajax({
                url: hierarchyPostAttributes.ajaxUrl,
                method: 'post',
                data: {
                    action: hierarchyPostAttributes.dialog.action.save,
                    hierarchy_posts: hierarchyPosts
                },
                success: function (response) {
                    self.spinner(false);
                    self.destroy();
                },
                error: function (jqXHR) {
                    self.destroy();
                    new DialogError(jqXHR.responseText);
                }
            });
        },
        
        spinner: function(isShow) {
            if (isShow) {
                var $spinner = this.$element.find('.nestable-list-spinner').clone();
                $spinner.appendTo(this.$element.closest('.ui-dialog.ui-widget')).show();
            } else {
                this.$element.find('.nestable-list-spinner').remove();
            }
        },

        destroy: function () {
            this.$element.dialog('close');
            this.$element.remove();
        }
    };

    function DialogError(message) {
        this.$element = $('<div id="hierarchy-post-error">' + message + '</div>');
        this.show()
    }
    DialogError.prototype = {
        show: function () {
            var self = this;

            self.$element.appendTo('body');
            self.$element.dialog({
                'dialogClass' : 'wp-dialog',
                'title': hierarchyPostAttributes.error.title,
                'modal' : true,
                'autoOpen' : true,
                'closeOnEscape' : false,
                'buttons' : [
                    {
                        'text' : hierarchyPostAttributes.error.button.ok.label,
                        'class' : 'button',
                        'click' : function() { return self.destroy(); }
                    }
                ],
                'close': function() { return self.destroy(); }
            });
        },
        destroy: function () {
            this.$element.dialog('close');
            this.$element.remove();
        }
    };

    $(document).ready(function() {
        new DialogEdit();
    });
}(jQuery));
