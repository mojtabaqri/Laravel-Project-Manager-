<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table="messages";
    protected $fillable = [
        'title', 'pid', 'des','user_id','created_at',
    ];
    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
