<?php

class DocumentoGenerico extends AppModel{
	var $name = 'DocumentoGenerico';	  
	var $belongsTo = array(
    'Pauta' => array(
      'className'   => 'Pauta',
      'foreignKey'  => 'pauta_id'
      )
    );
  var $hasMany = array(
    'ProyectoDocumento' => array(
      'className' => 'ProyectoDocumento',
      'foreignKey' => 'documento_generico_id'));
  var $validate = array(  );
}
?>