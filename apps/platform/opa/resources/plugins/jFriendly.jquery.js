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
	.split("б").join("a")
	.split(/[абвгде]/).join("a")
	.split(/ж/).join("ae")
	.split(/з/).join("c")
	.split(/[ийкл]/).join("e")
	.split(/[мноп]/).join("i")
	.split(/с/).join("n")
	.split(/[туфхц]/).join("o")
	.split(/њ/).join("oe")
	.split(/[щъыь]/).join("u")
	.split(/[эя]/).join("y")
	.split(/[\W_]+/).join("-")
	.split(/-+/).join("-");
}