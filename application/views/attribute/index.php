<?php //var_dump($attributes); ?>
<a class="btn btn-default" href="<?php echo URL::site('attribute/add'); ?>"><?php echo __('Add attribute'); ?></a>
<hr>
<ul>
	<?php foreach ($attributes as $a): ?>
		<li>
			<a href="<?php echo URL::site('attribute/edit/' . $a['id']); ?>"><?php echo HTML::chars($a['name']); ?></a>
			<?php if ($a['values']): ?>
				<ul>
					<?php foreach ($a['values'] as $a): ?>
						<li>
							<?php echo HTML::chars($a['value']); ?>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</li>
	<?php endforeach; ?>
</ul>
