<?php

namespace App\Http\Controllers;

use App\Services\FilterService;
use Illuminate\Http\Request;

class FilterController{
    protected $filterService;

    public function __construct(FilterService $filterService){
        $this->filterService = $filterService;
    }

    public function filter(Request $request){
        $table = $request -> input('table'); // NOTE: indica a que tabla se realiza la busqueda
        $getDate = $request -> input('date'); // NOTE: capturamos el rango de fechas

        $results = $this->filterService->getFilteredSales($getDate, $table);

        $count = count($results);
        $page = $table.'.index';

        return view($page,[
            'tables' => $results,
            'count' => $count
        ]);
    }
}