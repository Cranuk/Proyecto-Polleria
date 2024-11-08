@extends('layouts.web')

@section('title', 'Dashboard')

@section('content-dashboard')
<section class="dashboard">
    <div class="dash-content">
        <div class="overview">
            <div class="title">
                <i class='bx bx-home-circle'></i>
                <span class="text">Dashboard</span>
            </div>

            <div class="boxes">
                @foreach($payMethod as $data)
                    <div class="box box1">
                        <i class='bx bx-money'></i>
                        <span class="text">Total de ventas en {{$data->name}}</span>
                        <span class="number">@getBalancePositive($data->id)</span>
                    </div>
                @endforeach
                <div class="box box1">
                    <i class='bx bx-money'></i>
                    <span class="text">Total en ventas</span>
                    <span class="number">@getBalancePositive()</span>
                </div>
            </div>
            <div class="space-10"></div>
            <div class="boxes">
                <div class="box box2">
                    <i class='bx bx-shopping-bag'></i>
                    <span class="text">Total en insumos</span>
                    <span class="number">@getBalanceNegative()</span>
                </div>
                <div class="box box3">
                    <i class='bx bx-line-chart'></i>
                    <span class="text">Balance general</span>
                    <span class="number">@getBalance()</span>
                </div>
            </div>
        </div>

        <div class="activity">
            <div class="title">
                <i class='bx bx-book-content'></i>
                <span class="text">Ultimas ventas</span>
            </div>

            <div class="button-box">
                <a href="{{ route('sales.create')}}" class="buttons button-lightBlue" title="Nueva ventas">
                    <i class='bx bxs-cart-add icon-big'></i>
                </a>
                <a href="{{-- route('sales.create') --}}" class="buttons button-orange" title="Filtrar ventas">
                    <i class='bx bx-filter icon-big'></i>
                </a>
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
                            <td>{{ $sale->product->price ?? 'Precio de oferta' }}</td>
                            <td>@formatAmount($sale->amount)</td>
                            <td>@formatCurrency($sale->price ?? $sale->offer->price)</td>
                            <td>{{ $sale->paymentMethod->name }}</td><!--NOTE: muestra el metodo de pago asociado a la venta-->
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

        </div>
    </div>
</section>
@endsection