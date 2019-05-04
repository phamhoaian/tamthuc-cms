$(function(){
    setTimeout(function() {
        $('.mo-loading-logo').removeClass('is-active');
    }, 600)
	setTimeout(function() {
        $('body').removeClass('is-loading').addClass('is-loaded');
    }, 1000);

    $('button.mo-nav-button').click(function(){
		if ($('body').hasClass('has-nav-open'))
		{
			$('body').removeClass('has-nav-open');
		}
		else
		{
			$('body').addClass('has-nav-open');
		}
	});

	$(window).scroll(function(){
        if ($(window).scrollTop()>100){
			$(".mo-main-nav").addClass('is-hide');
			$(".mo-nav-button").addClass('is-show');
        }
        else {
			$(".mo-main-nav").removeClass('is-hide');
			$(".mo-nav-button").removeClass('is-show');
		}
		
		if ($(window).scrollTop()>0){
			$(".mo-video-overlay").addClass('is-scroll');
		}
		else {
			$(".mo-video-overlay").removeClass('is-scroll');
		}
	});
	
	$(".mo-main-nav-sp-overlay").click(function(){
		$("body").removeClass("has-nav-open");
	});

	$('.modal[role="dialog"]').on('hidden.bs.modal', function () {
		location.reload();
	})
})
function showErrorsByModel(errs, formID) {
	$('form#' + formID + ' .error-message').remove();
	$.each(errs, function (model) {
		$.each(this, function (id, item) {
			if ($.isPlainObject(item)) {
				$.each(item, function (field, message) {
					var element = $('form#' + formID).find('[name="data[' + model + '][' + id + '][' + field + ']"]');
					element.closest('div.input-group').after('<div class="error-message">' + message + '</div>');
				});
			} else {
				var element = $('form#' + formID).find('#' + model);
				var closest = element.closest('div.input-group');
				if (closest.length > 0) {
					closest.after('<div class="error-message">' + item + '</div>');
				} else {
					element.after('<div class="error-message">' + item + '</div>');
				}
			}
		});
	});
}