<?php

namespace App\Http\Controllers;

use App\Models\GceCaracteristicas;
use Illuminate\Http\Request;

class GceCaracteristicasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gce_caracteristicas = GceCaracteristicas::paginate(10);
        return $gce_caracteristicas;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'gce_nombre_equipo' => ['required', 'string', 'min:1'],
            'gce_board' => ['required', 'string', 'min:1'],
            'gce_case' => ['required', 'string', 'min:1'],
            'gce_procesador' => ['required', 'string', 'min:1'],
            'gce_grafica' => ['required', 'string', 'min:1'],
            'gce_ram' => ['required', 'min:1|max:100'],
            'gce_disco_duro' => ['required', 'string', 'min:1'],
            'gce_teclado' => ['required', 'string', 'min:1'],
            'gce_mouse' => ['required', 'string', 'min:1'],
            'gce_pantalla' => ['required', 'min:1|max:100'],
        ]);

        $result = GceCaracteristicas::create($request->all());

        return response()->json($result);

    }

    
    public function show($id)
    {
        $result = GceCaracteristicas::find($id);
        return response()->json($result);
    }

    
    public function update(Request $request, $id)
    {

        $validatedData = $request->validate([
            'gce_nombre_equipo' => ['required', 'string', 'min:3'],
            'gce_board' => ['required', 'string', 'min:3'],
            'gce_case' => ['required', 'string', 'min:3'],
            'gce_procesador' => ['required', 'string', 'min:3'],
            'gce_grafica' => ['required', 'string', 'min:3'],
            'gce_ram' => ['required', 'min:1|max:100'],
            'gce_disco_duro' => ['required', 'string', 'min:3'],
            'gce_teclado' => ['required', 'string', 'min:3'],
            'gce_mouse' => ['required', 'string', 'min:3'],
            'gce_pantalla' => ['required', 'min:1|max:100'],
        ]);

        $item = GceCaracteristicas::find($id);
        $item->update($request->all());
        
        return response()->json($item);
    }

    
    public function destroy($id)
    {
        $item = GceCaracteristicas::find($id);
        $item->delete();
    }
}
