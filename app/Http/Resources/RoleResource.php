<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
          'id' => $this->id,
          'Role_name' => $this->Role_name,

        ];
    }
}

            // 'role' => [
            //     'id' => $this->role->id ?? null,
            //     'Role_name' => $this->role->Role_name ?? null,
            //     'permissions' => $this->role->permissions->pluck('name') ?? [],
            // ],