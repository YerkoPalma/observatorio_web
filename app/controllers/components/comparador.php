<?php

Class JW {
  /*
    version 1.3

    Copyright (c) 2005-2013  Ivo Ugrina <ivo@iugrina.com>

    A PHP library implementing Jaro and Jaro-Winkler
    distance, measuring similarity between strings.

    Theoretical stuff can be found in:
    Winkler, W. E. (1999). "The state of record linkage and current
    research problems". Statistics of Income Division, Internal Revenue
    Service Publication R99/04. http://www.census.gov/srd/papers/pdf/rr99-04.pdf.


    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 3 of the License, or (at
    your option) any later version.

    This program is distributed in the hope that it will be useful, but
    WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
    General Public License for more details.
    
    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.

    ===

    A big thanks goes out to Pierre Senellart <pierre@senellart.com>
    for finding a small bug in the code. Also, thanks goes out to
    Debabrata Kar <debakjr@gmail.com> for help in transition to
    PHP 5.4+.

  */


  function getCommonCharacters( $string1, $string2, $allowedDistance ){
    
    $str1_len = strlen($string1);
    $str2_len = strlen($string2);
    $temp_string2 = $string2;
     
    $commonCharacters='';

    for( $i=0; $i < $str1_len; $i++){
      
      $noMatch = True;

      // compare if char does match inside given allowedDistance
      // and if it does add it to commonCharacters
      for( $j= max( 0, $i-$allowedDistance ); $noMatch && $j < min( $i + $allowedDistance + 1, $str2_len ); $j++){
        if( $temp_string2[$j] == $string1[$i] ){
          $noMatch = False;

      $commonCharacters .= $string1[$i];

      $temp_string2[$j] = '';
        }
      }
    }

    return $commonCharacters;
  }
    
  function Jaro( $string1, $string2 ){
      
    $str1_len = strlen( $string1 );
    $str2_len = strlen( $string2 );
      
    // theoretical distance
    $distance = (int) floor(min( $str1_len, $str2_len ) / 2.0); 
      
    // get common characters
    $commons1 = $this->getCommonCharacters( $string1, $string2, $distance );
    $commons2 = $this->getCommonCharacters( $string2, $string1, $distance );
      
    if( ($commons1_len = strlen( $commons1 )) == 0) return 0;
    if( ($commons2_len = strlen( $commons2 )) == 0) return 0;

    // calculate transpositions
    $transpositions = 0;
    $upperBound = min( $commons1_len, $commons2_len );
    for( $i = 0; $i < $upperBound; $i++){
      if( $commons1[$i] != $commons2[$i] ) $transpositions++;
    }
    $transpositions /= 2.0;

    // return the Jaro distance
    return ($commons1_len/($str1_len) + $commons2_len/($str2_len) + ($commons1_len - $transpositions)/($commons1_len)) / 3.0;
      
  }
   
  function getPrefixLength( $string1, $string2, $MINPREFIXLENGTH = 4 ){
    
    $n = min( array( $MINPREFIXLENGTH, strlen($string1), strlen($string2) ) );
    
    for($i = 0; $i < $n; $i++){
      if( $string1[$i] != $string2[$i] ){
        // return index of first occurrence of different characters 
        return $i;
      }
    }

    // first n characters are the same   
    return $n;
  }
    
  function JaroWinkler($string1, $string2, $PREFIXSCALE = 0.1 ){
    
    $JaroDistance = $this->Jaro( $string1, $string2 );
    
    $prefixLength = $this->getPrefixLength( $string1, $string2 );
    
    return $JaroDistance + $prefixLength * $PREFIXSCALE * (1.0 - $JaroDistance);
  }
}


class ComparadorComponent extends Object {
  
  var $name = "Comparador";
  
  //llamado antse de  Controller::beforeFilter()
  function initialize(&$controller) {
    // salvando la referencia al controlador para uso posterior
    $this->controller =& $controller;
  }

  //default tendra las configuraciones iniciales, si es que no se usan las funciones de configuracion
  private $default = array(
    "umbral" => 0.8,
    "p" => 0.1,
    "pesos" => array(
      'descripcion'     => 0.2,
      'partners'        => 0.1,
      'activities'      => 0.05,
      'resources'       => 0.1,
      'propositions'    => 0.2,
      'relationships'   => 0.05,
      'channels'        => 0.05,
      'segments'        => 0.1,
      'costs'           => 0.05,
      'revenuestreams'  => 0.1,     
    )
    );
  //settings cambiara la configuracion de default
  private $settings = array();

  //Objeto de la clase JW que ejecuta los metodos del algoritmo JaroWinkler
  private $JW = NULL;

  //Funcion que devuelve el descuento en base a la frecuencia de un tag 
  function frecuencia($tag, $f){}

  //Funcion que compara dos tags usando el algoritmo de Jaro-Winkler
  function compareTags($tag1, $tag2, $p = NULL, $umbral = NULL){
    if (is_null($this->JW)) $this->JW = new JW();

    if (is_null($p)) $p = $this->default["p"];

    if (is_null($umbral)) $umbral = $this->default["umbral"];

    return ( $this->JW->JaroWinkler($tag1, $tag2, $p) > $umbral) ? 1 : 0;
  }

  //Funcion que rvisa un arreglo de tags para ver si un tag se encuentra presente en dicho arreglo
  function inArray($tag, $tags, $p = NULL, $umbral = NULL){

    foreach ($tags as $txt) {
      if ( $this->compareTags($tag, $txt, $p, $umbral) == 1 ) return 1;
    }
    return 0;
  }

  //Funcion que compara dos grupos de tags y devuelve la cantidad de hits registrados
  function getHits($cadena1, $cadena2, $p = NULL, $umbral = NULL){
    $mayor = (count($cadena1) > count($cadena2)) ? $cadena1 : $cadena2;
    $menor = (count($cadena1) < count($cadena2)) ? $cadena1 : $cadena2;
    $max = count($mayor);
    $min = count($menor);
    $hits = 0;  

    for($i=0; $i < $min;$i++){
      if( $this->inArray($menor[$i], $mayor, $p, $umbral) ){
        $hits++;
      }
    }
    return $hits;
  }

  //Funcion que compara las propuestas
  function compare( $propuesta1, $propuesta2, $p = NULL, $umbral = NULL ){
    $mayores = array();

    foreach ($propuesta1 as $item => $tags) {
      $mayor = (count( $propuesta1[$item] ) > count( $propuesta2[$item] )) ? count( $propuesta1[$item] ) : count( $propuesta2[$item] );
      $mayores[$item] = $mayor;
    }

    $pesoTotal = 0;
    foreach ($propuesta1 as $item => $tags) {
      #echo "peso = ".$pesos[$item]." * ".getHits($propuesta1[$item],$propuesta2[$item],$p,$umbral)." / ". $mayores[$item]."\n\n";
      $pesoTotal += $this->default["pesos"][$item] * ( $this->getHits($propuesta1[$item],$propuesta2[$item],$p,$umbral) / $mayores[$item] );
    }
    return $pesoTotal * 100;
  }

  //Funcion que setea una de las opciones predefinidas
  function set($option = array()){}

  //Funcion que setea un grupo de funciones predefinidas
  function config($settings = array()){}
  
}

?>