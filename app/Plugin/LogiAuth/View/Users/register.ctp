

<?php
	$name_ph = __('氏名／グループ名／企業名(32文字以内)', true);
	$user_nn_ph = __('ニックネーム(32文字以内)', true);
	$password_ph = __('パスワード(5～15文字)', true);
    $password2_ph = __('パスワード（確認）', true);
	$sex_cd_ph = __('性別/グループ/企業を選択してください', true);
	$zip_cd_ph = __('郵便番号(-は必要ありません)', true);
	$address_ph = __('住所(128文字以内)', true);
	$telephone_no_ph = __('電話番号／携帯番号(-は必要ありません)');
	
	$title = $user_type_cd==SPONSEE?__('受援者新規登録', true):__('新規登録', true);
?>
<section class="login">
    <div class="row cf">
        <p class="section-title"><?php echo h($title) ?></p>
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
        )) ?>
        
        <div class="form-group">
            <div class="input-group">
                <?php echo $this->Form->email('email', array('placeholder' => 'Email', 'readonly' => true, 'class' => 'form-control', 'value' => $mail_auth['email'])); ?>
            </div>
        </div>
		
		<div class="form-group">
            <div class="input-group">
				<?php echo $this->Form->input('name', array('placeholder' => $user_nn_ph, 'class' => 'form-control', 'error' =>false)); ?>
            </div>
            <?php echo $this->Form->error('name') ?>
		</div>		
		
        <div class="form-group">
            <div class="input-group">
                <?php echo $this->Form->input('password', array('placeholder' => $password_ph, 'value' => '', 'class' => 'form-control', 'error' =>false)); ?>
            </div>
            <?php echo $this->Form->error('password') ?>
        </div>
        <div class="form-group">
            <div class="input-group">
                <?php echo $this->Form->input('password2',array('placeholder' => $password2_ph, 'value' => '', 'type' => 'password', 'class' => 'form-control', 'error' =>false))?>
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
            <div class="input-group ta-c">
                <?php echo $this->element('base/register-hb-ad') ?>
            </div>
        </div>
        <div class="form-group">
            <div id="recaptcha" class="g-recaptcha" style="clear: both" data-sitekey="<?php echo CAPTCHA_PUBLIC_KEY ?>" ></div>
            <div class="col-xs-offset-3 col-xs-6" style="margin-bottom:20px;">
                <?php echo $this->Form->button(__('登録'), array('class' => 'btn btn-danger',
                                                                 'id' => 'register', 'disabled' => 'disabled')) ?>
            </div>
        </div>
        <?php echo $this->Form->end() ?>
    </div>
</section>
<?php $this->start('endjs') ?>
<script>
    $('#register').click(function(e){
        e.preventDefault();
        var gt = gtag_report_conversion();
        if(gt != undefined){
            $('#UserConfirmMailForm').submit();
        }
    });
</script>
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
        document.getElementById('UserConfirmMailForm').submit();
    }

</script>
<?php $this->end(); ?>