<?php
    // Cargamos los recursos necesarios e incluimos las acciones para controlar a clientes
    require __DIR__ . "/inc/bootstrap.php";
    require PROJECT_ROOT_PATH . "/Controller/Api/CustomerController.php";

    // Utiliza la función parse_url para obtener la parte de la URL que corresponde 
    // a la ruta del archivo (path). 
    // $_SERVER['REQUEST_URI'] contiene la URI completa de la solicitud actual.
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);    

    // Divide la URI en segmentos utilizando el carácter / como delimitador 
    // y almacena los segmentos en un array llamado $uri
    // La URI Debe seguir el siguiente formato:
    // localhost/CarpetaProyecto/api.php/customer/{id | name}?{id | name}=
    // Obteniendo al dividir la URL un array que al menos contendra:
    // ['localhost', 'CarpetProyecto', 'api.php', 'customer']
    $uri = explode( '/', $uri );

    // Verifica ciertas condiciones en la URI.
    // Si alguna de las dichas condiciones es verdadera, se envía una 
    // respuesta HTTP 404 (Not Found) y se termina la ejecución del script.
    // Si luego de dividir la URI:
    //      * No encuentra valor en $uri[3]
    //      * Encuentra un valor diferente a 'customer' en $uri[3] 
    //      * No encuentra valor en $uri[4]
    if (!isset($uri[3]) || (isset($uri[3]) && $uri[3] != 'customer') || !isset($uri[4])) {
        header("HTTP/1.1 404 Not Found");
        exit();
    }
 
    $objFeedController = new CustomerController();

    // Construye el nombre del método que se llamará en CustomerController. Toma el quinto segmento de 
    // la URI (índice 4 en el array $uri) y le agrega '_action'.
    $strMethodName = $uri[4] . '_action';

    // en base al valor $uri[4] se llamara a algunos de los siguientes metodos:
    //      * metodo id_action 
    //      * metodo name_action
    //      * metodo __call (metodo magigo que se ejecuta cuando llamamos a uno no definido)
    $objFeedController->{$strMethodName}();
?>