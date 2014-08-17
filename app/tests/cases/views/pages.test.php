<?php
class PagesViewsTest extends CakeWebTestCase {   

  function testHomePage(){
    //obtenemos la pagina
    $this->get("http://http://127.0.0.1/observatorio/");
    
    //Probamos que la respuesta sea la correcta
    $this->assertResponse(200);

    //Luego, probamos el contenido, partiendo por el titulo
    $this->assertTitle("Proyectos Ingeniería Civil Informática | Home");

    //Probamos que existan los links a las otras paginas
    $this->assertLink("Help");
    $this->assertLink("Login");
    $this->assertLink("About");
    $this->assertLink("Contact");
    $this->assertLink("News");
    $this->assertLink("Registrate");

    //Luego, probamos que cada uno de los links redireccione a la pagina correcta
    $this->clickLink("Help");
    $this->assertTitle(new PatternExpectation('/Help/'));
    //volvemos a la pagina de inicio
    $this->back();
    $this->clickLink("Login");
    $this->assertTitle(new PatternExpectation('/Login/'));
    //volvemos a la pagina de inicio
    $this->back();
    $this->clickLink("About");
    $this->assertTitle(new PatternExpectation('/About/'));
    //volvemos a la pagina de inicio
    $this->back();
    $this->clickLink("Contact");
    $this->assertTitle(new PatternExpectation('/Contact/'));
    //volvemos a la pagina de inicio
    $this->back();
    $this->clickLink("News");
    $this->assertTitle(new PatternExpectation('/News/'));
    //volvemos a la pagina de inicio
    $this->back();
    $this->clickLink("Registrate");
    $this->assertTitle(new PatternExpectation('/Registrate/'));    

  }
}
?>