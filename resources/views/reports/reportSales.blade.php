<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;900&display=swap">
        <title>Informe</title>
        <style>
            *{
                box-sizing: border-box;
                font-family: "Poppins", sans-serif !important;
                font-weight: bolder;
            }

            table {
                font-size: 13px;
                text-align: center;
                border-collapse: collapse;
                width: 100%;
            }

            th, td {
                padding: 10px;
                color: #0b090a;
            }

            thead tr {
                text-align: center;
                border-bottom: 2px solid #0b090a;
                background-color: #adb5bd;
            }

            tbody tr:nth-child(even) {
                background-color: #adb5bd;
            }

            tbody tr:nth-child(odd) {
                background-color: #ced4da;
            }

            .offer{
                background-color: #f4acb7;
            }

            .title {
                font-size: 18px;
                font-weight: bold;
                text-align: center;
                text-decoration: underline;
                margin-bottom: 20px;
            }

            .total {
                font-size: 16px;
                font-weight: bold;
                margin-top: 20px;
            }
        </style>
    </head>
    <body>
        <p class="title">Informe de ventas</p>
        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio unitario / Oferta</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th>Medio de pago</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                @foreach($resultsArray as $sale)
                    <tr>
                        @isset($sale->offer->name)
                        <td class="offer">
                            {{ $sale->offer->name }}
                        </td>
                        @else
                        <td>
                            {{ $sale->product->name }}
                        </td>
                        @endisset
                        <td>@formatCurrency($sale->product_price ?? $sale->offer->price)</td>
                        <td>@formatAmount($sale->amount, $sale->product->type_unit ?? $sale->offer->type_unit)</td>
                        <td>@formatCurrency($sale->price ?? $sale->offer->price)</td>
                        <td>{{ $sale->paymentMethod->name }}</td>
                        <td>@formatDate($sale->created_at)</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <p class="total">Total de venta en {{ $rangeDate }} - @formatCurrency($total) </p>
    </body>
</html>

