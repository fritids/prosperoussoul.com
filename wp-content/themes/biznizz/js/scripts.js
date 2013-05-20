jQuery(function(){
	
	jQuery('#second-nav a img').css("opacity", "0.7");
	
	jQuery('#second-nav a').hover(function() {
        jQuery('#second-nav a img').animate({ opacity: 1}, 500);
      }, function() {
        jQuery('#second-nav a img').animate({ opacity: 0.7 }, 200);         
      });
});