<?php

namespace App\Traits;

trait PermissionTrait
{
    public function hasPermission($permissionName)
    {
        return $this->role->permissions->contains('name', $permissionName);
    }
}
