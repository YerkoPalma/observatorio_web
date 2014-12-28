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
		
	}
	
}
?>