<?php

	Class UsersController extends AppController {
		var $name = 'Users';		
		var $components = array('Auth', 'Session');

		function beforeFilter() {
      $this->Auth->fields = array(
        'username' => 'nombre',
        'password' => 'contrasena'
        );
      $this->Auth->allow('add', 'login');
    }

		function login(){
      if($this->Auth->user()){
        $this->Session->write('current_user', $this->Auth->user());
        $this->redirect( array('controller' => 'pages', 'action' => 'home') );
      }
		}	

		function logout(){
      $this->Session->destroy();
      $this->Session->setFlash('Gracias por usar nuestros servicios! vuelve cuando quieras', 'flash_success');
			$this->redirect($this->Auth->logout());
		}	

		function add(){
			//Si se trata de un post y no de acceder a travez de la URL
			if ( $this->data ) {
				//Si las contraseñas son iguales
        if ($this->data['User']['contrasena'] == $this->Auth->password($this->data['User']['password_confirm'])) {
        	
          $this->User->create();
          //Si se pudo guardar el usuario
          if ( $this->User->save($this->data) ){
          	
            $this->Auth->login( $this->data );         
            $this->Session->write('current_user', $this->Auth->user());    
            $this->redirect( array('controller' => 'pages', 'action' => 'home') );

          }else{
          	$this->Session->setFlash('ups! No se pudo guardar el usuario, intentelo más tarde', 'flash_warning');
          }          
        }else{
        	$this->Session->setFlash('Las contraseñas no coinciden, por favor vuelva a intentarlo', 'flash_warning');
        }
	    } else {
        if ($this->Auth->user()){
          $this->Session->setFlash('Ya estas registrado!', 'flash_warning');
          $this->redirect( array('controller' => 'pages', 'action' => 'home') );
        }
      }
		}
		
	}
?>