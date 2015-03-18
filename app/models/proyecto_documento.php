<?php

class ProyectoDocumento extends AppModel{
	var $name = 'ProyectoDocumento';	  
	var $belongsTo = array(
    'Proyecto' => array(
      'className'   => 'Proyecto',
      'foreignKey'  => 'proyecto_id'
      ),
    'DocumentoGenerico' => array(
    	'className' => 'DocumentoGenerico',
    	'foreignKey' => 'documento_generico_id')
    );
	var $actsAs = array(
    'Upload.Upload' => array(
      'documento'
    )
  );
  var $validate = array(  );
}
?>