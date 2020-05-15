<?php

namespace App\Http\Resources;

use App\Library\Helpers;
use Illuminate\Http\Resources\Json\JsonResource;

class RepairsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id ,
            'shift'=>$this->shift ,
            'system_id'=>$this->system_id,
            'section_report'=>$this->section_report,
            'reporter'=>$this->reporter ,
            'problem'=>$this->problem ,
            'date'=>Helpers::shamsi($this->created_at) ,
            'delivery'=>$this->delivery ,
            'solution'=>$this->solution ,
            'user_id'=>$this->users->pid ,
        ];
    }
}
