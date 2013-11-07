<hr>
<div class="row">
	<div class="col-sm-3" id="search-attributes">
		<?php echo Form::open('search'); ?>
		<ul class="list-unstyled">
			<?php foreach ($attributes as $a): ?>
				<li class="panel panel-primary">
					<div class="panel-heading">
						<span class="panel-title"><?php echo HTML::chars($a['name']); ?></span>
					</div>
					<?php if ($a['values']): ?>
						<ul class="list-unstyled panel-body">
							<?php foreach ($a['values'] as $a): ?>
								<li>
									<label>
										<?php
										$val = array_unique(array_merge($values, array($a['id'])));
										$checked = in_array($a['id'], $values);
										if ($checked) {
											$key = array_search($a['id'], $values);
											if ($key !== false) {
												unset($val[$key]);
											}
										}
										?>
										<?php echo Form::checkbox('value[]', $a['id'], $checked); ?>
										<a href="<?php echo URL::site('search/' . implode(',', $val)); ?>"><?php echo HTML::chars($a['value']); ?></a>
									</label>
								</li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				</li>
			<?php endforeach; ?>
		</ul>
		<?php echo Form::submit(null, __('Search'), array('class' => 'btn btn-primary btn-block')); ?>
		<?php echo Form::close(); ?>
	</div>
	<div class="col-sm-9">
		<div class="panel panel-primary">
			<div class="panel-heading panel-title">
				<?php echo (count($products)) ? __('Number of results') . ': ' . count($products) : __('No results'); ?>
			</div>
		</div>

		<ul class="list-unstyled">
			<?php foreach ($products as $p): ?>
				<li class="panel panel-primary">
					<div class="panel-heading">
						<span class="panel-title"><?php echo HTML::chars($p['name']); ?></span>
					</div>
					<ul class="list-unstyled panel-body">
						<?php if ($p['attributes']): ?>
							<?php foreach ($p['attributes'] as $a): ?>
								<li>
									<?php echo HTML::chars($a['name'] . ': ' . $a['value']); ?>
								</li>
							<?php endforeach; ?>
						<?php endif; ?>
					</ul>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>
