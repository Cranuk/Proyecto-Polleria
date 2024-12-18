<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;

class ProductController
{
    public function create(){
        return view('products.create');
    }

    public function save(Request $request){
        try {
            // Crear una nueva instancia de metodos de pago y asignar los valores
            $product = new Product();
            $product->name = $request->input('name');
            $product->description = $request->input('description');
            $product->amount = $request->input('amount');
            $product->minimal_amount = $request->input('minimal_amount');
            $product->price = $request->input('price');
            $product->type_unit = $request->input('type_unit');
            
            // Guardar el registro en la base de datos
            $product->save();
    
            return redirect()->route('products')
                            ->with('status', 'Operación realizada con éxito.');
        } catch (\Exception $e) {
            return redirect()->route('products')
                            ->with('error', 'Hubo un problema con la operación: ' . $e->getMessage());
        }
    }

    public function edit($id){
        $product = Product::findOrFail($id);
        return view('products.create', [
            'edit' => $product
        ]);
    }

    public function update(Request $request){
        try {
            $product = Product::findOrFail($request->input('id'));
    
            $product->name = $request->input('name');
            $product->description = $request->input('description');
            $product->amount = $request->input('amount');
            $product->minimal_amount = $request->input('minimal_amount');
            $product->price = $request->input('price');
            $product->type_unit = $request->input('type_unit');
    
            $product->save();
    
            return redirect()->route('products')
                            ->with('status', 'Operación realizada con éxito.');
        } catch (\Exception $e) {
            return redirect()->route('products')
                            ->with('error', 'Hubo un problema con la operación: ' . $e->getMessage());
        }
    }

    public function delete($id){
        try {
            $product = Product::findOrFail($id);
            $saleCount = Sale::where('product_id', $id)->count(); // NOTE: Verificar si el producto está en algún registro en las ventas
            
            if ($saleCount > 0) {
                return redirect()->route('products')
                                ->with('error', 'No se puede eliminar el producto porque está en uso en ' . $saleCount . ' registro(s) de ventas.');
            }

            $product->delete();
            
            return redirect()->route('products')
                            ->with('status', 'Metodo de pago eliminado con éxito.');
        } catch (\Exception $e) {
            return redirect()->route('products')
                            ->with('error', 'Hubo un problema al eliminar el metodo de pago: ' . $e->getMessage());
        }
    }
}
