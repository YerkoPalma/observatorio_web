<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<div class="col-md-6">
				<p><b>Nombre Proyecto:</b></p>
			</div>
			<div class="col-md-6">
				<p><?php echo $proyecto['Proyecto']['nombre_proyecto']?></p>
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-6">
				<p><b>Tipo Proyecto:</b></p>
			</div>
			<div class="col-md-6">
			<?php 
	      $opciones = array(
	        '1' => 'Sociales',
	        '2' => 'Servicios',
	        '3' => 'Infraestructura',
	        '4' => 'Manufactureros',
	        '5' => 'Agropecuarios',
	        '6' => 'Comerciales');       
	    ?>
				<p><?php echo $opciones[$proyecto['Propuesta']['tipo_idea_id']];?></p>
			</div>
		</div>
		
		<div class="form-group">
			<div class="col-md-6">
				<p><b>Integrantes Proyecto:</b></p>
			</div>
			<div class="col-md-6">
				<ul>
				<?php foreach ($proyecto['Estudiante'] as $estudiante):?>
					<li><?php echo $html->link($estudiante['nombre'], array('controller' => 'users', 'action' => 'show', $estudiante['user_id']));?></li>
				<?php endforeach;?>				
				</ul>
			</div>
		</div>		
				
		<div class="form-group">
			<div class="col-md-6">
				<p><b>Descripción Proyecto:</b></p>
			</div>
			<div class="col-md-6">
				<div class="well"><?php echo $proyecto['Proyecto']['descripcion_proyecto'];?></div>
			</div>
		</div>	
		
	</div>

	<div class="col-md-offset-1 col-md-3" style="margin-bottom:20px;">
		
		<?php echo $html->image('../files/proyecto/logo/'. $proyecto['Proyecto']['id'].'/' . $proyecto['Proyecto']['logo'], array('class' => 'img-responsive img-thumbnail', 'alt' => $proyecto['Proyecto']['descripcion_proyecto']))?>
	</div>
	<br><br>
	<div class="col-md-offset-1 col-md-3">
		<?php $fileIcon = "<span class='glyphicon glyphicon-file' aria-hidden='true'></span>";?>
		<?php echo $html->link($fileIcon . " Informe", '../files/proyecto_documento/documento/' . $proyecto['ProyectoDocumento'][0]['id'] . '/' . $proyecto['ProyectoDocumento'][0]['documento'], array('escape' => false, 'class' => 'btn btn-block btn-default'));?>
	</div>

	
</div>