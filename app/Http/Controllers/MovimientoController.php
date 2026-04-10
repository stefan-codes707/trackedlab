<?php
// app/Http/Controllers/MovimientoController.php

namespace App\Http\Controllers;

use App\Models\Reactivo;
use App\Models\Movimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovimientoController extends Controller
{
    public function index(Request $request)
    {
        $query = Movimiento::with(['reactivo', 'usuario']);
        
        // Filtros
        if ($request->filled('tipo')) {
            $query->where('tipo', $request->tipo);
        }
        
        if ($request->filled('reactivo_id')) {
            $query->where('reactivo_id', $request->reactivo_id);
        }
        
        if ($request->filled('fecha_desde')) {
            $query->whereDate('created_at', '>=', $request->fecha_desde);
        }
        
        if ($request->filled('fecha_hasta')) {
            $query->whereDate('created_at', '<=', $request->fecha_hasta);
        }
        
        $movimientos = $query->latest()->paginate(20);
        $reactivos = Reactivo::orderBy('nombre')->get();
        
        return view('movimientos.index', compact('movimientos', 'reactivos'));
    }

    public function create()
    {
        $reactivos = Reactivo::orderBy('nombre')->get();
        return view('movimientos.create', compact('reactivos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'reactivo_id' => 'required|exists:reactivos,id',
            'tipo' => 'required|in:entrada,salida',
            'cantidad' => 'required|numeric|min:0.01',
            'motivo' => 'nullable|string|max:500',
            'folio' => 'nullable|string|max:50',
            'responsable' => 'nullable|string|max:100',
        ]);

        DB::beginTransaction();
        
        try {
            $reactivo = Reactivo::findOrFail($request->reactivo_id);
            $cantidadOriginal = $request->cantidad;
            $cantidadAntes = $reactivo->cantidad;
            
            if ($request->tipo === 'entrada') {
                $cantidadDespues = $reactivo->cantidad + $cantidadOriginal;
                $reactivo->cantidad = $cantidadDespues;
                $mensaje = "Se agregaron {$cantidadOriginal} {$reactivo->unidad_medida} al inventario";
            } else {
                // Salida - validar stock suficiente
                if ($reactivo->cantidad < $cantidadOriginal) {
                    throw new \Exception("Stock insuficiente. Disponible: {$reactivo->cantidad} {$reactivo->unidad_medida}");
                }
                $cantidadDespues = $reactivo->cantidad - $cantidadOriginal;
                $reactivo->cantidad = $cantidadDespues;
                $mensaje = "Se retiraron {$cantidadOriginal} {$reactivo->unidad_medida} del inventario";
            }
            
            $reactivo->save();
            
            Movimiento::create([
                'reactivo_id' => $request->reactivo_id,
                'tipo' => $request->tipo,
                'cantidad' => $cantidadOriginal,
                'cantidad_antes' => $cantidadAntes,
                'cantidad_despues' => $cantidadDespues,
                'motivo' => $request->motivo,
                'usuario_id' => auth()->id(),
                'folio' => $request->folio,
                'responsable' => $request->responsable,
            ]);
            
            DB::commit();
            
            return redirect()->route('movimientos.index')
                ->with('success', $mensaje);
                
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function show(Movimiento $movimiento)
    {
        $movimiento->load(['reactivo', 'usuario']);
        return view('movimientos.show', compact('movimiento'));
    }
}