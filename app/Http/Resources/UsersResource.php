<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UsersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
          'id'=>$this->id,
          'firstname'=>$this->firstname,
          'lastname'=>$this->lastname,
          'isblocked'=>$this->blocked,
          'links' => [
               'self' => '/api/v1/users/'.$this->id,
           ],
        ];
    }
}
