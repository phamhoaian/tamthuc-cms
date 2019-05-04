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
								<th width="10%">Họ tên</th>
								<th width="15%">Email</th>
								<th width="10%">Điện thoại</th>
								<th width="15%">Nhà hàng</th>
								<th width="10%">Thời gian</th>
								<th width="5%">Số lượng</th>
								<th>Yêu cầu thêm</th>
								<th width="10%">Trạng thái</th>
								<?php if ($auth_user['User']['user_type_cd'] == ADMIN_ROLE) : ?>
								<th width="5%"></th>
								<?php endif; ?>
							</tr>
						</thead>
						<tbody>
						<?php 
						$start = 0;
						$start++;
						foreach ($list as $key => $row) {
						?>
							<tr>
								<td><?php echo $start++; ?></td>
								<td><?php echo $row['Order']['name']; ?></td>
								<td><?php echo $row['Order']['email']; ?></td>
								<td><?php echo $row['Order']['phone']; ?></td>
								<td><?php echo json_decode($agencies[$row['Order']['agency']], TRUE)['vi']; ?></td>
								<td><?php echo date('H:i d-m-Y', strtotime($row['Order']['hour'].':'.$row['Order']['minute'].' '.$row['Order']['day'])); ?></td>
								<td><?php echo $row['Order']['num_of_guest']; ?></td>
								<td><?php echo $row['Order']['additional']; ?></td>
								<td>
									<?php if ($row['Order']['read_flag'] == READ_FLAG) : ?>
									<span style="color: green">
										<i class="fa fa-check"></i> Đã duyệt</span>
									</span>
									<?php else : ?>
										<?php echo $this->Html->link('Duyệt', array('action'=> 'admin_accept', $row['Order']['id']), array('class' => 'btn btn-circle btn-primary btn-xs', 'escape' => false)) ?>
									<?php endif; ?>
								</td>
								<?php if ($auth_user['User']['user_type_cd'] == ADMIN_ROLE) : ?>
								<td>
									<?php echo $this->Html->link('<i class="fa fa-trash"></i> Xóa', array('action'=> 'admin_delete', $row['Order']['id']), array('class' => 'btn btn-circle btn-danger btn-xs', 'escape' => false, 'confirm' => 'Bạn có chắc chắn muốn xóa?')) ?>
								</td>
								<?php endif; ?>
							</tr>
						<?php }?>
						</tbody>
					</table>
				</div>
				<?php else : ?>
				<div class="alert alert-danger"><?php echo __('Không có dữ liệu.'); ?></div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>

