<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja" dir="ltr"
>
<head>
    <meta charset="utf-8">
    <title>
        <?php echo __('ただいまメンテナンス中です'); ?> - <?php echo h($setting['site_name']) ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo $this->Html->meta('icon'); ?>
    <?php echo $this->Html->css('error')."\n" ?>
</head>
<body style="background: #e0dfd7">
    <p class="logo" style="text-align: center">
        <?php
            echo $this->Html->image('common/real-boost-logo.svg', array('width' => '200'));
        ?>
    </p>

<?php echo $this->fetch('content'); ?>
</body>
</html>