<?php

namespace Osfrportal\OsfrportalLaravel\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;


class OrionAccessPointsByCardIdCollection extends ResourceCollection
{
    public $preserveKeys = true;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'results' => $this->collection,
        ];
    }
}
