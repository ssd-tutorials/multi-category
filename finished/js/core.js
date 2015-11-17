var systemObject = {
	run : function() {
		this.edit($('.edit'));
	},
	edit : function(obj) {
		
		obj.live('click', function(e) {
			
			e.preventDefault();
			
			var thisObj = $(this);
			var thisProduct = thisObj.attr('data-id');
			var thisText = thisObj.parent().children('.smallText');
			var thisCategories = thisObj.parent().children('.categories');
			
			if (thisObj.hasClass('save')) {
				
				var thisArray = thisObj.parent().find('form').serializeArray();
				
				jQuery.post('/mod/save.php?id=' + thisProduct, { items : thisArray }, function(data) {
					
					if (data && !data.error) {
						
						thisObj.removeClass('save');
						thisObj.html('Edit');
						thisText.html(data.text).show();
						thisCategories.empty();
						
					}
					
				}, 'json');
				
			} else {
				
				jQuery.getJSON('/mod/edit.php?id=' + thisProduct, function(data) {
					if (data && !data.error) {
					
						thisObj.html('Save');
						thisObj.addClass('save');
						thisText.hide();
						thisCategories.html(data.categories);
					
					}
				});
				
			}
			
		});
		
	}
};
$(function() {
	systemObject.run();
});





