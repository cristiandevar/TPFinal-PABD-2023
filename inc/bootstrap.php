<?php
define("PROJECT_ROOT_PATH", __DIR__ . "/../");
// incluimos el archivo principal de configuracion 
require_once PROJECT_ROOT_PATH . "/inc/config.php";

// incluimos el archivo del controlador base 
require_once PROJECT_ROOT_PATH . "/Controller/Api/BaseController.php";

// incluimos el archivo del modelo base
require_once PROJECT_ROOT_PATH . "/Model/Database.php";

// incluimos el archivo del modelo de cliente 
require_once PROJECT_ROOT_PATH . "/Model/CustomerModel.php";

// Definimos el nivel de error
error_reporting(E_ERROR);
?>