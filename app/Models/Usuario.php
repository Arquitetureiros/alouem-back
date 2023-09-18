<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = "Usuario";
    protected $primaryKey = "IdUsuario";
    public $incrementing = true;

    protected $fillable = ["Email", "Senha", "RA", "Nome"];

    public $timestamps = false;
}
