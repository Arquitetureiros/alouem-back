<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Moderador extends Model
{
    use HasFactory;

    protected $table = "Moderador";
    protected $primaryKey = "Email";
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ["Email", "Senha"];

    public $timestamps = false;
}
