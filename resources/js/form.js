window.addEventListener('load', function(){
    let saleOptionSelect = $('#sale-option select');
    let product = $('#sale-product');
    let offer = $('#sale-offer');
    let payment = $('#sale-payment');
    let date = $('#sale-date');

    // NOTE: ocultamos los campos
    product.hide();
    offer.hide();
    payment.hide();
    date.hide();

    saleOptionSelect.on("change", function () { 
        let optionData = saleOptionSelect.val();

        if (optionData == 1) {
            product.show();
            payment.show();
            offer.hide();
            date.show();
        }else if (optionData == 2) {
            product.hide();
            payment.show();
            offer.show();
            date.show();
        }else{
            product.hide();
            offer.hide();
            payment.hide();
            date.hide();
        }
    });

    flatpickr(".datePicker", {
        dateFormat: "d/m/Y",
        maxDate: "today",
        locale: "es",
    });
    
});