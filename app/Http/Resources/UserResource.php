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
            'roles' => $this->roles->map(fn($role) => [
                'id' => (int)$role->id,
                'name' => $role->name,
            ]),
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),

            // // La fecha solo se enviará si la ruta es 'admin.users.show' o 'index'
            // 'created_at' => $this->mergeWhen(
            //     $request->routeIs('admin.users.show', 'admin.users.index'),
            //     ['created_at' => $this->created_at->format('d/m/Y')]
            // ),

            // // Datos pesados solo para el Show
            // 'profile_details' => $this->when($request->routeIs('admin.users.show'), $this->details),
        ];
    }
}
