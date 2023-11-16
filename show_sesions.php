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
                                require_once __DIR__."/inc/bootstrap.php";
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
                                $result = $conn->exec_query_db($query, $db);
                            
                                while ($row = pg_fetch_assoc($result)) {
                                    
                                    echo "<tr id='{$db}-{$row['proceso']}'>";
                                    echo "<td>{$row['proceso']}</td>";
                                    echo "<td>{$row['ip']}</td>";
                                    echo "<td>{$row['usuario']}</td>";
                                    echo "<td>{$row['inicio']}</td>";
                                    echo "<td>{$row['estado']}</td>";
                                    echo "<td>{$row['query']}</td>";
                                    echo "<td><a href='#' onclick='end_process({$row['proceso']})'>Stop</a></td>";
                                    echo "</tr>";
                                }
                            ?>
                        </tbody>
                    </table> 
                </div>
                <div class="row mb-3">
                    <a href="index.php" class="btn btn-primary col-12 col-sm-5 m-1">Volver</a>
                </div>
            </div>
        </div>
        <script src="./js/script-sesion.js"></script>
<?php
    require __DIR__.'/footer.php'
?>