<html lang="<?php echo Configure::read('Config.language_key') ?>">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<?php echo $this->Html->meta('icon'); ?>
	<title><?php echo !empty($page_title) ? h($page_title) : h($setting['site_title']); ?></title>
	<meta name="description" content="<?php echo h($setting['site_description']); ?>">
	<meta name="keywords" content="<?php echo h($setting['site_keywords']); ?>"/>
	<meta property="og:url" content="<?php echo $this->Common->baseURL(false) . $this->here ?>" />
    <meta property="og:site_name" content="<?php echo h($setting['site_title']); ?>">
    <meta property="og:type" content="<?php echo !empty($sns) ? 'article' :'website' ?>">
    <meta property="og:title" content="<?php echo !empty($sns['title']) ? h($sns['title']) : h($setting['site_title']); ?>" />
	<meta property="og:description" content="<?php echo !empty($sns['description']) ? h($sns['description']) : h($setting['site_description']); ?>" />
	<?php 
		if(isset($sns['image'])) {
			$sns['image']['file_name'] = urlencode($sns['image']['file_name']);
			$image_url = $this->Label->url($sns['image']);
		}
		else{
			$image_url = $this->Common->baseURL() .'img/logo.png';
		}
	?>
	<meta property="og:image" content="<?php echo $image_url; ?>" />
	<?php if (!empty($setting['google_site_verification'])) : ?>
	<meta name="google-site-verification" content="<?php echo $setting['google_site_verification']; ?>" />
	<?php endif; ?>
	<link rel="shortcut icon" href="favicon.ico">
	<link rel="stylesheet" href="/css/public.css?t=<?php echo date('ymdHis'); ?>">
	<?php echo $this->fetch('css'); ?>
	<!-- Googel Analytics -->
	<?php if (!empty($setting['site_google_analytics'])) echo $setting['site_google_analytics']; ?>
	<!-- End Googel Analytics -->
	<!-- Facebook Pixel -->
	<?php if (!empty($setting['facebook_pixel'])) echo $setting['facebook_pixel']; ?>
	<!-- End Facebook Pixel -->
	<script defer>
        var _lang = '<?php echo Configure::read('Config.language_key') ?>';
        var _baseURL = '<?php echo $this->Common->baseURL(false); ?>';
        var _globalAuth = <?php echo isset($auth_user) ? 'true' : 'false'; ?>;
    </script>
</head>
<body class="is-loading<?php echo isset($is_home) ? ' is-home' : '' ?>">
	<div class="mo-loading-logo is-active">
		<?php echo $this->Html->image('logo-loading.png', array('class' => 'mo-loading-logo-img')); ?>
	</div>
	<div class="mo-transition-overplay"></div>