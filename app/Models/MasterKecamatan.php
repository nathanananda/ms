<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterKecamatan extends Model
{
    use HasFactory;
    protected $table = 'master_kecamatan';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];
}
