<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chollo extends Model {
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'url',
        'categoria',
        'precio',
        'precio_descuento'
    ];

    function user(){ //Un chollo pertenece a un usuario
        return $this->belongsTo(User::class, 'usuario_id');
    }

    function categorias() { //Un chollo tiene muchas categorías
        return $this -> belongsToMany(Categoria::class);
    }

    

}
