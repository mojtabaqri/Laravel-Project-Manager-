<?php

namespace App\Http\Resources;

use App\Library\Helpers;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Resources\Json\JsonResource;

class HelpResource extends JsonResource
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
            'id'=>$this->id,
            'phone_number'=>$this->phone_number,
            'pid'=>$this->pid,
            'problem'=>$this->problem,
            'solution'=>$this->solution,
            'created_at'=>Verta::instance($this->created_at)->format('Y-m-d'),
            'user_id'=>$this->users->pid,
            'state'=>Helpers::getState($this->state),
        ];
    }
}
