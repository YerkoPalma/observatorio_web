<?php
/*
 *	Fixture para probar los tutores
 */
  class ProfesorFixture extends CakeTestFixture {
		var $name = 'Profesor';
		var $import = 'Profesor';

		//Defino un usuario de cada tipo (luego estos mismos datos estaran en las pruebas de los otros modelos)
		var $records = array(
      array ('user_id' => '1', 'id' => 1, 'nombre' => 'Usuario1', 'rut' => '11.111.111-1', 'password' => "8843d7f92416211de9ebb963ff4ce28125932878", 'mail' => 'ppablo@mail.com', 'estado' => 'activo'),
      array ('user_id' => '2', 'id' => 2, 'nombre' => 'Usuario2', 'rut' => '2.222.222-2', 'password' => "", 'mail' => 'ppablo@mail.com', 'estado' => 'inactivo')      
	  );
  }
  ?>