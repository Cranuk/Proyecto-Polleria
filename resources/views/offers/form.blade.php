<form action="{{ route($route)}}" method="POST" class="form-style">
    @csrf

    @isset($edit)
        <input type="hidden" name="id" value="{{ $edit->id }}">
    @endisset

    <label for="name" class="label-text">Nombre:</label>
    <input type="text" name="name" class="input-text" value="{{ $edit->name ?? '' }}" required>

    <label for="product_id" class="label-text">Producto:</label>
    <select name="product_id" class="input-text" required>
        <option value="">Seleccione un producto</option>
        @foreach($products as $product)
            <option value="{{ $product->id }}" @isset($edit) {{ $product->id == $edit->product_id ? 'selected' : '' }}@endisset>
                {{ $product->name }}
            </option>
        @endforeach
    </select>

    <label for="description" class="label-text">Descripcion:</label>
    <input type="text" name="description" class="input-text" value="{{ $edit->description ?? '' }}" required>

    <label for="amount_discount" class="label-text">Cantidad en oferta:</label>
    <input type="number" name="amount_discount" class="input-text" value="{{ $edit->amount_discount ?? '' }}" required min="0" step="0" placeholder="Ejemplo: 2">

    <label for="type_unit" class="label-text">Seleccione tipo de medida:</label>
    <select name="type_unit" class="input-select" required>
        <option value="">Seleccione tipo de medida</option>
        <option value="kg" @isset($edit) {{ 'kg' == $edit->type_unit ? 'selected' : '' }} @endisset>Peso(kg)</option>
        <option value="u" @isset($edit) {{ 'u' == $edit->type_unit ? 'selected' : '' }} @endisset>Unidad(u)</option>
    </select>

    <label for="price" class="label-text">Precio:</label>
    <input type="number" name="price" class="input-text" value="{{ $edit->price ?? '' }}" required min="0" step="0.01" placeholder="Ejemplo: 2.50">

    <div class="button-box">
        <a href="{{ route('offers') }}" class="buttons button-orange" title="Volver">
            <i class='bx bx-arrow-back icon-small'></i>
        </a>
        <input type="submit" value="Guardar" class="buttons button-green">
    </div>
</form>