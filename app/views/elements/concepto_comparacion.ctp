<div class="form active">
	<div class="form-group">			
		<label for="<?php echo $for; ?>"><?php echo $label. " " . $titulo;?></label>
		<?php  echo $form->textarea('Propuesta.' . $index . '.descripcion_concepto_comparacio', array('class' => 'form-control', 'cols' => '4')); ?>
		<?php  echo $form->hidden('Propuesta.' . $index . '.titulo_concepto_comparacion', array('value' => $titulo)); ?>
		<?php  echo $form->hidden('Propuesta.' . $index . '.propuesta_id', array('value' => $propuesta['Propuesta']['id'])); ?>	
	</div>	
	<div class="form-group">
		<div class="input-group">			
				<?php  echo $form->input('Propuesta.' . $index . '.palabras_clave', array('type' => 'text', 'class' => 'form-control')); ?>	
				<?php  echo $form->hidden('Propuesta.' . $index . '.tags', array('value' => '')); ?>						
			<span class="input-group-btn">
				<a class="btn btn-default btn-block" id="newTag<?php echo $titulo;?>">Agregar</a>
			</span>
		</div>
	</div>
	<div class="form-group">
		<div class="form-control tags after" id="<?php echo $titulo; ?>Tags"></div>
	</div>
</div>