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
						$idea_badge = '';

						if ( isset($pendientes) && $pendientes > 0){
							$pend_badge = ' <span class="badge">'.$pendientes.'</span>';
						}
						if ( isset($nuevasIdeas) && $nuevasIdeas > 0){
							$idea_badge = ' <span class="badge">'.$nuevasIdeas.'</span>';
						}
						echo $html->link('Estudiantes'.$pend_badge, array('controller' => 'estudiantes', 'action' => 'index'), array('class' => 'btn btn-default btn-block', 'escape' => false));
						echo $html->link('Ideas'.$idea_badge, array('controller' => 'propuestas', 'action' => 'index'), array('class' => 'btn btn-default btn-block', 'escape' => false));
					}else{
						echo $html->link('Ideas', array('controller' => 'propuestas', 'action' => 'index'), array('class' => 'btn btn-default btn-block'));
					}
				?>
				<?php if (isset($profesor) || isset($estudiante)):?>
					<?php echo $html->link('Proyectos', array('controller' => 'proyectos', 'action' => 'index'), array('class' => 'btn btn-default btn-block'))?>	
				<?php endif;?>
				<?php if( trim( $user['estado'] ) == "pendiente" ): ?>
					<?php echo $html->link('Mi Proyecto', array('controller' => 'users', 'action' => 'project'), array('class' => 'btn btn-default btn-block', 'disabled' => 'disabled'))?>
					<?php echo $html->link('Curso', array('controller' => 'propuestas', 'action' => 'index'), array('class' => 'btn btn-default btn-block', 'disabled' => 'disabled'))?>
				<?php elseif( isset($profesor) ):?>	
					<?php echo $html->link('Administrar Proyectos', array('controller' => 'proyectos', 'action' => 'admin'), array('class' => 'btn btn-default btn-block'))?>	
					<?php echo $html->link('Curso', array('controller' => 'estudiantes', 'action' => 'curso'), array('class' => 'btn btn-default btn-block'))?>
				<?php else: ?>
					<?php if( isset($propuestaCandidata['Propuesta']) ):?>
						<?php echo $html->link('Mi Proyecto <span class="label label-primary">nuevo</span>', array('controller' => 'proyectos', 'action' => 'add',$propuestaCandidata['Propuesta']['id']), array('class' => 'btn btn-success btn-block','escape' => false))?>
					<?php elseif( isset($estudiante) && $estudiante['Estudiante']['proyecto_id'] != "" ):?>
						<?php echo $html->link('Mi Proyecto', array('controller' => 'proyectos', 'action' => 'pauta', $estudiante['Proyecto']['pauta_id'], $estudiante['Estudiante']['proyecto_id']), array('class' => 'btn btn-default btn-block'))?>												
			  	<?php endif;?>
			  	<?php echo $html->link('Curso', array('controller' => 'estudiantes', 'action' => 'curso'), array('class' => 'btn btn-default btn-block'))?>
			  <?php endif; ?>
			  <!--<pre><?php print_r($estudiante);?></pre>-->
			</div>
		</div>
	</div>	
