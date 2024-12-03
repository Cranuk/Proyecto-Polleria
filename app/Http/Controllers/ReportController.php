<?php

namespace App\Http\Controllers;

use App\Services\FilterService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReportController{
    protected $filterService;

    public function __construct(FilterService $filterService){
        $this->filterService = $filterService;
    }

    public function report(Request $request){
        $table = $request -> input('table'); // NOTE: indica a que tabla se realiza la busqueda
        $getDate = $request -> input('date'); // NOTE: capturamos el rango de fechas

        $results = $this->filterService->getFilteredSales($getDate, $table);
        $resultsArray = $results->items();

        $totalPrice = $results->sum(function($sale) { // NOTE: capturamos de la coleccion el campo price y lo sumamos por cada campo price
            return $sale->price;
        });

        $pdf = Pdf::loadView('reports.reportSales', [
            'resultsArray' => $resultsArray,
            'rangeDate' => $getDate,
            'total' => $totalPrice
        ]);

        return $pdf->download('ventas.pdf');
    }
}
