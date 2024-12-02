window.addEventListener('load', function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var url = "http://laravel-polleria/";
    var hacerFiltroEn = "";

    $('#filter-button').on('click', function(){
        hacerFiltroEn = ($(this).data('table'));
        var table = $(this).data('table');
        var action = url + 'filters/table';

        $('#table').val(table);
        $('#filter-form').attr('action', action);
        
        console.log(hacerFiltroEn);
        
        $('#filter-modal').removeClass('hide-modal').addClass('open-modal');
    });

    $('#button-cancel').on('click', function() {
        $('#filter-modal').removeClass('open-modal').addClass('hide-modal');
    });
});