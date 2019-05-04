<p class="setting_menu">
	<!-- count_request_change_address
	count_update_card -->
	<?php 
		$count_request_text = '';
		$count_update_text = '';
		if(isset($count_request_change_address) && $count_request_change_address > 0){
			if($count_request_change_address > 100) {
				$count_request_change_address = '99+';
			}
			$count_request_text = $count_request_change_address;
		}

		if(isset($count_update_card) && $count_update_card > 0){
			if($count_update_card > 100) {
				$count_update_card = '99+';
			}
			$count_update_text = $count_update_card;
		}
	 ?>
    <?php echo $this->Html->link(__('Candidates'), '/admin/admin_candidates/') ?>
    <?php echo $this->Html->link(__('   |Reward Coin'), '/admin/admin_reward_coin/') ?>
    <?php echo $this->Html->link(__('   |Change Ether Address' . (($count_request_text!='') ? ('<span class="notification">'.$count_request_change_address.'</span>') : '' )), '/admin/admin_request_update_address/', array('escape' => false)) ?>
    <?php echo $this->Html->link(__('   |Users'), '/admin/admin_users/') ?>
    <?php echo $this->Html->link(__('   |Update Cards'. (($count_update_text!='') ? ('<span class="notification">'.$count_update_card.'</span>') : '' )), '/admin/admin_cards/', array('escape' => false)) ?>

    <?php echo $this->Html->link(__('   |Notifications'), '/admin/admin_notifications/') ?>
    <?php echo $this->Html->link(__('   |Dividends'), '/admin/admin_dividends/') ?>
    <?php echo $this->Html->link(__('   |FAQs'), '/admin/admin_faqs/') ?>
    <?php echo $this->Html->link(__('   |Contests'), '/admin/admin_contests/') ?>
</p>
<?php if(!empty($setting_title)): ?>
    <h1>
        <?php echo h($setting_title) ?>
    </h1>
<?php endif; ?>
