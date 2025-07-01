<?php

namespace App\Models\Info;

use App\Enums\DivisionType;
use App\Enums\Info\Managers;
use App\Enums\Info\Structure;
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
            'label'             => Managers::rucovodstvo->getName(),
            'captions'          => [
                Managers::fio,
                Managers::post,
                Managers::telephone,
                Managers::email,
            ],
            'chief_prop'    => Managers::rucovodstvo->name,
            'chief'         => self::manager($rectorate->chief ?? null),
            'staff_prop'    => Managers::rucovodstvoZam->name,
            'staffs'        => $rectorate->staffs->keyBy('id')->map(fn($staff) => self::manager($staff ?? null)),
        ];
    }
    public function branches(): array
    {
        return [
            'label'             => Managers::rucovodstvoFil->getName(),
            'captions'          => [
                Managers::nameFil,
                Managers::fio,
                Managers::post,
                Managers::telephone,
                Managers::email,
            ],
            'staff_prop'    => Managers::rucovodstvoFil->name,
            'staffs'        =>
                Division::where('type',DivisionType::Branch)
                    ->orderBy('sort')->orderBy('name')
                    ->get()->keyBy('id')->map(function ($item){
                        return array_merge(['nameFil' => $item->name ],self::manager($item->chief));
                    }),
        ];

    }

}
