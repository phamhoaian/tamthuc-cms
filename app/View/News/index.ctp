<div class="container">
	<section class="page-header">
		<h1 class="page-title"><?php echo __('Tin tức'); ?></h1>
	</section>
	<nav class="page-nav">
		<ul>
			<?php foreach ($news_categories as $row) : ?>
			<li class="nav-item<?php if ($row['NewsCategory']['slug'] == $cat_slug) echo ' is-active'; ?>">
				<a href="<?php echo $this->Html->url('/tin-tuc/the-loai/'.$row['NewsCategory']['slug']); ?>"><?php echo h(json_decode($row['NewsCategory']['title'], TRUE)[Configure::read('Config.language_key')]); ?></a>
			</li>
			<?php endforeach; ?>
			<li class="nav-item">
				<a href="<?php echo $this->Html->url('/hinh-anh'); ?>"><?php echo __('Hình ảnh'); ?></a>
			</li>
		</ul>
	</nav>
	<div class="page-body">
	<?php if ($news_list) : ?>
		<ul class="news-list">
			<?php foreach ($news_list as $news) : ?>
			<li class="news-item">
				<a href="<?php echo $this->Html->url('/tin-tuc/'.$news['News']['slug']); ?>">
					<?php echo $this->ImageLabel->image($news['News']['top_pic'], array('class' => 'news-img')); ?>
				</a>
				<div class="news-info">
					<a href="<?php echo $this->Html->url('/tin-tuc/'.$news['News']['slug']); ?>" class="news-title"><?php echo h(json_decode($news['News']['title'], TRUE)[Configure::read('Config.language_key')]); ?></a>
					<div class="news-date"><?php echo date('H:i Y-m-d', strtotime($news['News']['created'])); ?></div>
					<div class="news-content">
					<?php 
						$content = json_decode($news['News']['content'], TRUE)[Configure::read('Config.language_key')];
						echo strlen($content) > 200 ? mb_substr(strip_tags($content), 0, 200).'...' : strip_tags($content)
					?>
					</div>
				</div>
			</li>
			<?php endforeach; ?>
		</ul>
		<?php echo $this->element('admin/pagination') ?>
	<?php else : ?>
		<div class="page-footer"><?php echo __('Không có tin tức nào!'); ?></div>
	<?php endif; ?>
	</div>
</div>