<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GetLihatNilai extends JsonResource
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
            // 'namaTugas'=>$this->tugas_tahfidz->namaTugas,
            // 'jenisSurah'=>$this->tugasTahfidz->jenisSurah,
            'nilai'=>$this->nilai,
        ];
    }
}
