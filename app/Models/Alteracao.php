<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alteracao extends Model
{
    use HasFactory;

    protected $table = "alteracaopublicacao";
    protected $primaryKey = "id";
    public $incrementing = true;
    public $timestamps = false;

}
