<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Routing\Controller;

class IndexController extends Controller
{
    public function main(){
        $sales = Sale::whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year)
                ->orderBy('created_at', 'desc')
                ->take(7)
                ->get();
        $count = $sales->count();

        return view('main',[
            'sales' => $sales,
            'count' => $count
        ]);
    }
}
