<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentMethod;

class PaymentMethodController 
{
    public function create(){
        return view('paymentMethods.create');
    }

    public function save(Request $request){
        try {
            // Crear una nueva instancia de metodos de pago y asignar los valores
            $payMethod = new PaymentMethod();
            $payMethod->name = $request->input('name');
            $payMethod->description = $request->input('description');
            
            // Guardar el registro en la base de datos
            $payMethod->save();
    
            return redirect()->route('paymentMethods')
                            ->with('status', 'Operación realizada con éxito.');
        } catch (\Exception $e) {
            return redirect()->route('paymentMethods')
                            ->with('error', 'Hubo un problema con la operación: ' . $e->getMessage());
        }
    }

    public function edit($id){
        $paymentMethod = PaymentMethod::findOrFail($id);
        return view('paymentMethods.create', [
            'edit' => $paymentMethod
        ]);
    }

    public function update(Request $request){
        try {
            $paymentMethod = PaymentMethod::findOrFail($request->input('id'));
    
            $paymentMethod->name = $request->input('name');
            $paymentMethod->description = $request->input('description');
    
            $paymentMethod->save();
    
            return redirect()->route('paymentMethods')
                            ->with('status', 'Operación realizada con éxito.');
        } catch (\Exception $e) {
            return redirect()->route('paymentMethods')
                            ->with('error', 'Hubo un problema con la operación: ' . $e->getMessage());
        }
    }

    public function delete($id){
        try {
            $paymentMethod = PaymentMethod::findOrFail($id);

            $paymentMethod->delete();

            return redirect()->route('paymentMethods')
                            ->with('status', 'Metodo de pago eliminado con éxito.');
        } catch (\Exception $e) {
            return redirect()->route('paymentMethods')
                            ->with('error', 'Hubo un problema al eliminar el metodo de pago: ' . $e->getMessage());
        }
    }
}
