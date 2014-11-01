<?php  echo $form->create('User', array('class' => 'form-horizontal', 'role' => 'form', 'inputDefaults' => array(
	'label' => false,
	'div' => false))); ?>
	<div class="row" style="margin-bottom: 2%;">
		<div class="col-md-5 col-md-offset-4">
			<h3>¿Perteneces al curso de Piinfo?</h3>
			<?php echo $this->Form->input('usertype', array(
			    'before' => '<div class="btn-group" data-toggle="buttons"><label class="btn btn-primary active">',
			    'after' => '</label></div>',    
			    'hiddenField' => false,
			    'separator' => '</label><label class="btn btn-primary">',
			    'legend' => false,
			    'options' => array(
				    'profesor'=>'Si, soy profesor',
				    'estudiante'=>'Si, soy estudiante',
				    'externo'=>'No, soy externo'
			    ),
			    'type' => 'radio'
			));?>
		</div>
	</div>

	<?php echo $this->element('user_form');?>

	<?php echo $this->element('profesor_form');?>

	<?php echo $this->element('estudiante_form');?>	

	<?php echo $this->element('externo_form');?>

	<div class="form-group">
    <div class="col-sm-offset-3 col-sm-8">
			<?php echo $this->Form->submit('Registrarse',array('class'=>'btn btn-default', 'div' => false)); ?>
		</div>
	</div>
<?php  echo $form->end(); ?>