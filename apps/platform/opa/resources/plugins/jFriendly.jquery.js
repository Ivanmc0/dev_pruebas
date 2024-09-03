/**
* jFriendly : jQuery Plugin to make friendly urls in your forms.
* by : ikhuerta (ikhuerta@gmail.com)
* more info : 
**/
(function($){
    $.fn.extend({
        jFriendly : function ( inputUri ){
        	inputUri = $(inputUri);
			
			$(this).keyup(function(){
				inputUri.val( uriSanitize($(this).val()) );
			});
			
			return inputUri;
        }
    });
})(jQuery);  

uriSanitize = function(uri) { 
	return String(uri)
	.toLowerCase()
	.split("�").join("a")
	.split(/[������]/).join("a")
	.split(/�/).join("ae")
	.split(/�/).join("c")
	.split(/[����]/).join("e")
	.split(/[����]/).join("i")
	.split(/�/).join("n")
	.split(/[�����]/).join("o")
	.split(/�/).join("oe")
	.split(/[����]/).join("u")
	.split(/[��]/).join("y")
	.split(/[\W_]+/).join("-")
	.split(/-+/).join("-");
}