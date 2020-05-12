<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Repair extends Model
{
    protected $fillable = [
        'shift', 'system_id', 'section_report','reporter','responsible','problem','date',
        'delivery'
    ];
}
