<div class="container">
	<section class="page-header">
		<h1 class="page-title"><?php echo __('Giới thiệu'); ?></h1>
	</section>
	<nav class="page-nav">
		<ul>
			<?php foreach ($introduction_list as $row) : ?>
			<li class="nav-item<?php if ($row['Introduction']['slug'] == $slug) echo ' is-active'; ?>">
				<a href="<?php echo $this->Html->url('/gioi-thieu/'.$row['Introduction']['slug']); ?>"><?php echo h(json_decode($row['Introduction']['title'], TRUE)[Configure::read('Config.language_key')]); ?></a>
			</li>
			<?php endforeach; ?>
		</ul>
	</nav>
	<div class="page-body">
		<?php echo json_decode($introduction['Introduction']['content'], TRUE)[Configure::read('Config.language_key')]; ?>
	</div>
</div>