<?php

namespace App\Http\Resources\Quest;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'title'=>$this->title,
            'time'=>$this->time,
            'path'=>$this->path,
            'text'=>$this->text,
            'file_main'=>$this->file_main,
        ];
    }
}
