<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'category id' => $this->id,
            'English Category' => $this->cate_en,
            'Arabic Category' => $this->cate_ar,
            'Created At: ' => $this->created_at
        ];
    }
}
