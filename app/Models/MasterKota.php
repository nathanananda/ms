<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterKota extends Model
{
    use HasFactory;
    protected $table = 'master_kota';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];
}
