<?php  echo $form->create('Proyecto', array('type' => 'file', 'class' => 'form-horizontal', 'role' => 'form', 'inputDefaults' => array(
  'label' => false,
  'div' => false))); ?>   
<div class="form active">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 col-sm-offset-1 control-label">Nombre</label>
    <div class="col-sm-8">
      <?php  echo $form->input('nombre_proyecto', array('type' => 'text', 'class' => 'form-control', 'value' => $proyecto['Proyecto']['nombre_proyecto'])); ?>
    </div>
  </div>
  
    <?php 
      $opciones = array(
        '1' => 'Sociales',
        '2' => 'Servicios',
        '3' => 'Infraestructura',
        '4' => 'Manufactureros',
        '5' => 'Agropecuarios',
        '6' => 'Comerciales');       
    ?>
  
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 col-sm-offset-1 control-label">Tipo</label>
    <div class="col-sm-8">
      <?php  echo $form->select('Propuesta.tipo_idea_id', $opciones, $proyecto['Propuesta']['tipo_idea_id'], array('class' => 'form-control')); ?>
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 col-sm-offset-1 control-label">Descripción</label>
    <div class="col-sm-8">
      <?php  echo $form->textarea('descripcion_proyecto', array('class' => 'form-control', 'value' => $proyecto['Proyecto']['descripcion_proyecto'])); ?>
    </div>
  </div>    

  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 col-sm-offset-1 control-label">Logo</label>
    <div class="col-sm-8">
      <?php  echo $form->input('Proyecto.logo', array('type' => 'file', 'class' => 'form-control')); ?>  
      <!--<?php echo $this->Form->input('Proyecto.logo_dir', array('type' => 'hidden')); ?>  -->
      <!--<?php echo $this->Form->input('Proyecto.logo.remove', array('type' => 'checkbox', 'label' => 'Remove existing file'));?>   -->
    </div>    
  </div> 

  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 col-sm-offset-1 control-label">Informe</label>
    <div class="col-sm-8">
      <?php  echo $form->input('ProyectoDocumento.documento', array('type' => 'file', 'class' => 'form-control')); ?> 
      <!--<?php echo $this->Form->input('ProyectoDocumento.documento_dir', array('type' => 'hidden')); ?>-->
      <?php echo $this->Form->input('pauta_id', array('type' => 'hidden', 'value' => $pauta_id)); ?>  
      <?php echo $this->Form->input('proyecto_id', array('type' => 'hidden', 'value' => $proyecto['Proyecto']['id'])); ?>       
    </div>    
  </div>       
  
</div>

<div class="form-group">
    <div class="col-sm-offset-3 col-sm-8">      
      <?php echo $form->button('Guardar ', array('type' => 'submit', 'class'=>'btn btn-success', 'escape' => false), array('escape' => false)); ?>
    </div>
  </div>
<?php  echo $form->end(); ?>