<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Tablas</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </head>
    <body>
        <div class="card position-absolute top-50 start-50 translate-middle">
            <h5 class="card-header">TPFinal PADB 2023</h5>
            <div class="card-body">
                <h5 class="card-title">Sesiones de <?php echo \htmlspecialchars($_GET['db']) ?></h5>
                <table class="table table-hover table-bordered table-striped ">
                    <thead>
                        <tr>
                        <th scope="col">Proceso</th>
                        <th scope="col">Ip</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Inicio</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Query</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="tbody-table" style='height:20em;overflow-y:auto'>	
                        <?php 
                            require_once __DIR__."/Model/DataBase.php";
                            $db = htmlspecialchars($_GET['db']);
                            $conn = new DataBase();
                            $query = "
                                SELECT 
                                    pid AS proceso,
                                    usename AS usuario,
                                    client_addr AS ip,
                                    to_char(backend_start, 'YYYY-MM-DD HH24:MI') AS inicio,
                                    state AS estado,
                                    query
                                FROM pg_catalog.pg_stat_activity 
                                WHERE datname ='".$_GET['db']."';"
                            ;
                            $result = $conn->ejecutar_consulta_db($query, $db);
                        
                            while ($row = pg_fetch_assoc($result)) {
                                
                                echo "<tr id='{$db}-{$row['proceso']}'>";
                                echo "<td>{$row['proceso']}</td>";
                                echo "<td>{$row['ip']}</td>";
                                echo "<td>{$row['usuario']}</td>";
                                echo "<td>{$row['inicio']}</td>";
                                echo "<td>{$row['estado']}</td>";
                                echo "<td>{$row['query']}</td>";
                                echo "<td><a href='#' onclick='finalizar_proceso({$row['proceso']})'>Ver</a></td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                    </table> 
                    <a href="index.php" class="btn btn-primary col-12 col-sm-5 m-1">Volver</a>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="./js/script-sesion.js"></script>
    </body>
</html>