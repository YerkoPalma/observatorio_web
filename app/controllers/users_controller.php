<?php

	Class UsersController extends AppController {
		var $name = 'Users';		
    var $helpers = array('Html', 'Feed');
		var $components = array('Auth', 'Session', 'RequestHandler');    

		function beforeFilter() {

      $this->Auth->fields = array(
        'username' => 'nombre',
        'password' => 'password'        
        );
      $this->Auth->allow('add', 'login', 'show');
    }   
    
		function login(){      
      $this->set('title_for_layout', 'Proyectos Ingeniería Civil Informática | Login');
      if($this->Auth->user()){
        $this->Session->write('current_user', $this->Auth->user());
        $this->set('user',current( $this->Auth->user() ));  
        $this->redirect( array('controller' => 'pages', 'action' => 'home') );
      }      
		}	    
    
		function logout(){
      $this->Session->destroy();
      
      $this->Session->setFlash('Gracias por usar nuestros servicios! vuelve cuando quieras', 'flash_success');
			$this->redirect($this->Auth->logout());
		}	

		function add(){
      $this->set('title_for_layout', 'Proyectos Ingeniería Civil Informática | Registro');
			//Si se trata de un post y no de acceder a travez de la URL
			if ( $this->data ) {

				//Evaluamos que tipo de usuario se esta ingresando
        $usertype = $this->data['User']['usertype'];

        switch ($usertype) {
          case 'profesor':
            #si se trata de un profesor, primero cargamos el modelo
            $this->loadModel('Profesor');

            #luego buscamos el profesor por el rut ingresado
            $profesor = $this->Profesor->findByRut( $this->data['User']['rut'] );

            #si se encontro el profesor, se actualizan sus datos...
            if ( $profesor ){

              #verifico que el profesor no haya activado su cuenta antes
              if ( $profesor['Profesor']['estado'] != 'activo' ){

                #genera una contraseña aleatoria de 5 caracteres
                $random_pass = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);         

                $this->User->id = $profesor['Profesor']['user_id'];
                $this->User->saveField('estado', 'activo');
                $this->User->saveField('password', $this->Auth->password( $random_pass ) );

                $this->Profesor->id = $profesor['Profesor']['id'];
                $this->Profesor->saveField('estado', 'activo');
                $this->Profesor->saveField('password', $this->Auth->password( $random_pass ) );              

                #finalmente, inicio sesion
                $user = $this->User->findById( $profesor['Profesor']['user_id'] );
                $profesor = $this->Profesor->findByRut( $this->data['User']['rut'] );
                $this->set('profesor', $profesor ); 
                $this->Auth->login( $user );         
                $this->Session->setFlash($random_pass.'  '.$profesor['Profesor']['nombre'], 'flash_success');
                $this->Session->write('current_user', $this->Auth->user());  
                $this->set('user', $this->Auth->user() );                 
                $this->redirect( array('controller' => 'pages', 'action' => 'home') );
              }else{
                $this->Session->setFlash( "El profesor ".$profesor['Profesor']['nombre']." ya ha sido ingresado, intente iniciar sesión con su contraseña" , 'flash_warning');
                $this->redirect( array('controller' => 'pages', 'action' => 'home') );
              }

            #sino, se redirecciona a la pagina de registro indicando que el profesor no es valido
            }else{
              $this->Session->setFlash( "Lo sentimos, este rut no existe" , 'flash_warning');
              $this->redirect( array('controller' => 'pages', 'action' => 'home') );
            }

            break;

          case 'estudiante':
            #si las contraseñas son iguales...
            if ( $this->data['User']['password'] == $this->Auth->password($this->data['User']['password_confirm']) ){
              
              #dejo el estado como pendiente
              $this->data['User']['estado'] = 'pendiente';

              #pero guardo primero el usuario asociado
              $this->User->create();    

              #si se cumplen las validaciones del modelo
              if ( $this->User->save($this->data) ){ 
                
                #asocio el id de usuarios con el campo correspondiente en los estudiantes
                $this->data['Estudiante']['user_id'] = $this->User->getLastInsertId();

                #guardo la contraseña encriptada
                $this->data['Estudiante']['password'] = $this->data['User']['password'];
                $this->data['Estudiante']['estado'] = $this->data['User']['estado'];                
                
                #si puedo guardar el estudiante
                if( $this->User->Estudiante->save( $this->data ) ){

                  #Inicio sesion con el usuario
                  $this->Auth->login( $this->data );         
                  $this->Session->setFlash('Bienvenido '. $this->Auth->user('nombre') , 'flash_success');
                  $this->Session->write('current_user', $this->Auth->user());
                  $this->set('user', $this->Auth->user() );    
                  $this->redirect( array('controller' => 'pages', 'action' => 'home') );                  
                }
              }else{
                $this->Session->setFlash('Ups! no pudimos guardar tu usuario, por favor intenta nuevamente', 'flash_warning');
                $this->redirect( array('controller' => 'pages', 'action' => 'home') );
              }
            }
            break;

          case 'externo':
            
            #genera una contraseña aleatoria de 5 caracteres
            $random_pass = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);

            #se la asigno al usuario
            $this->data['User']['password'] = $this->Auth->password( $random_pass );

            #dejo el estado como activo
            $this->data['User']['estado'] = 'activo';

            #se crea el usuario
            $this->User->create();

            #lo guardamos
            if ( $this->User->save( $this->data ) ){

              #si se pudo guardar, revisamos el tipo de usuario
              $tipo = ( isset($this->data['Externo']['type']) ) ? trim( $this->data['Externo']['type'] ) : 'Tutor';

              #generamos los datos para guardar
              $this->data[$tipo]['password'] = $this->data['User']['password'];
              $this->data[$tipo]['nombre'] = $this->data['User']['nombre'];
              $this->data[$tipo]['mail'] = $this->data['User']['mail'];
              $this->data[$tipo]['estado'] = $this->data['User']['estado'];
              #asocio el id de usuarios con el campo correspondiente en los estudiantes
              $this->data[$tipo]['user_id'] = $this->User->getLastInsertId();

              #revisamos en que modelo guardar
              if ( $tipo == 'Tutor' ){
                if ( $this->User->Tutor->save( $this->data ) ){
                  #Inicio sesion con el usuario
                  $this->Auth->login( $this->data );         
                  $this->Session->setFlash('Bienvenido '. $this->Auth->user('nombre') . 'tu contraseña es '. $random_pass, 'flash_success');
                  $this->Session->write('current_user', $this->Auth->user());
                  $this->set('user', $this->Auth->user() );    
                  $this->redirect( array('controller' => 'pages', 'action' => 'home') );
                }
              } elseif ($tipo == 'Inversionista') {
                if ( $this->User->Inversionista->save( $this->data ) ){
                  #Inicio sesion con el usuario
                  $this->Auth->login( $this->data );         
                  $this->Session->setFlash('Bienvenido '. $this->Auth->user('nombre'). 'tu contraseña es '. $random_pass , 'flash_success');
                  $this->Session->write('current_user', $this->Auth->user());
                  $this->set('user', $this->Auth->user() );    
                  $this->redirect( array('controller' => 'pages', 'action' => 'home') );
                }
              }elseif ($tipo == 'Visita') {
                if ( $this->User->Visita->save( $this->data ) ){
                  #Inicio sesion con el usuario
                  $this->Auth->login( $this->data );         
                  $this->Session->setFlash('Bienvenido '. $this->Auth->user('nombre') . 'tu contraseña es '. $random_pass, 'flash_success');
                  $this->Session->write('current_user', $this->Auth->user());
                  $this->set('user', $this->Auth->user() );    
                  $this->redirect( array('controller' => 'pages', 'action' => 'home') );
                }
              }

            }else{
              $this->Session->setFlash('No se pudo grabar el usuario, favor intentalo más tarde', 'flash_warning');
              $this->redirect( array('action' => 'add') );
            }
              
            break;
            
          
          default:
            #si se trata de un profesor, primero cargamos el modelo
            $this->loadModel('Profesor');

            #luego buscamos el profesor por el rut ingresado
            $profesor = $this->Profesor->findByRut( $this->data['User']['rut'] );

            #si se encontro el profesor, se actualizan sus datos...
            if ( $profesor ){

              #verifico que el profesor no haya activado su cuenta antes
              if ( $profesor['Profesor']['estado'] != 'activo' ){

                #genera una contraseña aleatoria de 5 caracteres
                $random_pass = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);         

                $this->User->id = $profesor['Profesor']['user_id'];
                $this->User->saveField('estado', 'activo');
                $this->User->saveField('password', $this->Auth->password( $random_pass ) );

                $this->Profesor->id = $profesor['Profesor']['id'];
                $this->Profesor->saveField('estado', 'activo');
                $this->Profesor->saveField('password', $this->Auth->password( $random_pass ) );              

                #finalmente, inicio sesion
                $user = $this->User->findById( $profesor['Profesor']['user_id'] );                
                #$this->set('profesor', $profesor ); 
                $this->Auth->login( $user );         
                $this->Session->setFlash($random_pass.'  '.$profesor['Profesor']['nombre'], 'flash_success');
                $this->Session->write('current_user', $this->Auth->user());  
                #$this->set('user', $this->Auth->user() ); 
                $user = $this->Auth->user();
                $profesor = $this->Profesor->findByRut( $this->data['User']['rut'] );
                $this->set( compact('user', 'profesor') );        
                $this->redirect( array('controller' => 'pages', 'action' => 'home') );
              }else{
                $this->Session->setFlash( "El profesor ".$profesor['Profesor']['nombre']." ya ha sido ingresado, intente iniciar sesión con su contraseña" , 'flash_warning');
                $this->redirect( array('controller' => 'pages', 'action' => 'home') );
              }

            #sino, se redirecciona a la pagina de registro indicando que el profesor no es valido
            }else{
              $this->Session->setFlash( "Lo sentimos, este rut no existe" , 'flash_warning');
              $this->redirect( array('controller' => 'pages', 'action' => 'home') );
            }

            break;
        }                
	    } else {
        if ($this->Auth->user()){
          $this->Session->setFlash('Ya estas registrado!', 'flash_warning');
          $this->redirect( array('controller' => 'pages', 'action' => 'home') );
        }
      }
		}

    function show(){      
      $user = $this->User->findById($this->params['pass'][0]); 
      $this->set('show_user',current($user));
      $this->loadModel( 'Propuesta' );
      $this->set('propuestas', $this->Propuesta->find('all') );
      $estudiante = $this->User->Estudiante->findByRut( $user['User']['rut'] );
      $this->set( 'estudiante', $estudiante);
      $propuestaCandidata = $this->Propuesta->find( 'first', array('conditions' => array('Propuesta.user_id' => $this->Auth->user('id'),
                                                                                          'Propuesta.estado_propuesta_id' => 11)) );
      $this->set('propuestaCandidata', $propuestaCandidata);
      if ( $this->Auth->user() ) {      
        $this->set('user',current($this->Auth->user()));  
        $this->layout = 'connected';
        $this->loadModel( 'Profesor' );
        if ( is_array( $this->Profesor->findByRut( $this->Auth->user( 'rut' ) ) ) ){
          $this->loadModel( 'Estudiante' );
          $this->set('profesor', current($this->Profesor->findByRut( $this->Auth->user( 'rut' ) )) );
          
          $pendientes = $this->Estudiante->find('count', array('conditions' => array('Estudiante.estado' => 'pendiente')));
          $ideasNuevas = $this->Propuesta->find('count', array('conditions' => array('Propuesta.estado_propuesta_id' => '10')));
          $this->set('pendientes', $pendientes);
          $this->set('nuevasIdeas', $ideasNuevas);
        }
        if (is_array( $estudiante )){
          $projectID =  $estudiante['Estudiante']['proyecto_id'];
          $this->set('proyectoID', $projectID);
          if (isset($projectID) && !empty($projectID) ){
            $project = $this->User->Estudiante->Proyecto->findById($projectID);
            $this->set('proyecto', $project); 
            #Agregar miembros e info del proyecto                    
          }
        }
      }       
    }

    function edit(){
      $user = $this->User->findById($this->params['pass'][0]); 
      $this->set('user',current($user));      

      if ( $this->Auth->user() ) {        
        $this->layout = 'connected';
        $this->loadModel( 'Profesor' );
        $this->loadModel( 'Propuesta' );
        $this->set( 'estudiante', $this->User->Estudiante->findByRut( $this->Auth->user('rut') ));
        $propuestaCandidata = $this->Propuesta->find( 'first', array('conditions' => array('Propuesta.user_id' => $this->Auth->user('id'),
                                                                                          'Propuesta.estado_propuesta_id' => 11)) );
        $this->set('propuestaCandidata', $propuestaCandidata);
        if ( $this->Profesor->findByRut( $this->Auth->user( 'rut' ) ) ){
          $this->loadModel( 'Estudiante' );
          $this->set('profesor', current($this->Profesor->findByRut( $this->Auth->user( 'rut' ) )) );
          $pendientes = $this->Estudiante->find('count', array('conditions' => array('Estudiante.estado' => 'pendiente')));
          $ideasNuevas = $this->Propuesta->find('count', array('conditions' => array('Propuesta.estado_propuesta_id' => '10')));
          $this->set('pendientes', $pendientes);
          $this->set('nuevasIdeas', $ideasNuevas);
        }
        $this->User->id = $this->params['pass'];

        //Solo puedo editar mis datos!
        if (($this->params['pass'][0] == $this->Auth->user('id')) || ctype_alpha($this->params['pass'][0]) ){
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

    /**
     * Cambia la contraseña de un usuario
     * @return Redirect
     */
    function changePassword(){

      #evito que me pida una vista para esta accion
      $this->autoRender = false;

      #Selecciono el usuario      
      $user = $this->User->findById($this->data['User']['id']);

      #si la contraseña ingresada es correcta
      if ( $this->Auth->password( $this->data['User']['password'] ) == trim( $user['User']['password'] ) ){

        #si las dos nuevas contraseñas son iguales
        if ( $this->data['User']['new_password'] == $this->data['User']['confirm_new_password'] ){
          #cambio la contraseña
          $this->User->id = $user['User']['id'];
          $this->User->saveField( 'password', $this->Auth->password( $this->data['User']['new_password'] ) );          

          $this->Session->setFlash('Tu contraseña se actualizo exitosamente!', 'flash_success');
          $this->redirect(array('controller' => 'pages', 'action' => 'home'));
        }else{
          $this->Session->setFlash('Tus contraseñas no son iguales!', 'flash_warning');
          $this->redirect(array('controller' => 'pages', 'action' => 'home'));
        }
      }else{
        $this->Session->setFlash('Debes ingresar correctamente tu contraseña actual', 'flash_warning');
        $this->redirect(array('controller' => 'pages', 'action' => 'home'));
      }
    }

    /**
     * Acepta un estudiante cambiandole el estado en la base de datos
     * @return Redirect
     */
    function accept_student(){
      #evito que me pida una vista para esta accion
      $this->autoRender = false;

      #cambio el estado del estudiante
      $this->User->id = $this->params['pass'][0]; //en params[0] tengo el id del usuario!!
      $this->User->saveField( 'estado', 'activo' );

      $this->User->Estudiante->id = $this->params['pass'][1];
      #cambio también los datos del user asociado al estudiante
      $this->User->Estudiante->saveField(  'estado', 'activo'  );

      $this->Session->setFlash('El estudiante '.$this->User->Estudiante->field( 'nombre' ).' ha sido exitosamente actualizado', 'flash_success');
      $this->redirect(array('controller' => 'estudiantes', 'action' => 'index'));
    }

    /**
     * Redirecciona al usuario que no tiene un proyecto aceptado
     * @return Redirect()
     */
    function project(){
      if ( $this->Auth->user() ){
      $this->set('user', current( $this->Auth->user()) );
      $this->layout = 'connected';
      $this->loadModel( 'Profesor' );
      $this->loadModel( 'Estudiante' );
      $this->set( 'estudiante', $this->Estudiante->findById( $this->Auth->user('id') ));
      #$propuestaCandidata = $this->Propuesta->find( 'first', array('conditions' => array('Propuesta.user_id' => $this->Auth->user('id'),
      #                                                                                    'Propuesta.estado_propuesta_id' => 11)) );
      #$this->set('propuestaCandidata', $propuestaCandidata);
      }
    }
		
	}
?>