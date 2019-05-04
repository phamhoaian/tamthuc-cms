<?php echo $this->element('parts/header_top') ?>
<?php echo $this->element('parts/flash'); ?>
<?php echo $this->Flash->render(); ?>
<div class="mo-wrapper">
  <main class="mo-main-content">
		<?php echo $this->fetch('content'); ?>	
	</main>
</div>
<?php echo $this->element('parts/footer_bottom'); ?>