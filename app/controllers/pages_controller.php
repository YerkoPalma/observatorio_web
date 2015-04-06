<?php
#App::uses('Validation', 'Utility');

	Class PagesController extends AppController {
		var $name = 'Pages';
		var $uses = null;
		var $helpers = array('Html', 'Feed');
		var $components = array('Email','Auth', 'Session');


		function beforeFilter() {
	    parent::beforeFilter();
	    $this->Auth->allowedActions = array('*');
		}
		function home(){	
			if ( $this->Auth->user() ){
				$this->set('user', current($this->Auth->user()) );
				$this->loadModel( 'Profesor' );
				$this->loadModel( 'Propuesta' );
				$this->loadModel( 'Estudiante' );
				$this->set( 'estudiante', $this->Estudiante->findByRut( $this->Auth->user('rut') )); # !*
				$propuestaCandidata = $this->Propuesta->find( 'first', array('conditions' => array('Propuesta.user_id' => $this->Auth->user('id'),
																																													'Propuesta.estado_propuesta_id' => 11)) );
				$this->set('propuestaCandidata', $propuestaCandidata);
				
				if ( $this->Profesor->findByRut( $this->Auth->user( 'rut' ) ) ){
					
					$this->set('profesor', current($this->Profesor->findByRut( $this->Auth->user( 'rut' ) )) );
					$pendientes = $this->Estudiante->find('count', array('conditions' => array('Estudiante.estado' => 'pendiente')));
					$ideasNuevas = $this->Propuesta->find('count', array('conditions' => array('Propuesta.estado_propuesta_id' => '10')));
          $this->set('pendientes', $pendientes);
          $this->set('nuevasIdeas', $ideasNuevas);
				}
				$this->set('propuestas', $this->Propuesta->find('all') );
				$this->Session->write('current_user',$this->Auth->user() );
			}
			$this->set('title_for_layout', 'Proyectos Ingeniería Civil Informática | Home');		
		}

		function help(){		
			if ( $this->Auth->user() )
				$this->set('user', current($this->Auth->user()) );
			$this->set('title_for_layout', 'Proyectos Ingeniería Civil Informática | Help');	
		}

		function about(){			
			if ( $this->Auth->user() )
				$this->set('user', current($this->Auth->user()) );
			$this->set('title_for_layout', 'Proyectos Ingeniería Civil Informática | About');
		}

		function contact(){			
			if ( $this->Auth->user() )
				$this->set('user', current($this->Auth->user()) );
			$this->set('title_for_layout', 'Proyectos Ingeniería Civil Informática | Contact');
		}		

		function send(){
			if (!empty($this->data)) {
				if ( Validation::email( $this->data['sender'] ) && Validation::notEmpty( $this->data['subject'] ) && Validation::minLength( $this->data['message'], 5 ) ){
					$this->Email->from    = $this->data['sender'];
					$this->Email->to      = 'Alguien más <yerko.palma@usach.cl>';
					$this->Email->subject = $this->data['subject'];
					$this->Email->send( $this->data['message'] );				

	        $this->Session->setFlash('Su mensaje ha sido enviado correctamente', 'flash_success');
	        $this->redirect(array('action' => 'contact'));
	      } else{
	      	$this->Session->setFlash('Debe completar los campos correctamente', 'flash_warning');
	        $this->redirect(array('action' => 'contact'));
	      }
	    } 
		}
	}
?>