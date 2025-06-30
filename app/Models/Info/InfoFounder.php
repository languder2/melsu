<?php

namespace App\Models\Info;

use App\Enums\Info\CommonFields;
use App\Enums\Info\InfoType;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class InfoFounder extends Info
{
    public function template(): array
    {
        return [
            'prop'              => CommonFields::uchredLaw->name,
            'label'             => CommonFields::uchredLaw->getName(),
            'captions'          => [
                CommonFields::nameUchred->getName(),
                CommonFields::addressUchred->getName(),
                CommonFields::telUchred->getName(),
                CommonFields::mailUchred->getName(),
                CommonFields::websiteUchred->getName(),
            ],
            'list'            => $this->list(),
        ];
    }
    public function list(): Collection
    {
        $list = $this->getFields(InfoType::Founder,CommonFields::uchredLaw);

        if($list->isEmpty())
            $list->push(new self([
                "type"  => InfoType::Common,
                "code"  => CommonFields::uchredLaw
            ]));

        return $list->map(function ($item) {
            return (object)[
                "id"        => $item->id,
                "fields"    => [
                    "nameUchred"    => $item->getRelationArgs(CommonFields::nameUchred),
                    "addressUchred" => $item->getRelationArgs(CommonFields::addressUchred),
                    "telUchred"     => $item->getRelationArgs(CommonFields::telUchred),
                    "mailUchred"    => $item->getRelationArgs(CommonFields::mailUchred),
                    "websiteUchred" => $item->getRelationArgs(CommonFields::websiteUchred),
                ]
            ];
        });
    }

}
