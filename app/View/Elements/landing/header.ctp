<section class="header">
	<div class="logo">
		<a href="<?php echo $this->Html->url('/'); ?>">
			<?php echo $this->Html->image('logo.svg'); ?>
		</a>
	</div>
	<h1 class="page-title"><?php echo json_decode($event['Event']['title'], TRUE)['vi'] ?></h1>
	<div class="body">
		<div class="content-top">
			<?php echo json_decode($event['Event']['content_top'], TRUE)['vi'] ?>
		</div>
		<div class="content-center">
			<ul class="slider">
				<li class="slider-item">
					<?php echo $this->Html->image('Lau3.png') ?>
				</li>
				<li class="slider-item">
					<?php echo $this->Html->image('Lau2.png') ?>
				</li>
				<li class="slider-item">
					<?php echo $this->Html->image('Lau1.png') ?>
				</li>
				<li class="slider-item">
					<?php echo $this->Html->image('Lau4.png') ?>
				</li>
			</ul>
		</div>
		<div class="content-bottom">
			<?php echo json_decode($event['Event']['content_bottom'], TRUE)['vi'] ?>
		</div>
	</div>
</section>