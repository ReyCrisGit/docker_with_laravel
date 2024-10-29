<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EL BLOG DE INGENIEROS</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 text-gray-800">
    <div class="container mx-auto p-8">
        <div class="flex justify-center mb-8">
            <img src="{{ asset('img/logo.png') }}" alt="Logo del blog" class="w-1/4">
        </div>
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-indigo-700">EL BLOG DE INGENIEROS</h1>
            <p class="text-lg text-indigo-500 font-semibold">TRANSFORMANDO IDEAS EN REALIDAD</p>
            <p class="mt-4 text-gray-600">Bienvenidos a nuestro blog. Aquí compartimos nuestros proyectos e ideas.</p>
            <p class="mt-2 text-gray-600">El equipo está compuesto por <strong>Ariel</strong> y
                <strong>Cristian</strong>.
            </p>
        </div>
        <div class="text-center mb-8">
            <button onclick="openModal()"
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Crear Nuevo
                Proyecto</button>
        </div>
        <div id="modal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex items-center justify-center hidden">
            <div class="bg-white p-6 rounded-lg w-1/2">
                <h2 id="modal-title" class="text-xl font-bold mb-4">Nuevo Proyecto</h2>
                <form id="modal-form" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="project-id" name="id">
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
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
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
                    <div class="mt-4 flex justify-between">
                        <button
                            onclick="editProject({{ $proyecto->id }}, '{{ $proyecto->nombre }}', '{{ $proyecto->descripcion }}', '{{ $proyecto->enlace }}')"
                            class="bg-yellow-500 text-white px-4 py-2 rounded">Editar</button>
                        <form action="{{ route('proyectos.destroy', $proyecto->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded"
                                onclick="return confirm('¿Estás seguro de que deseas eliminar este proyecto?')">Eliminar</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script>
        function openModal() {
            document.getElementById('modal-form').reset();
            document.getElementById('project-id').value = '';
            document.getElementById('modal-form').action = "{{ route('proyectos.store') }}";
            document.getElementById('modal-title').innerText = 'Nuevo Proyecto';
            document.getElementById('modal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('modal').classList.add('hidden');
        }

        function editProject(id, nombre, descripcion, enlace) {
            document.getElementById('project-id').value = id;
            document.getElementById('nombre').value = nombre;
            document.getElementById('descripcion').value = descripcion;
            document.getElementById('enlace').value = enlace;
            document.getElementById('modal-form').action = `/proyectos/${id}`;
            document.getElementById('modal-title').innerText = 'Editar Proyecto';
            document.getElementById('modal').classList.remove('hidden');
        }
    </script>
</body>

</html>
