<?php
/*
 *	Test del modelo de usuarios
 */

  App::import('Model','User');

  class UserTestCase extends CakeTestCase {
    var $fixtures = array( 'app.user' );
  }

?>