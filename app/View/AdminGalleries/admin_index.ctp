<div class="btn-back">
	<?php echo $this->Html->link('<i class="fa fa-plus"></i> Thêm mới', array('controller' => 'admin_galleries', 'action' => 'admin_edit'), array('class' => 'btn btn-circle btn-success', 'escape' => false)) ?>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="portlet light bordered">
			<div class="portlet-body">
				<?php if (!empty($list)) : ?>
					<?php foreach ($list as $key => $row) : ?>
					<?php if (($key + 1) % 4 == 1) : ?>
					<div class="row">
					<?php endif; ?>
						<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 item grid-item">
							<div class="portlet light portlet-fit bordered">
								<div class="portlet-title">
									<div class="caption">
										<i class=" icon-layers font-green"></i>
										<span class="caption-subject font-green-sharp uppercase"><?php echo json_decode($row['Gallery']['title'], TRUE)['vi']; ?></span>
									</div>
								</div>
								<div class="portlet-body">
									<div class="mt-element-overlay">
										<div class="row">
											<div class="col-md-12">
												<div class="mt-overlay-2 mt-overlay-2-grey">
													<?php if (! empty($row["Gallery"]["top_pic"]) && ! empty($row["Gallery"]["top_pic"]["file_size"])) { ?>
														<?php echo $this->ImageLabel->image($row["Gallery"]["top_pic"]); ?>
													<?php } ?>
													<div class="mt-overlay">
														<h2><?php echo json_decode($row['Gallery']['title'], TRUE)['vi']; ?></h2>
														<div class="mt-info">
															<?php echo $this->Html->link('Xem thông tin', array('action'=> 'admin_edit', $row['Gallery']['id']), array('class' => 'btn btn-default', 'escape' => false)) ?>
															<?php echo $this->Html->link('Xóa', array('action'=> 'admin_delete', $row['Gallery']['id']), array('class' => 'btn btn-danger', 'escape' => false, 'confirm' => 'Bạn có chắc chắn muốn xóa ảnh này?')) ?>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php if (($key + 1) / 4 == 0) : ?>
					</div>
					<?php endif; ?>
					<?php endforeach; ?>
				<?php echo $this->element('admin/pagination') ?>
				<?php else : ?>
				<div class="alert alert-danger"><?php echo __('Không có dữ liệu.'); ?></div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>

