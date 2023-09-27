<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    use HasFactory;

    protected $table = "Foto";
    protected $primaryKey = "IdFoto";
    public $incrementing = true;

    protected $fillable = [ "nome", "fk_IdPublicacao"];

    public $timestamps = false;
}
