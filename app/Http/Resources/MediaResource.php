<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MediaResource extends JsonResource
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
            'id' => $this->resource->id,
            'uuid' => $this->resource->uuid,
            'name' => $this->resource->name,
            'url' => $this->resource->getFullUrl(),
            'mime_type' => $this->resource->mime_type,
            'order' => $this->resource->order_column,
        ];
    }
}
