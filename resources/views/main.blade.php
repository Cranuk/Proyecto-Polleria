@extends('layouts.web')

@section('title', 'Dashboard')

@section('content-dashboard')
<section class="dashboard">
    <div class="dash-content">
        <div class="title">
            <i class='bx bx-home-circle'></i>
            <span class="text">Dashboard</span>
        </div>

        <div class="boxes">
            @foreach($payMethod as $data)
                <div class="box box1">
                    <i class='bx bx-money'></i>
                    <p class="text">Total en {{$data->name}}</p>
                    <p class="number">@getBalancePositive($data->id)</p>
                </div>
            @endforeach
            <div class="box box1">
                <i class='bx bx-money'></i>
                <p class="text">Total en ventas</p>
                <p class="number">@getBalancePositive()</p>
            </div>
        </div>

        <div class="boxes">
            <div class="box box2">
                <i class='bx bx-shopping-bag'></i>
                <p class="text">Total en insumos</p>
                <p class="number">@getBalanceNegative()</p>
            </div>
            <div class="box box3">
                <i class='bx bx-line-chart'></i>
                <p class="text">Balance general</p>
                <p class="number">@getBalance()</p>
            </div>
        </div>

        <div class="activity">
            <div class="title">
                <i class='bx bx-book-content'></i>
                <p class="text">Ultimas ventas</p>
            </div>
        
        @if($count > 0)
            <table>
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio x kg</th>
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
                            <td>{{ $sale->product->price ?? $sale->offer->price }}</td>
                            <td>@formatAmount($sale->amount, $sale->product->type_unit ?? $sale->offer->type_unit)</td>
                            <td>@formatCurrency($sale->price ?? $sale->offer->price)</td>
                            <td>{{ $sale->paymentMethod->name }}</td><!--NOTE: muestra el metodo de pago asociado a la venta-->
                            <td>@formatDate($sale->created_at)</td>
                            <td>
                                <a href="{{ route('sales.delete', ['id'=>$sale->id]) }}" class="delete-button">
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

        </div>
    </div>
</section>
@endsection