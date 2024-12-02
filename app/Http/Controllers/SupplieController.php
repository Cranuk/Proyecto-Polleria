<?php

namespace App\Http\Controllers;

use App\Models\Supplie;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SupplieController
{
    public function create(){
        return view('supplies.create');
    }

    public function save(Request $request){
        try {
            $data = $request->input('date');
            $date = $data ? Carbon::createFromFormat('d/m/Y', $data)->startOfDay(): Carbon::now();

            $supplie = new Supplie();
            $supplie->name = $request->input('name');
            $supplie->price = $request->input('price');
            $supplie->created_at = $date;
            $supplie->updated_at = $date;
            
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
        $dateFormat = Carbon::parse($supplie->updated_at)->format('d/m/Y');
        return view('supplies.create', [
            'edit' => $supplie,
            'dateFormat' => $dateFormat
        ]);
    }

    public function update(Request $request){
        try {
            $supplie = Supplie::findOrFail($request->input('id'));

            $data = $request->input('date');
            $date = $data ? Carbon::createFromFormat('d/m/Y', $data)->startOfDay(): Carbon::now();
    
            $supplie->name = $request->input('name');
            $supplie->price = $request->input('price');
            $supplie->updated_at = $date;
    
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
