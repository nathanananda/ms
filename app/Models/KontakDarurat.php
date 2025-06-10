<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KontakDarurat extends Model
{
    use HasFactory;
    protected $table = 'kontak_darurat';
    protected $primaryKey = 'id_kontak_darurat';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];
}
