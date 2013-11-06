<?php echo Form::open(null, array('class' => 'form-horizontal', 'role' => 'form')); ?>

<div class="form-group">
	<?php echo Form::label('name', __('Attribute name'), array('class' => 'col-sm-2 control-label')); ?>
	<div class="col-sm-10">
		<?php echo Form::input('name', $data['name'], array('id' => 'name', 'class' => 'form-control', 'placeholder' => __('Product name'))); ?>
	</div>
</div>

<div id="values-list">
	<?php if (!empty($data['value'])): ?>
		<?php foreach ($data['value'] as $k => $v): ?>
			<div class="form-group">
				<?php echo Form::label('value[' . $k . ']', __('Value'), array('class' => 'col-sm-2 control-label')); ?>
				<div class="col-sm-10">
					<?php echo Form::input('value[' . $k . ']', $v, array('id' => 'value[' . $k . ']', 'class' => 'form-control')); ?>
				</div>
			</div>
		<?php endforeach; ?>
	<?php endif; ?>
</div>

<script type="text/template" id="template-add-value">
	<div class="form-group">
		<?php echo Form::label('value[:INDEX:]', __('Value'), array('class' => 'col-sm-2 control-label')); ?>
		<div class="col-sm-10">
			<?php echo Form::input('value[]', '', array('id' => 'value[:INDEX:]', 'class' => 'form-control')); ?>
		</div>
	</div>
</script>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
		<a class="btn btn-default" id="add-value" href="#"><?php echo __('Add value'); ?></a>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
		<?php echo Form::submit(null, __('Save'), array('class' => 'btn btn-primary')); ?>
		
		<?php if (!empty($data['id'])): ?>
			<a class="delete-item btn btn-danger" href="<?php echo URL::site('attribute/delete/' . $data['id']); ?>"><?php echo __('Delete'); ?></a>
		<?php endif; ?>
    </div>
</div>

<?php echo Form::close(); ?>
