<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Advertisement extends JsonResource
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
            "id" => $this->id,
            "adtitle" => $this->adtitle,
            "description" => $this->description,
            "price" => $this->price,
            "sawcounter" => $this->sawcounter,
            "picturepath" => $this->picturepath,
            "badcontent" => $this->badcontent,
            "book_id" => $this->book_id,
            "user_id" => $this->user_id,
            "created_at" => $this->created_at->format( "m/d/Y" ),
            "updated_at" => $this->updated_at->format( "m/d/Y" )
        ];
    }
}
