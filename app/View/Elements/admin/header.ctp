<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja" dir="ltr"
>
<head>
    <meta charset="utf-8">
    <title><?php echo __('Management'); ?><?php echo isset($page_title) ? ' - '.$page_title : ''; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo $this->Html->meta('icon'); ?>
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="/components/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/components/simple-line-icons/simple-line-icons.css">
    <?php echo $this->Html->css('admin/components-md.min.css?_='.date('YmdHis')) ?>
    <?php echo $this->Html->css('admin/plugins-md.min.css?_='.date('YmdHis')) ?>
    <?php echo $this->Html->css('admin/layout.min.css?_='.date('YmdHis')) ?>
    <?php echo $this->Html->css('admin/darkblue.min.css?_='.date('YmdHis')) ?>
    <?php echo $this->Html->css('admin/custom.css?_='.date('YmdHis')) ?>
    <?php //echo $this->Html->css('old/css/admin/common.css?_='.date('YmdHis')) ?>
    <?php //echo $this->Html->css('old/css/style') ?>
    <?php echo $this->fetch('css'); ?>
    <script>
        var baseURL = '<?php echo $this->Common->baseURL(false); ?>';
    </script>
</head>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid page-content-white">
    <div class="page-wrapper">
        <!-- BEGIN HEADER -->
		<div class="page-header navbar navbar-fixed-top">
			<!-- BEGIN HEADER INNER -->
			<div class="page-header-inner ">
				<!-- BEGIN LOGO -->
				<div class="page-logo">
                    <a href="<?php echo $this->Html->url('/admin/dashboard'); ?>">
                        <?php echo $this->Html->image('admin/logo.png', array('class' => 'logo-default')); ?>
                    </a>
					<div class="menu-toggler sidebar-toggler">
						<span></span>
					</div>
				</div>
				<!-- END LOGO -->
				<!-- BEGIN RESPONSIVE MENU TOGGLER -->
				<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
					<span></span>
				</a>
				<!-- END RESPONSIVE MENU TOGGLER -->
				<!-- BEGIN TOP NAVIGATION MENU -->
				<div class="top-menu">
					<ul class="nav navbar-nav pull-right">
						<!-- BEGIN USER LOGIN DROPDOWN -->
						<li class="dropdown dropdown-user">
							<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <?php 
                                    if (!empty($auth_user['User']['profile_pic'])) {

                                    } else {
                                        echo $this->Html->image('admin/user.svg');
                                    }
                                ?>
								<span class="username username-hide-on-mobile"><?php echo $auth_user['User']['name']; ?></span>
								<i class="fa fa-angle-down"></i>
							</a>
							<ul class="dropdown-menu dropdown-menu-default">
								<li>
									<a href="<?php echo $this->Html->url('/admin/logout') ?>">
										<i class="icon-logout"></i> <?php echo __('Đăng xuất'); ?>
									</a>
								</li>
							</ul>
						</li>
						<!-- END USER LOGIN DROPDOWN -->
					</ul>
				</div>
				<!-- END TOP NAVIGATION MENU -->
			</div>
			<!-- END HEADER INNER -->
		</div>
        <!-- END HEADER -->
        <div class="clearfix"> </div>