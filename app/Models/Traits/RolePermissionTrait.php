<?php

namespace App\Models\Traits;

trait RolePermissionTrait {
    public function canUserList()
    {
        return $this->canError(20);
    }

    public function canUserCreate()
    {
        return $this->canError(21);
    }

    public function canUserUpdate()
    {
        return $this->canError(23);
    }

    public function canUserDelete()
    {
        return $this->canError(24);
    }

    public function canUserForceDelete()
    {
        return $this->canError(25);
    }

    protected function canError($id)
    {
        try {
            return $this->hasPermissionTo($id);
        } catch (\Throwable $e) {
            return false;
        }
    }
}