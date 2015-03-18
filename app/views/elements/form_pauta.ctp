<?php 
  switch ($pauta_id) {
    case 1:
      echo $this->element('form_pauta_1');
      break;
    case 2:
      echo $this->element('form_pauta_2');
      break;
    case 3:
      echo $this->element('form_pauta_3');
      break;
    case 4:
      echo $this->element('form_pauta_4');
      break;
    case 5:
      echo $this->element('form_pauta_5');
      break;
    case 6:
      echo $this->element('form_pauta_6');
      break;
    case 7:
      echo $this->element('form_pauta_7');
      break;
    case 8:
      echo $this->element('form_pauta_8');
      break;
    default:
      
      break;
  }
?>