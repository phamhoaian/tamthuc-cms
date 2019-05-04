<div class="btn-back">
	<?php echo $this->Html->link('<i class="fa fa-arrow-left"></i> Quay lại', array('controller' => 'admin_events', 'action' => 'admin_index'), array('class' => 'btn btn-circle btn-primary', 'escape' => false)) ?>
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
								<th>Họ tên</th>
								<th width="25%">Số điện thoại</th>
								<th width="25%">Email</th>
								<th width="15%">Trạng thái</th>
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
								<td><?php echo $row['EventRegister']['name']; ?></td>
								<td><?php echo $row['EventRegister']['phone']; ?></td>
								<td><?php echo $row['EventRegister']['email']; ?></td>
								<td>
									<?php if ($row['EventRegister']['read_flag'] == READ_FLAG) : ?>
									<span style="color: green">
										<i class="fa fa-check"></i> Đã duyệt</span>
									</span>
									<?php else : ?>
										<?php echo $this->Html->link('Duyệt', array('action'=> 'admin_accept', $row['EventRegister']['event_id'], $row['EventRegister']['id']), array('class' => 'btn btn-circle btn-primary btn-xs', 'escape' => false)) ?>
									<?php endif; ?>	
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

