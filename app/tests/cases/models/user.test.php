<?php
/*
 *	Test del modelo de usuarios
 */

  App::import('Model','User');
  App::import('Model','Profesor');
  App::import('Model','Estudiante');
  App::import('Model','Tutor');
  App::import('Model','Inversionista');
  App::import('Model','Visita');

  class UserTestCase extends CakeTestCase {

    //var $useDbConfig = 'test';
  	//incluyo los fixtures de los modelos asociados
    var $fixtures = array( 'app.user', 'app.estudiante', 'app.profesor', 'app.tutor', 'app.inversionista', 'app.visita');

    //pruebo la relacion de herencia
    function testInheritance(){
    	//creo una instancia de los modelos
    	$this->User =& ClassRegistry::init('User');
    	$this->User->Profesor =& ClassRegistry::init('Profesor');
    	$this->User->Estudiante =& ClassRegistry::init('Estudiante');
    	$this->User->Tutor =& ClassRegistry::init('Tutor');
    	$this->User->Inversionista =& ClassRegistry::init('Inversionista');
    	$this->User->Visita =& ClassRegistry::init('Visita');

    	
    }
  }

?>