<div class="container">
	<section class="page-header">
		<h1 class="page-title"><?php echo __('Xem điểm tích lũy'); ?></h1>
	</section>
	<nav class="page-nav">
		<ul>
			<li class="nav-item<?php if ($active_menu == 'policy') echo ' is-active'; ?>">
				<a href="<?php echo $this->Html->url('/thanh-vien-vip'); ?>"><?php echo __('Chính sách thành viên VIP'); ?></a>
			</li>
			<li class="nav-item<?php if ($active_menu == 'request') echo ' is-active'; ?>">
				<a href="<?php echo $this->Html->url('/xem-diem-tich-luy'); ?>"><?php echo __('Xem điểm tích lũy'); ?></a>
			</li>
		</ul>
	</nav>
	<div class="page-body">
		<div class="request">
			<h3 class="request-title"><?php echo __('Hãy điền thông tin để xem điểm tích lũy'); ?>:</h3>
			<?php echo $this->Form->create('Request', array('id' => 'request_form', 'inputDefaults' => array('label' => false, 'div' => false))); ?>
			<div class="form-group">
				<?php echo $this->Form->text('name', array('id' => 'name', 'class' => 'form-control', 'required' => false, 'placeholder' => __('Tên'))); ?>
			</div>
			<div class="form-group">
				<?php echo $this->Form->text('email', array('id' => 'email', 'class' => 'form-control', 'required' => false, 'placeholder' => __('Email'))); ?>
			</div>
			<div class="form-group">
				<?php echo $this->Form->text('phone', array('id' => 'phone', 'class' => 'form-control', 'required' => false, 'placeholder' => __('Điện thoại'))); ?>
			</div>
			<div class="form-group">
				<button type="submit" id="request_submit">
					<?php echo $this->Html->image('button-submit.png'); ?>
				</button>
			</div>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
</div>
<?php echo $this->start('script') ?>
<?php echo $this->element('modal/request'); ?>
<script>
	$(document).ready(function(){
		$('#request_submit').click(function(e){
			e.preventDefault();
            $('.error-message').remove();
			$(this).attr("disabled", "disabled");
			var url = _baseURL + "/thanh-vien-vip/gui-yeu-cau";
			var formElem = $("#request_form");
			var formdata = new FormData(formElem[0]);
			$.ajax({
				method: "POST",
				async: true,
				url: url,
				data: formdata,
				processData: false,
				contentType: false
			})
			.done(function( r ) {
				r = $.parseJSON(r);
				if(r.success == 0)
				{
					$('#request_submit').removeAttr("disabled");
					showErrorsByModel(r.errors, 'request_form');
				}
				else if(r.success == 99) {
					$('#request_submit').removeAttr("disabled");
				}
				else {
					$('#request_success_modal').modal('show');
				}
			})
			.always(function(jqXHR, status){
				$('#request_submit').removeAttr("disabled");
			});
		});
	});
</script>
<?php echo $this->end(); ?>