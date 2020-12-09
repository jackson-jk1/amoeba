<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Imagem;
use App\Categorias;

class Portfolio extends Model
{
    protected $fillable = ['imagem_id','link', 'categoria_id'];
    
    protected $with = ['imagem', 'categoria'];
    
    public function imagem()
    {
        return $this->belongsTo(Imagem::class);
    }

    public function categoria()
    {
        return $this->belongsToMany(Categoria::class);
    }
}
