<div role="tabpanel">
<?php 
  $userPropuestas = array();
  foreach ($propuestas as $propuesta) {
    if ($propuesta['Propuesta']['user_id'] == $user['id']){
      array_push($userPropuestas, $propuesta['Propuesta']);
    }
  }
?>
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <?php $counter = 0;?>
    <?php foreach ($userPropuestas as $uPropuesta): ?>
      <li role="presentation" <?php if ($counter == 0) {echo "class='active'";} ?>><a href="#<?php echo str_replace(" ", "_", trim($uPropuesta['nombre_propuesta'])); ?>" aria-controls="home" role="tab" data-toggle="tab"><?php echo $uPropuesta['nombre_propuesta']; ?></a></li>
      <?php $counter++; ?>
    <?php endforeach; ?>
    
    <li role="presentation" class="link"><?php 
          $plusIcon = "<span class='glyphicon glyphicon-plus' aria-hidden='true'></span>";
          echo $html->link($plusIcon.' Agregar propuesta', array('controller' => 'propuestas', 'action' => 'add'), array('escape' => false));
        ?></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <?php $counter = 0;?>
    <?php foreach ($userPropuestas as $uPropuesta):?>
      <div role="tabpanel" class="tab-pane fade <?php if ($counter == 0) {echo "in active";} ?>" id="<?php echo str_replace(" ", "_", trim($uPropuesta['nombre_propuesta'])); ?>">        
      <h2>
        <?php echo $uPropuesta['nombre_propuesta'] ?>
        <?php $pencilIcon = "<span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>"; 
        echo $html->link($pencilIcon, array('action' => 'edit', $uPropuesta['id']), array('escape' => false) );?>
      </h2>
      <p><?php echo $uPropuesta['descripcion_propuesta'] ?></p>
      </div>
      <?php $counter++; ?>
    <?php endforeach;?>    
    
  </div>

</div>