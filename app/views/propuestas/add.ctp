<?php  echo $form->create('Propuesta', array('class' => 'form-horizontal', 'role' => 'form', 'inputDefaults' => array(
	'label' => false,
	'div' => false))); ?>		

	<?php echo $this->element('new_propuesta_form');?>		
	
	<div class="form-group">
    <div class="col-sm-offset-3 col-sm-8">
    	<?php
    		$nextIcon = "<span class='glyphicon glyphicon-chevron-right' aria-hidden='true'></span>";
    	?>
			<?php echo $form->button('Siguiente '.$nextIcon, array('type' => 'submit', 'class'=>'btn btn-success', 'escape' => false), array('escape' => false)); ?>
		</div>
	</div>
<?php  echo $form->end(); ?>