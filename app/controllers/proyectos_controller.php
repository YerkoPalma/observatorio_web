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

	function pauta($pauta_id = null, $proyecto_id = null){
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
			$proyecto = $this->Proyecto->findById($proyecto_id);
			$this->set('proyecto', $proyecto);
			$pauta = $this->Proyecto->Pauta->findById($pauta_id);
			$editable = $pauta['Pauta']['editable'];
			$this->set('pauta_id', $pauta_id);
			$this->set('editable', $editable);
			
			if ( $this->Profesor->findByRut( $this->Auth->user( 'rut' ) ) ){
				
				$this->set('profesor', current($this->Profesor->findByRut( $this->Auth->user( 'rut' ) )) );
				$pendientes = $this->Estudiante->find('count', array('conditions' => array('Estudiante.estado' => 'pendiente')));
				$ideasNuevas = $this->Propuesta->find('count', array('conditions' => array('Propuesta.estado_propuesta_id' => '10')));
        $this->set('pendientes', $pendientes);
        $this->set('nuevasIdeas', $ideasNuevas);
			}

			#Si se esta editando una pauta, primero evaluo qué pauta es
			if ( $this->data ){
				$pauta_id = $this->data['Proyecto']['pauta_id'];				
				$proyecto_id = $this->data['Proyecto']['proyecto_id'];
				$proyecto = $this->Proyecto->findById($proyecto_id);
				$this->Proyecto->id = $proyecto_id;
				$this->Proyecto->Propuesta->id = $proyecto['Proyecto']['propuesta_id'];
				#$this->Session->setFlash($proyecto['Proyecto']['propuesta_id'], "flash_warning");
				#$this->redirect(array('controller' => 'pages', 'action' => 'home'));
				switch ($pauta_id) {
					case 1:
						#Actualizo el nombre
						$this->Proyecto->saveField("nombre_proyecto", $this->data['Proyecto']['nombre_proyecto']);
						
						#Actualizo el tipo
						$this->Proyecto->Propuesta->saveField("tipo_idea_id", $this->data['Propuesta']['tipo_idea_id']);

						#Actualizo la descripción
						$this->Proyecto->saveField("descripcion_proyecto", $this->data['Proyecto']['descripcion_proyecto']);
						
						#Actualizo el logo						
						$this->Proyecto->saveField("logo", $this->data['Proyecto']['logo']);

						#Agrego el informe
						#Si ya existe el documento del proyecto
						if ( $this->Proyecto->ProyectoDocumento->findByProyectoId( $proyecto_id ) ){
							if ( isset($this->data['ProyectoDocumento']['documento']) && $this->data['ProyectoDocumento']['documento'] != ""){
								$proyectoDocumento = $this->Proyecto->ProyectoDocumento->findByProyectoId( $proyecto_id);
								$this->Proyecto->ProyectoDocumento->id = $proyectoDocumento['ProyectoDocumento']['id'];
								$this->Proyecto->ProyectoDocumento->saveField("documento", $this->data['ProyectoDocumento']['documento']);
								#$this->Proyecto->ProyectoDocumento->saveField("documento_dir", (string)$this->data['ProyectoDocumento']['documento_dir']);
								$this->Proyecto->ProyectoDocumento->saveField("documento_generico_id", $pauta_id);
							}
							$this->Session->setFlash("¡tus datos han sido modificados exitosamente!", "flash_success");
        		
							$this->redirect(array('controller' => 'pages', 'action' => 'home'));
						}else{
							$this->data['ProyectoDocumento']['proyecto_id'] = $proyecto_id;
							$this->Proyecto->ProyectoDocumento->create();
							$this->Proyecto->ProyectoDocumento->save( $this->data );
							$this->Session->setFlash("¡tus datos han sido modificados exitosamente!", "flash_success");
        		
							$this->redirect(array('controller' => 'pages', 'action' => 'home'));
						}

						break;
					
					default:
						$this->Session->setFlash("Default action", "flash_warning");
        		$this->redirect(array('controller' => 'pages', 'action' => 'home'));
						break;
				}			
			}
		}
	}
	
	/**
	 * Función que maneja el panel de control del profesor
	 * @return Redirect
	 */
	function admin(){
		$this->loadModel( 'Profesor' );
		if ( $this->Auth->user() && $this->Profesor->findByRut( $this->Auth->user( 'rut' ) )){
			$this->set('user', current($this->Auth->user()) );
			
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

        $idPauta = $this->Proyecto->field('pauta_id');
        if( isset($idPauta) && $idPauta > 0 ){
        	$this->set('pauta', $this->Proyecto->Pauta->findById($idPauta));
        }

        if ( $this->data ){
        	$this->set('data', $this->data);
        	$pautaActual = $this->data['Proyecto']['Pauta'];
        	if (( isset($pautaActual) ) && ( $pautaActual > 0 )){
        		$editable = (isset($this->data['Proyecto']['Editable']) && $this->data['Proyecto']['Editable'] == 1 ? 'true' : 'false');
        		$oldeditable = (isset($this->data['Proyecto']['OldEditable']) && $this->data['Proyecto']['OldEditable'] == 1 ? 'true' : 'false');
        		$programable = (isset($this->data['Proyecto']['Programar']) && $this->data['Proyecto']['Programar'] == 1 ? 'true' : 'false');
        		$fechaCierre = (isset( $this->data['Proyecto']['FechaCierre'] ) ? $this->data['Proyecto']['FechaCierre'] : "");
        		#Marco en todos los proyectos la pauta actual, esto fallara cuando hayan proyectos de semestres anteriores
        		$this->Proyecto->updateAll(array('Proyecto.pauta_id' => $pautaActual), true);
        		$this->Proyecto->Pauta->updateAll(array('Pauta.editable' => 'false'), true );
        		#Marco como editable/no editable  la pauta actual
        		$this->Proyecto->Pauta->updateAll(array('Pauta.editable' => $editable), array('Pauta.id' => $pautaActual) );
        		#Marco como editable/no editable las pautas anteriores
        		$this->Proyecto->Pauta->updateAll(array('Pauta.editable' => $oldeditable), array('Pauta.id <' => $pautaActual) );

        		if (isset($this->data['Proyecto']['Programar']) && $this->data['Proyecto']['Programar'] == 1) {
        			$this->Proyecto->Pauta->id = $pautaActual;
        			$this->Proyecto->Pauta->saveField("fecha_cierre", $fechaCierre);
        		}else{
        			$this->Proyecto->Pauta->id = $pautaActual;
        			$this->Proyecto->Pauta->saveField("fecha_cierre", "");
        		}
        		$this->Session->setFlash("Datos actualizados", "flash_success");
        		$this->redirect($this->referer());
        	}else{
        		$this->Session->setFlash("Debes indicar la pauta actual", "flash_warning");
        		$this->redirect($this->referer());
        	}
        }
			}			
		}else{
			$this->Session->setFlash("No puedes acceder acá", "flash_warning");
      $this->redirect(array('controller' => 'pages', 'action' => 'home'));
		}
	}
}
?>