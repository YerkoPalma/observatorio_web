<ul class="media-list">
	<?php foreach ($estudiantes as $estudiante): ?>
		<?php $avatar = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $user['mail'] ) ) ) . "&s=40";?>
		<li class="media">
			<a class="pull-left" href="#">
				<img class="media-object" src="<?php echo $avatar; ?>">
			</a>
			<div class="media-body">
				<h3 class="media-heading">
					<?php echo $estudiante['Estudiante']['nombre'];?>
					<small>
						<?php echo $estudiante['Estudiante']['estado'];?>
					</small>
				</h3>				
				<?php if ( trim($estudiante['Estudiante']['estado']) == "pendiente" ): ?>
					<?php echo $html->link('<span class="glyphicon glyphicon-plus"></span>', array('controller' => 'users', 'action' => 'accept_student', $estudiante['Estudiante']['user_id'], $estudiante['Estudiante']['id']), array('class' => 'btn btn-success', 'escape' => false))?>
				<?php endif;?>
			</div>			
		</li>
	<?php	endforeach;	?>
</ul>