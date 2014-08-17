
<div class="row">
	<div class="col-md-6">
		<h1>Tienes algo que decirnos? Te escuchamos!</h1>	
		<br>	
		<p class="text-left lead msg">Lorem ipsum ad his scripta blandit partiendo, eum fastidii accumsan euripidis in, eum liber hendrerit an. Qui ut wisi vocibus suscipiantur, quo dicit ridens inciderint id. Quo mundi lobortis reformidans eu, legimus senserit definiebas an eos.</p>
	</div>
	<div class="col-md-6">
		<?php echo $this->Form->create(null, array('url' => array('controller' => 'pages', 'action' => 'send'), 'class' => 'form-horizontal', 'role' => 'form', 'style' => 'margin-top: 20px;')); ?>

		<div class="form-group">
			<label for="sender" class="col-sm-2 control-label">De: </label>
			<div class="col-sm-10">
				<?php echo $this->Form->input('sender', array('div' => false, 'label' => false, 'class' => 'form-control', 'placeholder' => 'Anonimo')) ?>
			</div>
		</div>

		<div class="form-group">
			<label for="subject" class="col-sm-2 control-label">Asunto: </label>
			<div class="col-sm-10">
				<?php echo $this->Form->input('subject', array('div' => false, 'label' => false, 'class' => 'form-control', 'placeholder' => 'Asunto')) ?>
			</div>
		</div>

		<div class="form-group">
			<label for="message" class="col-sm-2 control-label">Mensaje: </label>
			<div class="col-sm-10">
				<?php echo $this->Form->textarea('message', array('div' => false, 'label' => false, 'class' => 'form-control', 'placeholder' => 'Mensaje...', 'rows' => '4')) ?>
			</div>
		</div>
		<div class="form-group">
	    <div class="col-sm-offset-2 col-sm-10">
	      <?php echo $this->Form->submit('Enviar', array('class' => 'btn btn-default')) ?>
	    </div>
	  </div>
		<?php echo $form->end(); ?>
	</div>
</div>