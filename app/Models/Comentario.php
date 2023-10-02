<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;

    protected $table = "Comentario";
    protected $primaryKey = "IdComentario";
    public $incrementing = true;

    protected $fillable = ["fk_IdPublicacao",  "fk_IdUsuario", "NomeUsuario", "Descricao"];

    public $timestamps = false;
}
