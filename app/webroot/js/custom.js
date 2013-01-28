$(document).ready(function() {

	// Dropdowns
	$('.dropdown-toggle').dropdown();
	// Navbar tooltips
	$('.navbar [title]').tooltip({
		placement : 'bottom'
	});
	// Content tooltips
	$('[role=main] [title]').tooltip({
		placement : 'top'
	});
}); 