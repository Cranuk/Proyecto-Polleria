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
                <i class='bx bxs-cart-add icon-big'></i>
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

    @if($count > 0) <!-- crear el count para poder configurar la tabla mas adelante $count > 0-->
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
                @foreach($sales as $sale)
                    <tr>
                        <td>
                            @isset($sale->offer->name)
                                <i class='bx bxs-offer' title="Oferta"></i>
                                {{ $sale->offer->name }}
                            @else
                                {{ $sale->product->name }}
                            @endisset
                        </td>
                        <td>@formatCurrency( $sale->product->price ?? $sale->offer->price )</td>
                        <td>@formatAmount($sale->amount)</td>
                        <td>@formatCurrency($sale->price ?? $sale->offer->price)</td>
                        <td>{{ $sale->paymentMethod->name }}</td>
                        <td>@formatDate($sale->created_at)</td>
                        <td>
                            <a href="{{ route('sales.edit', ['id'=>$sale->id]) }}">
                                <i class='bx bxs-edit-alt'></i>
                            </a>
                            <a href="{{ route('sales.delete', ['id'=>$sale->id]) }}">
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
                No hay ventas registradas en el mes!!!
            </div>
        </div>
    @endif
</section>
@endsection