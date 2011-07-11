var changeTitleForURL = function( URL ) {
	jQuery.get( URL, function(data){
			$('aside h3').html(data);
		});
}

jQuery(document).ready(function(){
	jQuery('nav a').click(function(event){
		history.pushState({url: jQuery(this).attr('href')}, 'title', '/' + jQuery(this).attr('href') )
		changeTitleForURL( jQuery(this).attr('href') );
		return false;
	});
	
	jQuery(window).bind("popstate", function(e) {
		  if (e.originalEvent.state) {
			changeTitleForURL( e.originalEvent.state.url );
			}
		return false;
	  });
});