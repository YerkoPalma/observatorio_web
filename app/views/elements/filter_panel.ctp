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

<div class="panel" style="padding: 2%;">
<?php
echo $form->create('Propuesta', array('inputDefaults' => array(
            'label' => false,
            'div' => false), 'role' => 'form', 'class' => 'form-inline'));?>
<div class="row">
	<div class="col-md-6">
		<div class="form-group">	
			<label>Nombre Propuesta: </label>
			<?php echo $form->input('nombre_propuesta', array('class' => 'form-control pull-right', 'placeholder' => 'Mi proyecto')); ?>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">	
			<label>Usuario: </label>
			<?php echo $form->input('nombre', array('class' => 'form-control pull-right', 'placeholder' => 'Juan Perez')); ?>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group">	
			<label>Tipo: </label>
			<?php  echo $form->select('tipo_idea_id', $opciones, null, array('class' => 'form-control pull-right')); ?>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">	
			<label>Tags: </label>
			<?php echo $form->input('palabras_clave', array('class' => 'form-control pull-right')); ?>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<?php echo $ajax->submit('Filtrar', array('url'=> array('controller'=>'propuestas', 'action'=>'addfilter'), 'update' => 'feeds', 'class' => 'btn btn-default pull-right')); ?>
	</div>
</div>
<?php echo $form->end(); ?>
</div>