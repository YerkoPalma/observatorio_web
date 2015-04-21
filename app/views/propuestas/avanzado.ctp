<?php  echo $form->create('Proyecto', array('type' => 'file', 'class' => 'form-horizontal', 'role' => 'form', 'inputDefaults' => array(
  'label' => false,
  'div' => false))); ?>
  <?php $values = array(.1,.2,.3,.4,.5,.6,.7,.8,.9,1.0);?>
  <div class="row">
  	<div class="col-md-6">
		  <fieldset>
		  	<legend>Pesos</legend>
		  	<div class="form-group">
		  		<label style="text-align:left;" for="inputEmail3" class="col-sm-5 text-left control-label">Descripción</label>
		  		<div class="col-sm-offset-2 col-sm-5">
		  			<?php echo $form->select('Descripcion', $values, 0, array('class' => 'form-control')); ?>
		  		</div>
		  	</div>
		  	<div class="form-group">
		  		<label style="text-align:left;" for="inputEmail3" class="col-sm-5 text-left control-label">Socios clave</label>
		  		<div class="col-sm-offset-2 col-sm-5">
		  			<?php echo $form->select('Socios', $values, 0, array('class' => 'form-control')); ?>
		  		</div>
		  	</div>
		  	<div class="form-group">
		  		<label style="text-align:left;" for="inputEmail3" class="col-sm-5 text-left control-label">Actividades clave</label>
		  		<div class="col-sm-offset-2 col-sm-5">
		  			<?php echo $form->select('actividades', $values, 0, array('class' => 'form-control')); ?>
		  		</div>
		  	</div>
		  	<div class="form-group">
		  		<label style="text-align:left;" for="inputEmail3" class="col-sm-5 text-left control-label">Recursos clave</label>
		  		<div class="col-sm-offset-2 col-sm-5">
		  			<?php echo $form->select('recursos', $values, 0, array('class' => 'form-control')); ?>
		  		</div>
		  	</div>
		  	<div class="form-group">
		  		<label style="text-align:left;" for="inputEmail3" class="col-sm-5 text-left control-label">Propuesta de valor</label>
		  		<div class="col-sm-offset-2 col-sm-5">
		  			<?php echo $form->select('propuesta', $values, 0, array('class' => 'form-control')); ?>
		  		</div>
		  	</div>
		  	<div class="form-group">
		  		<label style="text-align:left;" for="inputEmail3" class="col-sm-5 text-left control-label">Relación clientes</label>
		  		<div class="col-sm-offset-2 col-sm-5">
		  			<?php echo $form->select('clientes', $values, 0, array('class' => 'form-control')); ?>
		  		</div>
		  	</div>
		  	<div class="form-group">
		  		<label style="text-align:left;" for="inputEmail3" class="col-sm-5 text-left control-label">Canales</label>
		  		<div class="col-sm-offset-2 col-sm-5">
		  			<?php echo $form->select('canales', $values, 0, array('class' => 'form-control')); ?>
		  		</div>
		  	</div>
		  	<div class="form-group">
		  		<label style="text-align:left;" for="inputEmail3" class="col-sm-5 text-left control-label">Segmentos clientes</label>
		  		<div class="col-sm-offset-2 col-sm-5">
		  			<?php echo $form->select('segmentos', $values, 0, array('class' => 'form-control')); ?>
		  		</div>
		  	</div>
		  	<div class="form-group">
		  		<label style="text-align:left;" for="inputEmail3" class="col-sm-5 text-left control-label">Estructura de costos</label>
		  		<div class="col-sm-offset-2 col-sm-5">
		  			<?php echo $form->select('costos', $values, 0, array('class' => 'form-control')); ?>
		  		</div>
		  	</div>
		  	<div class="form-group">
		  		<label style="text-align:left;" for="inputEmail3" class="col-sm-5 text-left control-label">Fuentes de ingresos</label>
		  		<div class="col-sm-offset-2 col-sm-5">
		  			<?php echo $form->select('ingresos', $values, 0, array('class' => 'form-control')); ?>
		  		</div>
		  	</div>
		  </fieldset>
	  </div>
  </div>
<?php  echo $form->end(); ?>