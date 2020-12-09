<?php

use Illuminate\Database\Seeder;
use App\Imagem;

class ImagemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    $factory->define(Post::class, function (Faker $faker) {
        return [
              'image'=>'https://source.unsplash.com/'.Str::random(10),
    
        ];
    });

    public function run()
    {   
        Imagem::create([
            'titulo' => 'a',
            'descricao' => 'aaaaa',
            'imagem' => $factory,
        ]);
    }
}
