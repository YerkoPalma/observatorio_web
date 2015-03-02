<?php
class ProyectosController extends AppController {

	var $name = 'Proyectos';
	var $helpers = array('Html');
	var $components = array('Auth', 'Session');


	function beforeFilter() {
    parent::beforeFilter();
    $this->Auth->allowedActions = array('*');
	}

	function add($id){
		if($this->Auth->user()){
			$this->set('user', current($this->Auth->user()) );
			$this->layout = 'connected';
			$this->loadModel( 'Propuesta' );
			$propuestaCandidata = $this->Propuesta->find( 'first', array('conditions' => array('Propuesta.user_id' => $this->Auth->user('id'),
																																													'Propuesta.estado_propuesta_id' => 11)) );
			$this->set('propuestaCandidata', $propuestaCandidata);
			$this->set('estudiantes', $this->Propuesta->User->Estudiante->find('all'));
			
			$this->set( 'estudiante', $this->Propuesta->User->Estudiante->findById( $this->Auth->user('id') ));
			//Si es que la propuesta pertenece al usuario que inicio sesion y esta aprobada
			if( $propuestaCandidata['Propuesta']['id'] == $id ){
				//si se ingreso el nombre de los estudiantes
				if( $this->data){
								
					$this->Proyecto->create();

					//preparo los datos del proyecto
					$this->data['Proyecto']['estado_proyecto_id'] = 3; //Perfil de proyecto
					$this->data['Proyecto']['nombre_proyecto'] = trim($propuestaCandidata['Propuesta']['nombre_propuesta']);
					$this->data['Proyecto']['descripcion_proyecto'] = trim($propuestaCandidata['Propuesta']['descripcion_propuesta']);

					if( $this->Proyecto->save( $this->data ) ){

						//inscribo a los estudiantes que estan en el proyecto
						foreach ($this->data['Proyecto']['estudiante_id'] as $id) {
							$this->Propuesta->User->Estudiante->id = $id;
							$this->Propuesta->User->Estudiante->saveField("proyecto_id", $this->Proyecto->getLastInsertID() );
						}

						//Luego de guardar la información de mis compañeros guardo la mia
						$this->Propuesta->User->Estudiante->id = $this->Propuesta->User->Estudiante->field("id", array("user_id" => $this->Auth->user('id')));
						$this->Propuesta->User->Estudiante->saveField("proyecto_id", $this->Proyecto->getLastInsertID() );

						$this->Propuesta->id = $propuestaCandidata['Propuesta']['id'];
						$this->Propuesta->saveField("estado_propuesta_id", 3);

						$this->Session->setFlash(":)", "flash_success");
						$this->redirect(array("controller" => "pages", "action" => "home"));
					}else{
						$this->Session->setFlash($this->data, "flash_warning");
						$this->redirect(array("controller" => "pages", "action" => "home"));
					}
				}
			}else{
				$this->Session->setFlash("No puedes ingresar aquí", "flash_warning");
				$this->redirect(array("controller" => "pages", "action" => "home"));
			}
		}else{
			$this->Session->setFlash("No puedes ingresar aquí, debes iniciar sesión primero", "flash_warning");
			$this->redirect(array("controller" => "pages", "action" => "home"));
		}
	}

	function pauta($id_user, $pauta){
		if ( $this->Auth->user() ){
			$this->set('user', current($this->Auth->user()) );
			$this->loadModel( 'Profesor' );
			$this->loadModel( 'Propuesta' );
			$this->loadModel( 'Estudiante' );
			$this->layout = "connected";
			$this->set( 'estudiante', $this->Estudiante->findById( $this->Auth->user('id') ));
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
			
		}
	}
	
}
?>