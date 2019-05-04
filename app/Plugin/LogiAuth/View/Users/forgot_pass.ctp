<?php if(empty($setting)){
    echo $this->Html->css('admin/fundee_login', null, array('inline' => false));
}else{
   // echo $this->Html->css('login', null, array('inline' => false));
} ?>
<?php echo $this->element('base/hb-ad') ?>
<section class="login">
    <div class="row cf">
        <p class="section-title"><?php echo __('パスワード再設定'); ?></p>
        <p class="dots"><span class="pink-dot">.</span><span class="yellow-dot">.</span><span class="green-dot">.</span></p>
    </div>
    <div class="row cf">
        <?php echo $this->Form->create('User', array('inputDefaults' => array('class' => 'form-control', 'div' => false),
                                                'class' => 'login-form' 
                                                )); ?>
            <div class="form-group">
            <?php echo $this->Form->input('email', array(
                'placeholder' => __('メールアドレス'), 'label' => false
             )); ?>
            </div>
            <div class="form-group">
            <?php echo $this->Form->submit(__('再設定メールを送信する'), array('class' => 'btn btn-danger')) ?>
            </div>
            <?php echo $this->Form->end(); ?>
    </div>
</section>