<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterStatusKaryawan extends Model
{
    use HasFactory;
    protected $table = 'master_status_karyawan';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];
}
