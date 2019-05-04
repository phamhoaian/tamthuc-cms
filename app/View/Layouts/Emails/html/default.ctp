<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<style>
		.main {
			font-size: 12px;
			font-family: 'KozGoPr6N-Regular', 'Hiragino Kaku Gothic ProN', 'ヒラギノ角ゴ Pro W3', "游ゴシック体", "Yu Gothic", YuGothic, 'メイリオ', Meiryo, 'ＭＳ Ｐゴシック', sans-serif;
			padding-top: 20px;
			padding-bottom: 20px;
		}
		p.logo{
			text-align: center;
		}
		.container {
			width: 380px;
			border: 1px solid #efefef;
			margin: 20px auto;
			padding: 40px 20px;
			background: #fff;
		}
		.center {
			text-align: center;
		}
		sub.description {
			font-size: 11px;
			color: #ccc;

		}
		sub.description span{
			text-decoration: underline;
		}
		.btn-action{
			background: #dd636d;
			padding: 10px;
			color: #fff;
			text-decoration: none;
			/* Safari 3-4, iOS 1-3.2, Android 1.6- */
			-webkit-border-radius: 4px; 
			/* Firefox 1-3.6 */
			-moz-border-radius: 4px; 
			/* Opera 10.5, IE 9, Safari 5, Chrome, Firefox 4, iOS 4, Android 2.1+ */
		  border-radius: 4px; 
		}
		.half-border{
			width: 50px; border: 1px solid #e5e5e5; margin-bottom: 30px;
		}
	</style>    
</head>
<body>
	<div class="main" style="background: #fbf8dc;">
		<p class="logo">
			<?php echo $this->Html->link(
                                        '<img src="'.$setting['site_url'].'img/common/real-boost-logo.svg'.'" width="220" alt="REAL BOOST" />',
                                        Router::url('/', true), array('escape'=>false, 'target' => '_blank')
                                        ) ?>
		</p>
		<div id="content">
			<div class="container">
				<?php echo $this->fetch('content'); ?>
			</div>
		</div>
		<p class="center">
			<sub class="description">
				<span>
					<?php if(!empty($setting['mail_signature'])): ?>
					    <?php echo h($setting['mail_signature']) ?>
					<?php else: ?>
					    --------------------------------------------
					    <?php echo $setting['site_name'], "\n" ?>
					    <?php echo $setting['site_url'], "\n" ?>
					<?php endif ?>
				</span>
			</sub>
		</p>
	</div>
	
</body>
</html>