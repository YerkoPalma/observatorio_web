
<div class="list-group">
<?php foreach ($estudiantes as $estudiante): ?>
	<?php $avatar = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $estudiante['Estudiante']['mail'] ) ) ) . "&s=40"; ?>
	<a class="list-group-item" href=<?php echo $html->url(array('controller' => "users", "action" => "show", $estudiante['Estudiante']['user_id'])); ?>>
		<div class="row">
			<div class="col-md-2">
				<img src="<?php echo $avatar; ?>" alt="" class="img-rounded" />
			</div>
			<div class="col-md-10">
				<h4 class="list-group-item-heading"><?php echo $estudiante['Estudiante']['nombre']; ?><small><?php echo $estudiante['Estudiante']['estado'];?></small></h4>
				
				<?php if ( isset($estudiante['Propuesta']) ):?>
				<ul class="list-inline list-group-item-text">					
					<?php foreach ($estudiante['Propuesta'] as $propuesta):?> 
						<li><u>
						<?php echo $propuesta['nombre_propuesta'] ; ?>
						</u></li>
					<?php endforeach;?>					
				</ul>
				<?php endif;?>

				<?php if ( isset($estudiante['Proyecto']) ): ?>

				<?php endif;?>
				
			</div>
		</div>
	</a>

<?php endforeach;?>
</div>