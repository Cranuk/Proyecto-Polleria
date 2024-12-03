window.addEventListener('load', function(){
    const url = "http://laravel-polleria/";

    function modalAction(table, action){
        $('#table').val(table);
        $('#filter-form').attr('action', action);
        $('#filter-modal').removeClass('hide-modal').addClass('open-modal');
    }

    $('#button-cancel').on('click', function() {
        $('#filter-modal').removeClass('open-modal').addClass('hide-modal');
    });

    $('#filter-button, #report-button').on('click', function(){
        let table = $(this).data('table');
        let action = url + 'filter/table';
        modalAction(table, action);
    });

    $('#report-button').on('click', function(){
        let table = $(this).data('table');
        let action = url + 'report/pdf';
        modalAction(table, action);
    });
});