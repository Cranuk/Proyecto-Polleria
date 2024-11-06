@extends('layouts.web')

@php
    $title = isset($edit) ? 'Editar Medio de pago' : 'Nuevo medio de pago';
    $route = isset($edit) ? 'paymentMethods.update' : 'paymentMethods.save';
@endphp

@section('title', $title)

@section('content-paymentmethod')
    <div class="subtitle underlined center">
        @isset($edit)
            Editar Medio de pago
        @else
            Nuevo medio de pago
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

        <div class="button-box">
            <a href="{{ route('paymentMethods') }}" class="buttons button-orange" title="Volver">
                <i class='bx bx-arrow-back icon-small'></i>
            </a>
            <input type="submit" value="Guardar" class="buttons button-green">
        </div>
    </form>
@endsection