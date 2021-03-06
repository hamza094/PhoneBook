<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserResource;

class ContactResource extends JsonResource
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
          'mobile'=>$this->mobile,
          'type'=>$this->type,
          'created_at'=>$this->created_at->diffforHumans(),
          'updated_at'=>$this->updated_at->diffforHumans(),
          'links' => [
               'self' => '/api/v1/contacts/'.$this->id,
           ],
        ];
    }
}
