<?php #$user = current($this->Session->read('current_user'));
	  $avatar = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $user['mail'] ) ) ) . "&s=40";?>

	<div class="panel panel-default">
		<div class="panel-body">
			<div class="row">
				<div class="col-md-4">
					<img src="<?php echo $avatar; ?>" alt="" class="img-thumbnail" />
				</div>
				<div class="col-md-8">
					<h2><?php echo $user['nombre']?></h2>
					<?php echo $html->link('Ver perfil', array('controller' => 'users', 'action' => 'show', $user['id']))?><br>
					<?php echo $html->link('Editar perfil', array('controller' => 'users', 'action' => 'edit', $user['id']))?>
				</div>
			</div>
			<hr>
			<div class="btn-group-vertical">
				<?php 
					if( isset($profesor) ){
						$pend_badge = '';
						if ( isset($pendientes) && $pendientes > 0){
							$pend_badge = ' <span class="badge">'.$pendientes.'</span>';
						}
						echo $html->link('Estudiantes'.$pend_badge, array('controller' => 'estudiantes', 'action' => 'index'), array('class' => 'btn btn-default btn-block', 'escape' => false));
					}
				?>
				<?php echo $html->link('Ideas', array('controller' => 'propuestas', 'action' => 'index'), array('class' => 'btn btn-default btn-block'))?>
				<?php if( trim( $user['estado'] ) == "pendiente" ): ?>
					<?php echo $html->link('Proyecto', array('controller' => 'users', 'action' => 'project'), array('class' => 'btn btn-default btn-block', 'disabled' => 'disabled'))?>
					<?php echo $html->link('Curso', array('controller' => 'propuestas', 'action' => 'index'), array('class' => 'btn btn-default btn-block', 'disabled' => 'disabled'))?>
				<?php else: ?>
			  	<?php echo $html->link('Proyecto', array('controller' => 'users', 'action' => 'project'), array('class' => 'btn btn-default btn-block'))?>
			  	<?php echo $html->link('Curso', array('controller' => 'propuestas', 'action' => 'index'), array('class' => 'btn btn-default btn-block'))?>
			  <?php endif; ?>
			  
			</div>
		</div>
	</div>	
