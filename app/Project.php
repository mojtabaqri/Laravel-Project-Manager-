<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title', 'expire_date', 'description','state','user_id','expired_text',
    ];
    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}
