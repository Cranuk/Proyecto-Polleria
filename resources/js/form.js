window.addEventListener('load', function(){
    
    let saleOptionSelect = $('#sale-option select');
    let product = $('#sale-product');
    let offer = $('#sale-offer');
    let payment = $('#sale-payment');

    // NOTE: ocultamos los campos
    product.hide();
    offer.hide();
    payment.hide();

    saleOptionSelect.on("change", function () { 
        let optionData = saleOptionSelect.val();

        if (optionData == 1) {
            product.show();
            payment.show();
            offer.hide();
        }else if (optionData == 2) {
            product.hide();
            payment.show();
            offer.show();
        }else{
            product.hide();
            offer.hide();
            payment.hide();
        }
    });
});