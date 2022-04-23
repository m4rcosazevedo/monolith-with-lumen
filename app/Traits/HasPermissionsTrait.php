<?php

namespace App\Traits;

trait HasPermissionsTrait {

    /**
     * @param $permission
     * @return bool
     */
    public function hasPermissionTo ($permission)
    {
        return $this->hasPermissionThroughRole($permission);
    }

    /**
     * @param $permission
     * @return bool
     */
    public function hasPermissionThroughRole ($permission)
    {
        foreach ($permission->roles as $role) {
            if ($this->roles->contains($role)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param ...$roles
     * @return bool
     */
    public function hasRole (...$roles)
    {
        foreach ($roles as $role) {
            if ($this->roles()-contains('description', $role)) {
                return true;
            }
        }
        return false;
    }
}
