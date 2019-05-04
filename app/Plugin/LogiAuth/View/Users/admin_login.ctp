<!-- Top content -->
<div class="top-content">
    <div class="inner-bg">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3 form-box">
                    <?php echo $this->Form->create('User', array(
                            'inputDefaults' => array(
                                    'label' => false, 'div' => false, 'class' => 'form-control'
                            )
                    )) ?>
                    <div class="form-top">
                        <div class="form-top-left">
                            <h3>Đăng nhập</h3>
                            <p>Nhập email và mật khẩu để đăng nhập:</p>
                        </div>
                        <div class="form-top-right">
                            <i class="fa fa-lock"></i>
                        </div>
                    </div>
                    <div class="form-body">
                        <?php $flash = $this->Session->flash(); ?>
                            <?php if($flash): ?>
                            <div class="error-message"><?php echo $flash; ?></div>
                            <?php endif; ?>
                            <div class="form-group">
                                <label class="sr-only" for="form-email">Email</label>
                                <?php echo $this->Form->input('email', array(
                                        'placeholder' => 'Email', 'value' => '', 'class' => 'form-control', 'required' => false
                                )) ?>
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="form-password">Mật khẩu</label>
                                <?php echo $this->Form->input('password', array(
                                        'placeholder' => 'Mật khẩu', 'value' => '', 'class' => 'form-control', 'required' => false
                                )) ?>
                            </div>
                            <?php echo $this->Form->submit('Đăng nhập!', array('class' => 'btn btn-danger')) ?>
                    </div>
                    <div class="form-bottom">
                        <?php if(!empty($account_lock)): ?>
                            <?php echo $this->Html->link('Reset tài khoản đã bị khóa?', '/reset_account_lock') ?><br>
                        <?php endif; ?>
                        <?php echo $this->Html->link('Quên mật khẩu?', '/admin/forgot_pass') ?>
                    </div>
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
