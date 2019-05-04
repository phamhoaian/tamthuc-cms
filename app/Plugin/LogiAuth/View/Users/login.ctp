<?php if(empty($setting)){
    echo $this->Html->css('admin/fundee_login', null, array('inline' => false));
}else{
    //echo $this->Html->css('login', null, array('inline' => false));
} ?>
<?php echo $this->element('base/hb-ad') ?>
<section class="login">
    <div class="row cf">
        <p class="section-title"><?php echo __('ログイン') ?></p>
        <p class="dots"><span class="pink-dot">.</span><span class="yellow-dot">.</span><span class="green-dot">.</span></p>
    </div>
    <div class="row cf">
        <?php echo $this->Form->create('User', array(
            'inputDefaults' => array(
                    'label' => false, 'div' => false, 'class' => 'form-control',
            
            ),
            'class' => 'login-form'
            )) ?>
            <div class="form-group">
            <?php echo $this->Form->input('email', array(
                'placeholder' => __('メールアドレス'), 'value' => ''
            )) ?>
            </div>
            <div class="form-group">
            <?php echo $this->Form->input('password', array(
                'placeholder' => __('パスワード'), 'value' => ''
            )) ?>
            </div>
            <div class="form-group">
            <?php echo $this->Form->submit(__('ログイン'), array('class' => 'btn btn-danger form-control')) ?>
            </div>
            
            <div class="form-group forgot">
            <?php echo $this->Html->link(__('パスワードを忘れた方'), '/forgot_pass') ?><br>
            <?php echo $this->Html->link(__('まだアカウントをお持ちでない方'), '/mail_auth') ?>
            </div>
            <div class="form-group">
                <a href="<?php echo $this->Html->url('/gg_login') ?>" class="btn btn-danger-o btn-google-plus form-control">
                    <?php echo "<img src='{$this->Html->url('/img/common/google-plus-icon.svg')}' class='btn-icon' alt=''/>";?>
                    <span><?php echo __('Googleでログイン') ?></span>
                </a>
            </div>
            <div class="form-group">
                <a href="<?php echo $this->Html->url('/fb_login') ?>" class="btn btn-primary-o btn-facebook form-control">
                <?php echo "<img src='{$this->Html->url('/img/common/facebook-icon.svg')}' class='btn-icon' alt=''/>";?>
                    <span><?php echo __('Facebookでログイン') ?></span>
                </a>
            </div>
            <div class="form-group">
                <a href="<?php echo $this->Html->url('/tw_login') ?>" class="btn btn-success-o btn-twitter form-control">
                <?php echo "<img src='{$this->Html->url('/img/common/twitter-icon.svg')}' class='btn-icon' alt=''/>";?>
                    <span> <?php echo __('Twitterでログイン') ?></span>
                </a>
            </div>
            <?php echo $this->Form->end() ?>
    </div>
</section>

