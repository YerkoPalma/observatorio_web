<?php

class ConceptoComparacion extends AppModel{
	var $name = 'ConceptoComparacion';	  
	var $belongsTo = array(
    'Propuesta' => array(
      'className'   => 'Propuesta',
      'foreignKey'  => 'propuesta_id'
      )
    );
  var $validate = array(  );
}
?>