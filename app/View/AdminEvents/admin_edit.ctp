<div class="btn-back">
	<?php echo $this->Html->link('<i class="fa fa-arrow-left"></i> Quay lại', array('controller' => 'admin_events', 'action' => 'admin_index'), array('class' => 'btn btn-circle btn-primary', 'escape' => false)) ?>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box green">
			<div class="portlet-title">
				<div class="caption">
					<i class="icon-plus"></i>Thêm sự kiện mới
				</div>
			</div>
			<div class="portlet-body form">
				<?php echo $this->Session->flash(); ?>
				<?php echo $this->Form->create('Event', array('class' => 'form-horizontal', 'enctype'=> 'multipart/form-data')); ?>
				<?php echo $this->Form->hidden('id'); ?>
				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#tab_content" id="tab_content_href" aria-expanded="true">Nội dung</a></li>
					<li class=""><a data-toggle="tab" href="#tab_meta" id="tab_meta_href" aria-expanded="false">Meta</a></li>
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
								<label class="col-md-2 control-label"><?php echo __('Ngày bắt đầu'); ?> <span class="required" aria-required="true">*</span></label>
								<div class="col-md-2">
									<div class="input-group" id="start_date">
										<?php echo $this->Form->input('start_date', array('type'=> 'text', 'label' =>false, 'div' => false, 'class'=>'form-control', 'maxlength' => 250, 'required' => false, 'error' => false)); ?>
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span>
										</span>
									</div>
									<?php echo $this->Form->error('start_date'); ?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label"><?php echo __('Ngày kết thúc'); ?> <span class="required" aria-required="true">*</span></label>
								<div class="col-md-2">
									<div class="input-group" id="end_date">
										<?php echo $this->Form->input('end_date', array('type'=> 'text', 'label' =>false, 'div' => false, 'class'=>'form-control', 'maxlength' => 250, 'required' => false, 'error' => false)); ?>
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span>
										</span>
									</div>
									<?php echo $this->Form->error('end_date'); ?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label"><?php echo __('Áp dụng tại'); ?> <span class="required" aria-required="true">*</span></label>
								<div class="col-md-10 col-lg-9">
									<?php echo $this->Form->select('agency', $agencies, array('multiple' => 'multiple', 'id' => 'agency', 'class' => 'form-control', 'label' => false, 'required' => false, 'hiddenField' => false)) ?>
									<?php echo $this->Form->error('agency'); ?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label"><?php echo __('Nội dung trên (tiếng Anh)'); ?></label>
								<div class="col-md-10 col-lg-9">
									<?php echo $this->Form->textarea('content_top_en', array('type'=> 'text', 'label' =>false,'class'=>'form-control form-content', 'rows' => 5,'maxlength' => 1000, 'required'=>false)); ?>
									<?php echo $this->Form->error('content_top_en'); ?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label"><?php echo __('Nội dung trên (tiếng Việt)'); ?></label>
								<div class="col-md-10 col-lg-9">
									<?php echo $this->Form->textarea('content_top_vi', array('type'=> 'text', 'label' =>false, 'class'=>'form-control form-content', 'rows' => 5,'maxlength' => 1000, 'required'=>false)); ?>
									<?php echo $this->Form->error('content_top_vi'); ?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label"><?php echo __('Nội dung dưới (tiếng Anh)'); ?></label>
								<div class="col-md-10 col-lg-9">
									<?php echo $this->Form->textarea('content_bottom_en', array('type'=> 'text', 'label' =>false,'class'=>'form-control form-content', 'rows' => 5,'maxlength' => 1000, 'required'=>false)); ?>
									<?php echo $this->Form->error('content_bottom_en'); ?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label"><?php echo __('Nội dung dưới (tiếng Việt)'); ?></label>
								<div class="col-md-10 col-lg-9">
									<?php echo $this->Form->textarea('content_bottom_vi', array('type'=> 'text', 'label' =>false, 'class'=>'form-control form-content', 'rows' => 5,'maxlength' => 1000, 'required'=>false)); ?>
									<?php echo $this->Form->error('content_bottom_vi'); ?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label"><?php echo __('Điều kiện (tiếng Anh)'); ?></label>
								<div class="col-md-10 col-lg-9">
									<?php echo $this->Form->textarea('condition_en', array('type'=> 'text', 'label' =>false,'class'=>'form-control form-content', 'rows' => 5,'maxlength' => 1000, 'required'=>false)); ?>
									<?php echo $this->Form->error('condition_en'); ?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label"><?php echo __('Điều kiện (tiếng Việt)'); ?></label>
								<div class="col-md-10 col-lg-9">
									<?php echo $this->Form->textarea('condition_vi', array('type'=> 'text', 'label' =>false, 'class'=>'form-control form-content', 'rows' => 5,'maxlength' => 1000, 'required'=>false)); ?>
									<?php echo $this->Form->error('condition_vi'); ?>
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
					<div id="tab_meta" class="tab-pane fade">
						<div class="form-body">
							<div class="form-group">
								<label class="col-md-2 control-label"><?php echo __('Meta keywords'); ?> </label>
								<div class="col-md-10 col-lg-9">
									<?php echo $this->Form->textarea('meta_keywords', array('type'=> 'text', 'label' =>false,'class'=>'form-control', 'rows' => 5,'maxlength' => 1000, 'required'=>false)); ?>
									<?php echo $this->Form->error('meta_keywords'); ?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label"><?php echo __('Meta descriptions'); ?> </label>
								<div class="col-md-10 col-lg-9">
									<?php echo $this->Form->textarea('meta_descriptions', array('type'=> 'text', 'label' =>false, 'class'=>'form-control', 'rows' => 5,'maxlength' => 1000, 'required'=>false)); ?>
									<?php echo $this->Form->error('meta_descriptions'); ?>
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
<?php echo $this->start('css'); ?>
<?php echo $this->Html->css('bootstrap-datetimepicker.min.css'); ?>
<link rel="stylesheet" href="/components/froala_editor/css/froala_editor.pkgd.min.css">
<link rel="stylesheet" href="/components/froala_editor/css/froala_style.min.css">
<link rel="stylesheet" href="/components/froala_editor/css/third_party/embedly.min.css">
<link rel="stylesheet" href="/components/croppie/croppie.css">
<link rel="stylesheet" href="/components/select2/dist/css/select2.min.css">
<style>
	button {
		background-color: transparent;
		border: none;
		cursor: pointer;
		outline: none;
		padding: 0;
		-webkit-appearance: none;
		-moz-appearance: none;
		appearance: none;
	}
	.fr-box.fr-basic .fr-element {
		word-break: break-word;
	}
