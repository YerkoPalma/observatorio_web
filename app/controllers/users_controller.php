<?php

	Class UsersController extends AppController {
		var $name = 'Users';		
		var $components = array('Auth', 'Session', 'RequestHandler');    

		function beforeFilter() {

      $this->Auth->fields = array(
        'username' => 'nombre',
        'password' => 'password'        
        );
      $this->Auth->allow('add', 'login', 'show');
    }   
    
		function login(){      
      if($this->Auth->user()){
        $this->Session->write('current_user', $this->Auth->user());
        $this->redirect( array('controller' => 'pages', 'action' => 'home') );
      }      
		}	

    public function isAuthorized($user) {
        // All registered users can add posts
        if ($this->action === 'add') {
            return true;
        }

        // The owner of a post can edit and delete it
        if (in_array($this->action, array('edit'))) {
            $userId = (int) $this->request->params['pass'][0];
            if ($this->Auth->user('users_id') == $userId ) {
                return true;
            }
        }

        return parent::isAuthorized($user);
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
        if ($this->data['User']['password'] == $this->Auth->password($this->data['User']['password_confirm'])) {
        	
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

    function show(){      
      $user = $this->User->findByUsersId($this->params['pass']); 
      $this->set('user',current($user));

      if ( $this->Auth->user() ) {        
        $this->layout = 'connected';
      }       
    }

    function edit(){
      $user = $this->User->findByUsersId($this->params['pass'][0]); 
      $this->set('user',current($user));      

      if ( $this->Auth->user() ) {        
        $this->layout = 'connected';
        $this->User->id = $this->params['pass'];

        //Solo puedo editar mis datos!
        if (($this->params['pass'][0] == $this->Auth->user('users_id')) || ctype_alpha($this->params['pass'][0]) ){
          if (empty($this->data)) {
            $this->data = $this->User->read();
          } else {
              if ($this->User->save($this->data)) {
                  $this->Session->setFlash('Datos actualizados correctamente!', 'flash_success');
                  $this->Session->write('current_user', $this->Auth->user());
                  $this->redirect(array('controller' => 'pages', 'action' => 'home'));
              }
          }
        } else{
          $this->Session->setFlash(' No puedes editar datos de otros usuarios', 'flash_warning');
          $this->redirect(array('controller' => 'pages', 'action' => 'home'));
        }
      }  
    }
		
	}
?>