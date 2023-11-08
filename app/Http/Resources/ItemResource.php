<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;

class ItemResource extends JsonResource
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
            'id'            => $this->id,
            'name'          => $this->name,
            'description'   => $this->en_name,
            'created_at'    => $this->created_at->format('d-m-Y'),
            'partition'    => $this->partition->name ?? "",
            'sequence'    => $this->partition->category->name ."/". $this->partition->name ?? "",
        ];
    }
}
