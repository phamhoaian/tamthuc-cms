<section class="register">
	<h3 class="register-title">Đăng ký trải nghiệm lẩu Nhật Bản</h3>
	<?php echo $this->Form->create('EventRegister', array('id' => 'event_register_form', 'inputDefaults' => array('label' => false, 'div' => false))); ?>
		<?php echo $this->Form->hidden('event_id', array('value' => $event['Event']['id'])) ?>
		<div class="form-group">
			<?php echo $this->Form->text('name', array('id' => 'name', 'class' => 'form-control', 'required' => false, 'placeholder' => 'Tên')); ?>
		</div>
		<div class="form-group">
			<?php echo $this->Form->text('phone', array('id' => 'phone', 'class' => 'form-control', 'required' => false, 'placeholder' => 'Số điện thoại')); ?>
		</div>
		<div class="form-group">
			<?php echo $this->Form->text('email', array('id' => 'email', 'class' => 'form-control', 'required' => false, 'placeholder' => 'Email')); ?>
		</div>
		<div class="form-group btn-submit">
			<button type="submit" id="register_submit">Đăng ký ngay</button>
		</div>
	<?php echo $this->Form->end(); ?>
</section>