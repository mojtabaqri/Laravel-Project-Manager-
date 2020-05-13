<?php

namespace App\Http\Resources;

use Carbon\Carbon;
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
            'state'=>$this->state,
        ];
    }
}
