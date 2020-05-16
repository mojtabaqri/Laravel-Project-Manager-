<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Help extends Model
{
    protected $table='help_desks';
    protected $fillable = [
        'id', 'phone_number', 'pid', 'state', 'problem', 'solution','created_at','user_id'
    ];
    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function helps()
    {
        return $this->hasMany(Help::class);
    }
}
