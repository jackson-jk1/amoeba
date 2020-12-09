<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Imagem;

class Servico extends Model
{
    protected $fillable = ['imagem_id','servico','descricao'];
    
    protected $with = ['imagem'];
    
    public function imagem()
    {
        return $this->belongsTo(Imagem::class);
    }
}
