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
        <div class="row">
            <div class="card position-absolute top-50 start-50 translate-middle col-12">
                <h5 class="card-header">TPFinal PADB 2023</h5>
                <div class="card-body">
                    <h5 class="card-title">Filas de la tabla: <?php echo $_GET['name'] ?></h5>
                    <div  style=' height: 30em;overflow-y: auto;'>
                        <table class="table table-responsive table-sm table-bordered">
                            <thead style="position: sticky; top: 0;">
                                <?php
                                    require_once __DIR__."/Model/DataBase.php";

                                    $limit = 100000;
                                    $count = 0;
                                    $b = 0;

                                    $conn = new DataBase();
                                    $db = htmlspecialchars($_GET['db']);
                                    $table = htmlspecialchars($_GET['name']);
                                    $query = "select column_name from information_schema.columns where table_name = '{$table}'";
                                    $result = $conn->ejecutar_consulta_db($query, $db);
                                    
                                    echo "<tr>";
                                    while ($column = pg_fetch_assoc($result)) {
                                        echo "<th>{$column['column_name']}</th>";
                                    }
                                    echo "</tr>";
                                
                                    echo '</thead>';
                                    echo "<tbody id='tbody-rows'>";
                                 
                                    // $conn = new DataBase();
                                    // $db = htmlspecialchars($_GET['db']);
                                    // $table = htmlspecialchars($_GET['name']);
                                    
                                    $query = "
                                        select *
                                        from {$table};"
                                    ;
                                    $result2 = $conn->ejecutar_consulta_db($query, $db);
                                
                                    while (($row = pg_fetch_array($result2)) && $count<$limit) {
                                        echo "<tr>";
                                        pg_result_seek($result, 0);
                                        for($i = 0 ; $i<intdiv(count($row),2) ; $i++){
                                            $column = pg_fetch_assoc($result);
                                            echo "<td>{$row[$column['column_name']]}</td>";
                                        }
                                        echo "</tr>";
                                        $count += 1;
                                    }
                                    if ( $row ) {
                                        $b = 1;
                                    }




                                    echo '</tbody>';
                                    echo '</table>';
                                    echo '</div>';
                                    echo '</div>';
                                    if ($b == 1) {
                                        echo "<p class='alert alert-warning'> Solo se mostraran las primeras 10000 filas<p>";
                                    }
                                ?>
                        <a id="<?php echo 'btnvolver-'.htmlspecialchars($_GET['db'])?>" href="#" class="btn btn-primary col-2 m-1">Volver</a>
                
                
                </div>
            </div>
            
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="./js/script-rows.js"></script>
    </body>
</html>