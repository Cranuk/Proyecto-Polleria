@extends('layouts.web')

@php
    $title = 'Nueva venta';
    $route = 'sales.save';
@endphp

@section('title', $title)

@section('content-sales')
    <div class="subtitle underlined center">
        Nueva venta
    </div>

    <div class="space-10"></div>

    @include('sales.form')
@endsection