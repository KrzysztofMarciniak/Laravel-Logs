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
        'x-forwarded-for',
        'device_type',
        'os',
        'browser',
        'browser_version',
        'device_model',
        'language',
        'page',
        'request_method',
        'created_at',
    ];

    public $timestamps = false;
}

