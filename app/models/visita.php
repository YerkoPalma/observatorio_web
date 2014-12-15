<?php

class Visita extends AppModel{
	var $name = 'Visita';	  
  var $belongsTo = array(
    'User' => array(
      'className'   => 'User',
      'foreignKey'  => 'user_id'
      )
    );
	var $validate = array(
    'nombre' => array(      
      'isUnique' => array(
        'rule' => 'isUnique',
        'required' => true,
        'message' => 'Nombre de usuario ya ocupado'
        ),
      'between' => array(
        'rule' => array('between', 5, 15),
        'message' => 'Entre 5 y 15 caracteres'
      )
    ),
    'password' => array(
      'rule' => array('minLength', '5'),
      'message' => 'Largo mínimo de 5 caracteres',
      'allowEmpty' => 'false'
    )
  );
}
?>