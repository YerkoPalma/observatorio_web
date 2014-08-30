<?php

class SessionauthComponent extends Object {
  
  var $name = "Sessionauth";
  var $components = array( "Auth", "Cookie" );

  function beforeFilter(){
  	$this->Cookie->name = 'baker_id';
	  $this->Cookie->time =  3600;  // or '1 hour'
	  //$this->Cookie->path = '/bakers/preferences/';
	  //$this->Cookie->domain = 'example.com';
	  $this->Cookie->secure = false;  //i.e. only sent if using secure HTTPS
	  $this->Cookie->key = 'qSI232qs*&sXOw!';
  }

  function sign_in($user) {

    //$userInstance = ClassRegistry::init('User');
    $current_user = null;
    $remember_token = md5($user['rut']);
    $this->Cookie->write('remeber_token',$remember_token);
    $current_user = $user

  }
}

?>