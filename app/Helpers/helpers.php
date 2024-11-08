<?php 
namespace App\Helpers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\Supplie;
use Carbon\Carbon;
use NumberFormatter;
use Illuminate\Support\Facades\DB;

class MyHelpers
{
    // TODO: aquí estarán los métodos que se usarán en toda la web, revisar igual si funciona como corresponde

    // NOTE: función para las fechas
    public static function formatDate($date){
        $fecha = Carbon::parse($date)->format('d/m/Y');
        return $fecha;
    }

    // NOTE: función para monedas
    public static function formatCurrency($price){
        $formatter = new NumberFormatter('es_AR', NumberFormatter::CURRENCY);
        $formatted = $formatter->formatCurrency($price, 'ARS');
        return $formatted;
    }

    // NOTE: funcion para la cantidad en kg
    public static function formatAmount($amount, $unit='kg'){
        $formatter = new NumberFormatter('es_ES', NumberFormatter::DECIMAL);
        $formatter->setAttribute(NumberFormatter::MIN_FRACTION_DIGITS, 0);
        $formatter->setAttribute(NumberFormatter::MAX_FRACTION_DIGITS, 2);
        return $formatter->format($amount) . ' ' . $unit;
    }

    // NOTE: funciones para balance
    public static function getBalancePositive($id=''){
        $month = Carbon::now()->month;
        if(empty($id)){
            $amountPositive = Sale::whereMonth('created_at', '=', $month)
                            ->sum('price');
            return self::formatCurrency($amountPositive);
        }else{
            $amountPositive = Sale::whereMonth('created_at', '=', $month)
                            ->where('payment_id', '=', $id)
                            ->sum('price');
            return self::formatCurrency($amountPositive);
        }
    }
    
    public static function getBalanceNegative(){
        $month = Carbon::now()->month;
        $amountNegative = Supplie::whereMonth('created_at', '=', $month)
                        ->sum('price');
        return self::formatCurrency($amountNegative);
    }

    public static function getBalance(){
        $month = Carbon::now()->month;
        $balancePositive = Sale::whereMonth('created_at', '=', $month)
                            ->sum('price');
        $balanceNegative = Supplie::whereMonth('created_at', '=', $month)
                            ->sum('price');
        $balanceTotal = self::formatCurrency($balancePositive - $balanceNegative);
        return $balanceTotal;
    }
}
