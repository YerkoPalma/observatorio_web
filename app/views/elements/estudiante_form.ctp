<div class="form estudiante">
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 col-sm-offset-1 control-label">Nombre</label>
			<div class="col-sm-8">
				<?php  echo $form->input('Estudiante.nombre', array('class' => 'form-control', 'placeholder' => 'Juan Peréz')); ?>
			</div>
		</div>
	
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 col-sm-offset-1 control-label">Email</label>
			<div class="col-sm-8">
				<?php  echo $form->input('Estudiante.mail', array('class' => 'form-control', 'placeholder' => 'juan.perez@mail.com')); ?>
			</div>
		</div>

		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 col-sm-offset-1 control-label">RUT</label>
			<div class="col-sm-8">
				<?php  echo $form->input('Estudiante.rut', array('class' => 'form-control', 'placeholder' => '11.111.111-1')); ?>
			</div>
		</div>		

		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 col-sm-offset-1 control-label">Contraseña</label>
			<div class="col-sm-8">
				<?php  echo $form->input('Estudiante.password', array('type' => 'password', 'class' => 'form-control')); ?>
			</div>
		</div>

		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 col-sm-offset-1 control-label">Repita contraseña</label>
			<div class="col-sm-8">
				<?php  echo $form->input('Estudiante.password_confirm', array('type' => 'password', 'class' => 'form-control')); ?>
			</div>
		</div>
	</div>