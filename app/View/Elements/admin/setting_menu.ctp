<div id="wrap">
    <div id="header">
        <div class="top_menu">
            <div id="logo">
                <?php echo __('管理画面'); ?>
            </div>
            <div class="left">

            </div>
            <div class="right">
                <?php if(!empty($auth_user)): ?>
                    <a href="<?php echo $this->Html->url('/admin/logout') ?>">
                        <span class="el-icon-off"></span>
                    </a>
                <?php else: ?>
                    <a href="<?php echo $this->Html->url('/login') ?>" class="btn btn-white btn-sm">
                        <?php echo __('ログイン'); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
        <?php echo $this->element('admin/setting_header'); ?>
    </div>

    <div id="contents">


