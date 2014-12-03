<div class="form active">
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 col-sm-offset-1 control-label">Nombre</label>
		<div class="col-sm-8">
			<?php  echo $form->input('nombre_propuesta', array('class' => 'form-control')); ?>
		</div>
	</div>
	<?php if ( isset($tiposIdeas) ): ?>
		<?php 
			$opciones = array(); 
			
			foreach ($tiposIdeas as $tipoIdea) {
				$key = $tipoIdea['TipoIdea']['id'];
				$value = $tipoIdea['TipoIdea']['nombre_tipo_idea'];
				$opciones[$key] = $value;
			}
			
		?>
	<?php endif; ?>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 col-sm-offset-1 control-label">Tipo</label>
		<div class="col-sm-8">
			<?php  echo $form->select('tipo_idea_id', $opciones, null, array('class' => 'form-control')); ?>
		</div>
	</div>

	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 col-sm-offset-1 control-label">Descripción</label>
		<div class="col-sm-8">
			<?php  echo $form->textarea('descripcion_propuesta', array('class' => 'form-control')); ?>
		</div>
	</div>		

	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 col-sm-offset-1 control-label">Tags</label>
		<div class="col-sm-6">
			<?php  echo $form->input('tags', array('type' => 'text', 'class' => 'form-control')); ?>	
			<?php  echo $form->hidden('palabras_clave', array('value' => '')); ?>			
		</div>
		<div class="col-sm-2">
			<a class="btn btn-default btn-block" id="newTag">Agregar</a>
		</div>
	</div>		
	<div class="form-group">
		<div class="tags col-sm-8 col-sm-offset-3">
		</div>
	</div>
	
</div>