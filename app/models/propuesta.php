<?php

class Propuesta extends AppModel{
	var $name = 'Propuesta';	  
  var $belongsTo = array(
    'User' => array(
      'className'   => 'User',
      'foreignKey'  => 'user_id'
      ),
    'TipoIdea' => array(
      'className'   => 'TipoIdea',
      'foreignKey'  => 'tipo_idea_id'
      )
    #'EstadoPropuesta'
    );
	var $validate = array(
    'nombre_propuesta' => array(  
      'rule' => 'notEmpty',
      'messagge' => 'Este campo no puede estar vacio!'
    )
  );
}
?>