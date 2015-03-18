<?php
class Pauta extends AppModel{
	var $name = 'Pauta';	
  
  var $hasMany = array(
    'Proyecto' => array(
      'className' => 'Proyecto',
      'foreignKey' => 'pauta_id')
    );

  var $hasOne = array(
  	'DocumentoGenerico' => array(
  		'className' => 'DocumentoGenerico',
  		'foreignKey' => 'pauta_id'));
  
}
?>