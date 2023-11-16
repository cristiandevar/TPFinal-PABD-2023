<?php

// define("PROJECT_ROOT_PATH", __DIR__ . "/../");
// incluimos el archivo principal
// require  __DIR__ . "/../inc/bootstrap.php";
// require_once PROJECT_ROOT_PATH . "/inc/config.php";
class Database
{
    protected $host = null;
    protected $port = null;
    protected $user = null;
    protected $password = null;
    protected $query = null;
    
    public function __construct()
    { 
        $this->host = DB_HOST;
        $this->port = DB_PORT;
        $this->user = DB_USERNAME;
        $this->password = DB_PASSWORD;
    }

    function exec_query_db($sql, $db) {
        $conn_string = "host={$this->host} port={$this->port} dbname={$db} user={$this->user} password={$this->password}";
        $this->query = $conn_string;
        $conn = pg_connect($conn_string);
        $result = pg_query($conn, $sql);
        
        if ( !$result ) {
            echo '<div class="alert alert-danger"><p>No se pudo consultar las BDs</p></div>';
            exit;
        }
        pg_close($conn);
        return $result;
    }
}

?>