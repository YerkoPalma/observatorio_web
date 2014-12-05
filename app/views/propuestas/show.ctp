<div class="jumbotron">
  <h1><?php echo $propuesta['Propuesta']['nombre_propuesta']; ?></h1>
  <p><?php echo $propuesta['Propuesta']['descripcion_propuesta']?></p>
  <?php $tags = explode(",", $propuesta['Propuesta']['palabras_clave']); ?>
  <p>
  <?php	foreach ($tags as $tag): ?>  		
  	<span class="badge"><?php echo $tag; ?></span>
  <?php endforeach; ?>
 	</p>
</div>
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
<?php foreach ($propuesta['ConceptoComparacion'] as $concepto): ?>
	<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="<?php echo $concepto['titulo_concepto_comparacion']."header";?>">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#<?php echo $concepto['titulo_concepto_comparacion'];?>" aria-expanded="true" aria-controls="<?php echo $concepto['titulo_concepto_comparacion'];?>">
          <?php echo $concepto['titulo_concepto_comparacion'];?>
        </a>
      </h4>
    </div>
    <div id="<?php echo trim($concepto['titulo_concepto_comparacion']);?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="<?php echo $concepto['titulo_concepto_comparacion']."header";?>">
      <div class="panel-body">
        <?php echo $concepto['descripcion_concepto_comparacio'];?>
        <p>
        <?php $tagsConcepto = explode(",", $concepto['tags']);
        	foreach ($tagsConcepto as $tagConcepto):?>
        		<span class="badge"><?php echo $tagConcepto; ?></span>
        <?php	endforeach;?>
        </p>
      </div>
    </div>
  </div>
<?php endforeach;?>
  
</div>
