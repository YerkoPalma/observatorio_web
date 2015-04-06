<?php

class Complementario extends AppModel{
	var $name = 'Complementario';	  
  var $belongsTo = array(
    'Mercado' => array(
      'className'   => 'Mercado',
      'foreignKey'  => 'mercado_id'
      )
    );	
}
?>