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
                <div class="box box1">
                    <i class='bx bx-money'></i>
                    <span class="text">Total en ventas</span>
                    <span class="number">@getBalancePositive()</span>
                </div>
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
                <a href="{{ route('sales.create')}}" class="buttons button-lightBlue" title="Agregar medio de pago">
                    <i class='bx bxs-cart-add icon-big'></i>
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
        
            @if($count > 0) <!-- crear el count para poder configurar la tabla mas adelante $count > 0-->
                <table>
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Medio de pago</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sales as $sale)
                            <tr>
                                <td>{{ $sale->product->name }}</td><!--FIXME: esto se debe modificar para que traiga el dato requerido-->
                                <td>@formatAmount($sale->amount)</td>
                                <td>@formatCurrency($sale->price)</td>
                                <td>{{ $sale->paymentMethod->name }}</td><!--FIXME: esto se debe modificar para que traiga el dato requerido-->
                                <td>@formatDate($sale->created_at)</td>
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