<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Inicio</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </head>
    <body>
    <div class="card position-absolute top-50 start-50 translate-middle">
        <h5 class="card-header">TPFinal PADB 2023</h5>
        <div class="card-body">
            <h5 class="card-title">Inicio</h5>
            <p class="card-text">Elija la base de datos con la que quiera interactuar.</p>
            <form action="#" method="get">
                <div class="mb-5">    
                    <select id="selected-db" class="form-select" aria-label="Default select example">
                        <option id="opt-default" value='' selected>Base de Datos...</option>
                        <?php
                            require_once __DIR__."/Model/DataBase.php";
                            $db = new DataBase();
                            $query = 'select datname from pg_database';
                            $result = $db->ejecutar_consulta_db($query, 'postgres');
                            while ($row = pg_fetch_row($result)) {
                                if ($row[0] != 'postgres' && $row[0]!='template0' && $row[0]!='template1' ) {
                                    echo "<option value='$row[0]'>$row[0]</option>";

                                }
                            }
                        ?>
                    </select>
                    <hr>
                    <label id="label-bd-1"></label>
                </div>
                <div class="row mb-3">
                    <a id="link-tables" href='#' class="btn btn-primary col-12 col-sm-5 m-1">Ver Tablas</a>
                    <a id="link-sessions" href="#" class="btn btn-primary col-12 col-sm-5 m-1">Ver Sesiones</a>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="./js/script-index.js"></script>
    </body>
</html>