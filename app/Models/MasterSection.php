<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterSection extends Model
{
    use HasFactory;
    protected $table = 'master_section';
    protected $primaryKey = 'id_section';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];
}
