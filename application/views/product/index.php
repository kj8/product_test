<?php //var_dump($products); ?>
<a class="btn btn-default" href="<?php echo URL::site('product/add'); ?>"><?php echo __('Add product'); ?></a>
<hr>
<ul>
	<?php foreach ($products as $p): ?>
		<li>
			<a href="<?php echo URL::site('product/edit/' . $p['id']); ?>"><?php echo HTML::chars($p['name']); ?></a>
			<?php if ($p['attributes']): ?>
				<ul>
					<?php foreach ($p['attributes'] as $a): ?>
						<li>
							<?php echo HTML::chars($a['name'] . ': ' . $a['value']); ?>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>

		</li>
	<?php endforeach; ?>
</ul>
