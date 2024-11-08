window.addEventListener('load', function(){
    const productSelect = $('#sale-product select');
    const offerSelect = $('#sale-offer select');
    const boxProduct = $('#sale-product');
    const boxOffer = $('#sale-offer');
    const boxAmount = $('#sale-amount');

    function viewProduct(){
        boxProduct.toggle(!offerSelect.val());
        productSelect.toggle(!offerSelect.val());
        boxAmount.toggle(!offerSelect.val());
    }

    function viewOffer(){
        boxOffer.toggle(!productSelect.val());
        offerSelect.toggle(!productSelect.val());
    }

    productSelect.on('change', function(){
        viewProduct();
        viewOffer();
    });

    offerSelect.on('change', function(){
        viewProduct();
        viewOffer();
    });

    viewProduct();
    viewOffer();
});