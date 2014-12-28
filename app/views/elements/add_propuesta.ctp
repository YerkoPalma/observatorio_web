<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Mi propuesta</h3>
  </div>
  <div class="panel-body row">
    <div class="col-md-4">
      <div class="btn-panel">
        <?php 
          $plusIcon = "<span class='glyphicon glyphicon-plus' aria-hidden='true'></span>";
          echo $html->link($plusIcon.' Agregar propuesta', array('controller' => 'propuestas', 'action' => 'add'), array('class' => 'btn btn-success btn-lg', 'escape' => false));
        ?>
      </div>
    </div>
    <div class="col-md-8">
      <?php if (isset($profesor)):?>
        <?php if (isset($nuevasIdeas) && $nuevasIdeas > 0):?>
          <h3>Existen nuevas propuestas que puedes <?php echo $html->link('comparar', array('controller' => 'propuestas', 'action' => 'comparar'));?></h3>
        <?php else:?>
          <h3>Aún no se han registrado nuevas propuestas</h3>
        <?php endif;?>
      <?php else:?>
        <h3>Agregar nueva propuesta</h3>
        <p>Aún no has agregado una propuesta de proyecto, ingresa una siguiendo el botón verde a la izuierda</p>
      <?php endif;?>
    </div>
  </div>
</div>