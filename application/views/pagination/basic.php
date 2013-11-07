<ul class="pagination">

	<li>
		<?php if ($first_page !== FALSE): ?>
			<a href="<?php echo HTML::chars($page->url($first_page)) ?>" rel="first"><?php echo __('First') ?></a>
		<?php else: ?>
			<?php //echo __('First') ?>
		<?php endif; ?>
	</li>

	<li>
		<?php if ($previous_page !== FALSE): ?>
			<a href="<?php echo HTML::chars($page->url($previous_page)) ?>" rel="prev"><?php echo __('Previous') ?></a>
		<?php else: ?>
			<?php //echo __('Previous') ?>
		<?php endif; ?>
	</li>

	<?php for ($i = 1; $i <= $total_pages; $i++): ?>
		<li class="<?php echo ($i == $current_page) ? 'active' : ''; ?>">
			<a href="<?php echo HTML::chars($page->url($i)) ?>"><?php echo $i ?></a>
		</li>
	<?php endfor; ?>

	<li>
		<?php if ($next_page !== FALSE): ?>
			<a href="<?php echo HTML::chars($page->url($next_page)) ?>" rel="next"><?php echo __('Next') ?></a>
		<?php else: ?>
			<?php //echo __('Next') ?>
		<?php endif; ?>
	</li>

	<li>
		<?php if ($last_page !== FALSE): ?>
			<a href="<?php echo HTML::chars($page->url($last_page)) ?>" rel="last"><?php echo __('Last') ?></a>
		<?php else: ?>
			<?php //echo __('Last') ?>
		<?php endif; ?>
	</li>
</ul>