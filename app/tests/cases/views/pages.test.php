<?php
class PagesViewsTest extends CakeWebTestCase {   

  function testHomePage(){
    //obtenemos la pagina
    $this->get("http://observatorio-web.herokuapp.com/");
    
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
    $this->assertLink("¡Registraté!");

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
    $this->assertTitle(new PatternExpectation('/Noticias/'));
    //volvemos a la pagina de inicio
    $this->back();
    $this->clickLink("¡Registraté!");
    $this->assertTitle(new PatternExpectation('/Registro/'));    

  }

  function testAboutPage(){
    //obtenemos la pagina
    $this->get("http://observatorio-web.herokuapp.com/pages/about");
    
    //Probamos que la respuesta sea la correcta
    $this->assertResponse(200);

    //Luego, probamos el contenido, partiendo por el titulo
    $this->assertTitle("Proyectos Ingeniería Civil Informática | About");

    //Probamos que existan los links a las otras paginas    
    $this->assertLink("Informática");
    $this->assertLink("Malla");
    $this->assertLink("Ingeniería");

    //Luego, probamos que cada uno de los links redireccione a la pagina correcta
    $this->clickLink("Informática");
    $this->assertTitle(new PatternExpectation('/INGENIERÍA CIVIL INFORMÁTICA/'));
    //volvemos a la pagina de inicio
    $this->back();
    $this->clickLink("Malla");
    //Se trata de un archivo en PDF por lo que no se puede probar el titulo
    //volvemos a la pagina de inicio
    $this->back();
    $this->clickLink("Ingeniería");
    $this->assertTitle(new PatternExpectation('/Ingeniería U de Santiago/'));    
  }

  function testContactPage(){
    //obtenemos la pagina
    $this->get("https://observatorio-web.herokuapp.com/pages/contact");
    
    //Probamos que la respuesta sea la correcta
    $this->assertResponse(200);

    //Luego, probamos el contenido, partiendo por el titulo
    $this->assertTitle("Proyectos Ingeniería Civil Informática | Contact");

    //Ahora se prueban los inputs del form
    $this->assertField("data[sender]");

    //Ahora se prueban los inputs del form
    $this->assertField("data[subject]");

    //Ahora se prueban los inputs del form
    $this->assertField("data[message]");

    //Probamos enviar el formulario sin datos y que falle
    $this->clickSubmit('Enviar');
    //Probamos que la respuesta sea la correcta
    $this->assertResponse(200);
    $this->assertText('Debe completar los campos correctamente');

    //Ahora probamos llenando el formulario
    //obtenemos la pagina
    $this->get("https://observatorio-web.herokuapp.com/pages/contact");
    $this->setField("data[sender]", "New Sender");

    $this->setField("data[subject]", "New Subject");

    $this->setField("data[message]", "This is a test message");

    //Lo enviamos, y esperamos que la respuesta sea correcta
    $this->clickSubmit('Enviar');
    //Probamos que la respuesta sea la correcta
    $this->assertResponse(200);
    $this->assertText('Su mensaje ha sido enviado correctamente');
  }
}
?>