<?php echo Form::open(null, array('class' => 'form-horizontal', 'role' => 'form')); ?>

<div class="form-group">
	<?php echo Form::label('name', __('Product name'), array('class' => 'col-sm-2 control-label')); ?>
    <div class="col-sm-10">
		<?php echo Form::input('name', $data['name'], array('id' => 'name', 'class' => 'form-control', 'placeholder' => __('Product name'))); ?>
    </div>
</div>
<div id="attributes-list">
	<?php if (!empty($data['id_value'])): ?>
		<?php foreach ($data['id_value'] as $k => $v): ?>
			<div class="form-group">
				<?php echo Form::label('id_value[' . $k . ']', __('Attribute'), array('class' => 'col-sm-2 control-label')); ?>
				<div class="col-sm-10">
					<?php echo Form::select('id_value[' . $k . ']', $values, $v, array('id' => 'id_value[' . $k . ']', 'class' => 'form-control')); ?>
				</div>
			</div>
		<?php endforeach; ?>
	<?php endif; ?>
</div>

<script type="text/template" id="template-add-attribute">
	<div class="form-group">
		<?php echo Form::label('id_value[:INDEX:]', __('Attribute'), array('class' => 'col-sm-2 control-label')); ?>
		<div class="col-sm-10">
			<?php echo Form::select('id_value[:INDEX:]', $values, '', array('id' => 'id_value[:INDEX:]', 'class' => 'form-control')); ?>
		</div>
	</div>
</script>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
		<a class="btn btn-default" id="add-attribute" href="#"><?php echo __('Add attribute'); ?></a>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
		<?php echo Form::submit(null, __('Save'), array('class' => 'btn btn-primary')); ?>
		
		<?php if (!empty($data['id'])): ?>
			<a class="delete-item btn btn-danger" href="<?php echo URL::site('product/delete/' . $data['id']); ?>"><?php echo __('Delete'); ?></a>
		<?php endif; ?>
    </div>
</div>

<?php echo Form::close(); ?>