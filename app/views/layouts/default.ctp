<!DOCTYPE html >

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
  <?php echo $this->Html->script('script'); ?>
  <?php if ($title_for_layout == "Proyectos Ingeniería Civil Informática | Help") {
      echo $this->Html->css('reset');
      echo $this->Html->css('style');
      echo $html->script('modernizr');
    }?>
  <?php #echo $html->script('prototype'); ?>
  <?php #echo $html->script('scriptaculous'); ?>

</head>
<body>

  <!-- Si quieres algún tipo de menú para mostrar en todas tus vistas, incluyelo aquí -->
  <?php echo $this->element('navbar'); ?>
  <div class="container">
    <?php echo $this->Session->flash(); ?>
    <!-- Aquí es donde quiero que se vean mis vistas -->
    <?php echo $content_for_layout ?>
    <?php #Debugger::dump($user);?>
    <?php #Debugger::dump( $this->Auth->user() );?>
    <?php echo $this->element('change_password_modal');?>
  </div>

  <!-- Añadir un pie de página a cada página mostrada -->
  <?php echo $this->element('sql_dump')?>
  <?php echo $this->element('footer'); ?>
  
</body>

</html>