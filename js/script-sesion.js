function end_process(proceso) {
    var seguro = confirm("¿Seguro que quiere cerrar la conexión " + proceso + " ?");

    if (seguro) {
        // Utilizar AJAX para enviar la solicitud al servidor
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "close_connection.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            // Función onreadystatechange: Se establece una función que se ejecutará 
            // cada vez que cambie el estado de la solicitud AJAX. Se verifica si la 
            // solicitud está completa (readyState == 4) y si la respuesta del servidor
            // es exitosa (status == 200).
            if (xhr.readyState == 4 && xhr.status == 200) {
                location.reload();
            }
        };
        xhr.send("proceso=" + proceso);
    } else {
        alert("Operación cancelada.");
    }
}