<div class="container is-landing-page">
	<?php echo $this->element('landing/header'); ?>
	<?php echo $this->element('landing/main_content'); ?>
	<?php echo $this->element('landing/register'); ?>
	<?php echo $this->element('landing/conditions'); ?>
</div>
<?php echo $this->start('css'); ?>
<link rel="stylesheet" href="/components/slick/slick.css">
<link rel="stylesheet" href="/components/slick/slick-theme.css">
<?php echo $this->end(); ?>
<?php echo $this->start('script') ?>
<?php echo $this->element('modal/register'); ?>
<?php echo $this->element('modal/duplicate_register'); ?>
<script src="/components/slick/slick.js" type="text/javascript"></script>
<script>
	$(document).ready(function(){
		$('.slider').slick({
			autoplay: true,
			autoplaySpeed: 2000,
			infinite: true
		});

		$('#register_submit').click(function(e){
			e.preventDefault();
            $('.error-message').remove();
			$(this).attr("disabled", "disabled");
			var url = _baseURL + "/su-kien/dang-ky";
			var formElem = $("#event_register_form");
			var formdata = new FormData(formElem[0]);
			$.ajax({
				method: "POST",
				async: true,
				url: url,
				data: formdata,
				processData: false,
				contentType: false
			})
			.done(function( r ) {
				r = $.parseJSON(r);
				if(r.success == 0)
				{
					$('#register_submit').removeAttr("disabled");
					showErrorsByModel(r.errors, 'event_register_form');
				}
				else if(r.success == 99) {
					$('#register_submit').removeAttr("disabled");
				}
				else if(r.success == -1) {
					$('#duplicate_register_modal').modal('show');
				}
				else {
					$('#register_success_modal').modal('show');
				}
			})
			.always(function(jqXHR, status){
				$('#register_submit').removeAttr("disabled");
			});
		});
	});
</script>
<?php echo $this->end(); ?>