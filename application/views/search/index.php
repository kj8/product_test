<div class="row">
	<div class="col-sm-3" id="search-attributes">
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
										<?php echo Form::checkbox(null, $a['id']); ?>
										<?php echo HTML::chars($a['value']); ?>
									</label>
								</li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
	<div class="col-sm-9">
		col-sm-9
	</div>
</div>


<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Panel title</h3>
	</div>
	<div class="panel-body">
		Panel content
	</div>
</div>