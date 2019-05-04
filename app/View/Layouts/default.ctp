<?php echo $this->element('parts/header_top') ?>
<?php echo $this->element('parts/flash'); ?>
<?php echo $this->Flash->render(); ?>
<div class="mo-wrapper">
	<?php echo $this->element('parts/header') ?>
	<main class="mo-main-content">
		<?php echo $this->fetch('content'); ?>	
	</main>
	<?php echo $this->element('parts/footer') ?>
</div>
<?php echo $this->element('parts/footer_bottom'); ?>
<?php //echo $this->element('sql_dump');?>

