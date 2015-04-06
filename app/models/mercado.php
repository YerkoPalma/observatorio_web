<?php
class Mercado extends AppModel{
	var $name = 'Mercado';	
  #var $primaryKey = 'users_id';
  var $hasOne = array('Complementario', 'UsuarioPotencial','Competencia','ClientePotencial');

  var $belongsTo = array(
  	'Proyecto' => array(
  		'className' => 'Proyecto',
  		'foreignKey' => 'proyecto_id'));
  
  var $actsAs = array(
    'Upload.Upload' => array(
      'imagen' 
    )
  );
}
?>