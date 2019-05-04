<footer class="mo-footer">
	<div class="footer-pattern"></div>
	<div class="footer-body">
		<div class="container">
			<div class="left">
				<a href="<?php echo $this->Html->url('/y-kien-khach-hang'); ?>" class="footer-link"><?php echo __('Ý kiến khách hàng'); ?></a>
			</div>
			<div class="right">
				<ul class="contact">
					<li>
						<a href="tel:<?php echo $setting['hotline']; ?>">
							<?php echo $this->Html->image('icon-phone.png', array('class' => 'contact-icon')); ?>
						</a>
					</li>
					<li>
						<a href="<?php echo $setting['facebook']; ?>" target="_blank">
							<?php echo $this->Html->image('icon-fb.png', array('class' => 'contact-icon')); ?>
						</a>
					</li>
					<li>
						<a href="mailto:<?php echo $setting['admin_mail_address']; ?>">
							<?php echo $this->Html->image('icon-email.png', array('class' => 'contact-icon')); ?>
						</a>
					</li>
				</ul>
				<a href="<?php echo $this->Html->url('/lien-he'); ?>" class="footer-link"><?php echo __('Liên hệ'); ?></a>
			</div> 
		</div>
	</div>
</footer>