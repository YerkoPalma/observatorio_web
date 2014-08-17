<!-- Fixed navbar -->
<div class="navbar navbar-default navbar-fixed-top navbar-inverse" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <?php 
        $homeIcon = $this->Html->tag('span', '', array('class' => 'glyphicon glyphicon-home'));
        echo $this->Html->link($homeIcon.' Observatorio Piinfo',
        array('controller' => 'pages',
              'action' => 'home'),
        array('class' => 'navbar-brand',
              'escape' => false)) ?> 
    </div>
    <div class="navbar-collapse collapse">
      
      <ul class="nav navbar-nav navbar-right">
        <li><?php echo $this->Html->link('Home', array('controller' => 'pages', 'action' => 'home'))?></li>
        <li><?php echo $this->Html->link('Help', array('controller' => 'pages', 'action' => 'help'))?></li>
        <li><?php echo $this->Html->link('Login', array('controller' => 'users', 'action' => 'login'))?></li>
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</div>