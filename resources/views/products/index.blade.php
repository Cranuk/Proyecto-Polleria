@extends('layouts.web')

@section('title', 'Productos')

@section('content-products')
<section class="section">
    <div class="section-content">
        <div class="title">
            <i class='bx bx-home-circle'></i>
            <span class="text">Productos:</span>
        </div>

        <div class="button-box">
            <a href="{{ route('products.create') }}" class="buttons button-lightBlue" title="Nuevo producto">
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
                    <th>Precio</th>
                    <th>Cantidad en venta</th>
                    <th>Herramientas</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>
                            <i class='bx bx-info-circle d-none {{ $product->amount <= $product->minimal_amount ? 'alert-amount' : '' }}' title="Aviso de poco stock"></i>
                            {{ $product->name }}
                        </td>
                        <td>{{ $product->description }}</td>
                        <td>@formatCurrency($product->price)</td>
                        <td>@formatAmount($product->amount, $product->type_unit)</td>
                        <td>
                            <a href="{{ route('products.edit', ['id'=>$product->id]) }}">
                                <i class='bx bxs-edit-alt'></i>
                            </a>
                            <a href="{{ route('products.delete', ['id'=>$product->id]) }}" class="delete-button">
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
                No hay productos agregados!!!
            </div>
        </div>
    @endif
    <div class="pagination-box">
        {{ $products->links('pagination::bootstrap-4') }}
    </div>
</section>
@endsection