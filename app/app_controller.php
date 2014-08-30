<?php

	class AppController extends Controller {
		var $components = array('Auth');

    function beforeFilter() {
        //Configure AuthComponent
        $this->Auth->authorize = 'actions';
        $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
        $this->Auth->logoutRedirect = array('controller' => 'pages', 'action' => 'home');
        $this->Auth->loginRedirect = array('controller' => 'pages', 'action' => 'home');
    }
	}
?>