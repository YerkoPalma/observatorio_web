<?php echo $html->script('prototype'); ?>
<?php echo $html->script('scriptaculous'); ?>
<div class="list-group">
<?php foreach ($propuestas as $propuesta): ?>
	<?php $avatar = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $propuesta['User']['mail'] ) ) ) . "&s=40"; ?>
	<div class="list-group-item" >
		<div class="row">
			<div class="col-md-2">
				<img src="<?php echo $avatar; ?>" alt="" class="img-rounded" />
			</div>
			<div class="col-md-10">
				<h4 class="list-group-item-heading">Propuesta <?php echo $html->link($propuesta['Propuesta']['nombre_propuesta'], array('controller' => 'propuestas', 'action' => 'show', $propuesta['Propuesta']['id'])); ?>. Publicada por <?php echo $html->link($propuesta['User']['nombre'], array('controller' => 'users', 'action' => 'show', $propuesta['User']['id']))?></h4>
				
				<div class="btn-group" role="group" aria-label="...">
				  <?php 
				  	echo $ajax->link("comparar", 
				  		array('controller' => 'propuestas', 
				  			'action' => 'compare', 
				  			$propuesta['Propuesta']['id']), 
				  		array('update' => 'result-'.str_replace(" ", "_", trim($propuesta['Propuesta']['nombre_propuesta'])),
				  			'class' => 'btn btn-primary'));
				  	echo $html->link('avanzado', 
				  		array('controller' => 'propuestas', 
				  			'action' => 'avanzado', 
				  			$propuesta['Propuesta']['id']), 
				  		array('class' => 'btn btn-default'));
				  	echo $html->link('<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> aceptar', 
				  		array('controller' => 'propuestas', 
				  			'action' => 'aceptar', 
				  			$propuesta['Propuesta']['id']), 
				  		array('class' => 'btn btn-success', 
				  			'escape' => false));
				  	echo $html->link('<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> rechazar', 
				  		array('controller' => 'propuestas', 
				  			'action' => 'rechazar', 
				  			$propuesta['Propuesta']['id']), 
				  		array('class' => 'btn btn-danger', 
				  			'escape' => false));
				  ?>
				</div>
				
			</div>
			<div class="col-md-10 col-md-offset-2 result" id="result-<?php echo str_replace(" ", "_", trim($propuesta['Propuesta']['nombre_propuesta']));?>">
			</div>
		</div>
	</div>

<?php endforeach;?>
</div>