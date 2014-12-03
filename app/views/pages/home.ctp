<?php 	if( isset($user) ): ?>
	
	<?php $user = current($this->Session->read('current_user'));?>
	<div class="row">
		<div class="col-md-3 side-bar">
			<?php echo $this->element('sidebar');?>
		</div>

		<div class="col-md-9">
			<?php echo $this->element('feed', array(
													"feeds" => array($propuestas),
													"type" => "social")); ?>
		</div>
	</div>
<?php else:?>
<div class="row divider">
	<div class="col-md-4">
		<?php echo $this->Html->image('lightbulb.png', array('class' => 'img img-responsive'))?>
		<p class="text-center lead">Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo luctus.</p>
	</div>
	<div class="col-md-4">
		<?php echo $this->Html->image('file.png', array('class' => 'img img-responsive'))?>
		<p class="text-center lead">Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo luctus.</p>
	</div>
	<div class="col-md-4">
		<?php echo $this->Html->image('pencil.png', array('class' => 'img img-responsive'))?>
		<p class="text-center lead">Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo luctus.</p>
	</div>	
</div>

<div class="row">
	<div class="col-md-12">
		<h3 class="text-center">¿Aún no tienes una cuenta? <?php echo $this->Html->link('¡Registraté!', array('controller' => 'users', 'action' => 'add'), array('class' => 'btn btn-lg btn-primary'))?></h3>
	</div>
</div>
<?php endif; ?>