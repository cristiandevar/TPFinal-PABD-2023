<?php
    require __DIR__.'/header.php'
?>                   
                <h5 class="card-title">Primeras 100 filas de <?php echo $_GET['name'] ?></h5>
                <div class="row" style=' height: 30em;width: 40em;overflow: auto;'>
                    <table class="table table-sm table-bordered table-striped table-hover">
                        <thead style="position: sticky; top: 0;">
                        <?php
                            // Importamos los archivos necesarios para realizar una conexíon
                            require_once __DIR__."/inc/bootstrap.php";
                            $conn = new DataBase();
                            
                            // Limitamos el nro de filas a 100
                            $limit = 100;

                            // Leemos variables pasadas por url para saber en que BD y en que TAbla hacer la consulta 
                            $db = htmlspecialchars($_GET['db']);
                            $table = htmlspecialchars($_GET['name']);
                            $query = "select column_name from information_schema.columns where table_name = '{$table}'";
                            $result = $conn->exec_query_db($query, $db);
                            
                            // Creamos cabezal de la tabla, colocando como columnas todas las columnas de la tabla elegida
                            echo "<tr>";
                            while ($column = pg_fetch_assoc($result)) {
                                echo "<th>{$column['column_name']}</th>";
                            }
                            echo "</tr>";
                            
                            // Cerramos la etiqueta thead
                            echo '</thead>';

                            // Cargamos el body de la tabla con las 100 primeras filas de la tabla seleccionada
                            echo "<tbody id='tbody-rows'>";
                            $query = "select * from {$table} limit {$limit};";
                            $result2 = $conn->exec_query_db($query, $db);
                            while (($row = pg_fetch_array($result2))) {
                                echo "<tr>";
                                // Recorremos las columnas obteniendo asi el valor correspondiente para cada fila
                                // Cada vez que vamos a recorrer las columnas debemos reiniciar el puntero mediante pg_result_seek
                                pg_result_seek($result, 0);
                                for($i = 0 ; $i<intdiv(count($row),2) ; $i++){
                                    $column = pg_fetch_assoc($result);
                                    echo "<td>{$row[$column['column_name']]}</td>";
                                }
                                echo "</tr>";
                            }
                            echo '</tbody>';

                        ?>
                    </table>
                </div>
                <div class="row mb-3">
                    <a id="<?php echo 'btnvolver-'.htmlspecialchars($_GET['db'])?>" href="#" class="btn btn-primary col-12 col-sm-5 m-1">Volver</a>
                </div>
            </div>
        </div>
    <script src="./js/script-rows.js"></script>
<?php
    require __DIR__.'/footer.php'
?>