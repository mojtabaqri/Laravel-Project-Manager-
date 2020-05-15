<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Repair extends Model
{
    protected $fillable = [
        'shift', 'system_id', 'section_report','reporter','problem','date',
        'delivery','solution','user_id','created_at'
    ];
    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
