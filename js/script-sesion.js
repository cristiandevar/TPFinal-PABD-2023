function finalizar_proceso(proceso) {
    var seguro = confirm("¿Seguro que quiere cerrar la conexión " + proceso + " ?");

    if (seguro) {
        // Utilizar AJAX para enviar la solicitud al servidor
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "close_connection.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Se completó la solicitud, puedes realizar acciones adicionales si es necesario
                location.reload();
            }
        };
        xhr.send("proceso=" + proceso);
    } else {
        alert("Operación cancelada.");
    }
}