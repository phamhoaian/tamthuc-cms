<section class="login">
    <div class="row cf">
        <p class="section-title"><?php echo __('新規登録') ?></p>
        <p class="dots"><span class="pink-dot">.</span><span class="yellow-dot">.</span><span class="green-dot">.</span></p>
        <p class="ta-c">
            <span><b><?php echo __('新規登録後、応援したい受援者にHB Wallet から直接イーサリアムで支援を行うことができます。') ?></b></span> <br>
            <span class="text-warning ta-c">
                <b><?php echo __('支援を受けるには、新規登録後コインを作成し「受援者」となる必要があります。') ?></b>
            </span>
        </p>
    </div>
    <div class="row cf">
        <?php echo $this->Form->create('User', array(
                'inputDefaults' => array(
                        'label' => false, 'div' => false
                ),
                'class' => 'login-form'
        )); ?>
        <div class="form-group">
            <?php echo $this->Form->hidden('facebook_id', array('value' =>  __(!empty($facebook_info['id']) ? $facebook_info['id']:''))) ?>
            <div class="input-group">
            <?php echo $this->Form->input('name', array('value' => __(!empty($facebook_info['name']) ? $facebook_info['name']:''), 'placeholder' => __('Full name'), 'readonly' => 'readonly', 'class' => 'form-control', 'error' =>false)); ?>
            </div>
            <?php echo $this->Form->error('name') ?>
        </div>
        <div class="form-group">
            <div class="input-group">
            <?php echo $this->Form->input('email', array('value' => __(!empty($facebook_info['email']) ? $facebook_info['email']:''), 'placeholder' => __('メールアドレス'), 'class' => 'form-control', 'error' =>false)) ?>
            </div>
            <?php echo $this->Form->error('email') ?>
        </div>

        <div class="form-group">
            <div class="input-group">
            <?php echo $this->Form->input('password', array('placeholder' => __('パスワード'), 'value' => '', 'class' => 'form-control', 'error' =>false)); ?>
            </div>
            <?php echo $this->Form->error('password') ?>
        </div>
        <div class="form-group">
            <div class="input-group">
            <?php echo $this->Form->input('password2',array('placeholder' => __('パスワード（確認）'), 'value' => '', 'type' => 'password', 'class' => 'form-control', 'error' =>false))?>
            </div>
            <?php echo $this->Form->error('password2') ?>
        </div>
        <div class="form-group">
            <div class="input-group">
                <div class="ether-box">
                    <?php echo $this->Form->input('ether_address', array('placeholder' => __('HB Walletのイーサリアムアドレス'), 'maxlength' => 42, 'class' => 'form-control ether-address', 'error' =>false)); ?>
                </div>
            </div>
            <?php echo $this->Form->error('ether_address') ?>
        </div>
        <div class="form-group hb-description">
            <div class="input-group">
                <?php echo $this->element('base/register-hb-ad') ?>
            </div>
        </div>
        <div class="form-group">
            <div id="recaptcha" class="g-recaptcha" style="clear: both" data-sitekey="<?php echo CAPTCHA_PUBLIC_KEY ?>" ></div>
            <div class="col-md-6 col-md-offset-3" style="margin-bottom:20px;">
                <?php echo $this->Form->submit(__('送信'), array('class' => 'btn btn-danger', 'id' => 'register', 'disabled' => 'disabled')) ?>
            </div>
        </div>

        <?php echo $this->Form->end(); ?>
</section>

<?php $this->start('endjs') ?>
 <script type="text/javascript">
   var onloadCallback = function() {
        grecaptcha.render('recaptcha', {
          'sitekey' : '<?php echo CAPTCHA_PUBLIC_KEY ?>',
          'callback' : correctCaptcha,
        });
      };

    var correctCaptcha = function(response) {
        $('#register').removeAttr('disabled');
    };

    function onSubmit(token){
        document.getElementById('UserPasswordForm').submit();
    }

</script>
<?php $this->end(); ?>