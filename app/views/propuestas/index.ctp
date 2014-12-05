<?php echo $html->script('prototype'); ?>
<?php 
//si existen propuestas
if ( isset($propuestas) ){
	//mostrar panel de propuestas
	$flag = false;
	foreach ($propuestas as $propuesta){
		if ($propuesta['Propuesta']['user_id'] == $user['id']){
			$flag = true;
		}
	}
	if ($flag)
		echo $this->element('user_propuesta');
	else
		echo $this->element('add_propuesta');
		
//si no existen propuestas	
}else {
	//mostrar panel para agregar propuestas
	echo $this->element('add_propuesta');
}

//panel de filtros
echo $this->element('filter_panel');

echo $this->element('feed', array( 
												"feeds" => array($propuestas),
												"type" => "normal" ) );
?>

