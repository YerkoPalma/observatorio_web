<div class="page-header">	
  <h1><?php echo $show_user['nombre'];?> <br><small><?php echo $show_user['mail'];?></small></h1>
</div>	
<br>
<div class="row">
	<div class="col-md-8">
		<?php echo $this->element('feed', array( 
												"feeds" => array($propuestas),
												"type" => "social" )); ?>
	</div>
	<div class="col-md-4">
		<?php echo $this->element('project-avatar'); ?>
	</div>
</div>