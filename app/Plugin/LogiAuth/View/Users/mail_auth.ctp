<script type="text/javascript">
   var onloadCallback = function() {
        grecaptcha.render('recaptcha', {
          'sitekey' : '<?php echo CAPTCHA_PUBLIC_KEY ?>',
          'callback' : correctCaptcha,
        });
      };

    var correctCaptcha = function(response) {
        $('#btn-register').removeAttr('disabled');
    };

    function onSubmit(token){
        document.getElementById('UserMailAuthForm').submit();
    }

</script>
<?php echo $this->element('base/hb-ad') ?>
<section class="login">
    <div class="row cf">
        <p class="section-title"><?php echo __('アカウント登録') ?></p>
        <p class="dots"><span class="pink-dot">.</span><span class="yellow-dot">.</span><span class="green-dot">.</span></p>
    </div>
    <div class="row cf">
        <?php echo $this->Form->create('User', array('class' => 'login-form')); ?>
        <?php echo $this->Form->hidden('user_type_cd', array('value' => $user_type_cd)); ?>
            <div class="form-group">
                <?php echo $this->Form->input('email', array('label' => __('メールアドレスを入力してください。'), 'class' => 'form-control')); ?>
            </div>
            <div class="form-group">
                <div id="recaptcha" class="g-recaptcha" data-sitekey="<?php echo CAPTCHA_PUBLIC_KEY ?>" ></div>
                    <?php echo $this->Form->submit(__('送信'), array('id' => 'btn-register', 'class' => 'btn btn-danger btn-block g-recaptcha', 'disabled' => 'disabled')) ?>
            </div>
            <hr>
            <div class="form-group">
                 <a href="<?php echo $this->Html->url('/gg_login') ?>" class="btn btn-danger-o btn-google-plus form-control">
                    <?php echo $this->Html->image('common/google-plus-icon.svg', array('class' => 'btn-icon')) ?>
                    <?php echo __('Googleで新規登録') ?>
                </a>
            </div>
            <div class="form-group">
                <a href="<?php echo $this->Html->url('/fb_login') ?>" class="btn btn-primary-o btn-facebook form-control">
                    <?php echo $this->Html->image('common/facebook-icon.svg', array('class' => 'btn-icon')) ?>
                    <span><?php echo __('Facebookで新規登録') ?></span>
                </a>
            </div>
            <div class="form-group">
                <a href="<?php echo $this->Html->url('/tw_login') ?>" class="btn btn-success-o btn-twitter form-control">
                    <?php echo $this->Html->image('common/twitter-icon.svg', array('class' => 'btn-icon')) ?>
                    <span><?php echo __("Twitterで新規登録") ?></span>
                </a>
            </div>
        <?php echo $this->Form->end(); ?>
    </div>
</section>