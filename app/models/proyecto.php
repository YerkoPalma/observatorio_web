<?php
class Proyecto extends AppModel{
	var $name = 'Proyecto';	
  #var $primaryKey = 'users_id';
  #var $hasOne = array('Estudiante', 'Profesor','Tutor','Inversionista','Visita');
  var $hasMany = array(
    'Estudiante' => array(
      'className' => 'Estudiante',
      'foreignKey' => 'proyecto_id'),
    'ProyectoDocumento' => array(
      'className' => 'ProyectoDocumento',
      'foreignKey' => 'proyecto_id')
    );
  var $belongsTo = array(
    'EstadoProyecto' => array(
      'className' => 'EstadoProyecto',
      'foreignKey' => 'estado_proyecto_id'),
    'Pauta' => array(
      'className' => 'Pauta',
      'foreignKey' => 'pauta_id'),
    'Propuesta' => array(
      'className' => 'Propuesta',
      'foreignKey' => 'propuesta_id')
    );
	var $actsAs = array(
    'Upload.Upload' => array(
      'logo' 
    )
  );
}
?>