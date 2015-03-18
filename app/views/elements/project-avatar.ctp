<div class="panel project-panel">
	<div class="panel-body">
		<?php if (isset($proyecto)):?>

			<h2><?php echo $proyecto['Proyecto']['nombre_proyecto']?></h2>
			<?php echo $html->image('../files/proyecto/logo/'. $proyecto['Proyecto']['id'].'/' . $proyecto['Proyecto']['logo'], array('class' => 'img-responsive img-thumbnail', 'alt' => 'CakePHP'))?>
			<br><br>
			<p align="center">
			|
			<?php foreach ($proyecto['Estudiante'] as $est):?>
				<?php echo $html->link($est['nombre'], array('controller' => 'users', 'action' => 'show', $est['user_id']))  ?>	|
			<?php endforeach;?>
			</p>
		<?php else:?>
    	<h2>Mi Proyecto</h2>
  	<?php endif;?>
  </div>
</div>
