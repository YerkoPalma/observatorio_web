<div class="page-header">
  <h1 class="text-center">¡Felicitaciones!</h1>
  <h4 class="lead text-center">Tu propuesta fue aceptada como un proyecto del curso de Piinfo. Exito este semestre</h4>
  <h2 class="text-center"><small>Ahora indicanos el nombre de tus compañeros de grupo para oficializar la inscripción</small></h2>
</div>
<br>
<br>
<?php 
	echo $form->create(null, array('url' => array('controller' => 'proyectos', 'action' => 'add', $propuestaCandidata['Propuesta']['id']),'inputDefaults' => array('label' => false,'div' => false)));
?>
<div class="form-group has-feedback">
  <label class="control-label" for="inputSuccess2">Buscar compañeros de proyecto</label>
  <?php echo $form->input('search', array("class" => "form-control")); ?>
  <a id="search" href="#">
  	<span class="glyphicon glyphicon-search form-control-feedback" aria-hidden="true"></span>
  </a>
</div>
<div class="row clearfix">
	<?php foreach ($estudiantes as $estudiante): ?>		
		<?php if($estudiante['Estudiante']['user_id'] != $user['id'] ): ?>
			<?php $options[$estudiante['Estudiante']['id']] = $estudiante['Estudiante']['nombre'];?>
		<?php endif;?>
	<?php endforeach;?>
		<?php echo $form->input('estudiante_id', array( 'multiple' => 'checkbox', 'options' => $options, 'class' => 'text-center'));?>
	
</div>
<?php echo $this->Form->submit('Inscribir proyecto',array('class'=>'btn btn-default pull-right', 'div' => false)); ?>
<?php echo $form->end();?>
<br>
<br>