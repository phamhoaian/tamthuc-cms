<div class="row">
	<div class="col-md-12">
		<div class="portlet box green">
			<div class="portlet-title">
				<div class="caption">
					<i class="icon-plus"></i>Cập nhật tuyển dụng mới
				</div>
			</div>
			<div class="portlet-body form">
				<?php echo $this->Session->flash(); ?>
				<?php echo $this->Form->create('Recruitment', array('class' => 'form-horizontal', 'enctype'=> 'multipart/form-data')); ?>
				<?php echo $this->Form->hidden('id'); ?>
				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#tab_content" id="tab_content_href" aria-expanded="true">Nội dung</a></li>
					<li class=""><a data-toggle="tab" href="#tab_meta" id="tab_meta_href" aria-expanded="false">Meta</a></li>
				</ul>
				<div class="tab-content">
					<div id="tab_content" class="tab-pane active fade in">
						<div class="form-body">
							<div class="form-group">
								<label class="col-md-2 control-label"><?php echo __('Nội dung (tiếng Anh)'); ?></label>
								<div class="col-md-10 col-lg-9">
									<?php echo $this->Form->textarea('content_en', array('type'=> 'text', 'label' =>false,'class'=>'form-control form-content', 'rows' => 5,'maxlength' => 1000, 'required'=>false)); ?>
									<?php echo $this->Form->error('content_en'); ?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label"><?php echo __('Nội dung (tiếng Việt)'); ?></label>
								<div class="col-md-10 col-lg-9">
									<?php echo $this->Form->textarea('content_vi', array('type'=> 'text', 'label' =>false, 'class'=>'form-control form-content', 'rows' => 5,'maxlength' => 1000, 'required'=>false)); ?>
									<?php echo $this->Form->error('content_vi'); ?>
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
								echo $this->Form->button(("Cập nhật"), array('class' => 'btn btn-circle btn-success', 'id'=>'btn-accept'));
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
<link rel="stylesheet" href="/components/froala_editor/css/froala_editor.pkgd.min.css">
<link rel="stylesheet" href="/components/froala_editor/css/froala_style.min.css">
<link rel="stylesheet" href="/components/froala_editor/css/third_party/embedly.min.css">
<link rel="stylesheet" href="/components/croppie/croppie.css">
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
<script>
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
</script>
<?php echo $this->end(); ?>