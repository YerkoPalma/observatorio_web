<div class="form active">
	<div class="row">
		<div class="col-md-5 col-md-offset-1">
			<div class="form-group">
				<label for="inputEmail3" class="control-label">Nombre</label>			
			  <?php  echo $this->Form->input('nombre_propuesta', array('class' => 'form-control'));?>		  
			</div>
		</div>
		<div class="col-md-5 ">
			<div class="form-group">
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
				<label for="inputEmail3" class="control-label">Tipo</label>			
			  <?php  echo $form->select('tipo_idea_id', $opciones, null, array('class' => 'form-control')); ?>		  
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-5 col-md-offset-1">
			<div class="form-group">
				<label for="inputEmail3" class="control-label">Descripción</label>			
			  <?php  echo $form->textarea('descripcion_propuesta', array('class' => 'form-control')); ?>		  
			</div>	
		</div>
	  <?php  echo $this->Form->input('users_id', array('type' => 'hidden'));?>
	  <div class="col-md-5 ">
	  	<label for="inputEmail3" class="control-label">Tags</label>
		  <div class="input-group">
		    
				<?php  echo $this->Form->input('tags', array('class' => 'form-control')); ?>	
				<?php  echo $this->Form->hidden('palabras_clave'); ?>		
				<span class="input-group-btn">
				<a class="btn btn-default " id="newTag">Agregar</a>
				</span>
			</div>
			<div class="form-group">
				<div class="tags">
					<?php 
						$tags = explode( ",", $propuesta['Propuesta']['palabras_clave'] );
						foreach ($tags as $tag):?>
						<span class="label label-primary"><?php echo $tag;?><a class="rm-tag">&times;</a></span>
					<?php endforeach;?>
				</div>
			</div>
		</div>
	</div>
	
</div>	