<?php

namespace App\Models\Info;

use App\Enums\Info\Documents;
use App\Enums\Info\Types;
use App\Enums\Info\Standards;
use App\Models\Staff\Staff;
use Illuminate\Support\Collection;

class InfoStandarts extends Info
{
    protected const Types Type = Types::standards;

    protected Collection $codes;

    public function __construct(...$arguments)
    {
        $this->codes = collect(Standards::cases());

        parent::__construct($arguments);
    }

}
