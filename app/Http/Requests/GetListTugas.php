<?php

namespace App\Http\Requests;

use Illuminate\Http\Resources\Json\JsonResource;
class GetListTugas extends JsonResource
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
        ];
    }
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'namaTugas'=>$this->namaTugas,
            'jenisSurah'=>$this->jenisSurah,
            'mulai'=>$this->mulai,
            'selesai'=>$this->selesai,
        ];
    }
}
