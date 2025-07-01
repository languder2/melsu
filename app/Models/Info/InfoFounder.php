<?php

namespace App\Models\Info;

use App\Enums\Info\Common;
use App\Enums\Info\Types;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class InfoFounder extends Info
{
    public function template(): array
    {
        return [
            'prop'              => Common::uchredLaw->name,
            'label'             => Common::uchredLaw->getName(),
            'captions'          => [
                Common::nameUchred->getName(),
                Common::addressUchred->getName(),
                Common::telUchred->getName(),
                Common::mailUchred->getName(),
                Common::websiteUchred->getName(),
            ],
            'list'            => $this->list(),
        ];
    }
    public function list(): Collection
    {
        $list = $this->getFields(Types::Founder,Common::uchredLaw);

        if($list->isEmpty())
            $list->push(new self([
                "type"  => Types::Common,
                "code"  => Common::uchredLaw
            ]));

        return $list->map(function ($item) {
            return (object)[
                "id"        => $item->id,
                "fields"    => [
                    "nameUchred"    => $item->getRelationArgs(Common::nameUchred),
                    "addressUchred" => $item->getRelationArgs(Common::addressUchred),
                    "telUchred"     => $item->getRelationArgs(Common::telUchred),
                    "mailUchred"    => $item->getRelationArgs(Common::mailUchred),
                    "websiteUchred" => $item->getRelationArgs(Common::websiteUchred),
                ]
            ];
        });
    }

}
