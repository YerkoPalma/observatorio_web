<!--<pre><?php print_r($this->viewVars);?></pre>-->
<ol class="breadcrumb">
  <li <?php if($pauta_id == 1) echo "class='active'";?>>
  	<?php if($pauta_id != 1):?>
  		<?php echo $html->link('Pauta 1', array('action' => 'pauta', '1', $proyecto['Proyecto']['id']));?>
  	<?php else:?>
  		Pauta 1
  	<?php endif;?>
  </li>
  <li <?php if($pauta_id == 2) echo "class='active'";?>>
  	<?php if($pauta_id != 2):?>
  		<?php echo $html->link('Pauta 2', array('action' => 'pauta', '2', $proyecto['Proyecto']['id']));?>
  	<?php else:?>
  		Pauta 2
  	<?php endif;?>
  </li>
  <li <?php if($pauta_id == 3) echo "class='active'";?>>
  	<?php if($pauta_id != 3):?>
  		<?php echo $html->link('Pauta 3.1', array('action' => 'pauta', '3', $proyecto['Proyecto']['id']));?>
  	<?php else:?>
  		Pauta 3.1
  	<?php endif;?>
  </li>
  <li <?php if($pauta_id == 4) echo "class='active'";?>>
  	<?php if($pauta_id != 4):?>
  		<?php echo $html->link('Pauta 3.2', array('action' => 'pauta', '4', $proyecto['Proyecto']['id']));?>
  	<?php else:?>
  		Pauta 3.2
  	<?php endif;?>
  </li>
  <li <?php if($pauta_id == 5) echo "class='active'";?>>
  	<?php if($pauta_id != 5):?>
  		<?php echo $html->link('Pauta 4', array('action' => 'pauta', '5', $proyecto['Proyecto']['id']));?>
  	<?php else:?>
  		Pauta 4
  	<?php endif;?>
  </li>
  <li <?php if($pauta_id == 6) echo "class='active'";?>>
  	<?php if($pauta_id != 6):?>
  		<?php echo $html->link('Pauta 5', array('action' => 'pauta', '6', $proyecto['Proyecto']['id']));?>
  	<?php else:?>
  		Pauta 5
  	<?php endif;?>
  </li>
  <li <?php if($pauta_id == 7) echo "class='active'";?>>
  	<?php if($pauta_id != 7):?>
  		<?php echo $html->link('Pauta 6', array('action' => 'pauta', '7', $proyecto['Proyecto']['id']));?>
  	<?php else:?>
  		Pauta 6
  	<?php endif;?>
  </li>
  <li <?php if($pauta_id == 8) echo "class='active'";?>>
  	<?php if($pauta_id != 8):?>
  		<?php echo $html->link('Pauta 7', array('action' => 'pauta', '8', $proyecto['Proyecto']['id']));?>
  	<?php else:?>
  		Pauta 7
  	<?php endif;?>
  </li>
</ol>