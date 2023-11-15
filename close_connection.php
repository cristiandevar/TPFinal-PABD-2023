<?php
// Este bloque de código PHP se ejecuta en el servidor
require_once __DIR__."/Model/DataBase.php";
$db = 'postgres';
$conn = new DataBase();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["proceso"])) {
    $proceso = $_POST["proceso"];

    $query = "SELECT pg_terminate_backend($proceso);";
    echo $host; 
    $result = $conn->ejecutar_consulta_db($query, $db);

    // Puedes enviar una respuesta al cliente si lo deseas
    // echo json_encode(["success" => true]);
    exit(); // Termina la ejecución de PHP después de procesar la solicitud AJAX
}
?>