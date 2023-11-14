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
                <h5 class="card-title">Tablas de  <?php echo htmlspecialchars($_GET['db']) ?></h5>
                <table class="table table-hover table-bordered table-striped ">
                    <thead>
                        <tr>
                        <th scope="col">Esquema</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Owner</th>
                        <th scope="col">Filas</th>
                        <th scope="col">Acción</th>
                        </tr>
                    </thead>
                    <tbody id="tbody-table" style='height:20em;overflow-y:auto'>	
                        <?php 
                            require_once __DIR__."/Model/DataBase.php";
                            $db = htmlspecialchars($_GET['db']);
                            $conn = new DataBase();
                            $query = "
                                select table_schema,table_name,table_catalog
                                from information_schema.tables
                                where table_type = 'BASE TABLE' and table_schema='public'
                                ;"
                            ;
                            $result = $conn->ejecutar_consulta_db($query, $db);
                           
                            while ($table = pg_fetch_assoc($result)) {
                                $query = "select count(0) as qty from ".$table['table_name'].";";
                                
                                $rows = pg_fetch_assoc($conn->ejecutar_consulta_db($query, $db));
                                
                                echo "<tr id='{$db}-{$table['table_name']}'>";
                                echo "<td>{$table['table_schema']}</td>";
                                echo "<td>{$table['table_name']}</td>";
                                echo "<td>{$table['table_catalog']}</td>";
                                echo "<td>{$rows['qty']}</td>";
                                // echo "<td>{$table['qty']}</td>";
                                echo "<td><a href='#'>Ver</a></td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                    </table> 
                    <a href="index.php" class="btn btn-primary col-12 col-sm-5 m-1">Volver</a>
            
            
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="./js/script-tables.js"></script>
    </body>
</html>