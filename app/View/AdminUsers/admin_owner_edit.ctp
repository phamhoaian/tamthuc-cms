<div class="bread">
    <?php echo $this->Html->link(__('アカウント'), '/admin/admin_users/owner_edit') ?> &gt;
    <?php echo __('アカウント情報'); ?>
</div>
<div class="setting_title">
    <h2><?php echo __('アカウント情報の編集'); ?></h2>
</div>

<div class="container">
    <div style="padding:10px;">
        <?php echo $this->Form->create('User', array('inputDefaults' => array('class' => 'form-control'))); ?>

        <div class="form-group">
            <?php echo $this->Form->input('nick_name', array(
                    'required' => 'required', 'label' => __('ユーザ名')
            )); ?>
        </div>

        <div class="form-group">
            <?php echo $this->Form->input('email', array(
                    'required' => 'required', 'label' => __('メールアドレス')
            )); ?>
        </div>

        <div class="form-group">
            <?php echo $this->Form->input('password', array(
                    'label' => __('パスワード'), 'value' => '', 'required' => false
            )); ?>
            <span style="color:#069;"><?php echo __('※パスワードを変更する場合のみ入力してください。'); ?></span>
        </div>

        <div class="form-group">
            <div class="col-xs-6 col-xs-offset-3">
                <?php echo $this->Form->submit(__('更新'), array('class' => 'btn btn-primary btn-block')); ?>
            </div>
        </div>
        <br><br>
        <?php echo $this->Form->end(); ?>
    </div>
</div>
