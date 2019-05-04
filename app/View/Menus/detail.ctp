<div class="container">
	<section class="page-header">
		<h1 class="page-title"><?php echo __('Thực đơn'); ?></h1>
	</section>
	<nav class="page-nav">
		<ul>
			<?php foreach ($menu_list as $row) : ?>
			<li class="nav-item<?php if ($row['Menu']['slug'] == $slug) echo ' is-active'; ?>">
				<a href="<?php echo $this->Html->url('/thuc-don/'.$row['Menu']['slug']); ?>"><?php echo h(json_decode($row['Menu']['title'], TRUE)[Configure::read('Config.language_key')]); ?></a>
			</li>
			<?php endforeach; ?>
		</ul>
	</nav>
	<div class="page-body">
		<?php echo json_decode($menu['Menu']['content'], TRUE)[Configure::read('Config.language_key')]; ?>
	</div>
</div>