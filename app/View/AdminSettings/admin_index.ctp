<div class="row">
	<div class="col-md-12">
		<div class="portlet box green">
			<div class="portlet-title">
				<div class="caption">
					<i class="icon-settings"></i>Thiết lập
				</div>
			</div>
			<div class="portlet-body form">
				<?php echo $this->Session->flash(); ?>
				<?php echo $this->Form->create('Setting', array('class' => 'form-horizontal', 'enctype'=> 'multipart/form-data')); ?>
				<?php echo $this->Form->hidden('id'); ?>
				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#tab_site" id="tab_content_href" aria-expanded="true">Site</a></li>
					<li class=""><a data-toggle="tab" href="#tab_meta" id="tab_meta_href" aria-expanded="false">Meta</a></li>
					<li class=""><a data-toggle="tab" href="#tab_social" id="tab_social_href" aria-expanded="false">Social</a></li>
				</ul>
				<div class="tab-content">
					<div id="tab_site" class="tab-pane active fade in">
						<div class="form-body">
							<div class="form-group">
								<label class="col-md-2 control-label"><?php echo __('Site URL'); ?> <span class="required" aria-required="true">*</span></label>
								<div class="col-md-10 col-lg-9">
									<?php echo $this->Form->input('site_url', array('type'=> 'text', 'label' =>false, 'class'=>'form-control input-circle', 'maxlength' => 100, 'required' => false, 'error' => false)); ?>
									<?php echo $this->Form->error('site_url'); ?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label"><?php echo __('Site title'); ?> <span class="required" aria-required="true">*</span></label>
								<div class="col-md-10 col-lg-9">
									<?php echo $this->Form->input('site_title', array('type'=> 'text', 'label' =>false, 'class'=>'form-control input-circle', 'maxlength' => 255, 'required' => false, 'error' => false)); ?>
									<?php echo $this->Form->error('site_title'); ?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label"><?php echo __('Site description'); ?></label>
								<div class="col-md-10 col-lg-9">
									<?php echo $this->Form->input('site_description', array('type'=> 'text', 'label' =>false, 'class'=>'form-control input-circle', 'maxlength' => 1000, 'required' => false, 'error' => false)); ?>
									<?php echo $this->Form->error('site_description'); ?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label"><?php echo __('Site keywords'); ?></label>
								<div class="col-md-10 col-lg-9">
									<?php echo $this->Form->input('site_keywords', array('type'=> 'text', 'label' =>false, 'class'=>'form-control input-circle', 'maxlength' => 1000, 'required' => false, 'error' => false)); ?>
									<?php echo $this->Form->error('site_keywords'); ?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label"><?php echo __('Admin email address'); ?> <span class="required" aria-required="true">*</span></label>
								<div class="col-md-10 col-lg-9">
									<?php echo $this->Form->input('admin_mail_address', array('type'=> 'text', 'label' =>false, 'class'=>'form-control input-circle', 'maxlength' => 100, 'required' => false, 'error' => false)); ?>
									<?php echo $this->Form->error('admin_mail_address'); ?>
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
								<label class="col-md-2 control-label"><?php echo __('Google site verification'); ?></label>
								<div class="col-md-10 col-lg-9">
									<?php echo $this->Form->input('google_site_verification', array('type'=> 'text', 'label' =>false, 'class'=>'form-control input-circle', 'maxlength' => 100, 'required' => false, 'error' => false)); ?>
									<?php echo $this->Form->error('google_site_verification'); ?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label"><?php echo __('Google analytics'); ?></label>
								<div class="col-md-10 col-lg-9">
									<?php echo $this->Form->textarea('site_google_analytics', array('type'=> 'text', 'label' =>false, 'class'=>'form-control form-content', 'rows' => 5,'maxlength' => 1000, 'required'=>false)); ?>
									<?php echo $this->Form->error('site_google_analytics'); ?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label"><?php echo __('Facebook pixel'); ?></label>
								<div class="col-md-10 col-lg-9">
									<?php echo $this->Form->textarea('facebook_pixel', array('type'=> 'text', 'label' =>false,'class'=>'form-control form-content', 'rows' => 5,'maxlength' => 1000, 'required'=>false)); ?>
									<?php echo $this->Form->error('facebook_pixel'); ?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label"><?php echo __('Facebook chat'); ?></label>
								<div class="col-md-10 col-lg-9">
									<?php echo $this->Form->textarea('facebook_chat', array('type'=> 'text', 'label' =>false,'class'=>'form-control form-content', 'rows' => 5,'maxlength' => 1000, 'required'=>false)); ?>
									<?php echo $this->Form->error('facebook_chat'); ?>
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
					<div id="tab_social" class="tab-pane fade">
						<div class="form-body">
							<div class="form-group">
								<label class="col-md-2 control-label"><?php echo __('Hotline'); ?></label>
								<div class="col-md-10 col-lg-9">
									<?php echo $this->Form->input('hotline', array('type'=> 'text', 'label' =>false, 'class'=>'form-control input-circle', 'maxlength' => 50, 'required' => false, 'error' => false)); ?>
									<?php echo $this->Form->error('hotline'); ?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label"><?php echo __('Facebook'); ?></label>
								<div class="col-md-10 col-lg-9">
									<?php echo $this->Form->input('facebook', array('type'=> 'text', 'label' =>false, 'class'=>'form-control input-circle', 'maxlength' => 255, 'required' => false, 'error' => false)); ?>
									<?php echo $this->Form->error('facebook'); ?>
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