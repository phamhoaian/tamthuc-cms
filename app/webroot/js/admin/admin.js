$(function(){
	"use strict";
	
	// tooltip
	$('[data-toggle="tooltip"]').tooltip();

	// disabled submit button before submission
    $('form').submit(function() {
        $(this).find("[type='submit']").prop('disabled',true);
    });
});

// notify
function showNotify(messsage, type) {
	$.notify({
		// options
		message: messsage
	},{
		// settings
		type: type
	});
}