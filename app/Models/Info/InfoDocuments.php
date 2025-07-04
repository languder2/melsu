<?php

namespace App\Models\Info;

use App\Enums\Info\Documents;
use App\Enums\Info\Types;
use Illuminate\Support\Collection;

class InfoDocuments extends Info
{
    protected const Types Type = Types::documents;

    protected Collection $codes;

    public function __construct(...$arguments)
    {
        $this->codes = collect(Documents::cases());

        parent::__construct($arguments);
    }

}
