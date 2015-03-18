<!--<pre><?php print_r($data);?></pre>-->
<div class="row">
	<?php
	echo $form->create('Proyecto', array('inputDefaults' => array(
            'label' => false,
            'div' => false), 'role' => 'form', 'class' => 'form-horizontal'));?>
	<div class="form-group">
		<label class="col-sm-3 control-label">Pauta</label>
		<div class="col-sm-9">
			<?php 
				$pautas = array(					
					'1' 	=> 'Pauta 1: Perfil de proyecto',
					'2' 	=> 'Pauta 2: Estudio de mercado',
					'3' 	=> 'Pauta 3.1: Ingeniería para el desarrollo',
					'4' 	=> 'Pauta 3.2: Ingeniería para la producción',
					'5' 	=> 'Pauta 4: Marco legal',
					'6' 	=> 'Pauta 5: Marco financiero',
					'7' 	=> 'Pauta 6: Prototipo',
					'8' 	=> 'Pauta 7: Visita a terreno',
					);
			?>
			<?php echo $form->select('Pauta', $pautas, (isset($pauta) ? $pauta['Pauta']['id'] : '1') , array( 'empty' => 'Escoja una pauta', 'class' => 'form-control'));?>
		</div>
	</div>

	<div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
      <div class="checkbox">
        <label>
        	<?php $editable = (isset($pauta) && $pauta['Pauta']['editable'] == 1 ? true : false);?>
          <?php echo $form->checkbox('Editable', array('hiddenField' => false, 'checked' => $editable))?>Permitir edición de pauta actual
        </label>
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
      <div class="checkbox">
        <label>
          <?php echo $form->checkbox('OldEditable', array('hiddenField' => false, 'checked' => false))?>Permitir edición de pautas anteriores
        </label>
      </div>
    </div>
  </div>

  <?php $programar = (isset($pauta) && isset($pauta['Pauta']['fecha_cierre']) && $pauta['Pauta']['fecha_cierre'] != "" ? true : false)?>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Programar cierre de pauta</label>
    <div class="col-sm-3 ">    	
    		<?php echo $form->checkbox('Programar', array('hiddenField' => false, 'checked' => $programar))?>   	
    </div>
  </div>	

	<div class="form-group">
		<label class="col-sm-3 control-label">Pauta</label>
		<div class="col-sm-9">			
			<div class="input-group date">
			<?php $fechaCierre = (isset($pauta) && isset($pauta['Pauta']['fecha_cierre']) && $pauta['Pauta']['fecha_cierre'] ? $pauta['Pauta']['fecha_cierre'] : "");
				if ($fechaCierre != ""){
					$ano = strtok($fechaCierre, "-");
					$mes = strtok("-");
					$dia = strtok("-");
					$fecha = $mes . "/" . $dia . "/" . $ano;
				}else{$fecha = "";}?>
				<?php $datetime1 = new DateTime( date("d-m-Y",strtotime($fecha)) );
							$datetime2 = new DateTime( date("d-m-Y") );
							$interval = $datetime1->diff($datetime2);
							#echo date("d-m-Y",strtotime($fecha)) . " - " .date("d-m-Y") . " = " . $interval->format('%R%a días');
							#echo "\n".( $interval->format('%R') == "-" ? "falta" : "pasó" );?>
				<?php echo $form->input('FechaCierre', array('default' => $fecha, 'class' => 'form-control', 'escape' => false));?><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
			</div>
		</div>
	</div>
	
		<script type="text/javascript">
		<?php if(!$programar):?>
			$("#ProyectoFechaCierre").attr("disabled","disabled");
		<?php endif; ?>
		$("#ProyectoProgramar").on('change', function(){
			if ($("#ProyectoFechaCierre").attr("disabled"))
				$("#ProyectoFechaCierre").removeAttr("disabled");
			else
				$("#ProyectoFechaCierre").attr("disabled","disabled");
		});
		</script>
	
	<div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
      <?php echo $form->submit('Actualizar', array('class' => 'btn btn-primary'));?>
    </div>
  </div>
	<?php echo $form->end(); ?>
</div>