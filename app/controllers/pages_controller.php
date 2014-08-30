<?php

	Class PagesController extends AppController {
		var $name = 'Pages';
		var $uses = null;
		var $components = array('Email');

		function beforeFilter() {
	    parent::beforeFilter();
	    $this->Auth->allowedActions = array('*');
		}
		function home(){	
			$this->set('title_for_layout', 'Proyectos Ingeniería Civil Informática | Home');		
		}

		function help(){		
			$this->set('title_for_layout', 'Proyectos Ingeniería Civil Informática | Help');	
		}

		function about(){			
			$this->set('title_for_layout', 'Proyectos Ingeniería Civil Informática | About');
		}

		function contact(){			
			$this->set('title_for_layout', 'Proyectos Ingeniería Civil Informática | Contact');
		}		

		function send(){
			if (!empty($this->data)) {

				$this->Email->from    = $this->data['sender'];
				$this->Email->to      = 'Alguien más <yerko.palma@usach.cl>';
				$this->Email->subject = $this->data['subject'];
				$this->Email->send( $this->data['message'] );				

        $this->Session->setFlash('Su mensaje ha sido enviado correctamente', 'flash_success');
        $this->redirect(array('action' => 'contact'));
	    } else {
	        // Save logic goes here
	    }
		}
	}
?>