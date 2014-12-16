<?php 
App::import('Controller', 'Users');

//extiendo el controlador para agregar callbacks
class TestUsersController extends UsersController {
  var $name = 'Users';

  var $autoRender = false;

  function redirect($url, $status = null, $exit = true) {
    $this->redirectUrl = $url;
  }

  function render($action = null, $layout = null, $file = null) {
    $this->renderedAction = $action;
  }

  function _stop($status = 0) {
    $this->stopped = $status;
  }
}

class UsersControllerTestCase extends CakeTestCase {
	var $dropTables = false;
  var $fixtures = array( 'app.user', 'app.estudiante', 'app.profesor', 'app.tutor', 'app.inversionista', 'app.visita');

  function startTest() {
			$this->Users = new TestUsersController();
    $this->Users->constructClasses();
    $this->Users->Component->initialize($this->Posts);
  }

  function endTest() {
			unset($this->Posts);
  	ClassRegistry::flush();
  }
}

?>