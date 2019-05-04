<?php echo $this->element('base/header') ?>
<?php echo $this->element('base/menu') ?>
<?php echo $this->element('base/flash'); ?>
<?php echo $this->Flash->render() ?>
<main class="cd-main-content">
	<div class="container">
		<?php echo $this->element('page/sidebar') ?>
			<?php echo $this->fetch('content'); ?>
			</div>
</main>
<?php echo $this->element('base/footer') ?>