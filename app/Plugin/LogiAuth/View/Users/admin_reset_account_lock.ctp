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
                            <h3><?php echo __('Reset account locked'); ?></h3>
                        </div>
                    </div>
                    <div class="form-body">
                        <?php $flash = $this->Session->flash(); ?>
                            <?php if($flash): ?>
                            <div class="error-message"><?php echo $flash; ?></div>
                            <?php endif; ?>
                            <div class="form-group">
                                <label class="sr-only" for="form-username"><?php echo __('Email'); ?></label>
                                <?php echo $this->Form->input('email', array(
                                        'placeholder' => 'Email', 'value' => '', 'class' => 'form-control', 'required' => false
                                )) ?>
                            </div>
                            <?php echo $this->Form->submit('Submit', array('class' => 'btn btn-danger')) ?>
                    </div>
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
