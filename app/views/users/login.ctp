
<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<div class="panel panel-default">
			<div class="panel-heading">
		    <h3 class="panel-title">Iniciar sesión</h3>
		  </div>
		  <div class="panel-body">
		  <?php echo $session->flash('auth');?>
		  	<div class="row">
		  		<div class="col-md-6">
				    <?php
					    
					    echo $form->create('User', array('action' => 'login', 'inputDefaults' => array(
					    	'label' => false,
					    	'div' => false), 'role' => 'form'));?>
					    <div class="form-group">
					    	<label for="exampleInputEmail1">Nombre</label>
					    	<?php echo $form->input('nombre', array('class' => 'form-control', 'placeholder' => 'Juanito Perez'));?>
					    </div>
					    <div class="form-group">
					    	<label for="exampleInputEmail1">Contraseña</label>
					    	<?php echo $form->input('password', array('type' => 'password', 'class' => 'form-control'));?>
					    </div>
					    
						  <?php echo $this->Form->submit('Login',array('class'=>'btn btn-primary', 'div' => false)); ?>
						  <?php echo $this->Html->link('Olvide mi contraseña', array('controller' => 'users', 'action' => 'recover'), array('style' => 'padding-left: 25px;')); ?>
					    <?php echo $form->end();?>
						
					</div>
					<div class="col-md-6">
						<p class="text-center lead">...O ingresa con</p>
						<div class="socials">
							<?php echo $this->Html->image('Facebook_Logo.png') ?>
							<?php echo $this->Html->image('Gmail-Logo.png') ?>
						</div>
					</div>
				</div>
		  </div>
		</div>
	</div>
</div>