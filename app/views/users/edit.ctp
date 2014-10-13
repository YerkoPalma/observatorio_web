<?php
    echo $this->Form->create('User', array('action' => 'edit', 'class' => 'form-horizontal', 'role' => 'form', 'inputDefaults' => array(
	'label' => false,
	'div' => false)));?>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 col-sm-offset-1 control-label">Nombre</label>
		<div class="col-sm-8">
	  	<?php  echo $this->Form->input('nombre', array('class' => 'form-control'));?>
	  </div>
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 col-sm-offset-1 control-label">Mail</label>
		<div class="col-sm-8">
	  	<?php  echo $this->Form->input('mail', array('class' => 'form-control'));?>
	  </div>
	</div>
	<div class="form-group">
		<label for="inputEmail3" class="col-sm-2 col-sm-offset-1 control-label">RUT</label>
		<div class="col-sm-8">
	  	<?php  echo $this->Form->input('rut', array('class' => 'form-control'));?>
	  </div>
	</div>	
  <?php  echo $this->Form->input('users_id', array('type' => 'hidden'));?>
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-8">
			<?php echo $this->Form->submit('Editar',array('class'=>'btn btn-default', 'div' => false)); ?>
		</div>
	</div>

  <?php  echo $form->end(); ?>
