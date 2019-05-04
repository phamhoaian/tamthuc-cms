	<!-- Facebook Chat -->
	<?php if (!empty($setting['facebook_chat'])) echo $setting['facebook_chat']; ?>
	<!-- End Facebook Chat -->
	<script src="/js/public.js?t=<?php echo date('ymdHis'); ?>" type="text/javascript"></script>
	<?php echo $this->fetch('script'); ?>
</body>
</html>