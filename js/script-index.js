document.addEventListener('DOMContentLoaded', 
    function () {

        $('#label-bd-1').html('Seleccione una BD');

        $('#selected-db').on('change',
            function () {
                console.log('Entro');
                if ($(this).val() != '') {
                    $('#label-bd-1').html('Base de datos elegida: <strong>' + $(this).val() + '</strong>');
                }
                else {
                    $('#label-bd-1').html('Seleccione una BD');
                }
            }
        );

        $('#link-tables').on('click', 
            function ( e ) {
                let valor_selecciondao = $('#selected-db').val();
                if (valor_selecciondao != '') {
                    $(this).attr('href', 'show_tables.php?db='+valor_selecciondao);
                }
                else {
                    $(this).attr('href', '#');
                }
            }
        )

        $('#link-sessions').on('click', 
        function ( e ) {
            let valor_selecciondao = $('#selected-db').val();
            if (valor_selecciondao != '') {
                $(this).attr('href', 'show_tables.php?db='+valor_selecciondao);
            }
            else {
                $(this).attr('href', '#');
            }
        }
    )

    }
);