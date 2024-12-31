<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataMined extends Model
{
    use HasFactory;

    protected $table = 'data_mined';

    protected $fillable = [
        'ip_address',
        'created_at',
    ];

    public $timestamps = false;
}

