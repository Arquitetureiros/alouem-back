<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publicacao extends Model
{
    use HasFactory;

    protected $table = "Publicacao";
    protected $primaryKey = "IdPublicacao";
    public $incrementing = true;

    protected $fillable = [ "Titulo", "descricao", "Endereco", "fk_IdEstado", "VotosPositivos", "VotosNegativos", "fk_IdUsuario"];

    public $timestamps = false;

    public function comentarios(){
        return $this->hasMany(Comentario::class, "fk_IdPublicacao", "IdPublicacao");
    }

    public function fotos(){
        return $this->hasMany(Foto::class, "fk_IdPublicacao", "IdPublicacao");
    }
}
