<!DOCTYPE html >
<html >
<head>
	<?php echo $this->Html->charset(); ?>
  <title><?php echo $title_for_layout?></title>
  <link rel="shortcut icon" href="img/logo_usach.png" type="image/x-icon">
  <!-- Incluir ficheros y scripts externos aquí (Mirar el ayudante HTML para más información -->
  <?php echo $this->Html->css('bootstrap.min'); ?>
  <?php echo $this->Html->css('docs.min'); ?>
  
  <?php echo $this->Html->css('custom'); ?>  
  
  <?php echo $this->Html->script('jquery.min'); ?>
  <?php echo $this->Html->script('bootstrap.min'); ?> 

</head>
<body>

  <!-- Si quieres algún tipo de menú para mostrar en todas tus vistas, incluyelo aquí -->
  <?php echo $this->element('navbar'); ?>
  <div class="container">
    <?php echo $this->Session->flash(); ?>
    <!-- Aquí es donde quiero que se vean mis vistas -->
    <?php echo $content_for_layout ?>
  </div>
  <!-- Añadir un pie de página a cada página mostrada -->
  <?php echo $this->element('sql_dump')?>
  <?php echo $this->element('footer'); ?>
  
</body>
</html>