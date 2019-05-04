<div class="btn-back">
	<?php echo $this->Html->link('<i class="fa fa-arrow-left"></i> Quay lại', array('controller' => 'admin_news', 'action' => 'admin_categories'), array('class' => 'btn btn-circle btn-primary', 'escape' => false)) ?>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box green">
			<div class="portlet-title">
				<div class="caption">
					<i class="icon-plus"></i>Thêm thể loại mới
				</div>
			</div>
			<div class="portlet-body form">
				<?php echo $this->Session->flash(); ?>
				<?php echo $this->Form->create('NewsCategory', array('class' => 'form-horizontal', 'enctype'=> 'multipart/form-data')); ?>
				<?php echo $this->Form->hidden('id'); ?>
				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#tab_content" id="tab_content_href" aria-expanded="true">Nội dung</a></li>
				</ul>
				<div class="tab-content">
					<div id="tab_content" class="tab-pane active fade in">
						<div class="form-body">
							<div class="form-group">
								<label class="col-md-2 control-label"><?php echo __('Trạng thái'); ?></label>
								<div class="col-md-10 col-lg-9">
									<div class="radio-group radio-inline">
										<?php 
											$opts = array(STATUS_PUBLIC => 'Công khai', STATUS_PRIVATE => 'Riêng tư');	
											echo $this->Form->input('status_cd', array(
												'options' => $opts,
												'type' => 'radio',
												'class' => 'radio-inline',
												'legend' => false,
												'div' => false,
												'default' => STATUS_PUBLIC,
											));
										?>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label"><?php echo __('Tiêu đề (tiếng Anh)'); ?> <span class="required" aria-required="true">*</span></label>
								<div class="col-md-10 col-lg-9">
									<?php echo $this->Form->input('title_en', array('type'=> 'text', 'label' =>false, 'class'=>'form-control input-circle', 'maxlength' => 50, 'required' => false, 'error' => false)); ?>
									<?php echo $this->Form->error('title_en'); ?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label"><?php echo __('Tiêu đề (tiếng Việt)'); ?> <span class="required" aria-required="true">*</span></label>
								<div class="col-md-10 col-lg-9">
									<?php echo $this->Form->input('title_vi', array('type'=> 'text', 'label' =>false, 'id' => 'title-vi', 'class'=>'form-control input-circle', 'maxlength' => 50, 'required' => false, 'error' => false)); ?>
									<?php echo $this->Form->error('title_vi'); ?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label"><?php echo __('Slug'); ?> <span class="required" aria-required="true">*</span></label>
								<div class="col-md-10 col-lg-9">
									<?php echo $this->Form->input('slug', array('type'=> 'text', 'label' =>false, 'id' => 'slug', 'class'=>'form-control input-circle', 'maxlength' => 250, 'required' => false, 'error' => false)); ?>
									<?php echo $this->Form->error('slug'); ?>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-12 margin-top-10">
									<span class="label label-danger">Lưu ý !</span>&nbsp;
									<span>Trường có <span class="required" aria-required="true">*</span> là bắt buộc nhập.</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="form-actions">
					<div class="row">
						<div class="col-md-offset-2 col-md-10">
							<?php
								echo $this->Form->button(($mode == 'create'?'Tạo mới' : "Cập nhật"), array('class' => 'btn btn-circle btn-success', 'id'=>'btn-accept'));
							?>
							<?php echo $this->Form->button('Hủy bỏ', array('type' => 'reset', 'class' => 'btn btn-circle btn-default')) ?>
						</div>
					</div>
				</div>
				<?php echo $this->Form->end(); ?>
			</div>
		</div>
	</div>
</div>
<?php echo $this->start('script'); ?>
<script>
	// automatically convert strings with accent marks
	$('#title-vi').on('keyup', function(){
		var txt = $(this).val();
		$('#slug').val(convertToSlug(txt));
	});

	function convertToSlug(str)
	{
		str = str.replace(/^\s+|\s+$/g, ''); // trim
		str = str.toLowerCase();

		// remove accents, swap ñ for n, etc
		var from = "ãàáảạäăặẳằắẵâậẩẫấầẽèéẹẻẽëêểễếềệìíïĩịîỉõọỏòóöôộốồỗổơớờởợợưửựữừứùúụũủüûñç·/_,:;";
		var to   = "aaaaaaaaaaaaaaaaaaeeeeeeeeeeeeeiiiiiiioooooooooooooooooouuuuuuuuuuuuunc------";
		for (var i=0, l=from.length ; i<l ; i++) {
			str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
		}

		str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
			.replace(/\s+/g, '-') // collapse whitespace and replace by -
			.replace(/-+/g, '-'); // collapse dashes

		return str;
	}
</script>
<?php echo $this->end(); ?>