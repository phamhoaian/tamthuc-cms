<!-- import internal stylesheet -->
<?php echo $this->start('css'); ?>
<link rel="stylesheet" href="/components/slick/slick.css">
<link rel="stylesheet" href="/components/slick/slick-theme.css">
<?php echo $this->end(); ?>
<!-- import internal javascript -->
<?php echo $this->start('script'); ?>
<script src="/components/slick/slick.js" type="text/javascript"></script>
<script>
		$(document).ready(function(){
			$('.promotion-list').slick({
				centerMode: true,
				slidesToShow: 3,
				slidesToScroll: 1,
				autoplay: true,
				autoplaySpeed: 2000,
				infinite: true,
				prevArrow: ".slick-prev",
    			nextArrow: ".slick-next",
				responsive: [
					{
						breakpoint: 1200,
						settings: {
							arrows: false,
							centerMode: true,
							slidesToShow: 3
						}
					},
					{
						breakpoint: 480,
						settings: {
							arrows: false,
							centerMode: true,
							slidesToShow: 1
						}
					}
				]
			});

			// introduction behavior
			$('.introduction-list .item').on('click', function(e){
				e.preventDefault();
				var intro_id = $(this).data('intro-id');
				console.log('intro_id', intro_id);
				$('.introduction-content').hide();
				$('#intro_' + intro_id).show();
			});
		});
	</script>
<?php echo $this->end(); ?>
<!-- view content -->
<?php echo $this->element('Base/video_overlay'); ?>
<div class="container">
	<?php echo $this->element('Base/featured'); ?>
	<?php echo $this->element('Base/introduction'); ?>
	<?php echo $this->element('Base/menu'); ?>
	<?php echo $this->element('Base/promotion'); ?>
	<?php echo $this->element('Base/additional'); ?>
	<section class="logo-footer">
		<?php echo $this->Html->image('logo.svg') ?>
	</section>
	<?php echo $this->element('Base/contact'); ?>
</div>