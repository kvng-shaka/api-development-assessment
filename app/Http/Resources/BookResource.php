<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class BookResource extends JsonResource
{
    public function withResponse($request, $response)
    {
        if($response->getData()) {
            $response->setStatusCode(200);
        } else{
            $response->setStatusCode(404);
        }
        parent::withResponse($request, $response);

        // return [
        //     "status_code"=>200,
        //     "status"=>"success",
        // ];
    }



    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);

        return [
            'id' =>$this->id,
            'name'=>$this->name,
            "isbn"=>$this->isbn,
            "authors"=>[
                $this->authors
            ],
            "number_of_pages"=>$this->number_of_pages,
            "publisher"=>$this->publisher,
            "country"=>$this->country,
            "release_date"=>$this->release_date
        ];

        // return [
        //     "status_code"=>200,
        //     "status"=>"success",
        //     'data' => BookResource::collection($this->collection),
        // ];
    }

}
