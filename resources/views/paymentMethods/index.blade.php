@extends('layouts.web')

@section('title', 'Metodos de pago')

@section('content-paymentmethod')
<section class="section">
    <div class="section-content">
        <div class="title">
            <i class='bx bx-home-circle'></i>
            <span class="text">Medios de pago:</span>
        </div>

        <div class="button-box">
            <a href="{{ route('paymentMethods.create') }}" class="buttons button-lightBlue" title="Nuevo medio de pago">
                <i class='bx bx-add-to-queue icon-big'></i>
            </a>
        </div>
    </div>

    <div class="space-10"></div>

    @if($count > 0)
        <table>
            <thead>
                <tr>
                    <th>Medio de pago</th>
                    <th>Descripcion</th>
                    <th>Herramientas</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tables as $methodPay)
                    <tr>
                        <td>{{ $methodPay->name }}</td>
                        <td>{{ $methodPay->description }}</td>
                        <td>
                            <a href="{{ route('paymentMethods.edit', ['id'=>$methodPay->id]) }}">
                                <i class='bx bxs-edit-alt'></i>
                            </a>
                            <form action="{{ route('paymentMethods.delete', ['id'=>$methodPay->id]) }}" method="POST">
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
                No hay medios de pagos registrados!!!
            </div>
        </div>
    @endif
    <div class="pagination-box">
        {{ $tables->links('pagination::bootstrap-4') }}
    </div>
</section>
@endsection