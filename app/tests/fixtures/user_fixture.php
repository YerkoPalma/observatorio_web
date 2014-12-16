<?php
/*
 *	Fixture para probar los usuarios
 */
  class UserFixture extends CakeTestFixture {
		var $name = 'User';
		var $import = 'User';

		//Defino un usuario de cada tipo (luego estos mismos datos estaran en las pruebas de los otros modelos)
		var $records = array(
			//usuario1 y suuario2 son profesores, usuario2 esta inactivo
      array('id' => 1, 'nombre' => 'Usuario1', 'rut' => '11.111.111-1', 'password' => "8843d7f92416211de9ebb963ff4ce28125932878", 'mail' => 'ppablo@mail.com', 'estado' => 'activo'),
      array('id' => 2, 'nombre' => 'Usuario2', 'rut' => '2.222.222-2', 'password' => "", 'mail' => 'ppablo@mail.com', 'estado' => 'inactivo'),
      //usuario3 es estudiante
      array('id' => 3, 'nombre' => 'Usuario3', 'rut' => '3.333.333-3', 'password' => "8843d7f92416211de9ebb963ff4ce28125932878", 'mail' => 'ppablo@mail.com', 'estado' => 'activo'),
      //usuario4 es tutor
      array('id' => 4, 'nombre' => 'Usuario4', 'rut' => '4.444.444-4', 'password' => "8843d7f92416211de9ebb963ff4ce28125932878", 'mail' => 'ppablo@mail.com', 'estado' => 'activo'),
      //usuario5 es inversionista
      array('id' => 5, 'nombre' => 'Usuario5', 'rut' => '5.555.555-5', 'password' => "8843d7f92416211de9ebb963ff4ce28125932878", 'mail' => 'ppablo@mail.com', 'estado' => 'activo'),
      //usuario 6 es visita
      array('id' => 6, 'nombre' => 'Usuario6', 'rut' => '6.666.666-6', 'password' => "8843d7f92416211de9ebb963ff4ce28125932878", 'mail' => 'ppablo@mail.com', 'estado' => 'activo')
      
	  );
  }
  ?>