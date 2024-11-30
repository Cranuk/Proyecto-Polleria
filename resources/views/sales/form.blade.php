<form action="{{ route($route)}}" method="POST" class="form-style">
    @csrf

    <div id="sale-option" class="form-block">
        <label for="sale-data" class="label-text">Seleccione tipo de venta:</label>
        <select name="sale-data" class="input-select" required>
            <option value="">Seleccione venta</option>
            <option value="1">Productos</option>
            <option value="2">Ofertas</option>
        </select>
    </div>

    <div id="sale-product" class="form-block">
        <label for="product_id" class="label-text">Producto:</label>
        <select name="product_id" class="input-select">
            <option value="">Seleccione un producto</option>
            @foreach($products as $product)
                <option value="{{ $product->id }}">{{ $product->name }}</option>
            @endforeach
        </select>

        <label for="amount" class="label-text">Cantidad:</label>
        <input type="number" name="amount" id="amount" class="input-text" min="0" step="0.001" placeholder="Ejemplo: 2.500">
    </div>

    <div id="sale-offer" class="form-block">
        <label for="offer_id" class="label-text">Ofertas:</label>
        <select name="offer_id" class="input-select">
            <option value="">Seleccione una oferta</option>
            @foreach($offers as $offer)
                <option value="{{ $offer->id }}">{{ $offer->name }}</option>
            @endforeach
        </select>
    </div>

    <div id="sale-payment" class="form-block">
        <label for="payment_id" class="label-text">Medios de pago:</label>
        <select name="payment_id" class="input-select" required>
            <option value="">Seleccione un medio de pago</option>
            @foreach($paymentMethods as $data)
                <option value="{{ $data->id }}">{{ $data->name }}</option>
            @endforeach
        </select>
    </div>

    <div id="sale-date" class="form-block">
        <label for="date" class="label-text">Fecha:</label>
        <input type="date" name="date" id="date" class="input-text">
    </div>

    <div class="button-box">
        <a href="{{ route('sales') }}" class="buttons button-orange" title="Volver">
            <i class='bx bx-arrow-back icon-small'></i>
        </a>
        <input type="submit" value="Guardar" class="buttons button-green">
    </div>
</form>
