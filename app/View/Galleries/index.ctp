<div class="container">
	<section class="page-header">
		<h1 class="page-title"><?php echo __('Tin tức'); ?></h1>
	</section>
	<nav class="page-nav">
		<ul>
			<?php foreach ($news_categories as $row) : ?>
			<li class="nav-item">
				<a href="<?php echo $this->Html->url('/tin-tuc/the-loai/'.$row['NewsCategory']['slug']); ?>"><?php echo h(json_decode($row['NewsCategory']['title'], TRUE)[Configure::read('Config.language_key')]); ?></a>
			</li>
			<?php endforeach; ?>
			<li class="nav-item is-active">
				<a href="<?php echo $this->Html->url('/hinh-anh'); ?>"><?php echo __('Hình ảnh'); ?></a>
			</li>
		</ul>
	</nav>
	<div class="page-body">
		<div class="row galleries" id="lightgallery">
			<div class="col-xs-6 col-md-3">
				<?php foreach ($galleries as $index => $gallery) : ?>
					<?php if ($index % 4 === 0) : ?>
						<a class="gallery-item" href="<?php echo $this->ImageLabel->url($gallery['Gallery']['top_pic']) ?>">
							<?php echo $this->ImageLabel->image($gallery['Gallery']['top_pic']); ?>
							<div class="gallery-title"><?php echo h(json_decode($gallery['Gallery']['title'], TRUE)[Configure::read('Config.language_key')]); ?></div>
						</a>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
			<div class="col-xs-6 col-md-3">
				<?php foreach ($galleries as $index => $gallery) : ?>
					<?php if ($index % 4 === 1) : ?>
						<a class="gallery-item" href="<?php echo $this->ImageLabel->url($gallery['Gallery']['top_pic']) ?>">
							<?php echo $this->ImageLabel->image($gallery['Gallery']['top_pic']); ?>
							<div class="gallery-title"><?php echo h(json_decode($gallery['Gallery']['title'], TRUE)[Configure::read('Config.language_key')]); ?></div>
						</a>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
			<div class="col-xs-6 col-md-3">
				<?php foreach ($galleries as $index => $gallery) : ?>
					<?php if ($index % 4 === 2) : ?>
						<a class="gallery-item" href="<?php echo $this->ImageLabel->url($gallery['Gallery']['top_pic']) ?>">
							<?php echo $this->ImageLabel->image($gallery['Gallery']['top_pic']); ?>
							<div class="gallery-title"><?php echo h(json_decode($gallery['Gallery']['title'], TRUE)[Configure::read('Config.language_key')]); ?></div>
						</a>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
			<div class="col-xs-6 col-md-3">
				<?php foreach ($galleries as $index => $gallery) : ?>
					<?php if ($index % 4 === 3) : ?>
						<a class="gallery-item" href="<?php echo $this->ImageLabel->url($gallery['Gallery']['top_pic']) ?>">
							<?php echo $this->ImageLabel->image($gallery['Gallery']['top_pic']); ?>
							<div class="gallery-title"><?php echo h(json_decode($gallery['Gallery']['title'], TRUE)[Configure::read('Config.language_key')]); ?></div>
						</a>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
		</div>
		<?php if( count($pagination) > 1) :?>
		<div class="load-more">
			<button id="more-photo" class="btn btn-default"><?php echo __('Hiển thị thêm ảnh') ?></button>
		</div>
		<?php endif; ?>
	</div>
</div>
<?php echo $this->start('css'); ?>
<link rel="stylesheet" type="text/css" href="/components/lightgallery/css/lightgallery.min.css" />
<?php echo $this->end(); ?>
<?php echo $this->start('script'); ?>
<script src="/components/lightgallery/js/lightgallery.min.js"></script>
<script src="/components/lightgallery/js/lg-thumbnail.min.js"></script>
<script src="/components/lightgallery/js/lg-fullscreen.min.js"></script>
<script>

	lightGallery(document.getElementById('lightgallery'), {
		thumbnail: true,
		selector: '.gallery-item'
	}); 

	$(document).on('click', '#more-photo', function(){
		// var sponsee_id = <?php // echo $sponsee_id ?>;
		// var page = parseInt($('#pageno').val());
		// page += 1;
		// $('#pageno').val(page);
		// var url = baseURL +'/SponseeTopPage/picture/' + sponsee_id + '/' + page;

		// //append loader
		// $('#more-photo').hide();
		// $(".load-more").append('<div id="loading" align="center"><div class="box-loading"><span></span></div><p><?php //echo __('ローディング中'); ?>･･･</p></div>');


		// $.ajax({
		// 	type: 'GET',
		// 	url: url,
		// 	dataType: 'html',
		// })
		// .done(function(data, status, jqXHR){
		// 	//remove loader
		// 	$('.load-more #loading').remove();
		// 	$('#more-photo').show();

		// 	$('#store').html(data);
		// 	var first = $('#store #first-list div');
		// 	var second = $('#store #second-list a');
		// 	$('#photo-list').append(first);
		// 	$('#lightgallery').append(second);
		// 	//empty hidden container
		// 	$('#store').html('');
		// 	var pic_count = $('#picture_count').val();
		// 	var current_pic_count = $('#lightgallery a').length;
		// 	if(pic_count == current_pic_count){
		// 		$('#more-photo').remove();
		// 	}
		// 	lightGallery(document.getElementById('lightgallery'), {
		// 		thumbnail:true
		// 	}); 
		// })
		// .fail(function(jqXHR, status, error){
		// 		window.alert('<?php // echo __("通信エラーが発生しました。ページを更新して再度実行してください。") ?>');
		// });	
	});
</script>
<?php echo $this->end(); ?>