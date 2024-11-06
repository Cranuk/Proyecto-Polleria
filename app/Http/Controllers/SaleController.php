<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController
{
    // ANCHOR: funciones privadas
    private function changeAmountProduct($idProduct, $amountSale){ // NOTE: funcion para cambiar el stock del producto luego de una venta
        $product = Product::findOrFail($idProduct);
        if ($product->amount < $amountSale) {
            return false;
        }else{
            $product->amount -= $amountSale;
            $product->save();
            return true;
        }
    }

    private function calculatePriceSale($idProduct, $amountSale){ // NOTE: funcion para calcular el precio de un venta segun la cantidad que se vendio
        $product = Product::findOrFail($idProduct);
        $total = round($amountSale * $product->price, 2);
        return $total;
    } 

    public function create(){
        $products = Product::all();  // NOTE: obtenemos los productos para cargarlo en el formulario
        $paymentMethods = PaymentMethod::all(); // NOTE: obtenemos los medios de pago para cargarlo en el formulario
        return view('sales.create',[
            'products' => $products,
            'paymentMethods' => $paymentMethods
        ]);
    }

    public function save(Request $request){
        try {
            $productId = $request->input('product_id');
            $amount = $request->input('amount');
            $paymentId = $request->input('payment_id');

            if(self::changeAmountProduct($productId, $amount)){ // ANCHOR: llamamos al metodo auxiliar
                $sale = new Sale();
                $sale->product_id = $productId; // NOTE: en los select se usa el name del select para capturar el dato del option
                $sale->payment_id = $paymentId;
                $sale->amount = $amount;
                $sale->price = self::calculatePriceSale($productId, $amount);
                
                $sale->save();
        
                return redirect()->route('sales')
                                ->with('status', 'Operación realizada con éxito.');
            }else{
                return redirect()->route('sales')
                                ->with('error', 'La cantidad solicitada supera el stock actual');
            }
        } catch (\Exception $e) {
            return redirect()->route('sales')
                            ->with('error', 'Hubo un problema con la operación: ' . $e->getMessage());
        }
    }

    public function edit($id){
        $sale = Sale::findOrFail($id);
        $products = Product::all();
        $paymentMethods = PaymentMethod::all();
        return view('sales.create', [
            'edit' => $sale,
            'products' => $products,
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
