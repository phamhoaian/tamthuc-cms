<div class="btn-back">
	<?php echo $this->Html->link('<i class="fa fa-arrow-left"></i> Quay lại', array('controller' => 'admin_features', 'action' => 'admin_index'), array('class' => 'btn btn-circle btn-primary', 'escape' => false)) ?>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box green">
			<div class="portlet-title">
				<div class="caption">
					<i class="icon-plus"></i>Thêm trang mới
				</div>
			</div>
			<div class="portlet-body form">
				<?php echo $this->Session->flash(); ?>
				<?php echo $this->Form->create('Feature', array('class' => 'form-horizontal', 'enctype'=> 'multipart/form-data')); ?>
				<?php echo $this->Form->hidden('id'); ?>
				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#tab_content" id="tab_content_href" aria-expanded="true">Nội dung</a></li>
					<li class=""><a data-toggle="tab" href="#tab_how_to_enjoy" id="tab_how_to_enjoy_href" aria-expanded="true">Cách thưởng thức</a></li>
					<li class=""><a data-toggle="tab" href="#tab_sauce" id="tab_sauce_href" aria-expanded="true">Nước chấm</a></li>
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
									<?php echo $this->Form->input('title_en', array('type'=> 'text', 'label' =>false, 'class'=>'form-control input-circle', 'maxlength' => 250, 'required' => false, 'error' => false)); ?>
									<?php echo $this->Form->error('title_en'); ?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label"><?php echo __('Tiêu đề (tiếng Việt)'); ?> <span class="required" aria-required="true">*</span></label>
								<div class="col-md-10 col-lg-9">
									<?php echo $this->Form->input('title_vi', array('type'=> 'text', 'label' =>false, 'id' => 'title-vi', 'class'=>'form-control input-circle', 'maxlength' => 250, 'required' => false, 'error' => false)); ?>
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
								<label class="col-md-2 control-label"><?php echo __('Nội dung (tiếng Anh)'); ?> <span class="required" aria-required="true">*</span></label>
								<div class="col-md-10 col-lg-9">
									<?php echo $this->Form->textarea('content_en', array('type'=> 'text', 'label' =>false,'class'=>'form-control form-content', 'rows' => 5,'maxlength' => 1000, 'required'=>false)); ?>
									<?php echo $this->Form->error('content_en'); ?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label"><?php echo __('Nội dung (tiếng Việt)'); ?> <span class="required" aria-required="true">*</span></label>
								<div class="col-md-10 col-lg-9">
									<?php echo $this->Form->textarea('content_vi', array('type'=> 'text', 'label' =>false, 'class'=>'form-control form-content', 'rows' => 5,'maxlength' => 1000, 'required'=>false)); ?>
									<?php echo $this->Form->error('content_vi'); ?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label">Hình ảnh</label>
								<div class="col-md-5">
									<div class="uploading horizontal <?php echo ! empty($this->request->data["Feature"]["top_pic"]) && ! empty($this->request->data["Feature"]["top_pic"]["file_size"]) ? 'opened' : '';  ?>">
										<div class="preview-area">
											<div id="top_pic_preview" class="preview-wrap <?php echo ! empty($this->request->data["Feature"]["top_pic"]) && ! empty($this->request->data["Feature"]["top_pic"]["file_size"])  ? 'opened' : '';  ?>">
												<?php if (! empty($this->request->data["Feature"]["top_pic"]) && ! empty($this->request->data["Feature"]["top_pic"]["file_size"])) { ?>
													<div style="background: url(<?php echo $this->ImageLabel->url($this->request->data["Feature"]["top_pic"]); ?>) no-repeat center; background-size: contain; height: 208px; width: auto; margin: auto; border-radius: 10px;"></div>
												<?php } ?>
											</div>
										</div>
										<div class="drap-and-drop <?php echo ! empty($this->request->data["Feature"]["top_pic"]) && ! empty($this->request->data["Feature"]["top_pic"]["file_size"]) ? 'opened' : '';  ?>" data-file-id="top_pic">
											<label for="top_pic">
												<input type="file" id="top_pic" name="data[Feature][top_pic]" class="upload-file" data-preview-id="top_pic_preview" accept=".jpg,.jpeg,.gif,.png"  <?php if(!empty($readOnly)) echo 'disabled="true"' ?> data-type="image"/>
												<?php echo $this->Html->image('admin/upload-icon.svg', array('class' => 'upload-icon', 'style' => 'margin-bottom: 5px;')); ?>
												<p>Kéo và thả để tải ảnh lên</p>
											</label>
										</div>
									</div>
									<?php echo $this->Form->error('top_pic'); ?>
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
					<div id="tab_how_to_enjoy" class="tab-pane fade">
						<div class="form-body">
							<div class="accordion scrollable in collapse" id="accordion_how_to_enjoy" style="height: auto;">
								<?php $sort_order_how_to_enjoy = array(); ?>
								<?php if (!empty($optional_enjoy)) : ?>
									<?php foreach ($optional_enjoy as $val) : ?>
										<?php echo $this->element('admin_features/step', array('item' => $val, 'key' => $val['Optional']['id'], 'type' => OPTIONAL_HOW_TO_ENJOY)); ?>
										<?php $sort_order_how_to_enjoy[] = $val['Optional']['id']; ?>
									<?php endforeach; ?>
								<?php endif; ?>
								<input type="hidden" name="sort_order_how_to_enjoy" id="sort_order_how_to_enjoy" value="<?php echo implode(',', $sort_order_how_to_enjoy); ?>" />
							</div>
							<div class="collapse-add">
								<button id="btn-add-how-to-enjoy" class="btn btn-circle btn-brand btn-block">
									<i class="fa fa-plus"></i>Thêm
								</button>
							</div>
							<div class="form-group">
								<div class="col-md-12 margin-top-10">
									<span class="label label-danger">Lưu ý !</span>&nbsp;
									<span>Trường có <span class="required" aria-required="true">*</span> là bắt buộc nhập.</span>
								</div>
							</div>
						</div>
					</div>
					<div id="tab_sauce" class="tab-pane fade">
						<div class="form-body">
							<div class="accordion scrollable in collapse" id="accordion_sauce" style="height: auto;">
								<?php $sort_order_sauce = array(); ?>
								<?php if (!empty($optional_sauce)) : ?>
									<?php foreach ($optional_sauce as $val) : ?>
										<?php echo $this->element('admin_features/step', array('item' => $val, 'key' => $val['Optional']['id'], 'type' => OPTIONAL_SAUCE)); ?>
										<?php $sort_order_sauce[] = $val['Optional']['id']; ?>
									<?php endforeach; ?>
								<?php endif; ?>
								<input type="hidden" name="sort_order_sauce" id="sort_order_sauce" value="<?php echo implode(',', $sort_order_sauce); ?>" />
							</div>
							<div class="collapse-add">
								<button id="btn-add-sauce" class="btn btn-circle btn-brand btn-block">
									<i class="fa fa-plus"></i>Thêm
								</button>
							</div>
							<div class="form-group">
								<div class="col-md-12">
									<label class="col-md-1 control-label">Số cột</label>
									<div class="col-md-10 col-lg-9">
										<div class="radio-group radio-inline">
											<?php 
												$cols_opts = array(ONE_COLUMN => 1, TWO_COLUMN => 2);	
												echo $this->Form->input('cols', array(
													'options' => $cols_opts,
													'type' => 'radio',
													'class' => 'radio-inline',
													'legend' => false,
													'div' => false,
													'default' => ONE_COLUMN,
												));
											?>
										</div>
										<?php echo $this->Form->error('cols'); ?>
									</div>
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
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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

	$('#btn-add-how-to-enjoy').click(function(e){
		e.preventDefault();
		$.ajax({
			url: '/admin/admin_features/add_more_step',
			type: 'POST',
			data: {
				type: <?php echo OPTIONAL_HOW_TO_ENJOY; ?>,
				key: $('#accordion_how_to_enjoy .accordion-group').length + $('#accordion_sauce .accordion-group').length
			},
			success: function (html) {
				$('#accordion_how_to_enjoy').append(html);
			}
		});
	});

	$('#btn-add-sauce').click(function(e){
		e.preventDefault();
		$.ajax({
			url: '/admin/admin_features/add_more_step',
			type: 'POST',
			data: {
				type: <?php echo OPTIONAL_SAUCE; ?>,
				key: $('#accordion_how_to_enjoy .accordion-group').length + $('#accordion_sauce .accordion-group').length
			},
			success: function (html) {
				$('#accordion_sauce').append(html);
			}
		});
	});

	// automatically convert strings with accent marks
	$('#title-vi').on('keyup', function(){
		var txt = $(this).val();
		$('#slug').val(convertToSlug(txt));
	});

	// remove step collapse
	$(document).on('click', '.btn-remove-step', function(e){
		var button = $(this);
		e.preventDefault();
		var result = confirm("Bạn có muốn xóa nội dung này?");
		if (result) {
			var accordion = button.parents('.accordion-group');
			accordion.slideUp('slow', function(){ accordion.remove(); });
			$.ajax({
				url: '/admin/admin_features/remove_step',
				type: 'POST',
				data: {
					step_id: button.data('step-id')
				},
				success: function (res) {
					var r = $.parseJSON(res);
					if (r.error === false) {
						
					}
				}
			});
		}
	});

	// drag sort collapse
	var sortEnjoy = $('#sort_order_how_to_enjoy');
	var listEnjoy = $('#accordion_how_to_enjoy');
	/* worker function */
	var fnSubmit = function() {
		var sortOrder = [];
		listEnjoy.children('.accordion-group').each(function(){
			sortOrder.push($(this).data('id'));
		});
		sortEnjoy.val(sortOrder.join(','));
		console.log(sortEnjoy.val());
	};
	/* store values */
	listEnjoy.children('.accordion-group').each(function() {
		var li = $(this);
		li.data('id',li.attr('title')).attr('title','');
	});
	/* sortables */
	listEnjoy.sortable({
		opacity: 0.7,
		update: function() {
			fnSubmit();
		}
	});
	listEnjoy.disableSelection();

	// drag sort collapse
	var sortSauce = $('#sort_order_sauce');
	var listSauce = $('#accordion_sauce');
	/* worker function */
	var fnSubmit = function() {
		var sortOrder = [];
		listSauce.children('.accordion-group').each(function(){
			sortOrder.push($(this).data('id'));
		});
		sortSauce.val(sortOrder.join(','));
		console.log(sortSauce.val());
	};
	/* store values */
	listSauce.children('.accordion-group').each(function() {
		var li = $(this);
		li.data('id',li.attr('title')).attr('title','');
	});
	/* sortables */
	listSauce.sortable({
		opacity: 0.7,
		update: function() {
			fnSubmit();
		}
	});
	listSauce.disableSelection();

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