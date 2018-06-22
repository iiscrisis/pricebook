jQuery(document).ready(function(){

jQuery("a.comment-reply-link").each(function(){
    var atr = jQuery(this).parents("li").attr("id");
	jQuery(this).attr("lang",atr);
    });
});