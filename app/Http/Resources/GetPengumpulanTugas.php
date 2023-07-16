<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GetPengumpulanTugas extends JsonResource
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
            'id'=>$this->id,
            'namaLengkap'=>$this->santri->namaLengkap,
            'nisn'=>$this->santri->nisn,
            'nilai'=>$this->nilai,
            'audio'=>$this->getFirstMediaUrl('audio'),
        ];
    }
    
}
