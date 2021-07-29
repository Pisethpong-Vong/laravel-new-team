<?php

namespace App\Models\Traits;

trait ContactRolePermissionTrait {
    public function canContactList()
    {
        return $this->canErrors(2);
    }

    public function canContactCreate()
    {
        return $this->canErrors(3);
    }
    public function canContactShow()
    {
        return $this->canErrors(4);
    }

    public function canContactUpdate()
    {
        return $this->canErrors(5);
    }

    public function canContactDelete()
    {
        return $this->canErrors(6);
    }

    public function canContactForceDelete()
    {
        return $this->canErrors(7);
    }

    protected function canErrors($id)
    {
        try {
            return $this->hasPermissionTo($id);
        } catch (\Throwable $e) {
            return false;
        }
    }
}