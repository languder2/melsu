<?php

namespace App\Models\Info;

use App\Enums\DivisionType;
use App\Enums\Info\ManagersFields;
use App\Enums\Info\StructureFields;
use App\Models\Division\Division;
use App\Models\Staff\Affiliation;
use App\Models\Staff\Staff;

class InfoManagers extends Info
{
    public static function manager(?Affiliation $staff = null): array
    {
        return
            [
                "fio"       => $staff->full_name ?? __('info.empty'),
                "post"      => $staff->post ?? __('info.empty'),
                "telephone" => $staff->card->phones ?? __('info.empty'),
                "email"     => $staff->card->emails ?? __('info.empty'),
            ];
    }
    public function rectorate(): array
    {
        $rectorate = Division::where('type',DivisionType::Rectorate)->first();

        return [
            'label'             => ManagersFields::rucovodstvo->getName(),
            'captions'          => [
                ManagersFields::fio,
                ManagersFields::post,
                ManagersFields::telephone,
                ManagersFields::email,
            ],
            'chief_prop'    => ManagersFields::rucovodstvo->name,
            'chief'         => self::manager($rectorate->chief ?? null),
            'staff_prop'    => ManagersFields::rucovodstvoZam->name,
            'staffs'        => $rectorate->staffs->keyBy('id')->map(fn($staff) => self::manager($staff ?? null)),
        ];
    }
    public function branches(): array
    {
        return [
            'label'             => ManagersFields::rucovodstvoFil->getName(),
            'captions'          => [
                ManagersFields::nameFil,
                ManagersFields::fio,
                ManagersFields::post,
                ManagersFields::telephone,
                ManagersFields::email,
            ],
            'staff_prop'    => ManagersFields::rucovodstvoFil->name,
            'staffs'        =>
                Division::where('type',DivisionType::Branch)
                    ->orderBy('sort')->orderBy('name')
                    ->get()->keyBy('id')->map(function ($item){
                        return array_merge(['nameFil' => $item->name ],self::manager($item->chief));
                    }),
        ];

    }

}
