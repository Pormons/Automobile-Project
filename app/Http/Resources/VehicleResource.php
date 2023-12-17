<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VehicleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'vin' => $this->vin,
            'model' => ModelResource::resource($this->whenLoaded('model')),
            'model_year' => $this->model_year,
            'price' => $this->price,
            'status' => $this->status,
            'available' => $this->available,
        ];
    }
}
