<?php $this->layout = "error"; ?>
<div class="container">
    <div id="msg_box" style="text-align: center">
        <?php echo __('申訳ございません。'); ?><br>
        <?php echo __('現在メンテナンス中です。'); ?><br>
        <?php echo __('今しばらくお待ちください。'); ?>
        <br><br><br>
        We are sorry.<br>
		System is under maintenance. <br>
		Please wait a moment now. <br>
        <?php echo $this->Html->image('jump.gif') ?>
    </div>
</div>

