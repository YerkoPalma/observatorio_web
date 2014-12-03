<?php echo $feed->startBlock($type);?>
<?php $array = $feed->feedArray($feeds); ?>
	<?php foreach ($array as $item): ?>
		<?php echo $feed->activityHeader( $item[2], $item[0], $item[1] ); ?>
		<?php if ($type == "social"):?>
			<?php echo $feed->activityBody( $item ); ?>
		<?php else:
			echo "</div>";
			endif;?>
	<?php endforeach; ?>
<?php echo $feed->endBlock();?>
