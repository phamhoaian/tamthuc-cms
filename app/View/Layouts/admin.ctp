<?php echo $this->element('admin/header') ?>
<div class="page-container">
    <?php echo $this->element('admin/page_sidebar') ?>
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <div class="page-content">
            <?php echo $this->element('admin/breadcrumbs') ?>
            <h1 class="page-title"><?php echo $page_title ?></h1>
            <?php echo $this->fetch('content'); ?>
            <?php echo $this->Flash->render() ?>
        </div>
    </div>
    <!-- END CONTENT -->
</div>
<?php echo $this->element('admin/footer') ?>