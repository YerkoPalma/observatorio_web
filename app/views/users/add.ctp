<?php  echo $form->create('User', array('class' => 'form-horizontal', 'role' => 'form', 'inputDefaults' => array(
	'label' => false,
	'div' => false))); ?>

	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 col-sm-offset-1 control-label">Nombre</label>
		<div class="col-sm-8">
			<?php  echo $form->input('nombre', array('class' => 'form-control', 'placeholder' => 'Juan Peréz')); ?>
		</div>
	</div>

	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 col-sm-offset-1 control-label">Email</label>
		<div class="col-sm-8">
			<?php  echo $form->input('mail', array('class' => 'form-control', 'placeholder' => 'juan.perez@mail.com')); ?>
		</div>
	</div>

	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 col-sm-offset-1 control-label">RUT</label>
		<div class="col-sm-8">
			<?php  echo $form->input('rut', array('class' => 'form-control', 'placeholder' => '11.111.111-1')); ?>
		</div>
	</div>

	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 col-sm-offset-1 control-label">Contraseña</label>
		<div class="col-sm-8">
			<?php  echo $form->input('password', array('type' => 'password', 'class' => 'form-control')); ?>
		</div>
	</div>

	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 col-sm-offset-1 control-label">Repita contraseña</label>
		<div class="col-sm-8">
			<?php  echo $form->input('password_confirm', array('type' => 'password', 'class' => 'form-control')); ?>
		</div>
	</div>

	<div class="form-group">
    <div class="col-sm-offset-3 col-sm-8">
			<?php echo $this->Form->submit('Registrarse',array('class'=>'btn btn-default', 'div' => false)); ?>
		</div>
	</div>
<?php  echo $form->end(); ?>