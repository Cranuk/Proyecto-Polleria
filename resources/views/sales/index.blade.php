@extends('layouts.web')

@section('title', 'Ventas')

@section('content-sales')
<section class="section">
    <div class="section-content">
        <div class="title">
            <i class='bx bx-home-circle'></i>
            <span class="text">Ventas:</span>
        </div>

        <div class="button-box">
            <a href="{{ route('sales.create')}}" class="buttons button-lightBlue" title="Nueva venta">
                <i class='bx bx-add-to-queue icon-big'></i>
            </a>
            <a id="filter-button" class="buttons button-yellow" title='Filtro' data-table="sales">
                <i class='bx bx-filter icon-big'></i>
            </a>            
            <a id="report-button" class="buttons button-red" title='Generar reporte' data-table="sales">
                <i class='bx bxs-file-pdf icon-big'></i>
            </a>
        </div>
    </div>

    <div class="space-10"></div>

    @if($count > 0)
        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio unitario / Oferta</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th>Medio de pago</th>
                    <th>Fecha</th>
                    <th>Herramientas</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tables as $sale)
                    <tr>
                        <td>
                            @isset($sale->offer->name)
                                <i class='bx bxs-offer' title="Oferta"></i>
                                {{ $sale->offer->name }}
                            @else
                                {{ $sale->product->name }}
                            @endisset
                        </td>
                        <td>@formatCurrency( $sale->product_price ?? $sale->offer->price )</td>
                        <td>@formatAmount($sale->amount, $sale->product->type_unit ?? $sale->offer->type_unit)</td>
                        <td>@formatCurrency($sale->price ?? $sale->offer->price)</td>
                        <td>{{ $sale->paymentMethod->name }}</td>
                        <td>@formatDate($sale->created_at)</td>
                        <td>
                            <form action="{{ route('sales.delete', ['id'=>$sale->id]) }}" method="POST">
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
                No hay ventas registradas en el mes!!!
            </div>
        </div>
    @endif
    <div class="pagination-box">
        {{ $tables->links('pagination::bootstrap-4') }}
    </div>
</section>
@endsection