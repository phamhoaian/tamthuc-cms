<?php if ($auth_user['User']['user_type_cd'] == ADMIN_ROLE) : ?>
<div class="btn-back">
	<?php echo $this->Html->link('<i class="fa fa-plus"></i> Thêm mới', array('controller' => 'admin_events', 'action' => 'admin_edit'), array('class' => 'btn btn-circle btn-success', 'escape' => false)) ?>
</div>
<?php endif; ?>
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
								<th>Tiêu đề</th>
								<th width="15%">Ngày bắt đầu</th>
								<th width="15%">Ngày kết thúc</th>
								<?php if ($auth_user['User']['user_type_cd'] == ADMIN_ROLE) : ?>
								<th width="10%">Trạng thái</th>
								<?php endif; ?>
								<th width="22%"></th>
							</tr>
						</thead>
						<tbody>
						<?php 
						$start = ($page - 1)*PAGI_LIMIT;
						$start++;
						foreach ($list as $key => $row) { 
						$title = json_decode($row['Event']['title'], TRUE);
						?>
							<tr>
								<td><?php echo $start++; ?></td>
								<td><?php echo $title['vi']; ?></td>
								<td><?php echo date('H:s d-m-Y', strtotime($row['Event']['start_date'])) ?></td>
								<td><?php echo date('H:s d-m-Y', strtotime($row['Event']['end_date'])) ?></td>
								<?php if ($auth_user['User']['user_type_cd'] == ADMIN_ROLE) : ?>
								<td><?php echo $row['Event']['status_cd'] == STATUS_PUBLIC ? 'Công khai' : 'Riêng tư' ?></td>
								<?php endif; ?>
								<td style="text-align:center">
								<?php if ($auth_user['User']['user_type_cd'] == ADMIN_ROLE) : ?>
									<?php echo $this->Html->link('<i class="fa fa-pencil"></i> Cập nhật', array('action'=> 'admin_edit', $row['Event']['id']), array('class' => 'btn btn-circle btn-warning btn-xs', 'escape' => false)) ?>
								<?php endif; ?>
									<?php echo $this->Html->link('<i class="fa fa-street-view"></i> Danh sách', array('action'=> 'admin_registered', $row['Event']['id']), array('class' => 'btn btn-circle btn-primary btn-xs', 'escape' => false)) ?>
								<?php if ($auth_user['User']['user_type_cd'] == ADMIN_ROLE) : ?>
									<?php echo $this->Form->button('<i class="fa fa-copy"></i> Copy URL', array('class' => 'btn btn-circle btn-success btn-xs', 'data-clipboard-text' => Router::url('/su-kien/'.$row['Event']['slug'], TRUE))) ?>
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
<?php if ($auth_user['User']['user_type_cd'] == ADMIN_ROLE) : ?>
<?php echo $this->start('script'); ?>
<script src="/components/clipboard/dist/clipboard.min.js"></script>
<script>
	var clipboard = new ClipboardJS('.btn');
</script>
<?php echo $this->end(); ?>
<?php endif; ?>

