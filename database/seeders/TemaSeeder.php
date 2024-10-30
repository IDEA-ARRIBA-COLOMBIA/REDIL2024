<?php

namespace Database\Seeders;

use App\Models\Tema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TemaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        Tema::create([
            'titulo'=> 'El titulo 1',
            'contenido'=> 'sfasdf asdfsda567fghfggh  dfsdafasdf',
            'portada'=>'default.png'
        ]);

        Tema::create([
            'titulo'=> 'El titulo 2',
            'contenido'=> 'sfasdf asdfsda urtyutrhtyh dfsdafasdf',
            'portada'=>'default.png'
        ]);

        Tema::create([
            'titulo'=> 'El titulo 3',
            'contenido'=> 'laslfl lasdfl asdlfdslf  dfsdafasdf',
            'portada'=>'default.png'
        ]);

        Tema::create([
            'titulo'=> 'El titulo 4',
            'contenido'=> 'sfasdf 234234 gdfgdg dfsdafasdf',
            'portada'=>'default.png'
        ]);




    }
}
