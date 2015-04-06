<!-- <pre><?php echo print_r($proyectos); ?></pre>-->
<?php
	echo $this->element('feed', array( 
												"feeds" => array($proyectos),
												"type" => "normal" ) );
?>
