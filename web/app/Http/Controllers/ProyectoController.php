<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proyectos = Proyecto::all();
        return view('proyectos.index', compact('proyectos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:45',
            'descripcion' => 'required|string|max:1024',
            'enlace' => 'nullable|string|max:250',
            'imagenes' => 'nullable|image|mimes:jpeg,png,jpg|max:1024'
        ]);

        DB::beginTransaction();

        try {
            $proyecto = new Proyecto();
            $proyecto->nombre = $request->nombre;
            $proyecto->descripcion = $request->descripcion;
            $proyecto->enlace = $request->enlace;
            $proyecto->save();

            if ($request->hasFile('imagenes')) {
                $image_path = 'public/images/proyectos';
                $image = $request->file('imagenes');
                $name_image = time() . "_" . $image->getClientOriginalName();
                $request->file('imagenes')->storeAs($image_path, $name_image);

                $proyecto->imagenes()->create(['ruta' => $name_image]);
            }

            DB::commit();
            return redirect('/');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect('/');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:45',
            'descripcion' => 'required|string|max:1024',
            'enlace' => 'nullable|string|max:250',
            'imagenes' => 'nullable|image|mimes:jpeg,png,jpg|max:1024'
        ]);

        DB::beginTransaction();

        try {
            $proyecto = Proyecto::find($id);
            $proyecto->nombre = $request->nombre;
            $proyecto->descripcion = $request->descripcion;
            $proyecto->enlace = $request->enlace;
            $proyecto->save();

            if ($request->hasFile('imagenes')) {
                $image_path = 'public/images/proyectos';
                $image = $request->file('imagenes');
                $name_image = time() . "_" . $image->getClientOriginalName();
                $request->file('imagenes')->storeAs($image_path, $name_image);

                if ($proyecto->imagenes()->exists()) {
                    $proyecto->imagenes()->update(['ruta' => $name_image]);
                } else {
                    $proyecto->imagenes()->create(['ruta' => $name_image]);
                }
            }

            DB::commit();
            return redirect('/');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect('/');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            $proyecto = Proyecto::find($id);
            $proyecto->imagenes()->delete();
            $proyecto->delete();

            DB::commit();
            return redirect('/');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect('/');
        }
    }
}
