window.addEventListener('load', function(){
    flatpickr(".datePicker", {
        dateFormat: "d/m/Y",
        maxDate: "today",
        locale: "es",
    });
    
    flatpickr(".dateFilter",{
        mode: "range",
        dateFormat: "d/m/Y",
        maxDate: "today",
        locale: "es",
    })
});