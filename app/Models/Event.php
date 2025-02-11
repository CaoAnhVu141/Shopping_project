<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'event';
    protected $primaryKey = 'id_event';
    protected $fillable = [
        'name',
        'content',
        'image',
        'check_active',
        'start_day',
        'end_day',
    ];
}
