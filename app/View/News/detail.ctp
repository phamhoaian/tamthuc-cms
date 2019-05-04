<div class="container">
	<section class="page-header">
		<h1 class="page-title"><?php echo __('Tin tức'); ?></h1>
	</section>
	<nav class="page-nav">
		<ul>
			<?php foreach ($news_categories as $row) : ?>
			<li class="nav-item<?php if ($row['NewsCategory']['id'] == $news['News']['cat_id']) echo ' is-active'; ?>">
				<a href="<?php echo $this->Html->url('/tin-tuc/the-loai/'.$row['NewsCategory']['slug']); ?>"><?php echo h(json_decode($row['NewsCategory']['title'], TRUE)[Configure::read('Config.language_key')]); ?></a>
			</li>
			<?php endforeach; ?>
		</ul>
	</nav>
	<div class="page-body">
		<?php echo json_decode($news['News']['content'], TRUE)[Configure::read('Config.language_key')]; ?>
	</div>
</div>