<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Routing\Controller;

class IndexController extends Controller
{
    public function main(){
        $payMethod = PaymentMethod::all();
        $sales = Sale::whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year)
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();
        $count = $sales->count();

        return view('main',[
            'payMethod' => $payMethod,
            'sales' => $sales,
            'count' => $count
        ]);
    }
}
