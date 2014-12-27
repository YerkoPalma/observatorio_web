<?php
class User extends AppModel{
	var $name = 'User';	
  #var $primaryKey = 'users_id';
  var $hasOne = array('Estudiante', 'Profesor','Tutor','Inversionista','Visita');
  var $hasMany = array(
    'Propuesta' => array(
      'className' => 'Propuesta',
      'foreignKey' => 'user_id')
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