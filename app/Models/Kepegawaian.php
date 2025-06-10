<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kepegawaian extends Model
{
    use HasFactory;

    protected $table = 'kepegawaian';
    protected $primaryKey = 'id_kepegawaian';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];
}
