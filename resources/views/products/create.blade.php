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
    
    @include('products.form')
@endsection