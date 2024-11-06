@extends('layouts.web')

@php
    $title = isset($edit) ? 'Editar insumos' : 'Nuevo insumo';
    $route = isset($edit) ? 'supplies.update' : 'supplies.save';
@endphp

@section('title', $title)

@section('content-supplies')
    <div class="subtitle underlined center">
        @isset($edit)
            Editar insumo
        @else
            Nuevo insumo
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

        <label for="price" class="label-text">Precio:</label>
        <input type="number" name="price" class="input-text" value="{{ $edit->price ?? '' }}" required min="0" step="0.01" placeholder="Ejemplo: 2.50">

        <div class="button-box">
            <a href="{{ route('supplies') }}" class="buttons button-orange" title="Volver">
                <i class='bx bx-arrow-back icon-small'></i>
            </a>
            <input type="submit" value="Guardar" class="buttons button-green">
        </div>
    </form>
@endsection