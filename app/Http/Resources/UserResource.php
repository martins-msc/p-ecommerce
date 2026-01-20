<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            // Usamos pluck para enviar solo los nombres de los roles como un array de texto
            'roles' => $this->roles->pluck('name')->implode(', '),
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
        ];
    }
}
