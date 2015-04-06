<?php

class UsuarioPotencial extends AppModel{
	var $name = 'UsuarioPotencial';	  
  var $belongsTo = array(
    'Mercado' => array(
      'className'   => 'Mercado',
      'foreignKey'  => 'mercado_id'
      )
    );	
}
?>