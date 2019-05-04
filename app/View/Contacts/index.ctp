<div class="container">
	<section class="page-header">
		<h1 class="page-title"><?php echo __('Liên hệ'); ?></h1>
	</section>
	<nav class="page-nav">
		<ul>
			<li class="nav-item is-active">
				<a href="<?php echo $this->Html->url('/lien-he'); ?>"><?php echo __('Liên hệ đối tác'); ?></a>
			</li>
			<li class="nav-item">
				<a href="<?php echo $this->Html->url('/dat-ban'); ?>"><?php echo __('Đặt bàn'); ?></a>
			</li>
		</ul>
	</nav>
	<div class="page-body">
		<div id="contact" class="row">
			<div class="col-xs-12 col-md-6">
				<?php echo $this->Html->image('lien-he.jpg'); ?>
			</div>
			<div class="col-xs-12 col-md-6">
				<p style="margin-top:0"><?php echo __('Hãy để lại thông tin của bạn và thông tin mà bạn cần hỗ trợ, Mo Mo sẽ liên hệ lại để chăm sóc bạn!'); ?></p>
				<?php echo $this->Form->create('Contact', array('id' => 'contact_form', 'inputDefaults' => array('label' => false, 'div' => false))); ?>
				<div class="form-group">
					<?php echo $this->Form->text('name', array('id' => 'name', 'class' => 'form-control', 'required' => false, 'placeholder' => __('Họ tên').':')); ?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->text('email', array('id' => 'email', 'class' => 'form-control', 'required' => false, 'placeholder' => __('Email').':')); ?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->text('title', array('id' => 'title', 'class' => 'form-control', 'required' => false, 'placeholder' => __('Chủ đề').':')); ?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->textarea('content', array('id' => 'content', 'class' => 'form-control', 'rows' => 4, 'cols' => 10, 'placeholder' => __('Nội dung').':')); ?>
				</div>
				<div class="form-group">
					<button type="submit" id="contact_submit">
						<?php echo $this->Html->image('button-submit.png'); ?>
					</button>
				</div>
				<?php echo $this->Form->end(); ?>
			</div>
		</div>
		<?php echo $this->element('Base/contact', array('view_maps' => true)); ?>
	</div>
</div>
<?php echo $this->start('script') ?>
<?php echo $this->element('modal/contact'); ?>
<script>
	$(document).ready(function(){
		$('#contact_submit').click(function(e){
			e.preventDefault();
            $('.error-message').remove();
			$(this).attr("disabled", "disabled");
			var url = _baseURL + "/lien-he";
			var formElem = $("#contact_form");
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
					$('#contact_submit').removeAttr("disabled");
					showErrorsByModel(r.errors, 'contact_form');
				}
				else if(r.success == 99) {
					$('#contact_submit').removeAttr("disabled");
				}
				else {
					$('#contact_success_modal').modal('show');
				}
			})
			.always(function(jqXHR, status){
				$('#contact_submit').removeAttr("disabled");
			});
		});
	});
</script>
<?php echo $this->end(); ?>