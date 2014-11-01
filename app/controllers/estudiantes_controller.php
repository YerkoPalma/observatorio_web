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

			if ( $this->Auth->user() ) {
				$this->set('user', current($this->Auth->user()) );
				$this->layout = 'connected';
				
				if ( $this->Profesor->findByRut( $this->Auth->user( 'rut' ) ) ){
					
					$this->set('profesor', current($this->Profesor->findByRut( $this->Auth->user( 'rut' ) )) );
					$pendientes = $this->Estudiante->find('count', array('conditions' => array('Estudiante.estado' => 'pendiente')));
					$this->set('pendientes', $pendientes);
				}else{
					$this->redirect(array('controller' => 'pages', 'action' => 'home'));
				}
				$this->Session->write('current_user',$this->Auth->user() );
				#los ordeno para que aparescan primero los pendientes
				$this->Estudiante->order = 'Estudiante.estado DESC';
				$this->set('estudiantes', $this->Estudiante->find('all'));
				
			}
				
		}		
			
	}
?>