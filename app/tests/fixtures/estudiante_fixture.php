<?php
/*
 *	Fixture para probar los tutores
 */
  class EstudianteFixture extends CakeTestFixture {
		var $name = 'Estudiante';
		var $import = 'Estudiante';

		//Defino un usuario de cada tipo (luego estos mismos datos estaran en las pruebas de los otros modelos)
		var $records = array(
      array ('user_id' => '3', 'id' => 1, 'nombre' => 'Usuario3', 'rut' => '3.333.333-3', 'password' => "8843d7f92416211de9ebb963ff4ce28125932878", 'mail' => 'ppablo@mail.com', 'estado' => 'activo')      
	  );
  }
  ?>