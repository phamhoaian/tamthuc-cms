<?php if (isset($breadcrumb) && $breadcrumb) : ?>
<div class="page-bar">
	<?php echo $this->BreadcrumbFormatter->getList($breadcrumb, array('class' => 'page-breadcrumb'), '<i class="fa fa-circle"></i>'); ?>
</div>
<?php endif; ?>