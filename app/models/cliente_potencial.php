<?php

class ClientePotencial extends AppModel{
	var $name = 'ClientePotencial';	  
  var $belongsTo = array(
    'Mercado' => array(
      'className'   => 'Mercado',
      'foreignKey'  => 'mercado_id'
      )
    );	
}
?>