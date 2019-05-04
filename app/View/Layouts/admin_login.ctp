<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo __('Management'); ?><?php echo isset($page_title) ? ' - '.$page_title : ''; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
    <link rel="stylesheet" href="/components/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/components/font-awesome/css/font-awesome.min.css">
    <?php echo $this->Html->css('admin/login')."\n" ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Favicon and touch icons -->
    <link rel="shortcut icon" href="favicon.ico">
</head>
<body>
    <?php echo $this->fetch('content'); ?>

    <!-- JS -->
    <?php echo $this->Html->script('jquery.min') ?>
    <?php echo $this->Html->script('jquery.backstretch.min') ?>
    <?php echo $this->Html->script('admin/login') ?>
</body>
</html>