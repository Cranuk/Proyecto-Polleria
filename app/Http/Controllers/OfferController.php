<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;

class OfferController{
    public function create(){
        $products = Product::all(); // NOTE: obtenemos todos los productos
        return view('offers.create',[
            'products' => $products
        ]);
    }

    public function save(Request $request){
        try {
            $offer = new Offer();
            $offer->product_id = $request->input('product_id');
            $offer->name = $request->input('name');
            $offer->description = $request->input('description');
            $offer->amount_discount = $request->input('amount_discount');
            $offer->price = $request->input('price');
            $offer->type_unit = $request->input('type_unit');
            
            $offer->save();
    
            return redirect()->route('offers')
                            ->with('status', 'Operación realizada con éxito.');
        } catch (\Exception $e) {
            return redirect()->route('offers')
                            ->with('error', 'Hubo un problema con la operación: ' . $e->getMessage());
        }
    }

    public function edit($id){
        $offer = Offer::findOrFail($id);
        $products = Product::all();
        return view('offers.create', [
            'edit' => $offer,
            'products' => $products
        ]);
    }

    public function update(Request $request){
        try {
            $offer = Offer::findOrFail($request->input('id'));
            $offer->product_id = $request->input('product_id');
            $offer->name = $request->input('name');
            $offer->description = $request->input('description');
            $offer->amount_discount = $request->input('amount_discount');
            $offer->price = $request->input('price');
            $offer->type_unit = $request->input('type_unit');
    
            $offer->save();
    
            return redirect()->route('offers')
                            ->with('status', 'Operación realizada con éxito.');
        } catch (\Exception $e) {
            return redirect()->route('offers')
                            ->with('error', 'Hubo un problema con la operación: ' . $e->getMessage());
        }
    }

    public function delete($id){
        try {
            $offer = Offer::findOrFail($id);
            $saleCount = Sale::where('offer_id', $id)->count(); // NOTE: Verificar si la oferta está en algún registro en las ventas
            
            if ($saleCount > 0) {
                return redirect()->route('offers')
                                ->with('error', 'No se puede eliminar la oferta porque está en uso en ' . $saleCount . ' registro(s) de ventas.');
            }
            $offer->delete();

            return redirect()->route('offers')
                            ->with('status', 'Oferta eliminada con éxito.');
        } catch (\Exception $e) {
            return redirect()->route('offers')
                            ->with('error', 'Hubo un problema al eliminar la oferta: ' . $e->getMessage());
        }
    }
}

