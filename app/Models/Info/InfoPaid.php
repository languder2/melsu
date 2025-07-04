<?php

namespace App\Models\Info;

use App\Enums\Info\Grants;
use App\Enums\Info\Paid;
use App\Enums\Info\Types;
use Illuminate\Support\Collection;

class InfoPaid extends Info
{

    protected const Types Type = Types::paid;

    protected Collection $codes;

    public function __construct(...$arguments)
    {
        $this->codes = collect(Paid::cases());

        parent::__construct($arguments);
    }
}
