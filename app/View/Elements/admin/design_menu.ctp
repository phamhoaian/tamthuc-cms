<div class="setting_design_menu clearfix">
    <div class="menu <?php echo ($mode == 'logo') ? 'active' : '' ?>"
         onclick="location.href='<?php echo $this->Html->url('/admin/admin_design/edit/') ?>'">
        <?php echo __('ロゴ・色'); ?>
    </div>
    <div class="menu <?php echo ($mode == 'top') ? 'active' : '' ?>"
         onclick="location.href='<?php echo $this->Html->url('/admin/admin_design/edit_top') ?>'">
        <?php echo __('トップページ'); ?>
    </div>
</div>