<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EL BLOG DE LOS INGENIEROS</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body class="bg-gray-100 text-gray-800">
    <div class="container mx-auto p-8">

        <!-- Logo del Blog -->
        <div class="flex justify-center mb-8">
            <img src="{{ asset('img/logo.png') }}" alt="Logo del blog" class="w-1/3 md:w-1/4 lg:w-1/6">
        </div>

        <!-- Descripción del Blog -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-indigo-700">EL BLOG DE LOS INGENIEROS</h1>
            <p class="text-lg text-indigo-500 font-semibold">Transformando Ideas en Realidad</p>
            <p class="mt-4 text-gray-600">Bienvenidos a nuestro blog. Aquí compartimos nuestros proyectos y
                aspiraciones, esperando inspirar a futuros ingenieros. Conoce más sobre nuestro trabajo a continuación.
            </p>
        </div>

        <!-- Botón para abrir el modal de creación -->
        <div class="text-center mb-8">
            <button onclick="openModal()"
                class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700 transition">
                Crear Nuevo Proyecto
            </button>
        </div>

        <!-- Modal de creación de proyecto -->
        <div id="modal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex items-center justify-center hidden">
            <div class="bg-white p-6 rounded-lg w-11/12 md:w-1/2 lg:w-1/3">
                <h2 class="text-xl font-bold mb-4 text-indigo-700">Nuevo Proyecto</h2>
                <form id="modal-form" action="/" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="nombre" class="block text-gray-700">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" class="w-full border-gray-300 rounded"
                            required>
                    </div>
                    <div class="mb-4">
                        <label for="descripcion" class="block text-gray-700">Descripción:</label>
                        <textarea name="descripcion" id="descripcion" rows="4" class="w-full border-gray-300 rounded" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="enlace" class="block text-gray-700">Enlace:</label>
                        <input type="text" name="enlace" id="enlace" class="w-full border-gray-300 rounded">
                    </div>
                    <div class="mb-4">
                        <label for="imagenes" class="block text-gray-700">Imagen:</label>
                        <input type="file" name="imagenes" id="imagenes" class="w-full border-gray-300 rounded">
                    </div>
                    <div class="flex justify-end">
                        <button type="button" onclick="closeModal()"
                            class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Cancelar</button>
                        <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded">Guardar</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Listado de proyectos -->
        <div id="project-list" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
            @foreach ($proyectos as $proyecto)
                <div class="bg-white p-4 rounded-lg shadow">
                    <img src="{{ $proyecto->imagenes->isEmpty() ? asset('img/default.jpg') : asset('storage/images/proyectos/' . $proyecto->imagenes->first()->ruta) }}"
                        alt="Imagen del proyecto" class="w-full h-40 object-contain rounded mb-4">
                    <h3 class="text-xl font-semibold text-indigo-700">{{ $proyecto->nombre }}</h3>
                    <p class="text-gray-600 mt-2">{{ $proyecto->descripcion }}</p>
                    @if ($proyecto->enlace)
                        <a href="{{ $proyecto->enlace }}" target="_blank" rel="noopener noreferrer"
                            class="text-blue-500 mt-2 inline-block hover:underline">Visitar</a>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    <!-- Scripts -->
    <script>
        function openModal() {
            document.getElementById('modal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('modal').classList.add('hidden');
        }
    </script>
</body>

</html>