</style>
<?php echo $this->end(); ?>
<?php echo $this->start('script'); ?>
<script src="/components/froala_editor/js/froala_editor.min.js"></script>
<script src="/components/froala_editor/js/plugins/align.min.js"></script>
<script src="/components/froala_editor/js/plugins/char_counter.min.js"></script>
<script src="/components/froala_editor/js/plugins/draggable.min.js"></script>
<script src="/components/froala_editor/js/plugins/colors.min.js"></script>
<script src="/components/froala_editor/js/plugins/font_size.min.js"></script>
<script src="/components/froala_editor/js/plugins/font_family.min.js"></script>
<script src="/components/froala_editor/js/plugins/fullscreen.min.js"></script>
<script src="/components/froala_editor/js/plugins/image.min.js"></script>
<script src="/components/froala_editor/js/plugins/image_manager.min.js"></script>
<script src="/components/froala_editor/js/plugins/line_breaker.min.js"></script>
<script src="/components/froala_editor/js/plugins/link.min.js"></script>
<script src="/components/froala_editor/js/plugins/lists.min.js"></script>
<script src="/components/froala_editor/js/plugins/paragraph_format.min.js"></script>
<script src="/components/froala_editor/js/plugins/paragraph_style.min.js"></script>
<script src="/components/froala_editor/js/plugins/quick_insert.min.js"></script>
<script src="/components/froala_editor/js/plugins/table.min.js"></script>
<script src="/components/froala_editor/js/plugins/save.min.js"></script>
<script src="/components/froala_editor/js/plugins/url.min.js"></script>
<script src="/components/froala_editor/js/plugins/video.min.js"></script>
<script src="/components/froala_editor/js/languages/vi.js"></script>
<script src="/components/froala_editor/js/third_party/embedly.min.js"></script>
<script src="/components/croppie/croppie.js"></script>
<script src="/components/croppie/upload.js"></script>
<script src="/components/select2/dist/js/select2.min.js"></script>
<?php echo $this->Html->script('moment-with-locales.min.js', array('inline' => true)); ?>
<?php echo $this->Html->script('bootstrap-datetimepicker.min.js', array('inline' => true)); ?>
<script>
	var messagesExt = {
		top_pic: '<?php echo __("Hình ảnh không hợp lệ."); ?>',
	};
    var messagesExceed = {
		top_pic: '<?php echo __("Kích thước hình ảnh phải nhỏ hơn %s.", "1GB"); ?>',
	};

	 $('.form-content').froalaEditor({
        height: 400,
        language:'vi',
        imageDefaultWidth: 500,
        imageDefaultDisplay: 'inline',
        imageAllowedTypes: ['jpeg', 'jpg', 'png', 'gif', 'bmp'],
		imageEditButtons: ['imageReplace', 'imageRemove', 'imageLink', 'imageAlt', 'imageSize'],
		imageManagerPreloader: '/img/admin/loading.gif',
		imageManagerLoadURL: '/load_images',
		imageManagerDeleteURL: '/delete_image',
        imageUploadURL: '/upload_image',
        imageUploadParams: {
          id: 'my_editor'
        }
	})
	.on('froalaEditor.image.error', function (e, editor, error, response) {
		console.log('upload error', error)
	});

	// automatically convert strings with accent marks
	$('#title-vi').on('keyup', function(){
		var txt = $(this).val();
		$('#slug').val(convertToSlug(txt));
	});

	// datetime picker
	$('#start_date').datetimepicker({
		locale: 'vi',
		format: 'YYYY-MM-DD HH:mm',
		minDate: moment()
	});
	$('#end_date').datetimepicker({
		locale: 'vi',
		format: 'YYYY-MM-DD HH:mm',
		minDate: moment()
	});

	// multi selectbox
	$('#agency').select2({
		multiple: true,
		placeholder: 'Chọn chi nhánh',
		tokenSeparators: [',']
	});

	function convertToSlug(str)
	{
		str = str.replace(/^\s+|\s+$/g, ''); // trim
		str = str.toLowerCase();

		// remove accents, swap ñ for n, etc
		var from = "đãàáảạäăặẳằắẵâậẩẫấầẽèéẹẻẽëêểễếềệìíïĩịîỉõọỏòóöôộốồỗổơớờởợợưửựữừứùúụũủüûñç·/_,:;";
		var to   = "daaaaaaaaaaaaaaaaaaeeeeeeeeeeeeeiiiiiiioooooooooooooooooouuuuuuuuuuuuunc------";
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