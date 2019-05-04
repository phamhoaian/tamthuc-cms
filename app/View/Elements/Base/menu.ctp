<?php if (!empty($menus)) : ?>
<section class="menu">
	<h2 class="page-title"><a href="<?php echo $this->Html->url('/thuc-don'); ?>"><?php echo __('Thực đơn'); ?></a></h2>
	<div class="menu-list">
		<?php foreach ($menus as $key => $menu) : ?>
		<?php if ($key === 0) : ?>
		<div class="col-6">
		<?php endif; ?>
		<?php if ($key === 1) : ?>
		<div class="col-4">
		<?php endif; ?>
		<?php if ($key === 3) : ?>
		<div class="col-2">
		<?php endif; ?>
			<div class="item">
				<a href="<?php echo $this->Html->url('/thuc-don/'.$menu['Menu']['slug']); ?>">
					<h3 class="menu-title"><?php echo h(json_decode($menu['Menu']['title'], TRUE)[Configure::read('Config.language_key')]); ?></h3>
					<?php echo $this->ImageLabel->image($menu['Menu']['top_pic']); ?>
				</a>
			</div>
		<?php if (in_array($key, array(0,2,3))) : ?>
		</div>
		<?php endif; ?>
		<?php endforeach; ?>
	</div>
</section>
<?php endif; ?>