<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ContactResource;

class UserResource extends JsonResource
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
        'created_at'=>$this->created_at->diffforHumans(),
        'updated_at'=>$this->updated_at->diffforHumans(),
        'contacts'=>$this->when($this->contacts()->exists(),
          fn()=>ContactResource::collection($this->whenLoaded('contacts'))
        ),
      ];
    }
}
