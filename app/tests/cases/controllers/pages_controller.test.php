<?php
class PagesControllerTest extends CakeTestCase {

   function startCase() {
     echo '<h1>Comenzando Test Case</h1>';
   }

   function endCase() {
     echo '<h1>Terminado Test Case</h1>';
   }

   function startTest($method) {
     echo '<h3>Comenzando método ' . $method . '</h3>';
   }

   function endTest($method) {
     echo '<hr />';
   }

   function testHome() {
     $result = $this->testAction('/pages/home');  
     debug($result);   
   }
   
   function testAbout() {
     $result = $this->testAction('/pages/about'); 
     debug($result);    
   }

   function testHelp() {
     $result = $this->testAction('/pages/help');   
     debug($result);  
   }

   function testContact() {
     $result = $this->testAction('/pages/contact');  
     debug($result);   
   }
}
?>