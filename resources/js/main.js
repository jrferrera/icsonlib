$(document).ready(function() {
 
  /*
	"Hovernav" navbar dropdown on hover
	Delete this segment if you don't want it, and delete the corresponding CSS in bst.css
	Uses jQuery Media Query - see http://www.sitepoint.com/javascript-media-queries/
	*/
	var mq = window.matchMedia('(min-width: 768px)');
  if (mq.matches) {
    $('ul.navbar-nav li').addClass('hovernav');
  } else {
  	$('ul.navbar-nav li').removeClass('hovernav');
  };
	/*
	The addClass/removeClass also needs to be triggered
  on page resize <=> 768px
	*/
  if (matchMedia) {
    var mq = window.matchMedia('(min-width: 768px)');
    mq.addListener(WidthChange);
    WidthChange(mq);
  }
	function WidthChange(mq) {
    if (mq.matches) {
      $('ul.navbar-nav li').addClass('hovernav');
    } else {
      $('ul.navbar-nav li').removeClass('hovernav');
    }
  };

  $('#this-carousel-id').carousel();  

  $('#alertmessage').show().delay(4000).fadeOut();
});


/*Source: http://simonpadbury.com/bootstrap-3-navbar-dropdown-hover/*/
