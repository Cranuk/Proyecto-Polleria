@extends('layouts.web')

@php
    $title = isset($edit) ? 'Editar Productos' : 'Nuevo producto';
    $route = isset($edit) ? 'products.update' : 'products.save';
@endphp

@section('title', $title)

@section('content-products')
    <div class="subtitle underlined center">
        @isset($edit)
            Editar producto
        @else
            Nuevo producto
        @endisset
    </div>

    <div class="space-10"></div>
    
    <form action="{{ route($route)}}" method="POST" class="form-style">
        @csrf

        @isset($edit)
            <input type="hidden" name="id" value="{{ $edit->id }}">
        @endisset

        <label for="name" class="label-text">Nombre:</label>
        <input type="text" name="name" class="input-text" value="{{ $edit->name ?? '' }}" required>

        <label for="description" class="label-text">Descripcion:</label>
        <input type="text" name="description" class="input-text" value="{{ $edit->description ?? '' }}">

        <label for="amount" class="label-text">Cantidad:</label>
        <input type="number" name="amount" class="input-text" value="{{ $edit->amount ?? '' }}" required min="0" step="0.001" placeholder="Ejemplo: 2.500">

        <label for="minimal_amount" class="label-text">Cantidad minima:</label>
        <input type="number" name="minimal_amount" class="input-text" value="{{ $edit->minimal_amount ?? '' }}" required min="0" step="0.001" placeholder="Ejemplo: 2.500">

        <label for="price" class="label-text">Precio:</label>
        <input type="number" name="price" class="input-text" value="{{ $edit->price ?? '' }}" required min="0" step="0.01" placeholder="Ejemplo: 2.50">

        <div class="button-box">
            <a href="{{ route('products') }}" class="buttons button-orange" title="Volver">
                <i class='bx bx-arrow-back icon-small'></i>
            </a>
            <input type="submit" value="Guardar" class="buttons button-green">
        </div>
    </form>
@endsection