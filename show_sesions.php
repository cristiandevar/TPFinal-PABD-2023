<?php
    require __DIR__.'/header.php'
?>
                <h5 class="card-title">Sesiones de <?php echo \htmlspecialchars($_GET['db']) ?></h5>
                <div  style=' height: 30em;overflow-y: auto;'>       
                    <table class="table table-hover table-bordered table-striped ">
                        <thead style="position: sticky; top: 0;">
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
                                // Importamos los archivos necesarios para crear una conexión
                                require_once __DIR__."/inc/bootstrap.php";
                                $db = htmlspecialchars($_GET['db']);
                                $conn = new DataBase();
                                $query = "
                                    SELECT 
                                        pid AS process,
                                        usename AS user,
                                        to_char(backend_start, 'YYYY-MM-DD HH24:MI') AS start,
                                        client_addr AS ip,
                                        state,
                                        query
                                    FROM pg_catalog.pg_stat_activity 
                                    WHERE datname ='".$_GET['db']."';"
                                ;
                                $result = $conn->exec_query_db($query, $db);

                                // Cargamos las conexiones activas al servidor de bases de datos
                                while ($row = pg_fetch_assoc($result)) {
                                    
                                    echo "<tr id='{$db}-{$row['process']}'>";
                                    echo "<td>{$row['process']}</td>";
                                    echo "<td>{$row['ip']}</td>";
                                    echo "<td>{$row['user']}</td>";
                                    echo "<td>{$row['start']}</td>";
                                    echo "<td>{$row['state']}</td>";
                                    echo "<td>{$row['query']}</td>";
                                    // Agregamos un enlace "Stop" que, al hacer clic, ejecutará una función JavaScript end_process 
                                    // con el id de proceso correspondiente a la fila actual
                                    echo "<td><a href='#' onclick='end_process({$row['process']})'>Stop</a></td>";
                                    echo "</tr>";
                                }
                            ?>
                        </tbody>
                    </table> 
                </div>
                <div class="row mb-3">
                    <!-- Agregamos link para regresar a la pagina anterior -->
                    <a href="index.php" class="btn btn-primary col-12 col-sm-5 m-1">Volver</a>
                </div>
            </div>
        </div>
        <script src="./js/script-sesion.js"></script>
<?php
    require __DIR__.'/footer.php'
?>