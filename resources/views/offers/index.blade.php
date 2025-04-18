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
                @foreach($tables as $offer)
                    <tr>
                        <td>{{ $offer->name }}</td>
                        <td>{{ $offer->description }}</td>
                        <td>@formatCurrency($offer->price)</td>
                        <td>@formatAmount($offer->amount_discount, $offer->type_unit)</td>
                        <td>
                            <a href="{{ route('offers.edit', ['id'=>$offer->id]) }}">
                                <i class='bx bxs-edit-alt'></i>
                            </a>
                            <form action="{{ route('offers.delete', ['id'=>$offer->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-button" title="Eliminar medio de pago">
                                    <i class='bx bxs-trash-alt'></i>
                                </button>
                            </form>
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
        {{ $tables->links('pagination::bootstrap-4') }}
    </div>
</section>
@endsection