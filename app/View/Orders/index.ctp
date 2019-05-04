<div class="container">
	<section class="page-header">
		<h1 class="page-title"><?php echo __('Liên hệ'); ?></h1>
	</section>
	<nav class="page-nav">
		<ul>
			<li class="nav-item">
				<a href="<?php echo $this->Html->url('/lien-he'); ?>"><?php echo __('Liên hệ đối tác'); ?></a>
			</li>
			<li class="nav-item is-active">
				<a href="<?php echo $this->Html->url('/dat-ban'); ?>"><?php echo __('Đặt bàn'); ?></a>
			</li>
		</ul>
	</nav>
	<div class="page-body">
		<div id="order">
			<h3 class="order-title"><?php echo __('Thông tin khách hàng'); ?></h3>
			<p class="order-sub-title">(<?php echo __('Vui lòng đặt bàn trước 1 ngày hoặc gọi Hotline %s để đặt bàn', $setting['hotline']); ?>)</p>
			<?php echo $this->Form->create('Order', array('id' => 'order_form', 'inputDefaults' => array('label' => false, 'div' => false))); ?>
				<div class="form-group">
					<?php echo $this->Form->text('name', array('id' => 'name', 'class' => 'form-control', 'required' => false, 'placeholder' => __('Họ tên'))); ?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->text('phone', array('id' => 'phone', 'class' => 'form-control', 'required' => false, 'placeholder' => __('Điện thoại'))); ?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->text('email', array('id' => 'email', 'class' => 'form-control', 'required' => false, 'placeholder' => __('Email'))); ?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->select('agency', $list_agency, array('class' => 'form-control', 'id' => 'agency', 'label' => false, 'required' => false, 'empty' => __('Vui lòng chọn 1 nhà hàng'))) ?>
				</div>
				<div class="form-group">
					<div class="flex-container">
						<div class="columns aligner-item-top">
							<?php echo $this->Form->input('day', array('type'=> 'text', 'label' =>false, 'size' => 16, 'maxlength' => 16, 'class'=>'form-control', 'id' => 'day', 'error' => false, 'placeholder' => __('Ngày đặt bàn'))); ?>
						</div>
						<div class="columns aligner-item-top">
							<?php echo $this->Form->select('hour', $list_hour, array('id' => 'hour', 'class' => 'form-control', 'label' => false, 'required' => false, 'empty' => __('Vui lòng chọn giờ'))) ?>
						</div>
						<div class="columns aligner-item-top">
							<?php echo $this->Form->select('minute', $list_minute, array('id' => 'minute', 'class' => 'form-control', 'label' => false, 'required' => false, 'empty' => __('Vui lòng chọn phút'))) ?>
						</div>
					</div>
				</div>
				<div class="form-group">
					<?php echo $this->Form->text('num_of_guest', array('id' => 'num_of_guest', 'class' => 'form-control', 'required' => false, 'placeholder' => __('Số lượng khách'))); ?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->textarea('additional', array('id' => 'additional', 'class' => 'form-control', 'rows' => 7, 'cols' => 10, 'placeholder' => __('Mô tả chi tiết yêu cầu của bạn'))); ?>
				</div>
				<div class="form-group btn-submit">
					<button type="submit" id="order_submit" class="btn btn-default"><?php echo __('Đặt bàn'); ?></button>
				</div>
			<?php echo $this->Form->end(); ?>
		</div>
		<?php echo $this->element('Base/contact'); ?>
	</div>
</div>
<?php echo $this->start('css') ?>
<?php //echo $this->Html->css('bootstrap.min.css'); ?>
<?php echo $this->Html->css('bootstrap-datetimepicker.min.css'); ?>
<?php echo $this->end(); ?>
<?php echo $this->start('script') ?>
<?php echo $this->element('modal/order'); ?>
<?php echo $this->Html->script('moment-with-locales.min.js', array('inline' => true)); ?>
<?php echo $this->Html->script('bootstrap.min.js', array('inline' => true)); ?>
<?php echo $this->Html->script('bootstrap-datetimepicker.min.js', array('inline' => true)); ?>
<script>
	$(document).ready(function(){
		$('#day').datetimepicker({
			 format: 'DD-MM-YYYY',
			 icons: {
				up: "fa fa-arrow-up",
				down: "fa fa-arrow-down"
			 },
			 locale: '<?php echo Configure::read('Config.language_key'); ?>',
			 minDate: moment()
		 });

		$('#order_submit').click(function(e){
			e.preventDefault();
            $('.error-message').remove();
			$(this).attr("disabled", "disabled");
			var url = _baseURL + "/dat-ban";
			var formElem = $("#order_form");
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
					$('#order_submit').removeAttr("disabled");
					showErrorsByModel(r.errors, 'order_form');
				}
				else if(r.success == 99) {
					$('#order_submit').removeAttr("disabled");
				}
				else {
					$('#order_success_modal').modal('show');
				}
			})
			.always(function(jqXHR, status){
				$('#order_submit').removeAttr("disabled");
			});
		});
	});
</script>
<?php echo $this->end(); ?>