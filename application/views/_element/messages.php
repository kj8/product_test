<?php if (!empty($messages)): ?>
	<?php foreach ($messages as $m): ?>
		<?php
		$type = array(
			Message::TYPE_INFO => 'alert-info',
			Message::TYPE_SUCCESS => 'alert-success',
			Message::TYPE_WARNING => 'alert-warning',
			Message::TYPE_ERROR => 'alert-danger',
		);
		?>
		<div class="alert <?php echo $type[$m['type']]; ?>">
			<?php echo $m['message']; ?>
		</div>
	<?php endforeach; ?>
<?php endif; ?>