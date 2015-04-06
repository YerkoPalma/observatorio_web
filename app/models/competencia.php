<?php

class Competencia extends AppModel{
	var $name = 'Competencia';	  
  var $belongsTo = array(
    'Mercado' => array(
      'className'   => 'Mercado',
      'foreignKey'  => 'mercado_id'
      )
    );	
}
?>