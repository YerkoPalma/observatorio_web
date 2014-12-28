<?php
class PropuestasController extends AppController {

	var $name = 'Propuestas';
	var $helpers = array('Html','Feed','Js','Ajax');
	var $components = array('Email','Auth', 'Session', 'RequestHandler', 'Comparador');


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

			if ( $query != "" ){
				$query .= ";";
				$this->set('propuestas', $this->Propuesta->query( $query ));
			}else{
				$this->set('propuestas', $this->Propuesta->find( 'all' ));
			}
		}
	}

	function index() {
		if ( $this->Auth->user() ){
			$this->set('user', current($this->Auth->user()) );
			$this->loadModel('TipoIdea');
			$this->set('tiposIdeas', $this->TipoIdea->find('all') );
			$this->loadModel( 'Profesor' );
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
			$propuestaCandidata = $this->Propuesta->find( 'first', array('conditions' => array('Propuesta.user_id' => $this->Auth->user('id'),
																																													'Propuesta.estado_propuesta_id' => 11)) );
				$this->set('propuestaCandidata', $propuestaCandidata);
			$this->layout = 'connected';
			$this->set('title_for_layout', 'Proyectos Ingeniería Civil Informática | Propuestas');

			$this->loadModel( 'Profesor' );
			
			if ( $this->Profesor->findByRut( $this->Auth->user( 'rut' ) ) ){
				$this->loadModel( 'Estudiante' );
				$this->set('profesor', current($this->Profesor->findByRut( $this->Auth->user( 'rut' ) )) );
				$pendientes = $this->Estudiante->find('count', array('conditions' => array('Estudiante.estado' => 'pendiente')));
				$ideasNuevas = $this->Propuesta->find('count', array('conditions' => array('Propuesta.estado_propuesta_id' => '10')));
				$this->set('pendientes', $pendientes);
				$this->set('nuevasIdeas', $ideasNuevas);
			}

			//si se ha enviado la información
			if ( $this->data ){
				//sacar el user id del user con sesion iniciada
				$this->data['Propuesta']['user_id'] = $this->Auth->user('id');
				//definir el estado de idea como 10 (incompleto) 
				$this->data['Propuesta']['estado_propuesta_id'] = "12";

				$this->Propuesta->create();
				//Debugger::dump($this->data['Propuesta']);
				if ( $this->Propuesta->save( $this->data )){
					$this->Session->setFlash('Correctamente guardado!', 'flash_success');
					$this->redirect(array( 'action' => 'addcanvas', $this->Propuesta->getLastInsertID() ));
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

	function addcanvas(){
		if ( $this->Auth->user() ){
			$this->set('user', current( $this->Auth->user()) );
			$this->layout = 'connected';
			$this->loadModel( 'Profesor' );
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
			if (isset($this->params['propuestaid'])){
				$propuestaid = $this->params['propuestaid'];
			}else{
				$propuestaid = $this->data['Propuesta'][0]['propuesta_id'];
			}
			$propuesta = $this->Propuesta->findById($propuestaid); 
			$this->set("propuesta", $propuesta);
			$this->Propuesta->id = $propuestaid;
			//Solo procedemos si la propuesta esta incompleta, sino redirigimos a la propuesta 
			if( $propuesta['Propuesta']['estado_propuesta_id'] == "12" ){

				//si se trata de enviar el formulario
				if ($this->data){
					//guardo cada uno de los conceptos de comparacion
					foreach ($this->data['Propuesta'] as $conceptoComparacion){
						$data = array();
						$data['ConceptoComparacion'] = $conceptoComparacion;
						$data['ConceptoComparacion']['propuesta_id'] = $propuestaid;
						$data['ConceptoComparacion']['comparacion_proyecto_id'] = "0";

						$this->Propuesta->ConceptoComparacion->saveAll($data);
					}
					//actualizo el estado de la propuesta
					$this->Propuesta->saveField('estado_propuesta_id', '10');
					$this->redirect(array('action' => 'index'));
				}
			}else{
				$this->Session->setFlash("asad".$propuestaid, 'flash_warning');
				$this->redirect(array('action' => 'show', $propuestaid));
			}
		}
	}

	function show(){
		$propuesta = $this->Propuesta->findById($this->params['pass'][0]); 
		$this->set("propuesta", $propuesta);
		$this->set("user", current($this->Auth->user()) );
		$this->layout = 'connected';
		$this->loadModel( 'Profesor' );
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
	}

	function edit($id){
		if ($this->Auth->user()){
				$this->set('user', current($this->Auth->user()) );
				$this->layout = 'connected';
				$this->set('tiposIdeas', $this->Propuesta->TipoIdea->find('all'));

				$this->loadModel( 'Profesor' );
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

				$this->Propuesta->id = $id;
				$propuesta = $this->Propuesta->read();
				#solo puedo editar mis propias propuestas
				if ($this->Auth->user('id') == $propuesta['User']['id']){	
					#si solo se esta leyendo la página				
					if (empty($this->data)) {
	          $this->data = $this->Propuesta->read();
	          $this->set('propuesta', $this->Propuesta->read());
	          #si se POSTeo la información para editar
	        }else{

	        	#preparamos los datos de la propuesta
	        	$this->data['Propuesta']['id'] = $id;
	        	$this->data['Propuesta']['user_id'] = $this->Auth->user('id');
	        	if($this->Propuesta->save($this->data)){

	        		#ahora preparamos los datos de los conceptos de comparacion
	        		foreach ($this->data['ConceptoComparacion'] as $concepto) {
	        			$this->data['ConceptoComparacion'] = $concepto;
	        			$this->data['ConceptoComparacion']['descripcion_concepto_comparacio'] = trim($concepto['descripcion_concepto_comparacio']);

	        			$this->data['ConceptoComparacion']['propuesta_id'] = $id;
								$this->data['ConceptoComparacion']['comparacion_proyecto_id'] = "0";

								$this->Propuesta->ConceptoComparacion->saveAll( $this->data );
	        		}
		        	$this->redirect(array('action' => 'show', $id));
		        }else{
		        	$this->Session->setFlash("ups","flash_warning");
		        	$this->redirect(array('action' => 'index'));
		        }
	        }

	      }else{
	      	$this->set('propuestas', $this->Propuesta->findAllByUserId($this->Auth->user('id')));
	      }
			}
		}

		#funcion para mostrar la pagina de comparacion
		function comparar($id1 = NULL){
			
			$this->set("user", current($this->Auth->user()) );
			$this->layout = 'connected';
			$this->loadModel( 'Profesor' );
			$propuestaCandidata = $this->Propuesta->find( 'first', array('conditions' => array('Propuesta.user_id' => $this->Auth->user('id'),
																																													'Propuesta.estado_propuesta_id' => 11)) );
				$this->set('propuestaCandidata', $propuestaCandidata);
			if ( $this->Profesor->findByRut( $this->Auth->user( 'rut' ) ) ){
				$this->loadModel( 'Estudiante' );
				$this->set('profesor', current($this->Profesor->findByRut( $this->Auth->user( 'rut' ) )) );
				$pendientes = $this->Estudiante->find('count', array('conditions' => array('Estudiante.estado' => 'pendiente')));
				$ideasNuevas = $this->Propuesta->find('count', array('conditions' => array('Propuesta.estado_propuesta_id' => '10')));
				$propuestas = $this->Propuesta->find('all', array('conditions' => array('Propuesta.estado_propuesta_id' => '10')));
				$this->set('pendientes', $pendientes);
				$this->set('nuevasIdeas', $ideasNuevas);
				$this->set('propuestas', $propuestas);				
			}else{
				$this->Session->setFlash("Solo los profesores pueden comparar propuestas", "flash_warning");
				$this->redirect(array("action" => "index"));
			}
		}

		function compare($id){
			//si efectivamente se desea comparar una 
			if( !is_null($id) && $this->RequestHandler->isAjax()){
				//Primero preparo los datos para comparar
				$this->Propuesta->id = $id;
				$propuesta = $this->Propuesta->read();
				$conceptos = $propuesta['ConceptoComparacion'];
				foreach ($conceptos as $concepto) {
					$propuestaObjetivo[trim(strtolower($concepto['titulo_concepto_comparacion']))] = explode(",", $concepto['tags']);
				}
				$propuestaObjetivo['descripcion'] = explode(",", $propuesta['Propuesta']['palabras_clave']);

				//por seguridad, borro las variables antes usadas
				//unset($propuesta);
				//unset($conceptos);					

				//ahora preparo el resto de las propuestas
				$propuestas = $this->Propuesta->find('all');
				$propuestasFormateadas = array();
				foreach ($propuestas as $propuesta) {
					//evito compararme conmigo mismo
					if($propuesta['Propuesta']['id'] != $id && $propuesta['Propuesta']['estado_propuesta_id'] != 12){
						$conceptos = $propuesta['ConceptoComparacion'];
						foreach ($conceptos as $concepto) {
							$nuevaPropuesta[trim(strtolower($concepto['titulo_concepto_comparacion']))] = explode(",", $concepto['tags']);
						}
						$nuevaPropuesta['descripcion'] = explode(",", $propuesta['Propuesta']['palabras_clave']);
						//asigno el id solo para identificarla luego de compararla
						$nuevaPropuesta['id'] = $propuesta['Propuesta']['id'];
						array_push($propuestasFormateadas, $nuevaPropuesta);
					}
				}
				$this->set('propuesta', $propuestaObjetivo);
				$this->set('propuestasFormateadas', $propuestasFormateadas);

				//unset($propuestas);

				//ahora hago la comparacion
				if( $this->Propuesta->find('all', array('conditions' => array('Propuesta.estado_propuesta_id <>' => '12', 'Propuesta.id <>' => $id))) ){
					$best = 0;
					$propuestaSimilar = array();
					foreach ($propuestasFormateadas as $propuesta) {
						if ($this->Comparador->compare($propuestaObjetivo, $propuesta) > $best){
							$best = $this->Comparador->compare($propuestaObjetivo, $propuesta);
							$propuestaSimilar = $this->Propuesta->findById($propuesta['id']);
						}
					}
					$this->set('best', $best);
					$this->set('propuestaSimilar', $propuestaSimilar);
				}else{
					$this->set('warning', "Lamentablemente no existen más propuestas con las que comparar");
				}
			}
		}

		function aceptar($id){
			#evito que me pida una vista para esta accion
      $this->autoRender = false;
      $propuestaCandidata = $this->Propuesta->find( 'first', array('conditions' => array('Propuesta.user_id' => $this->Auth->user('id'),
																																													'Propuesta.estado_propuesta_id' => 11)) );
				$this->set('propuestaCandidata', $propuestaCandidata);
			$propuesta = $this->Propuesta->findById($id);
			if( $propuesta['Propuesta']['estado_propuesta_id'] == 10 ){
				$this->Propuesta->id = $id;
				$this->Propuesta->saveField('estado_propuesta_id', 11);
			}
			$this->redirect(array('action' => 'comparar'));
		}
}
?>