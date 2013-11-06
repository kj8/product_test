<?php echo Form::open(null, array('class' => 'form-horizontal', 'role' => 'form')); ?>

<div class="form-group">
	<?php echo Form::label('id_attribute', 'Atrybut', array('class' => 'col-sm-2 control-label')); ?>
    <div class="col-sm-10">
		<?php echo Form::select('id_attribute', $attributes, @$_POST['id_attribute'], array('id' => 'id_attribute', 'class' => 'form-control')); ?>
    </div>
</div>

<div class="form-group">
	<?php echo Form::label('value', __('Value'), array('class' => 'col-sm-2 control-label')); ?>
    <div class="col-sm-10">
		<?php echo Form::input('value', @$_POST['value'], array('id' => 'value', 'class' => 'form-control')); ?>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
		<?php echo Form::submit(null, __('Save'), array('class' => 'btn btn-primary')); ?>
    </div>
</div>

<?php echo Form::close(); ?>