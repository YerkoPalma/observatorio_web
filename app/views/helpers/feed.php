<?php

class FeedHelper extends AppHelper {
  var $helpers = array('Time', 'Html');

	/*
	 *	Función que inicia un bloque de feed, dependiendo del tipo de feed que se crea
	 */
  function startBlock($type) {

  	//si el tipo es social
    if ($type == "social"){
  		//genero los elementos con clase 'social'
      return $this->output("<section id=\"feeds\" class=\"feeds social\">");
    //sino
    }else{
  		//genero los elementos con clase 'no-social'
      return $this->output("<section id=\"feeds\" class=\"feeds normal\">");
    }
  }

  /*
	 *	Función que cierra un bloque de feed
   */
  function endBlock(){ 
  	
  	//cierro los elementos 
    return $this->output("</section>");	
  }

  /*
   *	Función que genera el encabezado de una feed
   */
  function activityHeader($action, $user, $data){

  	//Dependiendo del tipo de $action
  	//genero un $mensaje    
    if ($action == "Proyecto"){
      $linkPropuesta = $this->Html->link($data['nombre_proyecto'],array('controller' => 'proyectos', 'action' => 'pauta', 1, $data['id']));
      $nombre = $data['nombre_proyecto'];
    }else{
    $link = $this->Html->link($user['nombre'],array('controller' => 'users', 'action' => 'show', $user['id']));
    $linkPropuesta = $this->Html->link($data['nombre_propuesta'],array('controller' => 'propuestas', 'action' => 'show', $data['id']));
    $nombre = $user['nombre'];
    }
    

    if ( $action == "Propuesta" ){
      $msg = $link . " Ha publicado una nueva propuesta.";
    } elseif ( $action == "Noticia" ){
      $msg = $link . " Reviso una noticia.";
    } elseif ( $action == "Proyecto" ){
      $msg = "¡Hay un nuevo proyecto!";
    }  

    if ( $action == "Proyecto" ){
      $avatar = APP_PATH . 'files/proyecto/logo/'. $data['id'].'/' . $data['logo'];
    }else{
      $avatar = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $user['mail'] ) ) ) . "&s=40";
    }
    
    $timeAgo = $this->Time->timeAgoInWords($data['created']);    
    

  	//preparo e imprimo los datos del usuario
  	//junto con el mensaje   	
    return $this->output("
      <div class=\"feed\">
        <div class=\"feed-header media\">
          <a class=\"media-left\" href=\"#\">
            <img class=\"img-thumbnail\" src=\"$avatar\" alt=\"$nombre\">
          </a>
          <div class=\"media-body\">
            <h4 class=\"media-heading\">$msg $linkPropuesta</h4>
            <p>$timeAgo</p>
          </div>
        </div>    
      ");
  }

  /*
   *	Función que genera el cuerpo de una feed
   */
  function activityBody($content){  

  	//Si $content es un array
    if(is_array($content)){
    	//De acuerdo a la segunda llave $key, que indica el tipo de dato que es, si noticia, idea o proyecto
      if ($content[2] == "Propuesta"){
        //Cada tipo de dato, se muestra distinto
        //y tiene distintos campos  
        $desc = $content[1]['descripcion_propuesta'];
        $name = $content[1]['nombre_propuesta'];
        $linkPropuesta = $this->Html->link($name,array('controller' => 'propuestas', 'action' => 'show', $content[1]['id']));;
        return $this->output("
          <blockquote>
            <p>$desc</p>
            <footer>$linkPropuesta</footer>
          </blockquote>
          </div>
          ");
      }
    	
    }  
  }   
  
  /*
   *	Functión que crea el array que tendra toda la información de las feed
   *	Util principalmente para las feed mezcladas (home)
   */
  function feedArray($dataArray, $orderByModified = false){

    if ( is_array($dataArray) ){
      foreach ($dataArray as $data){
        //Si $data es un array
        if( is_array($data) ){
          //creo dos arreglos vacios $feedArray 
          $feedArray = array();
          
          //por cada elemento de $data como $item
          foreach ($data as $item) {
            //y $feedSingle
            $feedSingle = array();
            //agrego ese usuario a $feedSingle
            if ( isset($item['User']) ){
              $tmpUser = $item['User'];
            }else{
              if (isset($item['Estudiante'])){
                $tmpUser = array();
                foreach ($item['Estudiante'] as $estudiante) {
                  $tmpStudent = array(
                    'id' => $estudiante['id'],
                    'nombre' => $estudiante['nombre'],
                    'rut' => $estudiante['rut'],
                    'mail' => $estudiante['mail'],
                    'estado' => $estudiante['estado']
                    );
                  array_push($tmpUser, $tmpStudent);
                }
              }
            }

            array_push($feedSingle, $tmpUser);
    
            //Luego agrego lo que quede de $item a $feedSingle
            foreach ($item as $key => $value) {
    
              //se agregan solo las propuestas, noticias y proyectos por ahora
              if ($key == "Propuesta" || $key == "Noticia" || $key == "Proyecto"){
                $tmpItem = array($key => $value);                
                array_push($feedSingle, $value);
                array_push($feedSingle, $key);
              }          
            }
            /*
              Al final deberia tener algo así
              $feedSingle = array(
                $user => array(),
                $item => array()
              );
            */
    
            //Por ultimo agrego $feedSingle a $feedArray
            array_push($feedArray, $feedSingle);
            //Limpio $feedSingle
            unset($feedSingle);
          }
          
          //antes de retornar el array lo ordeno por fecha de creación si $orderByModified = false
          $feedArray = $this->sortByDate( $feedArray, $orderByModified );          
    
          //retorno $feedArray
          return array_reverse( $feedArray );
        }
      }
    }
  }

  /*
   *  Función que ordena por fecha de creación o modificación
   */
  function sortByDate($array, $byModified){
    // find array size
    $length = count($array);
    $key = $byModified ? 'created' : 'modified';
    
    // base case test, if array of length 0 then just return array to caller
    if($length <= 1){
      return $array;
    }
    else{
    
      // select an item to act as our pivot point, since list is unsorted first position is easiest
      $pivot = $array[0];
      
      // declare our two arrays to act as partitions
      $left = $right = array();
      
      // loop and compare each item in the array to the pivot value, place item in appropriate partition
      for($i = 1; $i < count($array); $i++)
      {
        if( $this->dateCompare($array[$i], $pivot, $key) ){
          $left[] = $array[$i];
        }
        else{
          $right[] = $array[$i];
        }
      }
      
      // use recursion to now sort the left and right lists
      return array_merge($this->sortByDate($left, $byModified), array($pivot), $this->sortByDate($right, $byModified));
    }
  }

  function dateCompare($array1, $array2, $key){

    /*
      (
          [0] => año
          [1] => mes
          [2] => día
      )
    */
    $tmp1 = explode("-",$array1[1][$key]);
    $tmp2 = explode("-",$array2[1][$key]);
    
    if( $tmp1[0] != $tmp2[0] ){
      return ($tmp1[0] < $tmp2[0]) ? true : false;
    } elseif ($tmp1[1] != $tmp2[1]){
      return ($tmp1[1] < $tmp2[1]) ? true : false;
    } elseif ($tmp1[2] != $tmp2[2]){
      return ($tmp1[2] < $tmp2[2]) ? true : false;
    }

    return false;
  }
}

?>