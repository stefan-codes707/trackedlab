<?php

namespace App\Http\Controllers;

use App\Models\Reactivo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ReactivoController extends Controller
{
    public function index(Request $request)
    {
        $query = Reactivo::with('registradoPor')->where('is_active', true);

        // Búsqueda
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nombre', 'like', "%{$search}%")
                  ->orWhere('formula_quimica', 'like', "%{$search}%")
                  ->orWhere('ubicacion', 'like', "%{$search}%")
                  ->orWhere('proveedor', 'like', "%{$search}%");
            });
        }

        // Filtros
        if ($request->has('ubicacion') && $request->ubicacion != '') {
            $query->where('ubicacion', $request->ubicacion);
        }

        if ($request->has('estado')) {
            if ($request->estado == 'proximo') {
                $query->whereNotNull('fecha_caducidad')
                    ->whereDate('fecha_caducidad', '<=', now()->addDays(30))
                    ->whereDate('fecha_caducidad', '>=', now());
            } elseif ($request->estado == 'caducado') {
                $query->whereNotNull('fecha_caducidad')
                    ->whereDate('fecha_caducidad', '<', now());
            }
        }

        $reactivos = $query->orderBy('nombre')->paginate(10);
        
        // Obtener ubicaciones únicas para el filtro
        $ubicaciones = Reactivo::where('is_active', true)
            ->select('ubicacion')
            ->distinct()
            ->pluck('ubicacion');

        return view('reactivos.index', compact('reactivos', 'ubicaciones'));
    }

    public function create()
    {
        return view('reactivos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'formula_quimica' => 'nullable|string|max:100',
            'cantidad' => 'required|numeric|min:0',
            'unidad_medida' => 'required|string|max:20',
            'fecha_caducidad' => 'nullable|date|after:today',
            'proveedor' => 'nullable|string|max:200',
            'ubicacion' => 'required|string|max:100',
            'lote' => 'nullable|string|max:50',
        ]);

        $data = $request->all();
        $data['qr_code'] = Reactivo::generateQRCode();
        $data['registrado_por'] = Auth::id();

        $reactivo = Reactivo::create($data);

        // Generar QR image
      // Después de crear el reactivo, generar QR en SVG
        $qrCode = QrCode::format('svg')->size(200)->generate($reactivo->qr_code);
        $reactivo->qr_image = 'data:image/svg+xml;base64,' . base64_encode($qrCode);
        $reactivo->save();

        return redirect()->route('reactivos.show', $reactivo)
            ->with('success', 'Reactivo registrado exitosamente.');
    }

    public function show(Reactivo $reactivo)
    {
        return view('reactivos.show', compact('reactivo'));
    }

    public function edit(Reactivo $reactivo)
    {
        return view('reactivos.edit', compact('reactivo'));
    }

    public function update(Request $request, Reactivo $reactivo)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'formula_quimica' => 'nullable|string|max:100',
            'cantidad' => 'required|numeric|min:0',
            'unidad_medida' => 'required|string|max:20',
            'fecha_caducidad' => 'nullable|date',
            'proveedor' => 'nullable|string|max:200',
            'ubicacion' => 'required|string|max:100',
            'lote' => 'nullable|string|max:50',
        ]);

        $reactivo->update($request->all());

        return redirect()->route('reactivos.show', $reactivo)
            ->with('success', 'Reactivo actualizado exitosamente.');
    }

    public function destroy(Reactivo $reactivo)
    {
        $reactivo->is_active = false;
        $reactivo->save();

        return redirect()->route('reactivos.index')
            ->with('success', 'Reactivo eliminado exitosamente.');
    }

    public function downloadQR(Reactivo $reactivo)
{
    $qrCode = QrCode::format('svg')
        ->size(300)
        ->generate(url('/qr/' . $reactivo->qr_code));  // <-- URL pública
    
    return response($qrCode)
        ->header('Content-Type', 'image/svg+xml')
        ->header('Content-Disposition', 'attachment; filename="qr_' . $reactivo->nombre . '.svg"');
}

    public function scanQR()
    {
        return view('reactivos.scan');
    }

    public function verifyQR(Request $request)
    {
        $qrCode = $request->qr_code;
        $reactivo = Reactivo::where('qr_code', $qrCode)->where('is_active', true)->first();

        if ($reactivo) {
            return response()->json([
                'success' => true,
                'reactivo' => $reactivo,
                'url' => route('reactivos.show', $reactivo)
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Reactivo no encontrado'
        ]);
    }

    public function publicShow($qr_code)
    {
    $reactivo = Reactivo::where('qr_code', $qr_code)
        ->where('is_active', true)
        ->first();

    if (!$reactivo) {
        abort(404, 'Reactivo no encontrado');
    }

    return view('reactivos.public', compact('reactivo'));
    }
}