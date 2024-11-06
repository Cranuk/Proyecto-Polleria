@extends('layouts.web')

@php
    $title = isset($edit) ? 'Editar ventas' : 'Nueva venta';
    $route = isset($edit) ? 'sales.update' : 'sales.save';
@endphp

@section('title', $title)

@section('content-sales')
    <div class="subtitle underlined center">
        @isset($edit)
            Editar venta
        @else
            Nueva venta
        @endisset
    </div>

    <div class="space-10"></div>
    
    <form action="{{ route($route)}}" method="POST" class="form-style">
        @csrf

        @isset($edit)
            <input type="hidden" name="id" value="{{ $edit->id }}">
        @endisset

        <label for="product_id" class="label-text">Producto:</label>
        <select name="product_id" class="input-text" required>
            <option value="" disabled>Seleccione un producto</option>
            @foreach($products as $product)
                <option value="{{ $product->id }}">{{ $product->name }}</option>
            @endforeach
        </select>

        <label for="payment_id" class="label-text">Medios de pago:</label>
        <select name="payment_id" class="input-text" required>
            <option value="" disabled>Seleccione un metodo de pago</option>
            @foreach($paymentMethods as $data)
                <option value="{{ $data->id }}">{{ $data->name }}</option>
            @endforeach
        </select>

        <label for="amount" class="label-text">Cantidad:</label>
        <input type="number" name="amount" class="input-text" value="{{ $edit->amount ?? '' }}" required min="0" step="0.001" placeholder="Ejemplo: 2.500">

        <div class="button-box">
            <a href="{{ route('sales') }}" class="buttons button-orange" title="Volver">
                <i class='bx bx-arrow-back icon-small'></i>
            </a>
            <input type="submit" value="Guardar" class="buttons button-green">
        </div>
    </form>
@endsection