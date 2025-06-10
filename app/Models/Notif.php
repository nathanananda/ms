<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notif extends Model
{
    use HasFactory;
    protected $table = 'notif';
    protected $primaryKey = 'id_notif';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];
}
