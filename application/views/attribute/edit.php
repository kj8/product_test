<?php echo Form::open(null, array('class' => 'form-horizontal', 'role' => 'form')); ?>

<div class="form-group">
	<?php echo Form::label('name', __('Attribute name'), array('class' => 'col-sm-2 control-label')); ?>
	<div class="col-sm-10">
		<?php echo Form::input('name', $data['name'], array('id' => 'name', 'class' => 'form-control', 'placeholder' => __('Product name'))); ?>
	</div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
		<?php echo Form::submit(null, __('Save'), array('class' => 'btn btn-primary')); ?>
    </div>
</div>

<?php echo Form::close(); ?>
