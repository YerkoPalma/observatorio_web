<?php if (isset($propuesta)):?>
<?php  echo $this->Form->create('Propuesta', array('action' => 'edit', 'class' => 'form-horizontal', 'role' => 'form', 'inputDefaults' => array(
	'label' => false,
	'div' => false)));?>	

	<?php echo $this->element('edit_propuesta');?>
	<div class="container-fluid edit" id="canvas">
		<div class="row">
			<div class="col-sm-2 col-md-2 canvas-single lg">
			<?php echo $this->element('edit_concepto_comparacion', 
																array(
																	"titulo" => "Partners", 
																	"index" => "0",
																	"label" => "<span class=\"glyphicon glyphicon-link\" aria-hidden=\"true\"></span>",
																	"for" => "Propuesta0DescripcionPropuesta" ));?>	
			</div>
			<div class="col-sm-3 col-md-3">
				<div class="canvas-single">
					<?php echo $this->element('edit_concepto_comparacion', 
																	array(
																		"titulo" => "Activities", 
																		"index" => "1",
																		"label" => "<span class=\"glyphicon glyphicon-ok\" aria-hidden=\"true\"></span>",
																		"for" => "Propuesta1DescripcionPropuesta" ));?>	
				</div>
				<div class="canvas-single">
					<?php echo $this->element('edit_concepto_comparacion', 
																	array(
																		"titulo" => "Resources", 
																		"index" => "5",
																		"label" => "<span class=\"glyphicon glyphicon-globe\" aria-hidden=\"true\"></span>",
																		"for" => "Propuesta5DescripcionPropuesta" ));?>
				</div>
			</div>
			<div class="col-sm-2 col-md-2 canvas-single lg">
			<?php echo $this->element('edit_concepto_comparacion', 
																array(
																	"titulo" => "Propositions", 
																	"index" => "2",
																	"label" => "<span class=\"glyphicon glyphicon-gift\" aria-hidden=\"true\"></span>",
																	"for" => "Propuesta2DescripcionPropuesta" ));?>	
			</div>
			<div class="col-sm-3 col-md-3">
				<div class="canvas-single">
					<?php echo $this->element('edit_concepto_comparacion', 
																	array(
																		"titulo" => "Relationships", 
																		"index" => "3",
																		"label" => "<span class=\"glyphicon glyphicon-heart\" aria-hidden=\"true\"></span>",
																		"for" => "Propuesta3DescripcionPropuesta" ));?>	
				</div>
				<div class="canvas-single">
					<?php echo $this->element('edit_concepto_comparacion', 
																	array(
																		"titulo" => "Channels", 
																		"index" => "6",
																		"label" => "<span class=\"glyphicon glyphicon-plane\" aria-hidden=\"true\"></span>",
																		"for" => "Propuesta6DescripcionPropuesta" ));?>
				</div>
			</div>
			<div class="col-sm-2 col-md-2 canvas-single lg">
			<?php echo $this->element('edit_concepto_comparacion', 
																array(
																	"titulo" => "Segments", 
																	"index" => "4",
																	"label" => "<span class=\"glyphicon glyphicon-user\" aria-hidden=\"true\"></span>",
																	"for" => "Propuesta4DescripcionPropuesta" ));?>	
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 col-sm-6 canvas-single">
				<?php echo $this->element('edit_concepto_comparacion', 
																array(
																	"titulo" => "Costs", 
																	"index" => "7",
																	"label" => "<span class=\"glyphicon glyphicon-tags\" aria-hidden=\"true\"></span>",
																	"for" => "Propuesta7DescripcionPropuesta" ));?>
			</div>
			<div class="col-md-6 col-sm-6 canvas-single">
				<?php echo $this->element('edit_concepto_comparacion', 
																array(
																	"titulo" => "RevenueStreams", 
																	"index" => "8",
																	"label" => "<span class=\"glyphicon glyphicon-usd\" aria-hidden=\"true\"></span>",
																	"for" => "Propuesta8DescripcionPropuesta" ));?>	
			</div>
		</div>
	</div>
<?php echo $this->Form->submit('Editar',array('class'=>'btn btn-primary', 'div' => false)); ?>
<?php  echo $form->end(); ?>
<?php else:?>
	<h3>Al parecer no puedes editar esta propuesta, por qué no intentas las siguientes?</h3>
	<ul>
		<?php foreach ($propuestas as $propuesta):?>
			<li><?php echo $html->link($propuesta['Propuesta']['nombre_propuesta'], array('controller' => 'propuestas', 'action' => 'edit', $propuesta['Propuesta']['id']));?></li>
		<?php endforeach; ?>
	</ul>
<?php endif;?>
