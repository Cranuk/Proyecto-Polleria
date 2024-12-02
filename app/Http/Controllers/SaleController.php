<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SaleController
{
    // ANCHOR: funciones privadas
    private function removeAmountProduct($idProduct, $amountDiscount){ // NOTE: funcion para cambiar el stock del producto luego de una venta
        $product = Product::findOrFail($idProduct);
        if ($product->amount < $amountDiscount) {
            return false;
        } else {
            $product->amount -= $amountDiscount;
            $product->save();
            return true;
        }
    }

    private function returnAmountProduct($idProduct, $amountReturn){
        $product = Product::findOrFail($idProduct);
        $product->amount += $amountReturn;
        if ($product->save()) {
            return true;
        } else {
            return false;
        }
    }

    private function calculatePriceSale($idProduct, $amountSale){ // NOTE: funcion para calcular el precio de un venta segun la cantidad que se vendio
        $product = Product::findOrFail($idProduct);
        $total = round($amountSale * $product->price, 2);
        return $total;
    }

    private function productSale($productId, $amount, $paymentId, $date){
        $product = Product::findOrFail($productId);
        if (self::removeAmountProduct($productId, $amount)) {
            $sale = new Sale();
            $sale->product_id = $productId;
            $sale->offer_id = 0;
            $sale->payment_id = $paymentId;
            $sale->amount = $amount;
            $sale->product_price = $product->price;
            $sale->price = self::calculatePriceSale($productId, $amount);
            $sale->created_at = $date;
            $sale->updated_at = $date;

            $sale->save();
            return true;
        } else {
            return false;
        }
    }

    private function offerSale($offerId, $paymentId, $date){
        $offerProduct = Offer::findOrFail($offerId);
        if (self::removeAmountProduct($offerProduct->product_id, $offerProduct->amount_discount)) {
            $sale = new Sale();
            $sale->product_id = 0;
            $sale->offer_id = $offerId;
            $sale->payment_id = $paymentId;
            $sale->amount = $offerProduct->amount_discount;
            $sale->product_price = $offerProduct->price;
            $sale->price = $offerProduct->price;
            $sale->created_at = $date;
            $sale->updated_at = $date;

            $sale->save();
            return true;
        } else {
            return false;
        }
    }

    // ANCHOR: funciones crud

    public function create(){
        $products = Product::all();  // NOTE: obtenemos los productos para cargarlo en el formulario
        $offers = Offer::all(); // NOTE: obtenemos las ofertas para cargarlo en el formulario
        $paymentMethods = PaymentMethod::all(); // NOTE: obtenemos los medios de pago para cargarlo en el formulario
        return view('sales.create', [
            'products' => $products,
            'offers' => $offers,
            'paymentMethods' => $paymentMethods
        ]);
    }

    public function save(Request $request){
        try {
            $data = $request->input('date');
            $date = $data ? Carbon::createFromFormat('d/m/Y', $data)->startOfDay(): Carbon::now();
            
            $productId = $request->input('product_id') ?: 0;
            $offerId = $request->input('offer_id') ?: 0;
            $amount = $request->input('amount');
            $paymentId = $request->input('payment_id');

            if ($productId != 0) {
                if (self::productSale($productId, $amount, $paymentId, $date)) {
                    return redirect()->route('sales')
                        ->with('status', 'Operación realizada con éxito.');
                } else {
                    return redirect()->route('sales')
                        ->with('error', 'La cantidad solicitada supera el stock actual');
                }
            }

            if ($offerId != 0) {
                if (self::offerSale($offerId, $paymentId, $date)) {
                    return redirect()->route('sales')
                        ->with('status', 'Operación realizada con éxito.');
                } else {
                    return redirect()->route('sales')
                        ->with('error', 'La cantidad solicitada supera el stock actual');
                }
            }
        } catch (\Exception $e) {
            return redirect()->route('sales')
                ->with('error', 'Hubo un problema con la operación: ' . $e->getMessage());
        }
    }

    public function delete($id){
        try {
            $sale = Sale::findOrFail($id);
            if($sale->product_id != 0){
                $deleteConfirm = self::returnAmountProduct($sale->product_id, $sale->amount);
                if($deleteConfirm){
                    $sale->delete();
                }
            }

            if($sale->offer_id != 0){
                $offer = Offer::findOrFail($sale->offer_id);
                $deleteConfirm = self::returnAmountProduct($offer->product_id, $offer->amount_discount);
                if($deleteConfirm){
                    $sale->delete();
                }
            }       

            return redirect()->route('sales')
                ->with('status', 'Venta eliminado con éxito.');
        } catch (\Exception $e) {
            return redirect()->route('sales')
                ->with('error', 'Hubo un problema al eliminar la venta: ' . $e->getMessage());
        }
    }
}
