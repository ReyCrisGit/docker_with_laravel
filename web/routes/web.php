<?php

use App\Models\Proyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $proyectos = Proyecto::with('imagenes')->get(); // Asegúrate de cargar la relación de imágenes
    return view('welcome', ['proyectos' => $proyectos]);
})->name('home');

Route::post('/', function (Request $request) {
    // Validación de los datos del formulario
    $request->validate([
        'nombre' => 'required|string|max:45',
        'descripcion' => 'required|string|max:1024',
        'enlace' => 'nullable|string|max:250',
        'imagenes' => 'nullable|image|mimes:jpeg,png,jpg|max:1024'
    ]);

    // Creación del nuevo proyecto
    $proyecto = Proyecto::create([
        'nombre' => $request->nombre,
        'descripcion' => $request->descripcion,
        'enlace' => $request->enlace,
    ]);

    // Almacena la imagen si se ha cargado
    if ($request->hasFile('imagenes')) {
        $image_path = 'public/images/proyectos';
        $image = $request->file('imagenes');
        $name_image = time() . "_" . $image->getClientOriginalName();
        $image->storeAs($image_path, $name_image);

        // Crea la relación con la imagen en la base de datos
        $proyecto->imagenes()->create(['ruta' => $name_image]);
    }

    // Redirigir de vuelta a la raíz con los proyectos actualizados
    return redirect('/');
});
