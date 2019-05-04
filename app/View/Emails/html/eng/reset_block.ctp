<?php echo $email ?>
<br>
The login information was entered incorrectly more than 10 times, so the account is locked.
<br/> Please access the following URL and unlock account lock.
<br>
<?php echo $this->Html->link(
					$url,
					$url,
					array('escape' => false)
				);
			?>