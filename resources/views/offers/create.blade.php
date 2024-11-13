@extends('layouts.web')

@php
    $title = isset($edit) ? 'Editar Oferta' : 'Nueva oferta';
    $route = isset($edit) ? 'offers.update' : 'offers.save';
@endphp

@section('title', $title)

@section('content-offers')
    <div class="subtitle underlined center">
        @isset($edit)
            Editar oferta
        @else
            Nueva oferta
        @endisset
    </div>

    <div class="space-10"></div>
    
    @include('offers.form')
@endsection