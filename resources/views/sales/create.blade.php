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

        <div id="sale-product" class="form-block">
            <label for="product_id" class="label-text">Producto:</label>
            <select name="product_id" class="input-select">
                <option value="">Seleccione un producto</option>
                @foreach($products as $product)
                <option value="{{ $product->id }}" 
                    @isset($edit) 
                        {{ $product->id == $edit->product_id ? 'selected' : '' }}
                    @endisset
                >
                    {{ $product->name }}
                </option>
            @endforeach
            </select>
        </div>

        <div id="sale-offer" class="form-block">
            <label for="offer_id" class="label-text">Ofertas:</label>
            <select name="offer_id" class="input-select">
                <option value="">Seleccione una oferta</option>
                @foreach($offers as $offer)
                <option value="{{ $offer->id }}" 
                    @isset($edit) 
                        {{ $offer->id == $edit->offer_id ? 'selected' : '' }}
                    @endisset
                >
                    {{ $offer->name }}
                </option>
            @endforeach
            </select>
        </div>

        <div id="sale-amount" class="form-block">
            <label for="amount" class="label-text">Cantidad:</label>
            <input type="number" name="amount" id="amount" class="input-text" value="{{ $edit->amount ?? '' }}" min="0" step="0.001" placeholder="Ejemplo: 2.500">
        </div>

        <div class="form-block">
            <label for="payment_id" class="label-text">Medios de pago:</label>
            <select name="payment_id" class="input-select" required>
                <option value="">Seleccione un medio de pago</option>
                @foreach($paymentMethods as $data)
                <option value="{{ $data->id }}" 
                    @isset($edit) 
                        {{ $data->id == $edit->payment_id ? 'selected' : '' }}
                    @endisset
                >
                    {{ $data->name }}
                </option>
            @endforeach
            </select>
        </div>

        <div class="button-box">
            <a href="{{ route('sales') }}" class="buttons button-orange" title="Volver">
                <i class='bx bx-arrow-back icon-small'></i>
            </a>
            <input type="submit" value="Guardar" class="buttons button-green">
        </div>
    </form>
@endsection