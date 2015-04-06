<?php  echo $form->create('Proyecto', array('type' => 'file', 'class' => 'form-horizontal', 'role' => 'form', 'inputDefaults' => array(
  'label' => false,
  'div' => false))); ?> 
  <div class="row">
  	<div class="col-md-5">
  		<div class="form-group">
	  		<?php  echo $form->input('ProyectoDocumento.documento', array('type' => 'file', 'class' => 'form-control')); ?> 
	      <!--<?php echo $this->Form->input('ProyectoDocumento.documento_dir', array('type' => 'hidden')); ?>-->
	      <?php echo $this->Form->input('pauta_id', array('type' => 'hidden', 'value' => $pauta_id)); ?>  
	      <?php echo $this->Form->input('proyecto_id', array('type' => 'hidden', 'value' => $proyecto['Proyecto']['id'])); ?>    
      </div>
     </div>
     <div class="col-md-offset-1 col-md-5">
      <div class="form-group">
      		<?php echo $form->button('Guardar ', array('type' => 'submit', 'class'=>'btn btn-success', 'escape' => false), array('escape' => false)); ?>
      	</div>
      </div>  	
  </div>
  <div class="row">
  	<div class="col-md-12">
  		<h3>Clientes potenciales</h3>
  	</div>
  </div>
  <hr style="border-top: 1px solid #ddd;">
  <div class="row" id="ClientePotencial">
  	<div class="col-md-4 mercado">
  		<div class="form-group">
		    <label for="exampleInputEmail1">Nombre</label>
		    <?php echo $form->input('ClientePotencial.0.Nombre', array('class' => 'form-control'));?>
		  </div>
		  <div class="form-group">
		    <label for="exampleInputPassword1">Descripción</label>
		    <?php echo $form->textarea('ClientePotencial.0.Descripcion', array('class' => 'form-control'));?>
		  </div>
		  <div class="form-group">
		    <label for="exampleInputFile">File input</label>
		    <?php  echo $form->input('ClientePotencial.0.imagen', array('type' => 'file', 'class' => 'form-control')); ?>
		    <p class="help-block">Example block-level help text here.</p>
		  </div>
  
  	</div>
  	<div class="col-md-4">
	  	<div class="panel panel-success panel-add" id="add-cliente">
			  <div class="panel-body">
			    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
			    <span class="glyphicon-class">Agregar nuevo</span>
			    <span class="glyphicon-class">Cliente potencial</span>
			  </div>
			</div>
		</div>
  </div>

  <div class="row">
  	<div class="col-md-12">
  		<h3>Competencias</h3>
  	</div>
  </div>
  <hr style="border-top: 1px solid #ddd;">
  <div class="row" id="Competencia">
  	<div class="col-md-4 mercado">
  		<div class="form-group">
		    <label for="exampleInputEmail1">Nombre</label>
		    <?php echo $form->input('Competencia.0.Nombre', array('class' => 'form-control'));?>
		  </div>
		  <div class="form-group">
		    <label for="exampleInputPassword1">Descripción</label>
		    <?php echo $form->textarea('Competencia.0.Descripcion', array('class' => 'form-control'));?>
		  </div>
		  <div class="form-group">
		    <label for="exampleInputFile">File input</label>
		    <?php  echo $form->input('Competencia.0.imagen', array('type' => 'file', 'class' => 'form-control')); ?>
		    <p class="help-block">Example block-level help text here.</p>
		  </div>  
  	</div>
  	<div class="col-md-4">
	  	<div class="panel panel-success panel-add" id="add-competencia">
			  <div class="panel-body">
			    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
			    <span class="glyphicon-class">Agregar nuevo</span>
			    <span class="glyphicon-class">Cliente potencial</span>
			  </div>
			</div>
		</div>
  </div>

  <div class="row">
  	<div class="col-md-12">
  		<h3>Complementario</h3>
  	</div>
  </div>
  <hr style="border-top: 1px solid #ddd;">
  <div class="row" id="Complementario">
  	<div class="col-md-4 mercado">
  		<div class="form-group">
		    <label for="exampleInputEmail1">Nombre</label>
		    <?php echo $form->input('Complementario.0.Nombre', array('class' => 'form-control'));?>
		  </div>
		  <div class="form-group">
		    <label for="exampleInputPassword1">Descripción</label>
		    <?php echo $form->textarea('Complementario.0.Descripcion', array('class' => 'form-control'));?>
		  </div>
		  <div class="form-group">
		    <label for="exampleInputFile">File input</label>
		    <?php  echo $form->input('Complementario.0.imagen', array('type' => 'file', 'class' => 'form-control')); ?>
		    <p class="help-block">Example block-level help text here.</p>
		  </div>  
  	</div>
  	<div class="col-md-4">
	  	<div class="panel panel-success panel-add" id="add-complementario">
			  <div class="panel-body">
			    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
			    <span class="glyphicon-class">Agregar nuevo</span>
			    <span class="glyphicon-class">Cliente potencial</span>
			  </div>
			</div>
		</div>
  </div>

  <div class="row">
  	<div class="col-md-12">
  		<h3>Usuarios potenciales</h3>
  	</div>
  </div>
  <hr style="border-top: 1px solid #ddd;">
  <div class="row" id="UsuarioPotencial">
  	<div class="col-md-4 mercado">
  		<div class="form-group">
		    <label for="exampleInputEmail1">Nombre</label>
		    <?php echo $form->input('UsuarioPotencial.0.Nombre', array('class' => 'form-control'));?>
		  </div>
		  <div class="form-group">
		    <label for="exampleInputPassword1">Descripción</label>
		    <?php echo $form->textarea('UsuarioPotencial.0.Descripcion', array('class' => 'form-control'));?>
		  </div>
		  <div class="form-group">
		    <label for="exampleInputFile">File input</label>
		    <?php  echo $form->input('UsuarioPotencial.0.imagen', array('type' => 'file', 'class' => 'form-control')); ?>
		    <p class="help-block">Example block-level help text here.</p>
		  </div>  
  	</div>
  	<div class="col-md-4">
	  	<div class="panel panel-success panel-add" id="add-usuario">
			  <div class="panel-body">
			    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
			    <span class="glyphicon-class">Agregar nuevo</span>
			    <span class="glyphicon-class">Cliente potencial</span>
			  </div>
			</div>
		</div>
  </div>

  <script type="text/javascript">
  	var i = 0, j=0, k=0, l=0;
  	function addPanel(parent, i, type){
  		if(i < 2){
	  		
	  		parent.before('<div class="col-md-4 mercado">'
	  		+'<div class="form-group">'
			    +'<label for="exampleInputEmail1">Email address</label>'
			    +'<?php echo $form->input("'+type+'.'+(i + 1)+'.Nombre", array("class" => "form-control"));?>'
			  +'</div>'
			  +'<div class="form-group">'
			    +'<label for="exampleInputPassword1">Password</label>'
			    +'<?php echo $form->textarea("'+type+'.'+(i + 1)+'.Descripcion", array("class" => "form-control"));?>'
			  +'</div>'
			  +'<div class="form-group">'
			    +'<label for="exampleInputFile">File input</label>'
			    +'<?php  echo $form->input("'+type+'.'+(i + 1)+'.imagen", array("type" => "file", "class" => "form-control")); ?>'
			    +'<p class="help-block">Example block-level help text here.</p>'
			  +'</div>'  
	  	+'</div>');	  			  		
	  	}
  	}

  	//Nuevos clientes
  	$(".panel-add#add-cliente").on("click", function(){
  		var parent = $(this).parent();
  		addPanel(parent, i, 'ClientePotencial');
  		i++;
  		if(i==2)parent.hide();
  	});

  	//nuevos competidores
  	$(".panel-add#add-competencia").on("click", function(){
  		var parent = $(this).parent();
  		addPanel(parent, j, 'Competencia');
  		j++;
  		if(j==2)parent.hide();
  	});

  	//nuevos complementarios
  	$(".panel-add#add-complementario").on("click", function(){
  		var parent = $(this).parent();
  		addPanel(parent, k, 'Complementario');
  		k++;
  		if(k==2)parent.hide();
  	});

  	//nuevos usuarios
  	$(".panel-add#add-usuario").on("click", function(){
  		var parent = $(this).parent();
  		addPanel(parent, l, 'UsuarioPotencial');
  		l++;
  		if(l==2)parent.hide();
  	});
  </script>
<?php  echo $form->end(); ?>