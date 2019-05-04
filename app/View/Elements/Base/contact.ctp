<?php if ($agencies) : ?>
<section class="contact-list">
	<h3 class="contact-title"><?php echo __('Địa chỉ và số liên lạc của 2 nhà hàng'); ?>:</h3>
	<ul class="agency">
		<?php foreach ($agencies as $agency) : ?>
		<li class="agency-item">
			<div class="agency-title">
				<?php echo h(json_decode($agency['Agency']['title'], TRUE)[Configure::read('Config.language_key')]); ?>:
				<?php if (!empty($view_maps)) : ?>
				<a href="<?php echo $agency['Agency']['google_maps_url']; ?>" class="view-maps" target="_blank"><?php echo __('Tìm đường'); ?></a>
				<?php endif; ?>
			</div>
			<div class="agency-info">
				<?php echo json_decode($agency['Agency']['content'], TRUE)[Configure::read('Config.language_key')]; ?>
			</div>
		</li>
		<?php endforeach; ?>
	</ul>
</section>
<?php endif; ?>