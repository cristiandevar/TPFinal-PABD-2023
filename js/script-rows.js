document.addEventListener('DOMContentLoaded',
    function () {
        $('a').first().on('click',
            function() {
                db = $(this).attr('id').split('-')[1];
                $(this).attr('href','show_tables.php?db=' + db);
            }
        );
    }
);