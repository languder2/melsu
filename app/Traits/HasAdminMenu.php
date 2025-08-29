<?php

namespace App\Traits;

use Illuminate\View\View;

trait HasAdminMenu
{
    public function adminMenu(): View
    {
        $entity = $this->entity ?? $this->getTable();

        dd($entity);

        return view('melsu.admin.menu');
    }
}
