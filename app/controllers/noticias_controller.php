<?php
class NoticiasController extends AppController {

	var $name = 'Noticias';
	var $helpers = array('Html');
	var $components = array('Email','Auth', 'Session');


	function beforeFilter() {
    parent::beforeFilter();
    $this->Auth->allowedActions = array('*');
	}

	function index() {
	if ( $this->Auth->user() )
			$this->set('user', current($this->Auth->user()) );
		$this->set('title_for_layout', 'Proyectos Ingeniería Civil Informática | Noticias');
	}
}
?>