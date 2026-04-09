<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reactivo;

class DashboardController extends Controller
{
    public function index()
    {
        // Estadísticas
        $totalReactivos = Reactivo::where('is_active', true)->count();
        
        $reactivosPorCaducar = Reactivo::where('is_active', true)
            ->whereNotNull('fecha_caducidad')
            ->whereDate('fecha_caducidad', '<=', now()->addDays(30))
            ->whereDate('fecha_caducidad', '>=', now())
            ->count();
        
        $reactivosCaducados = Reactivo::where('is_active', true)
            ->whereNotNull('fecha_caducidad')
            ->whereDate('fecha_caducidad', '<', now())
            ->count();
        
        $totalUnidades = Reactivo::where('is_active', true)->sum('cantidad');

        // Últimos reactivos agregados
        $ultimosReactivos = Reactivo::with('registradoPor')
            ->where('is_active', true)
            ->latest()
            ->limit(5)
            ->get();

        // Reactivos por ubicación
        $reactivosPorUbicacion = Reactivo::where('is_active', true)
            ->selectRaw('ubicacion, count(*) as total')
            ->groupBy('ubicacion')
            ->get();

        return view('dashboard.index', compact(
            'totalReactivos',
            'reactivosPorCaducar',
            'reactivosCaducados',
            'totalUnidades',
            'ultimosReactivos',
            'reactivosPorUbicacion'
        ));
    }
}