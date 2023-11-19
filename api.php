<?php
    require __DIR__ . "/inc/bootstrap.php"; // Cargamos los recursos necesarios

    // Utiliza la función parse_url para obtener la parte de la URL que corresponde 
    // a la ruta del archivo (path). $_SERVER['REQUEST_URI'] contiene la URI completa de la solicitud actual.
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);    

    // Divide la URI en segmentos utilizando el carácter / como delimitador y almacena los segmentos en un array llamado $uri
    $uri = explode( '/', $uri );

    // Verifica ciertas condiciones en la URI. Si alguna de las siguientes condiciones es verdadera, se envía una 
    // respuesta HTTP 404 (Not Found) y se termina la ejecución del script:
    if ((isset($uri[3]) && $uri[3] != 'customer') || !isset($uri[4])) {
        header("HTTP/1.1 404 Not Found");
        exit();
    }

    // Incluimos el archivo CustomerController.php
    require PROJECT_ROOT_PATH . "/Controller/Api/CustomerController.php";

    $objFeedController = new CustomerController();

    // Construye el nombre del método que se llamará en CustomerController. Toma el quinto segmento de 
    // la URI (índice 4 en el array $uri) y le agrega '_action'.
    $strMethodName = $uri[4] . '_action';
    // en base a lo seleccionado se llamara a el metodo id_action o name_action o en el peor caso se llamara a un metodo no definido
    $objFeedController->{$strMethodName}();
?>