<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DaftarSantriHalaqoh extends JsonResource
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
            'nik'=>$this->nik,
            'nisn'=>$this->nisn,
            'namaLengkap'=>$this->namaLengkap,
            'tempatLahir'=>$this->tempatLahir,
            'tanggalLahir'=>$this->tanggalLahir,
            'namaIbu'=>$this->namaIbu,
        ];
    }
}
