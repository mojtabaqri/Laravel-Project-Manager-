<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $diff=Carbon::now()->diffInDays($this->expire_date,false);
        return [
            'id'=>$this->id,
            'title'=>$this->title,
            'expire_date'=>$this->expire_date,
            'day'=>$diff,
            'description'=>$this->description,
            'created_at'=>Verta::instance($this->created_at)->format('Y-m-d'),
            'state'=>$this->state,
            'byUser'=>$this->users->pid,
            'userName'=>$this->users->name,
        ];
    }
}
