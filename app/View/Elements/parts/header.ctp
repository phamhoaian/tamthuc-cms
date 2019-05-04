<header class="mo-header">
	<a href="<?php echo $this->Html->url('/'); ?>" class="mo-logo">
		<?php echo $this->Html->image('logo.png', array('alt' => h($setting['site_name']))); ?>
	</a>
	<button class="mo-nav-button">
		<div class="mo-nav-button-wrap">
			<div class="mo-nav-button-icon">
				<span class="mo-nav-button-line"></span>
				<span class="mo-nav-button-line"></span>
				<span class="mo-nav-button-line"></span>
			</div>
		</div>
	</button>
	<nav class="mo-main-nav-sp">
		<div class="mo-main-nav-sp-wrap">
			<div class="mo-main-nav-sp-container">
				<div class="mo-nav-header">
					<a href="<?php echo $this->Html->url('/'); ?>" class="mo-nav-logo">
						<?php echo $this->Html->image('logo.png', array('alt' => h($setting['site_name']))); ?>
					</a>
					<ul class="mo-nav-list">
						<li><a href="<?php echo $this->Html->url('/net-dac-sac'); ?>" class="mo-nav-link"><span class="mo-nav-link-label"><?php echo __('Nét đặc sắc'); ?></span></a></li>
						<li><a href="<?php echo $this->Html->url('/gioi-thieu'); ?>" class="mo-nav-link"><span class="mo-nav-link-label"><?php echo __('Giới thiệu'); ?></span></a></li>
						<li><a href="<?php echo $this->Html->url('/thuc-don'); ?>" class="mo-nav-link"><span class="mo-nav-link-label"><?php echo __('Thực đơn'); ?></span></a></li>
						<li><a href="<?php echo $this->Html->url('/khuyen-mai'); ?>" class="mo-nav-link"><span class="mo-nav-link-label"><?php echo __('Khuyến mãi'); ?></span></a></li>
						<li><a href="<?php echo $this->Html->url('/tin-tuc'); ?>" class="mo-nav-link"><span class="mo-nav-link-label"><?php echo __('Tin tức'); ?></span></a></li>
						<li><a href="<?php echo $this->Html->url('/tuyen-dung'); ?>" class="mo-nav-link"><span class="mo-nav-link-label"><?php echo __('Tuyển dụng'); ?></span></a></li>
						<li><a href="<?php echo $this->Html->url('/thanh-vien-vip'); ?>" class="mo-nav-link"><span class="mo-nav-link-label"><?php echo __('Thành viên VIP'); ?></span></a></li>
						<li><a href="<?php echo $this->Html->url('/y-kien-khach-hang'); ?>" class="mo-nav-link"><span class="mo-nav-link-label"><?php echo __('Ý kiến khách hàng'); ?></span></a></li>
						<li><a href="<?php echo $this->Html->url('/lien-he'); ?>" class="mo-nav-link"><span class="mo-nav-link-label"><?php echo __('Liên hệ'); ?></span></a></li>
					</ul>
				</div>
				<div class="mo-nav-footer">
					<ul class="languages">
						<li>
							<a href="<?php echo $this->Html->url(array('controller' => 'SwitchLanguages', 'action' => 'index', 'vi')); ?>">
								<?php echo $this->Html->image('flag-vn.png', array('alt' => 'Tiếng Việt')); ?>
							</a>
						</li>	
						<li>
							<a href="<?php echo $this->Html->url(array('controller' => 'SwitchLanguages', 'action' => 'index', 'en')); ?>">
							<?php echo $this->Html->image('flag-us.png', array('alt' => 'English')); ?>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="mo-main-nav-sp-overlay"></div>
	</nav>
	<nav class="mo-main-nav">
		<div class="mo-main-nav-wrap">
			<a href="<?php echo $this->Html->url('/'); ?>" class="mo-nav-logo">
				<?php echo $this->Html->image('logo.png', array('alt' => h($setting['site_name']))); ?>
			</a>
			<ul class="mo-nav-list">
				<li><a href="<?php echo $this->Html->url('/net-dac-sac'); ?>" class="mo-nav-link"><span class="mo-nav-link-label"><?php echo __('Nét đặc sắc'); ?></span></a></li>
				<li><a href="<?php echo $this->Html->url('/gioi-thieu'); ?>" class="mo-nav-link"><span class="mo-nav-link-label"><?php echo __('Giới thiệu'); ?></span></a></li>
				<li><a href="<?php echo $this->Html->url('/thuc-don'); ?>" class="mo-nav-link"><span class="mo-nav-link-label"><?php echo __('Thực đơn'); ?></span></a></li>
				<li><a href="<?php echo $this->Html->url('/khuyen-mai'); ?>" class="mo-nav-link"><span class="mo-nav-link-label"><?php echo __('Khuyến mãi'); ?></span></a></li>
				<li><a href="<?php echo $this->Html->url('/tin-tuc'); ?>" class="mo-nav-link"><span class="mo-nav-link-label"><?php echo __('Tin tức'); ?></span></a></li>
				<li><a href="<?php echo $this->Html->url('/tuyen-dung'); ?>" class="mo-nav-link"><span class="mo-nav-link-label"><?php echo __('Tuyển dụng'); ?></span></a></li>
				<li><a href="<?php echo $this->Html->url('/thanh-vien-vip'); ?>" class="mo-nav-link"><span class="mo-nav-link-label"><?php echo __('Thành viên VIP'); ?></span></a></li>
				<li><a href="<?php echo $this->Html->url('/y-kien-khach-hang'); ?>" class="mo-nav-link"><span class="mo-nav-link-label"><?php echo __('Ý kiến khách hàng'); ?></span></a></li>
				<li><a href="<?php echo $this->Html->url('/lien-he'); ?>" class="mo-nav-link"><span class="mo-nav-link-label"><?php echo __('Liên hệ'); ?></span></a></li>
			</ul>
			<ul class="languages">
				<li>
					<a href="<?php echo $this->Html->url(array('controller' => 'SwitchLanguages', 'action' => 'index', 'vi')); ?>">
						<?php echo $this->Html->image('flag-vn.png', array('alt' => 'Tiếng Việt')); ?>
					</a>
				</li>	
				<li>
					<a href="<?php echo $this->Html->url(array('controller' => 'SwitchLanguages', 'action' => 'index', 'en')); ?>">
					<?php echo $this->Html->image('flag-us.png', array('alt' => 'English')); ?>
					</a>
				</li>
			</ul>
		</div>
	</nav>
</header>