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
      <?php if( $this->Session->read('current_user') ):
        $user = current($this->Session->read('current_user'));
        $avatar = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $user['mail'] ) ) ) . "&s=40";
        
        ?>

        <ul class="nav navbar-nav navbar-right online-usr">
          <li class="avatar">
            <img src="<?php echo $avatar; ?>" alt="" class="img-circle" />
            <?php echo $this->Html->link($user['nombre'], array('controller' => 'users', 'action' => 'show', $user['users_id'])); ?>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-cog"></span> <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="#">Action</a></li>
              <li><a href="#">Another action</a></li>
              <li><a href="#">Something else here</a></li>
              <li class="divider"></li>
              <li><?php echo $this->Html->link('Salir', array('controller' => 'users', 'action' => 'logout'))?></li>
            </ul>
          </li>
                
        </ul>
      
      <?php else: ?>  
      <ul class="nav navbar-nav navbar-right">
        <li><?php echo $this->Html->link('Home', array('controller' => 'pages', 'action' => 'home'))?></li>
        <li><?php echo $this->Html->link('Help', array('controller' => 'pages', 'action' => 'help'))?></li>
        <li><?php echo $this->Html->link('Login', array('controller' => 'users', 'action' => 'login'))?></li>
      </ul>
    <?php endif;?>
    </div><!--/.nav-collapse -->
  </div>
</div>