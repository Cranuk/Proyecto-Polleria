<?php

namespace App\Http\Controllers;

// NOTE: dependencias de laravel
use Carbon\Carbon;

// NOTE: modelos
use App\Models\Sale;
use App\Models\Supplie;
use App\Models\PaymentMethod;
use App\Models\Product;

class PanelController
{
    public function sales(){ // NOTE: estas funcion obtiene los datos del mes actual
        $sales = Sale::whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year)
                ->orderBy('created_at', 'desc')
                ->get();
        $count = $sales->count();

        return view('sales.index',[
            'sales' => $sales,
            'count' => $count
        ]);
    }

    public function supplies(){
        $supplies = Supplie::whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year)
                ->get();
        $count = $supplies->count();

        return view('supplies.index',[
            'supplies' => $supplies,
            'count' => $count
        ]);
    }

    public function products(){
        $products = Product::all();
        $count = Product::count();

        return view('products.index',[
            'products' => $products,
            'count' => $count
        ]);
    }

    public function paymentMethod(){
        $methodPay = PaymentMethod::all();
        $count = PaymentMethod::count();

        return view('paymentMethods.index',[
            'methodPay' => $methodPay,
            'count' => $count
        ]);
    }
}
