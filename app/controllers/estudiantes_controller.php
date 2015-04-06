<?php

	Class EstudiantesController extends AppController {
		var $name = 'Estudiantes';			
		var $helpers = array('Html');
		var $components = array('Auth', 'Session');		

		function beforeFilter() {
	    parent::beforeFilter();
	    $this->Auth->allowedActions = array('*');
		}

		function index(){		
			$this->loadModel('User');
			$this->loadModel( 'Profesor' );
			$this->loadModel( 'Propuesta' );
			$propuestaCandidata = $this->Propuesta->find( 'first', array('conditions' => array('Propuesta.user_id' => $this->Auth->user('id'),
																																													'Propuesta.estado_propuesta_id' => 11)) );
				$this->set('propuestaCandidata', $propuestaCandidata);
			if ( $this->Auth->user() ) {
				$this->set('user', current($this->Auth->user()) );
				$this->layout = 'connected';
				
				if ( $this->Profesor->findByRut( $this->Auth->user( 'rut' ) ) ){
					
					$this->set('profesor', current($this->Profesor->findByRut( $this->Auth->user( 'rut' ) )) );
					$pendientes = $this->Estudiante->find('count', array('conditions' => array('Estudiante.estado' => 'pendiente')));
					$ideasNuevas = $this->Propuesta->find('count', array('conditions' => array('Propuesta.estado_propuesta_id' => '10')));
					$this->set('pendientes', $pendientes);
					$this->set('nuevasIdeas', $ideasNuevas);
				}else{
					$this->redirect(array('controller' => 'pages', 'action' => 'home'));
				}
				$this->Session->write('current_user',$this->Auth->user() );
				#los ordeno para que aparescan primero los pendientes
				$this->Estudiante->order = 'Estudiante.estado DESC';
				$this->set('estudiantes', $this->Estudiante->find('all'));
				
			}				
		}

		function curso(){
			if ( $this->Auth->user() ){
				$this->set('user', current($this->Auth->user()) );
				$this->layout = 'connected';

				$this->set( 'estudiantes', $this->Estudiante->User->find( 'all', array( "conditions" => array("Estudiante.estado" => "activo")) ) );		
				$this->set( 'estudiante', $this->Estudiante->findByRut( $this->Auth->user('rut') ));
				$this->loadModel( 'Profesor' );
				$this->loadModel( 'Propuesta' );
				$propuestaCandidata = $this->Propuesta->find( 'first', array('conditions' => array('Propuesta.user_id' => $this->Auth->user('id'),
																																													'Propuesta.estado_propuesta_id' => 11)) );
				$this->set('propuestaCandidata', $propuestaCandidata);
        if ( is_array( $this->Profesor->findByRut( $this->Auth->user( 'rut' ) ) ) ){
          
          $this->set('profesor', current($this->Profesor->findByRut( $this->Auth->user( 'rut' ) )) );
          
          $pendientes = $this->Estudiante->find('count', array('conditions' => array('Estudiante.estado' => 'pendiente')));
          $ideasNuevas = $this->Propuesta->find('count', array('conditions' => array('Propuesta.estado_propuesta_id' => '10')));
					$this->set('pendientes', $pendientes);
					$this->set('nuevasIdeas', $ideasNuevas);
        }		
			}
		}		
			
	}
?>