<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ListTugasResource extends JsonResource
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
            'namaTugas'=>$this->namaTugas,
            'jenisSurah'=>$this->jenisSurah,
            'mulai'=>$this->mulai,
            'selesai'=>$this->selesai,
            // 'listSantri'=>GetPengumpulanTugas::collection($this->nilaiTahfidz),
        ];
    }
}
