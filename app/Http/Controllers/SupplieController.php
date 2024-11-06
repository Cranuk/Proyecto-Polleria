<?php

namespace App\Http\Controllers;

use App\Models\Supplie;
use Illuminate\Http\Request;

class SupplieController
{
    public function create(){
        return view('supplies.create');
    }

    public function save(Request $request){
        try {
            $supplie = new Supplie();
            $supplie->name = $request->input('name');
            $supplie->price = $request->input('price');
            
            $supplie->save();
    
            return redirect()->route('supplies')
                            ->with('status', 'Operación realizada con éxito.');
        } catch (\Exception $e) {
            return redirect()->route('supplies')
                            ->with('error', 'Hubo un problema con la operación: ' . $e->getMessage());
        }
    }

    public function edit($id){
        $supplie = Supplie::findOrFail($id);
        return view('supplies.create', [
            'edit' => $supplie
        ]);
    }

    public function update(Request $request){
        try {
            $supplie = Supplie::findOrFail($request->input('id'));
    
            $supplie->name = $request->input('name');
            $supplie->price = $request->input('price');
    
            $supplie->save();
    
            return redirect()->route('supplies')
                            ->with('status', 'Operación realizada con éxito.');
        } catch (\Exception $e) {
            return redirect()->route('supplies')
                            ->with('error', 'Hubo un problema con la operación: ' . $e->getMessage());
        }
    }

    public function delete($id){
        try {
            $supplie = Supplie::findOrFail($id);

            $supplie->delete();

            return redirect()->route('supplies')
                            ->with('status', 'Insumo eliminado con éxito.');
        } catch (\Exception $e) {
            return redirect()->route('supplies')
                            ->with('error', 'Hubo un problema al eliminar el insumo: ' . $e->getMessage());
        }
    }
}
