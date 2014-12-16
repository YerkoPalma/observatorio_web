<?php
/*
 *	Fixture para probar los tutores
 */
  class InversionistaFixture extends CakeTestFixture {
		var $name = 'Inversionista';
		var $import = 'Inversionista';

		//Defino un usuario de cada tipo (luego estos mismos datos estaran en las pruebas de los otros modelos)
		var $records = array(
      array ('user_id' => '5', 'id' => 1, 'nombre' => 'Usuario5', 'rut' => '5.555.555-5', 'password' => "8843d7f92416211de9ebb963ff4ce28125932878", 'mail' => 'ppablo@mail.com', 'estado' => 'activo')    
	  );
  }
  ?>