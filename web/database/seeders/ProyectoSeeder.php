<?php

namespace Database\Seeders;

use App\Models\Proyecto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProyectoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $proyecto1 = new Proyecto();
        $proyecto1->nombre = 'Red De Papás Emprendedores';
        $proyecto1->descripcion = 'Este proyecto es un sitio web para la Red De Papás Emprendedores de la Comunidad Educativa Loyola Cochabamba R.L., donde se muestra los productos y servicios que ofrecen cada emprendimiento.';
        $proyecto1->enlace = 'https://red-emprendedores.norvicsoftware.com/';
        $proyecto1->save();

        $proyecto2 = new Proyecto();
        $proyecto2->nombre = 'Testimonios';
        $proyecto2->descripcion = 'Página web de testimonios';
        $proyecto2->enlace = 'https://reycrisgit.github.io/testimonials-grid-section-main/';
        $proyecto2->save();

        $proyecto2 = new Proyecto();
        $proyecto2->nombre = 'Landing Page de Huddle';
        $proyecto2->descripcion = 'Página web que crea conexiones con tus usuarios mientras participas en debates genuinos.';
        $proyecto2->enlace = 'https://reycrisgit.github.io/huddle-landing-page-with-curved-sections-master/';
        $proyecto2->save();

        $proyecto2 = new Proyecto();
        $proyecto2->nombre = 'Social Links';
        $proyecto2->descripcion = 'Página web para mostrar los enlaces sociales de Jessica Randall';
        $proyecto2->enlace = 'https://reycrisgit.github.io/Social-links-profile/';
        $proyecto2->save();
    }
}
