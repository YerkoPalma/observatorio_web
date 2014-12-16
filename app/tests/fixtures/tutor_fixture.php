<?php
/*
 *	Fixture para probar los tutores
 */
  class TutorFixture extends CakeTestFixture {
		var $name = 'Tutor';
		var $import = 'Tutor';

		//Defino un usuario de cada tipo (luego estos mismos datos estaran en las pruebas de los otros modelos)
		var $records = array(
      array ('user_id' => '4', 'id' => 1, 'nombre' => 'Usuario4', 'rut' => '4.444.444-4', 'password' => "8843d7f92416211de9ebb963ff4ce28125932878", 'mail' => 'ppablo@mail.com', 'estado' => 'activo')      
	  );
  }
  ?>