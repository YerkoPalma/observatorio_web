<?php if (isset($warning)):?>
	<?php echo $warning; ?>
<?php else:?>
<div class="jumbotron">
  <h3>La propuesta más parecida es <?php echo $propuestaSimilar['Propuesta']['nombre_propuesta'];?></h3>
  <?php $avatar = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $propuestaSimilar['User']['mail'] ) ) ) . "&s=40"; ?>
  <div class="row">
	  <div class="col-sm-6 col-md-6">
	    <div class="thumbnail">
	      <img src="<?php echo $avatar?>" alt="...">
	      <div class="caption">
	        <h4><?php echo $propuestaSimilar['Propuesta']['nombre_propuesta'];?></h4>
	        <p><b>Autor:</b> <?php echo $propuestaSimilar['User']['nombre'];?></p>
	        <p><?php echo $propuestaSimilar['Propuesta']['descripcion_propuesta'];?></p>	        
	      </div>
	    </div>
	  </div>
	  <div class="well col-sm-6 col-md-6">
	  	<h4>Esta propuesta tiene una similitud de</h4>
	  	<p class="lead text-center" style="font-size: 2.5em;"><?php echo $best;?>%</p>
	  </div>
	</div>
</div>
<?php endif; ?>