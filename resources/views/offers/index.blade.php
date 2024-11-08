@extends('layouts.web')

@section('title', 'Ofertas')

@section('content-offers')
<section class="section">
    <div class="section-content">
        <div class="title">
            <i class='bx bx-home-circle'></i>
            <span class="text">Ofertas vigentes:</span>
        </div>

        <div class="button-box">
            <a href="{{ route('offers.create') }}" class="buttons button-lightBlue" title="Nueva oferta">
                <i class='bx bx-add-to-queue icon-big'></i>
            </a>
        </div>
    </div>

    <div class="alert-box">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    </div>

    <div class="space-10"></div>

    @if($count > 0)
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Precio en oferta</th>
                    <th>Cantidad en oferta</th>
                    <th>Herramientas</th>
                </tr>
            </thead>
            <tbody>
                @foreach($offers as $offer)
                    <tr>
                        <td>{{ $offer->name }}</td>
                        <td>{{ $offer->description }}</td>
                        <td>@formatCurrency($offer->price)</td>
                        <td>@formatAmount($offer->amount_discount)</td>
                        <td>
                            <a href="{{ route('offers.edit', ['id'=>$offer->id]) }}">
                                <i class='bx bxs-edit-alt'></i>
                            </a>
                            <a href="{{ route('offers.delete', ['id'=>$offer->id]) }}">
                                <i class='bx bxs-trash-alt'></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="alert-box">
            <div class="alert alert-notice">
                <i class='bx bxs-info-square icon-head icon-medium'></i>
                No hay ofertas agregadas!!!
            </div>
        </div>
    @endif
    <div class="pagination-box">
        {{ $offers->links('pagination::bootstrap-4') }}
    </div>
</section>
@endsection