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
      <h3>Agregar nueva propuesta</h3>
      <p>Aún no has agregado una propuesta de proyecto, ingresa una siguiendo el botón verde a la izuierda</p>
    </div>
  </div>
</div>