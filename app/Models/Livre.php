<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Livre extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }
    public function emprunts()
    {
        return $this->hasMany(Emprunt::class);
    }
}
