<?php

namespace App\Traits;

use Illuminate\Support\Facades\View;

trait HasAdminMenu
{
    public function adminMenu(): ?string
    {
        $entity = $this->entity ?? $this->getTable();

        return View::exists("{$entity}.includes.admin-menu") ? "{$entity}.includes.admin-menu" : null;
    }
}
