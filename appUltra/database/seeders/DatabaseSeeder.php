<?php

namespace Database\Seeders;

use App\Models\Fase1\Comision;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Comision::create(
            [
                'name' => 'Comisión de tesorería',
                'description' => 'Encargada de recaudar los fondos y gestionar los egresos del proyecto.'
            ]
        );

        Comision::create(
            [
                'name' => 'Comisión de instrumentos y cantos',
                'description' => 'Encargada de llevar el control de los instrumentos, la gestión de reuniones de repasos y creación de cantos.'
            ]
        );

        Comision::create(
            [
                'name' => 'Comisión de pólvora',
                'description' => 'Encargada de llevar el control de inventario, compra de fuegos artificiales y la quema de los mismos.'
            ]
        );

        Comision::create(
            [
                'name' => 'Comisión de publicidad y redes sociales',
                'description' => 'Encargada de creación de contenido, investigación de temas relevantes al proyecto, gestionar las publicaciones en las distintas redes sociales oficiales de la ultra y medios de comunicación del proyecto.'
            ]
        );

        Comision::create(
            [
                'name' => 'Comisión de ventas',
                'description' => 'Encargada de todo el tema de ventas que ayuden a generar mayor ingreso para el proyecto.'
            ]
        );

        Comision::create(
            [
                'name' => 'Comisión de innovación',
                'description' => 'Encargada de velar por ideas futuras que ayuden a generar ingresos, a dar a conocer el proyecto y traer patrocinadores o donaciones para el proyecto.'
            ]
        );

        $this->call([UsersTableSeeder::class]);
    }
}
