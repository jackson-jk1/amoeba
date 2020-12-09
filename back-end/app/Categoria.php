<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Portfolio;

class Categoria extends Model
{
    protected $fillable = ['nome'];

    public function portfolio()
    {
        return $this->belongsToMany(Portfolio::class);
    }
}
