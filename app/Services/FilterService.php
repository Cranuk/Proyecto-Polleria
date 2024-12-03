<?php

namespace App\Services;

use App\Models\Sale;
use App\Models\Supplie;
use Carbon\Carbon;

class FilterService{
    private function getModelByTable($table){ // ANCHOR: funcion que nos indica que modelo usar
        switch ($table) {
            case 'sales':
                return Sale::class;
            case 'supplies':
                return Supplie::class;
            default:
                throw new \Exception("Modelo no encontrado para la tabla: $table");
        }
    }

    private function singleFilterDate($array, $model){
        $dateFilter = trim($array[0]);
        $date = Carbon::createFromFormat('d/m/Y', $dateFilter)->startOfDay();
        $data = $model->whereDate('created_at', $date)
        ->orderBy('created_at', 'asc')
        ->paginate(10);
        return $data;
    }

    private function rangeFilterDate($array, $model){
        list($startDate, $endDate) = $array;
        $startDate = trim($startDate);
        $endDate = trim($endDate);
        $startDate = Carbon::createFromFormat('d/m/Y', $startDate)->startOfDay();
        $endDate = Carbon::createFromFormat('d/m/Y', $endDate)->endOfDay();
        $register = $model->whereBetween('created_at', [$startDate, $endDate])
        ->orderBy('created_at', 'asc')
        ->paginate(10);
        return $register;
    }

    public function getFilteredSales($getDate, $table){
        $getModel = $this->getModelByTable($table); // NOTE: creamos una funcion para capturar dinamicamente el modelo que usara el controlador filter
        $modelQuery = $getModel::query(); // NOTE: crea una instancia de query builder utilizando eloquent de manera dinamica

        $amountDate = explode('a', $getDate);

        if (!empty($getDate) && count($amountDate) == 2) {
            $results = $this->rangeFilterDate($amountDate, $modelQuery);
        }elseif(!empty($getDate) && count($amountDate) == 1){
            $results = $this->singleFilterDate($amountDate, $modelQuery);
        }else {
            $results = $modelQuery->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->orderBy('created_at', 'asc')
            ->paginate(10);
        }

        return $results;
    }
}
