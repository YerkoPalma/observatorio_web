<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
        <?php              
          echo $form->create('User', array('action' => 'changePassword', 'inputDefaults' => array(
            'label' => false,
            'div' => false), 'role' => 'form'));?>
            <?php
              echo $this->Form->hidden('id', array( 'default' => $user['id'] ));
              ?>
            <div class="form-group">
              <label for="exampleInputEmail1">Contraseña actual</label>
              <?php echo $form->input('password', array('type' => 'password', 'class' => 'form-control'));?>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Nueva contraseña</label>
              <?php echo $form->input('new_password', array('type' => 'password', 'class' => 'form-control'));?>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Repita contraseña</label>
              <?php echo $form->input('confirm_new_password', array('type' => 'password', 'class' => 'form-control'));?>
            </div>    
            <hr>      
          <?php echo $this->Form->submit('Aceptar',array('class'=>'btn btn-primary', 'div' => false)); ?>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <?php echo $form->end();?>
      </div>      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->