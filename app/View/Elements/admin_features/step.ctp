<div class="accordion-group" title="<?php echo !empty($item['Optional']['id']) ? $item['Optional']['id'] : ''; ?>">
	<?php echo $this->Form->hidden("Optional.{$key}.id", array('value' => !empty($item['Optional']['id']) ? $item['Optional']['id'] : '')); ?>
	<?php echo $this->Form->hidden("Optional.{$key}.cat_id", array('value' => $type)); ?>
	<div class="accordion-heading">
		<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion_how_to_enjoy" href="#collapse_<?php echo $type; ?>_<?php echo $key; ?>"><i class="icon-cursor-move"></i>&nbsp;&nbsp;&nbsp;<?php echo !empty($item['Optional']['content_vi']) ? $item['Optional']['content_vi'] : (!empty($item['Optional']['content_en']) ? $item['Optional']['content_en'] : 'Thêm nội dung'); ?></a>
		<div class="accordion-arrow">
			<button class="btn btn-circle btn-danger btn-xs btn-remove-step" data-step-id="<?php echo !empty($item['Optional']['id']) ? $item['Optional']['id'] : ''; ?>">
				<i class="fa fa-trash"></i> Xóa
			</button>
		</div>
	</div>
	<div id="collapse_<?php echo $type; ?>_<?php echo $key; ?>" class="accordion-body in collapse" style="height: auto;">
		<div class="accordion-inner">
		<div class="col-md-6 col-xs-12">
			<div class="row">
				<label class="col-md-3 control-label"><?php echo __('Mô tả (tiếng Việt)'); ?></label>
				<div class="col-md-9">
					<?php echo $this->Form->textarea("Optional.{$key}.content_vi", array('type'=> 'text', 'label' =>false,'class'=>'form-control', 'rows' => 10,'maxlength' => 1000, 'required'=>false, 'value' => !empty($item['Optional']['content_vi']) ? $item['Optional']['content_vi'] : '')); ?>
					<?php echo $this->Form->error("Optional.{$key}.content_vi"); ?>
				</div>
			</div>
			<div class="row">
				<label class="col-md-3 control-label"><?php echo __('Mô tả (tiếng Anh)'); ?></label>
				<div class="col-md-9">
					<?php echo $this->Form->textarea("Optional.{$key}.content_en", array('type'=> 'text', 'label' =>false,'class'=>'form-control', 'rows' => 10,'maxlength' => 1000, 'required'=>false, 'value' => !empty($item['Optional']['content_en']) ? $item['Optional']['content_en'] : '')); ?>
					<?php echo $this->Form->error("Optional.{$key}.content_en"); ?>
				</div>
			</div>
		</div>
		<div class="col-md-6 col-xs-12">
			<div class="row">
			<label class="col-md-2 control-label">Hình ảnh</label>
			<div class="col-md-10">
				<div class="uploading horizontal <?php echo ! empty($item["Optional"]["top_pic"]) && ! empty($item["Optional"]["top_pic"]["file_size"]) ? 'opened' : '';  ?>">
				<div class="preview-area">
					<div id="optional_<?php echo $key; ?>_top_pic_preview" class="preview-wrap <?php echo ! empty($item["Optional"]["top_pic"]) && ! empty($item["Optional"]["top_pic"]["file_size"])  ? 'opened' : '';  ?>">
					<?php if (! empty($item["Optional"]["top_pic"]) && ! empty($item["Optional"]["top_pic"]["file_size"])) { ?>
						<div style="background: url(<?php echo $this->ImageLabel->url($item["Optional"]["top_pic"]); ?>) no-repeat center; background-size: contain; height: 208px; width: auto; margin: auto; border-radius: 10px;"></div>
					<?php } ?>
					</div>
				</div>
				<div class="drap-and-drop <?php echo ! empty($item["Optional"]["top_pic"]) && ! empty($item["Optional"]["top_pic"]["file_size"]) ? 'opened' : '';  ?>" data-file-id="top_pic">
					<label for="optional_<?php echo $key; ?>_top_pic">
					<input type="file" id="optional_<?php echo $key; ?>_top_pic" name="data[Optional][<?php echo $key; ?>][top_pic]" class="upload-file" data-preview-id="optional_<?php echo $key; ?>_top_pic_preview" accept=".jpg,.jpeg,.gif,.png"  <?php if(!empty($readOnly)) echo 'disabled="true"' ?> data-type="image"/>
					<?php echo $this->Html->image('admin/upload-icon.svg', array('class' => 'upload-icon', 'style' => 'margin-bottom: 5px;')); ?>
					<p>Kéo và thả để tải ảnh lên</p>
					</label>
				</div>
				</div>
				<?php echo $this->Form->error("Optional.{$key}.top_pic"); ?>
			</div>
			</div>
		</div>
		</div>
	</div>
</div>