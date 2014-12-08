<?php

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
				if ( $this->Profesor->findByRut( $this->Auth->user( 'rut' ) ) ){
					$this->loadModel( 'Estudiante' );
					$this->set('profesor', current($this->Profesor->findByRut( $this->Auth->user( 'rut' ) )) );
					$pendientes = $this->Estudiante->find('count', array('conditions' => array('Estudiante.estado' => 'pendiente')));
					$this->set('pendientes', $pendientes);
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
				if ( $this->data['sender'] != "" ){
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