<?php

namespace Osfrportal\OsfrportalLaravel\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class Select2UnitsAllCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public $preserveKeys = true;
    public function toArray($request)
    {
        return [
            'results' => $this->collection,
        ];
    }
}
