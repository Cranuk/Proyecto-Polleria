@extends('layouts.web')

@section('title', 'Insumos')

@section('content-supplies')
<section class="section">
    <div class="section-content">
        <div class="title">
            <i class='bx bx-home-circle'></i>
            <span class="text">Insumos:</span>
        </div>

        <div class="button-box">
            <a href="{{ route('supplies.create') }}" class="buttons button-lightBlue" title="Nuevo insumo">
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
                    <th>Precio</th>
                    <th>Fecha</th>
                    <th>Herramientas</th>
                </tr>
            </thead>
            <tbody>
                @foreach($supplies as $supplie)
                    <tr>
                        <td>{{ $supplie->name }}</td>
                        <td>@formatCurrency($supplie->price)</td>
                        <td>@formatDate($supplie->created_at)</td>
                        <td>
                            <a href="{{ route('supplies.edit', ['id'=>$supplie->id]) }}">
                                <i class='bx bxs-edit-alt'></i>
                            </a>
                            <a href="{{ route('supplies.delete', ['id'=>$supplie->id]) }}">
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
                No hay insumos agregados!!!
            </div>
        </div>
    @endif
</section>
@endsection