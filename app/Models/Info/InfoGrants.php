<?php

namespace App\Models\Info;

use App\Enums\Info\Grants;
use App\Enums\Info\Types;
use Illuminate\Support\Collection;

class InfoGrants extends Info
{

    protected const Types Type = Types::grants;

    protected Collection $codes;

    public function __construct(...$arguments)
    {
        $this->codes = collect(Grants::cases());

        parent::__construct($arguments);
    }
}
