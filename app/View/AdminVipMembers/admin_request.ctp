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
								<th width="15%">Họ tên</th>
								<th>Email</th>
								<th>Số điện thoại</th>
								<th width="15%">Trạng thái</th>
								<?php if ($auth_user['User']['user_type_cd'] == ADMIN_ROLE) : ?>
								<th width="10%"></th>
								<?php endif; ?>
							</tr>
						</thead>
						<tbody>
						<?php 
						$start = ($page - 1)*PAGI_LIMIT;
						$start++;
						foreach ($list as $key => $row) { 
						?>
							<tr>
								<td><?php echo $start++; ?></td>
								<td><?php echo $row['Request']['name']; ?></td>
								<td><?php echo $row['Request']['email']; ?></td>
								<td><?php echo $row['Request']['phone']; ?></td>
								<td>
									<?php if ($row['Request']['read_flag'] == READ_FLAG) : ?>
									<span style="color: green">
										<i class="fa fa-check"></i> Đã duyệt</span>
									</span>
									<?php else : ?>
										<?php echo $this->Html->link('Duyệt', array('action'=> 'admin_accept', $row['Request']['id']), array('class' => 'btn btn-circle btn-primary btn-xs', 'escape' => false)) ?>
									<?php endif; ?>
								</td>
								<?php if ($auth_user['User']['user_type_cd'] == ADMIN_ROLE) : ?>
								<td>
									<?php echo $this->Html->link('<i class="fa fa-trash"></i> Xóa', array('action'=> 'admin_delete', $row['Request']['id']), array('class' => 'btn btn-circle btn-danger btn-xs', 'escape' => false, 'confirm' => 'Bạn có chắc chắn muốn xóa?')) ?>
								</td>
								<?php endif; ?>
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

