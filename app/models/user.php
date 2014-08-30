<?php
class User extends AppModel{
	var $name = 'User';	
  var $primaryKey = 'users_id';
	var $validate = array(
    'nombre' => array(
      'alphaNumeric' => array(
        'rule' => 'alphaNumeric',
        'required' => true,
        'message' => 'Sólo letras y números'
        ),
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
    'contrasena' => array(
      'rule' => array('minLength', '5'),
      'message' => 'Largo mínimo de 5 caracteres',
      'allowEmpty' => 'false'
    )
  );
}
?>