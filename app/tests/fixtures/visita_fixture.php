<?php
/*
 *	Fixture para probar los tutores
 */
  class VisitaFixture extends CakeTestFixture {
		var $name = 'Visita';
		var $import = 'Visita';

		//Defino un usuario de cada tipo (luego estos mismos datos estaran en las pruebas de los otros modelos)
		var $records = array(
      array ('user_id' => '6', 'id' => 1, 'nombre' => 'Usuario6', 'rut' => '6.666.666-6', 'password' => "8843d7f92416211de9ebb963ff4ce28125932878", 'mail' => 'ppablo@mail.com', 'estado' => 'activo')      
	  );
  }
  ?>