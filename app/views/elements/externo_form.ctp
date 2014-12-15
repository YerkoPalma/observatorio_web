<div class="form externo">
		
		<div class="row" style="margin-bottom: 2%;">
			<div class="col-md-5 col-md-offset-4">
				<h3>¿Qué quieres hacer en el sitio?</h3>
				<?php echo $this->Form->input('Externo.type', array(
				    'before' => '<div class="btn-group" data-toggle="buttons"><label class="btn btn-default active">',
				    'after' => '</label></div>',    
				    'hiddenField' => false,
				    'separator' => '</label><label class="btn btn-default">',
				    'legend' => false,
				    'options' => array(
					    'Tutor'=>'Ofrecer tutorias',
					    'Inversionista'=>'financiar proyectos',
					    'Visita'=>'proponer ideas'
				    ),
				    'type' => 'radio'
				));?>
			</div>
		</div>

		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 col-sm-offset-1 control-label">Nombre</label>
			<div class="col-sm-8">
				<?php  echo $form->input('Externo.nombre', array('class' => 'form-control', 'placeholder' => 'Juan Perez')); ?>
			</div>
		</div>

		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 col-sm-offset-1 control-label">Mail</label>
			<div class="col-sm-8">
				<?php  echo $form->input('Externo.mail', array('class' => 'form-control', 'placeholder' => 'juan.perez@mail.com')); ?>
			</div>
		</div>
		
</div>