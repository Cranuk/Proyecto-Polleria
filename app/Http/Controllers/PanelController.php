<?php

namespace App\Http\Controllers;

// NOTE: dependencias de laravel
use Carbon\Carbon;

// NOTE: modelos
use App\Models\Sale;
use App\Models\Supplie;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\Offer;

class PanelController
{
    public function sales(){ // NOTE: estas funcion obtiene los datos del mes actual
        $sales = Sale::whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        $count = $sales->count();

        return view('sales.index',[
            'tables' => $sales,
            'count' => $count
        ]);
    }

    public function supplies(){
        $supplies = Supplie::whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        $count = $supplies->count();

        return view('supplies.index',[
            'tables' => $supplies,
            'count' => $count
        ]);
    }

    public function products(){
        $products = Product::orderBy('created_at', 'desc')
                ->paginate(10);
        $count = Product::count();

        return view('products.index',[
            'tables' => $products,
            'count' => $count
        ]);
    }

    public function paymentMethod(){
        $methodPay = PaymentMethod::orderBy('created_at', 'desc')
                    ->paginate(10);
        $count = PaymentMethod::count();

        return view('paymentMethods.index',[
            'tables' => $methodPay,
            'count' => $count
        ]);
    }

    public function offers(){
        $offers = Offer::orderBy('created_at', 'desc')
                ->paginate(10);
        $count = Offer::count();

        return view('offers.index',[
            'tables' => $offers,
            'count' => $count
        ]);
    }
}
