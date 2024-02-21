<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;
    protected $table = 'films';

    public function films(){
        return $this->belongsToMany(Film::class);
    } 

    protected $fillable = [
        'name',
        'country',
        'duration',
        'year',
        'genre',
        'img_url'
        ];
}