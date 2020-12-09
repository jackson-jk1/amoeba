<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipe extends Model
{
    protected $fillable = ['imagem_id','nome','descricao', 'cargo', 'twitter_link', 'facebook_link', 'linkedin_link', 'instagram_link'];
    
    protected $with = ['imagem'];
    
    public function imagem()
    {
        return $this->belongsTo(Imagem::class);
    }
}
