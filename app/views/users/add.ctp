<?php 
	echo $form->create('User');
  echo $form->input('nombre');
  echo $form->input('mail');
  echo $form->input('rut');
  echo $form->input('contrasena', array('type' => 'password'));
  echo $form->input('password_confirm', array('type' => 'password'));
  echo $form->end('Registrarse');
?>