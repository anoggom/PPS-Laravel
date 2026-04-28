<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Film;

class FilmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $films = [
            // Director 1
            ['title' => 'El Amanecer Eterno', 'release_date' => '2015-05-12', 'sinopsis' => 'Un viaje visual por los paisajes más remotos.', 'duration' => 120, 'gendre' => 'Drama', 'director_id' => 1],
            ['title' => 'Sombras del Pasado', 'release_date' => '2018-11-20', 'sinopsis' => 'Un detective enfrenta sus propios demonios.', 'duration' => 105, 'gendre' => 'Thriller', 'director_id' => 1],
            
            // Director 2
            ['title' => 'Cero Absoluto', 'release_date' => '2020-02-14', 'sinopsis' => 'Supervivencia en el ártico tras un accidente.', 'duration' => 98, 'gendre' => 'Aventura', 'director_id' => 2],
            ['title' => 'Bajo el Hielo', 'release_date' => '2023-01-10', 'sinopsis' => 'El deshielo revela un secreto milenario.', 'duration' => 112, 'gendre' => 'Ciencia Ficción', 'director_id' => 2],

            // Director 3
            ['title' => 'Risas en la Oscuridad', 'release_date' => '2010-06-05', 'sinopsis' => 'Una comedia negra sobre la vida moderna.', 'duration' => 90, 'gendre' => 'Comedia', 'director_id' => 3],
            ['title' => 'El Chiste Final', 'release_date' => '2014-09-15', 'sinopsis' => 'Un comediante busca el éxito a cualquier precio.', 'duration' => 100, 'gendre' => 'Comedia', 'director_id' => 3],

            // Director 4
            ['title' => 'Galaxia Perdida', 'release_date' => '2019-12-25', 'sinopsis' => 'La humanidad busca un nuevo hogar entre las estrellas.', 'duration' => 145, 'gendre' => 'Ciencia Ficción', 'director_id' => 4],
            ['title' => 'Nebulosa', 'release_date' => '2022-07-30', 'sinopsis' => 'Encuentro cercano en los confines del universo.', 'duration' => 130, 'gendre' => 'Ciencia Ficción', 'director_id' => 4],

            // Director 5
            ['title' => 'Código de Honor', 'release_date' => '2012-03-18', 'sinopsis' => 'Intriga política en el corazón del gobierno.', 'duration' => 115, 'gendre' => 'Acción', 'director_id' => 5],
            ['title' => 'Venganza Silenciosa', 'release_date' => '2016-10-08', 'sinopsis' => 'Un ex-agente vuelve para saldar cuentas.', 'duration' => 95, 'gendre' => 'Acción', 'director_id' => 5],

            // Directores con una sola película para completar la lista de 20
            ['title' => 'Latidos', 'release_date' => '2021-08-14', 'sinopsis' => 'Una historia de amor inesperada.', 'duration' => 110, 'gendre' => 'Romance', 'director_id' => 6],
            ['title' => 'El Susurro', 'release_date' => '2017-10-31', 'sinopsis' => 'Terror psicológico en una casa abandonada.', 'duration' => 88, 'gendre' => 'Terror', 'director_id' => 7],
            ['title' => 'Montaña Arriba', 'release_date' => '2013-04-22', 'sinopsis' => 'Documental sobre el Everest.', 'duration' => 75, 'gendre' => 'Documental', 'director_id' => 8],
            ['title' => 'Pixel', 'release_date' => '2024-05-05', 'sinopsis' => 'Un mundo digital cobra vida.', 'duration' => 102, 'gendre' => 'Animación', 'director_id' => 9],
            ['title' => 'El Relojero', 'release_date' => '2009-11-12', 'sinopsis' => 'Un hombre que puede detener el tiempo.', 'duration' => 118, 'gendre' => 'Fantasía', 'director_id' => 10],
            ['title' => 'Marea Alta', 'release_date' => '2015-01-20', 'sinopsis' => 'Drama familiar en la costa.', 'duration' => 125, 'gendre' => 'Drama', 'director_id' => 11],
            ['title' => 'Asfalto Caliente', 'release_date' => '2018-06-15', 'sinopsis' => 'Carreras ilegales en la ciudad.', 'duration' => 92, 'gendre' => 'Acción', 'director_id' => 12],
            ['title' => 'Sin Retorno', 'release_date' => '2020-09-01', 'sinopsis' => 'Un viaje sin vuelta atrás.', 'duration' => 108, 'gendre' => 'Thriller', 'director_id' => 13],
            ['title' => 'La Herencia', 'release_date' => '2011-02-14', 'sinopsis' => 'Secretos familiares tras una muerte.', 'duration' => 114, 'gendre' => 'Misterio', 'director_id' => 14],
            ['title' => 'Vuelo 714', 'release_date' => '2022-12-01', 'sinopsis' => 'Tensión a 30.000 pies de altura.', 'duration' => 100, 'gendre' => 'Suspenso', 'director_id' => 15],
            ['title' => 'Bosque Sombrío', 'release_date' => '2016-08-20', 'sinopsis' => 'Perdidos en la naturaleza salvaje.', 'duration' => 96, 'gendre' => 'Terror', 'director_id' => 16],
            ['title' => 'Legado de Sangre', 'release_date' => '2014-04-10', 'sinopsis' => 'Épica histórica medieval.', 'duration' => 155, 'gendre' => 'Histórico', 'director_id' => 17],
            ['title' => 'El Algoritmo', 'release_date' => '2025-03-12', 'sinopsis' => 'La IA toma el control de la red.', 'duration' => 110, 'gendre' => 'Ciencia Ficción', 'director_id' => 18],
            ['title' => 'Danza Nocturna', 'release_date' => '2019-05-18', 'sinopsis' => 'Musical sobre los sueños artísticos.', 'duration' => 128, 'gendre' => 'Musical', 'director_id' => 19],
            ['title' => 'Última Parada', 'release_date' => '2023-11-11', 'sinopsis' => 'Un drama que ocurre en un tren.', 'duration' => 85, 'gendre' => 'Drama', 'director_id' => 20],

            // Repetimos directores para llegar a los 30 registros
            ['title' => 'El Reflejo', 'release_date' => '2021-02-10', 'sinopsis' => 'Un espejo que muestra realidades alternativas.', 'duration' => 104, 'gendre' => 'Fantasía', 'director_id' => 1],
            ['title' => 'Cazadores de Tormentas', 'release_date' => '2024-08-15', 'sinopsis' => 'La naturaleza en su estado más puro.', 'duration' => 115, 'gendre' => 'Aventura', 'director_id' => 2],
            ['title' => 'Operación Delta', 'release_date' => '2013-07-04', 'sinopsis' => 'Misión de rescate en territorio hostil.', 'duration' => 120, 'gendre' => 'Acción', 'director_id' => 5],
            ['title' => 'Ecos del Silencio', 'release_date' => '2017-03-25', 'sinopsis' => 'Una mujer que recupera el habla.', 'duration' => 95, 'gendre' => 'Drama', 'director_id' => 6],
            ['title' => 'Pesadilla en el Museo', 'release_date' => '2020-05-12', 'sinopsis' => 'Las estatuas cobran vida de noche.', 'duration' => 90, 'gendre' => 'Comedia', 'director_id' => 10],
        ];

        foreach ($films as $film) {
            Film::create($film);
        }
    }
}
