<h1>Edit Post</h1>
<?php
    echo $this->Form->create('User', array('action' => 'edit'));
    echo $this->Form->input('nombre');
    echo $this->Form->input('mail');
    echo $this->Form->input('users_id', array('type' => 'hidden'));
    echo $this->Form->end('Save Post');    
?>
