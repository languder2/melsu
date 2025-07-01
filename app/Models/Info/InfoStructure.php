<?php

namespace App\Models\Info;

use App\Enums\ContactType;
use App\Enums\DivisionType;
use App\Enums\Info\Structure;
use App\Models\Division\Division;
use Illuminate\Support\Collection;

class InfoStructure extends Info
{
    public string $pageTitle;

    public function __construct()
    {
        $this->pageTitle = Structure::structOrgUprav->getName();

        parent::__construct();
    }
    public function divisions(): array
    {
        return [
            'prop'              => Structure::structOrgUprav->name,
            'captions'          => [
                Structure::name,
                Structure::fio,
                Structure::post,
                Structure::addressStr,
                Structure::site,
                Structure::email,
                Structure::divisionClauseDocLink,
            ],
            'list'            => $this->divisionsList(),
        ];
    }
    public function divisionsList(): Collection
    {
        return Division::orderBy('sort','desc')->orderBy('name')
            ->whereNotIn('type',[DivisionType::Branch, DivisionType::Representative])->orWhereNull('type')
            ->get()
            ->keyBy('id')
            ->map(fn($item) => (object)[
                "name"          => $item->name,
                "fio"           => $item->chief->full_name ?? __('info.empty'),
                "post"          => $item->chief->post ?? __('info.empty'),
                "addressStr"    => $item->contacts->where('type',ContactType::Address),
                "site"          => $item->link,
                "email"         => $item->contacts->where('type',ContactType::Email),
                "divisionClauseDocLink" => __('info.empty'),
            ])
        ;
    }

    public function branches(): array
    {
        return [
            'prop'              => Structure::filInfo->name,
            'label'             => Structure::filInfo->getName(),
            'captions'          => [
                Structure::nameFil,
                Structure::fioFil,
                Structure::postFil,
                Structure::addressFil,
                Structure::websiteFil,
                Structure::emailFil,
                Structure::divisionClauseDocLink,
            ],
            'list'            => $this->branchesList(),
        ];
    }
    public function branchesList(): Collection
    {
        return Division::orderBy('sort','desc')->orderBy('name')
            ->where('type',DivisionType::Branch)
            ->get()
            ->keyBy('id')
            ->map(fn($item) => (object)[
                "nameFil"       => $item->name,
                "fioFil"        => $item->chief->full_name ?? __('info.empty'),
                "postFil"       => $item->chief->post ?? __('info.empty'),
                "addressFil"    => $item->contacts->where('type',ContactType::Address)->select('id','content'),
                "websiteFil"    => $item->link,
                "emailFil"      => $item->contacts->where('type',ContactType::Email)->select('id','content'),
                "divisionClauseDocLink" => __('info.empty'),
            ])
        ;
    }

    public function representative(): array
    {
        return [
            'prop'              => Structure::repInfo->name,
            'label'             => Structure::repInfo->getName(),
            'captions'          => [
                Structure::nameRep,
                Structure::fioRep,
                Structure::postRep,
                Structure::addressRep,
                Structure::websiteRep,
                Structure::emailRep,
                Structure::divisionClauseDocLink,
            ],
            'list'            => $this->representativeList(),
        ];
    }
    public function representativeList(): Collection
    {
        return Division::orderBy('sort','desc')->orderBy('name')
            ->where('type',DivisionType::Representative)
            ->get()
            ->keyBy('id')
            ->map(fn($item) => (object)[
                "nameRep"       => $item->name,
                "fioRep"        => $item->chief->full_name ?? __('info.empty'),
                "postRep"       => $item->chief->post ?? __('info.empty'),
                "addressRep"    => $item->contacts->where('type',ContactType::Address)->select('id','content'),
                "websiteRep"    => $item->link,
                "emailRep"      => $item->contacts->where('type',ContactType::Email)->select('id','content'),
                "divisionClauseDocLink" => __('info.empty'),
            ])
        ;
    }

}
