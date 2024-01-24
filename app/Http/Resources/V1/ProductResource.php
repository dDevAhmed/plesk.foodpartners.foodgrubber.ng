<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'store_id' => Auth::user()->userstore->id,
            'name' => $this->name,
            'price' => $this->price,
            'cuisine' => $this->cuisine,
            'category' => $this->category,
            'description' => $this->description,
            'measurement' => $this->measurement,
            'image1' => $this->image1,
            'image2' => $this->image2,
            'availability' => $this->availability
        ];
    }
}
