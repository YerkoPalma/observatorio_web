<?php echo $this->element('breadcrumb_pauta');?>

<?php if(isset($editable) && $editable == 1){
	echo $this->element('form_pauta');
}else{

	#if ($proyecto['Proyecto']['pauta_id'] > $pauta_id) # -> si la pauta en la que esta el proyecto es mayor a la que se esta revisando, se puede mostrar el contenido
	echo $this->element('show_pauta');
	#else # -> sino, aún no llega a esa pauta el curso.
}?>