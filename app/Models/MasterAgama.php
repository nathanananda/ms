<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterAgama extends Model
{
    use HasFactory;
    protected $table = 'master_agama';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];
}
