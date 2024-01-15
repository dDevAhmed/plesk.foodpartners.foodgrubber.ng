<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserStoreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'name' => $this->name,
            'phone' => $this->phone,
            'address' => $this->address,
            'city' => $this->city,
            'state' => $this->state,
            'postcode' => $this->postcode,
            // 'current_location' => $this->current_location,
            'description' => $this->description,
            'food_cert_number' => $this->food_cert_number,
            'food_cert' => $this->food_cert,
            'account_number' => $this->account_number,
            'sort_code' => $this->sort_code,
            'bank' => $this->bank,
            'availability' => $this->availability,
            'logo' => $this->logo,
            'cover_image' => $this->cover_image,
        ];
    }
}
