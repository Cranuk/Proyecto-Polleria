<?php

namespace App\Http\Controllers;

use App\Models\Product;
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
            $product->price = $request->input('price');
            $product->amount = $request->input('amount');
            $product->minimal_amount = $request->input('minimal_amount');
            
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
            $product->price = $request->input('price');
            $product->amount = $request->input('amount');
            $product->minimal_amount = $request->input('minimal_amount');
    
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

            $product->delete();

            return redirect()->route('products')
                            ->with('status', 'Metodo de pago eliminado con éxito.');
        } catch (\Exception $e) {
            return redirect()->route('products')
                            ->with('error', 'Hubo un problema al eliminar el metodo de pago: ' . $e->getMessage());
        }
    }
}
