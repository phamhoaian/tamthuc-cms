<div class="btn-back">
	<?php echo $this->Html->link('<i class="fa fa-plus"></i> Thêm mới', array('controller' => 'admin_pages', 'action' => 'admin_edit'), array('class' => 'btn btn-circle btn-success', 'escape' => false)) ?>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="portlet light bordered">
			<div class="portlet-body">
				<?php if (!empty($list)) : ?>
				<div class="table-responsive">
					<table class="table m-table m-table--head-bg-success">
						<thead>
							<tr>
								<th width="5%">#</th>
								<th width="10%">Hình ảnh</th>
								<th>Tiêu đề (tiếng Anh)</th>
								<th>Tiêu đề (tiếng Việt)</th>
								<th width="15%">Trạng thái</th>
								<th width="16%"></th>
							</tr>
						</thead>
						<tbody>
						<?php 
						$start = ($page - 1)*PAGI_LIMIT;
						$start++;
						foreach ($list as $key => $row) { 
						$title = json_decode($row['Page']['title'], TRUE);
						?>
							<tr>
								<td><?php echo $start++; ?></td>
								<td>
									<?php if (! empty($row["Page"]["top_pic"]) && ! empty($row["Page"]["top_pic"]["file_size"])) { ?>
											<div style="background: url(<?php echo $this->ImageLabel->url($row["Page"]["top_pic"]); ?>) no-repeat center; background-size: contain; height: 30px; width: auto; margin: auto; border-radius: 10px;"></div>
										<?php } ?>
								</td>
								<td><?php echo $title['en']; ?></td>
								<td><?php echo $title['vi']; ?></td>
								<td><?php echo $row['Page']['status_cd'] == STATUS_PUBLIC ? 'Công khai' : 'Riêng tư' ?></td>
								<td>
									<?php echo $this->Html->link('<i class="fa fa-pencil"></i> Cập nhật', array('action'=> 'admin_edit', $row['Page']['id']), array('class' => 'btn btn-circle btn-warning btn-xs', 'escape' => false)) ?>
									<?php echo $this->Html->link('<i class="fa fa-trash"></i> Xóa', array('action'=> 'admin_delete', $row['Page']['id']), array('class' => 'btn btn-circle btn-danger btn-xs', 'escape' => false, 'confirm' => 'Bạn có chắc chắn muốn xóa trang này?')) ?>
								</td>
							</tr>
						<?php }?>
						</tbody>
					</table>
				</div>
				<?php echo $this->element('admin/pagination') ?>
				<?php else : ?>
				<div class="alert alert-danger"><?php echo __('Không có dữ liệu.'); ?></div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>

