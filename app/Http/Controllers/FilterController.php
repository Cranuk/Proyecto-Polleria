<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FilterController
{
    private function getModelByTable($table){ // ANCHOR: funcion que nos indica que modelo usar
        switch ($table) {
            case 'sales':
                return Sale::class;
            default:
                throw new \Exception("Modelo no encontrado para la tabla: $table");
        }
    }


    public function filter(Request $request){
        $table = $request -> input('table'); // NOTE: indica a que tabla se realiza la busqueda
        $getDate = $request -> input('date'); // NOTE: capturamos la fecha

        $getModel = $this->getModelByTable($table); // NOTE: creamos una funcion para capturar dinamicamente el modelo usado por el filtro
        $model = $getModel::query();

        if (!empty($getDate)) {
            $date = Carbon::createFromFormat('d/m/Y', $getDate)->startOfDay();
            $register = $model->whereDate('created_at', '=', $date)->paginate(10);
        }else{
            $register = $model->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        }

        $count = $model->count();

        $page = $table.'.index';

        return view($page,[
            'tables' => $register,
            'count' => $count
        ]);
    }
}