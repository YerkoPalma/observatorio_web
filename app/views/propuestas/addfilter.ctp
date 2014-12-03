

<?php 
if ( count($propuestas) > 0 ):
echo $this->element('feed', array( 
												"feeds" => array($propuestas),
												"type" => "normal" ) ); 
else:?>
<h2>No se han encontrado resultados</h2>
<?php endif;?>
