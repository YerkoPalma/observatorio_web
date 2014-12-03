<?php
class PropuestasController extends AppController {

	var $name = 'Propuestas';
	var $helpers = array('Html','Feed','Js','Ajax');
	var $components = array('Email','Auth', 'Session', 'RequestHandler');


	function beforeFilter() {
    parent::beforeFilter();
    $this->Auth->allowedActions = array('*');
	}	

	function addfilter(){
		if($this->RequestHandler->isAjax()){
			$uname = trim($this->data['Propuesta']['nombre']);
			$tipoidea = trim($this->data['Propuesta']['tipo_idea_id']);
			$nombrepropuesta = trim($this->data['Propuesta']['nombre_propuesta']);
			$tag = trim($this->data['Propuesta']['palabras_clave']);

			$query = "";
			if ( $uname != "" ){
				$query = "SELECT * FROM propuestas p INNER JOIN users u ON p.user_id=u.id AND u.nombre='$uname'";				
			}
			if ( $tipoidea != "" ){
				//solo si se trata de la segunda o más consulta se usa el intersect
				if ( $query != "")
					$query .= " INTERSECT ";
				$query .= "SELECT * FROM propuestas p INNER JOIN users u ON p.user_id=u.id AND p.tipo_idea_id='$tipoidea'";
			}
			if ( $nombrepropuesta != "" ){
				if ( $query != "")
					$query .= " INTERSECT ";
				$query .= "SELECT * FROM propuestas p INNER JOIN users u ON p.user_id=u.id AND p.nombre_propuesta LIKE '%$nombrepropuesta%'";
			}
			if ( $tag != "" ){
				if ( $query != "")
					$query .= " INTERSECT ";
				$query .= "SELECT * FROM propuestas p INNER JOIN users u ON p.user_id=u.id AND p.palabras_clave LIKE '%$tag%'";
			}

			$query .= ";";
			$this->set('propuestas', $this->Propuesta->query( $query ));
		}
	}

	function index() {
		if ( $this->Auth->user() ){
			$this->set('user', current($this->Auth->user()) );
			$this->loadModel('TipoIdea');
			$this->set('tiposIdeas', $this->TipoIdea->find('all') );
			//si existen propuestas las declaramos
			if ( $this->Propuesta->find('all') )
				$this->set('propuestas', $this->Propuesta->find('all'));
			$this->layout = 'connected';
			$this->set('title_for_layout', 'Proyectos Ingeniería Civil Informática | Propuestas');
		}else{
			$this->Session->setFlash('Debes iniciar sesión para poder acceder a las propuestas', 'flash_success');
			$this->redirect(array( 'controller' => 'pages', 'action' => 'home' ));
		}

	}

	function add(){
		if ( $this->Auth->user() ){
			$this->set('user', current($this->Auth->user()) );
			//declarar los tipos de ideaas
			$this->loadModel('TipoIdea');
			$this->set('tiposIdeas', $this->TipoIdea->find('all') );

			$this->layout = 'connected';
			$this->set('title_for_layout', 'Proyectos Ingeniería Civil Informática | Propuestas');

			//si se ha enviado la información
			if ( $this->data ){
				//sacar el user id del user con sesion iniciada
				$this->data['Propuesta']['user_id'] = $this->Auth->user('id');
				//definir el estado de idea como 10 (registrada) 
				$this->data['Propuesta']['estado_propuesta_id'] = "10";

				$this->Propuesta->create();
				//Debugger::dump($this->data['Propuesta']);
				if ( $this->Propuesta->save( $this->data )){
					$this->Session->setFlash('Correctamente guardado!', 'flash_success');
					$this->redirect(array( 'action' => 'index' ));
				}else{
					$this->Session->setFlash('Hubo un error! Verifica nuevamente tus datos', 'flash_warning');
					$this->redirect(array( 'action' => 'add' ));
				}
			}
		//Si no hay usuario registrado no se puede acceder
		}else{
			$this->Session->setFlash('Debes iniciar sesión para poder acceder a las propuestas', 'flash_success');
			$this->redirect(array( 'controller' => 'pages', 'action' => 'home' ));
		}
	}
}
?>