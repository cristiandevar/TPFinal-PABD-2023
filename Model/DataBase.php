<?php
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
            if(!$conn){
                // Si detectamos que hubo un error en la conexión retornamos false
                return false;
            }
            else{
                $result = pg_query($conn, $sql);
                if ( !$result ) {
                    // Si detectamos que hubo un error en la consulta retornamos false
                    return false;
                }
                pg_close($conn);
                return $result;
            }
    }
}
?>