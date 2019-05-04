<br>
<ul class="nav nav-tabs">
    <li>
        <?php echo $this->Html->link(__('管理者一覧'), '/admin/users/admins') ?>
    </li>
    <li class="active">
        <?php echo $this->Html->link(__('管理者追加'), '/admin/users/addAdmin') ?>
    </li>
</ul>

<h2><?php echo __('管理者の追加'); ?></h2>

<?php
echo $this->Form->create('User', array(
        'inputDefaults' => array(
                'class' => 'form-control', 'div' => false, 'label' => false
        ), 'class' => 'form-horizontal'
)) ?>

<div class="form-group">
    <label class="col-sm-2 control-label"><?php echo __('ユーザ名'); ?></label>

    <div class="col-sm-10">
        <?php echo $this->Form->input('nick_name') ?>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label"><?php echo __('メールアドレス'); ?></label>

    <div class="col-sm-10">
        <?php echo $this->Form->input('email') ?>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label"><?php echo __('パスワード'); ?></label>

    <div class="col-sm-10">
        <?php echo $this->Form->input('password', array('value' => '')) ?>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label"><?php echo __('パスワード（確認）'); ?></label>

    <div class="col-sm-10">
        <?php echo $this->Form->input('password2', array('type' => 'password')) ?>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <?php echo $this->Form->submit(__('登録'), array('class' => 'btn btn-success col-xs-4')) ?>
    </div>
</div>
<?php echo $this->Form->end(); ?>

<br><br>
