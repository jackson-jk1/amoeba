<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Servico;
use App\Portfolio;
use App\Equipe;

class Imagem extends Model
{
    protected $fillable = ['titulo','descricao','caminho'];

    public function servico()
    {
        return $this->hasMany(Servico::class);
    }

    public function portfolio()
    {
        return $this->hasMany(Portfolio::class);
    }


    public function equipe()
    {
        return $this->hasMany(Equipe::class);
    }

}
