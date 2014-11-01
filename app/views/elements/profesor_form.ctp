<div class="form profesor active">
			
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 col-sm-offset-1 control-label">Email</label>
			<div class="col-sm-8">
				<?php  echo $form->input('Profesor.mail', array('class' => 'form-control', 'placeholder' => 'juan.perez@mail.com')); ?>
			</div>
		</div>

		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 col-sm-offset-1 control-label">RUT</label>
			<div class="col-sm-8">
				<?php  echo $form->input('Profesor.rut', array('class' => 'form-control', 'placeholder' => '11.111.111-1')); ?>
			</div>
		</div>
		
	</div>