<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController
{
    // ANCHOR: funciones privadas
    private function changeAmountProduct($idProduct, $amountDiscount){ // NOTE: funcion para cambiar el stock del producto luego de una venta
        $product = Product::findOrFail($idProduct);
        if ($product->amount < $amountDiscount) {
            return false;
        }else{
            $product->amount -= $amountDiscount;
            $product->save();
            return true;
        }
    }

    private function calculatePriceSale($idProduct, $amountSale){ // NOTE: funcion para calcular el precio de un venta segun la cantidad que se vendio
        $product = Product::findOrFail($idProduct);
        $total = round($amountSale * $product->price, 2);
        return $total;
    }

    private function productSale($productId, $amount, $paymentId){
        if(self::changeAmountProduct($productId, $amount)){
            $sale = new Sale();
            $sale->product_id = $productId;
            $sale->offer_id = 0;
            $sale->payment_id = $paymentId;
            $sale->amount = $amount;
            $sale->price = self::calculatePriceSale($productId, $amount);
            
            $sale->save();
            return true;
        }else{
            return false;
        }
    }

    private function offerSale($offerId, $paymentId){
        $offerProduct = Offer::findOrFail($offerId);
        if(self::changeAmountProduct($offerProduct->product_id, $offerProduct->amount_discount)){
            $sale = new Sale();
            $sale->product_id = 0;
            $sale->offer_id = $offerId;
            $sale->payment_id = $paymentId;
            $sale->amount = $offerProduct->amount_discount;
            $sale->price = $offerProduct->price;
            
            $sale->save();
            return true;
        }else{
            return false;
        }
    }

    public function create(){
        $products = Product::all();  // NOTE: obtenemos los productos para cargarlo en el formulario
        $offers = Offer::all(); // NOTE: obtenemos las ofertas para cargarlo en el formulario
        $paymentMethods = PaymentMethod::all(); // NOTE: obtenemos los medios de pago para cargarlo en el formulario
        return view('sales.create',[
            'products' => $products,
            'offers' => $offers,
            'paymentMethods' => $paymentMethods
        ]);
    }

    public function save(Request $request){
        try {
            $productId = $request->input('product_id') ?: 0;
            $offerId = $request->input('offer_id') ?: 0;
            $amount = $request->input('amount');
            $paymentId = $request->input('payment_id');

            if($productId != 0){
                if(self::productSale($productId, $amount, $paymentId)){
                    return redirect()->route('sales')
                                    ->with('status', 'Operación realizada con éxito.');
                }else{
                    return redirect()->route('sales')
                                    ->with('error', 'La cantidad solicitada supera el stock actual');
                }
            }

            if($offerId != 0){
                if(self::offerSale($offerId, $paymentId)){
                    return redirect()->route('sales')
                                    ->with('status', 'Operación realizada con éxito.');
                }else{
                    return redirect()->route('sales')
                                    ->with('error', 'La cantidad solicitada supera el stock actual');
                }
            }
            
        } catch (\Exception $e) {
            return redirect()->route('sales')
                            ->with('error', 'Hubo un problema con la operación: ' . $e->getMessage());
        }
    }

    public function edit($id){
        $sale = Sale::findOrFail($id);
        $products = Product::all();
        $offers = Offer::all(); 
        $paymentMethods = PaymentMethod::all();
        return view('sales.create', [
            'edit' => $sale,
            'products' => $products,
            'offers' => $offers,
            'paymentMethods' => $paymentMethods
        ]);
    }

    public function update(Request $request){
        try {
            $sale = Sale::findOrFail($request->input('id'));
    
            $sale->product_id = $request->input('product_id');
            $sale->payment_id = $request->input('payment_id');
            $sale->amount = $request->input('amount');
    
            $sale->save();
    
            return redirect()->route('sales')
                            ->with('status', 'Operación realizada con éxito.');
        } catch (\Exception $e) {
            return redirect()->route('sales')
                            ->with('error', 'Hubo un problema con la operación: ' . $e->getMessage());
        }
    }

    public function delete($id){
        try {
            $sale = Sale::findOrFail($id);

            $sale->delete();

            return redirect()->route('sales')
                            ->with('status', 'Venta eliminado con éxito.');
        } catch (\Exception $e) {
            return redirect()->route('sales')
                            ->with('error', 'Hubo un problema al eliminar la venta: ' . $e->getMessage());
        }
    }
}
