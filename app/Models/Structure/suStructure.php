<?php

namespace App\Models\Structure;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class suStructure extends Model
{
    public static $FormRules = [
        'ssu_group' => 'required',
        'lastname' => '',
        'firstname' => '',
        'middlename' => '',
        'department' => '',
        'post' => '',
        'address' => '',
        'email' => '',
        'phone' => '',
        'link' => '',
        'sort' => '',
    ];
    public static $FormMessage = [
        'ssu_group' => 'Выберите группу',
        'lastname' => 'Укажите фамилию',
        'firstname' => 'Укажите имя',
        'post' => 'Укажите должность',
    ];
    protected $table = 'su_structure';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'ssu_group',
        'department',
        'lastname',
        'firstname',
        'middlename',
        'post',
        'address',
        'email',
        'phone',
        'display',
        'link',
        'sort',
    ];

    public static function CreateGroup(array $arr): void
    {
        foreach ($arr as $record)
            DB::table('su_structure_group')->insert($record);
    }

    public static function getGroupsForSelect(): array
    {
        $response = [];

        $list = self::getGroups();

        foreach ($list as $record)
            $response[$record->id] = $record->name;

        return $response;
    }

    public static function getGroups(): array
    {
        return DB::table('su_structure_group')->orderBy('sort')->get(['id', 'name', 'sort'])->toArray();
    }

    public static function getListByGroups(?int $gid = null): object
    {
        $list = self::join('su_structure_group', 'su_structure_group.id', '=', 'su_structure.ssu_group')
            ->select('su_structure.*', 'su_structure_group.name as group_name', 'su_structure_group.type as type')
            ->orderBy('su_structure_group.sort')
            ->orderBy('su_structure.sort');

        if (!is_null($gid))
            $list->where('su_structure_group.id', $gid);

        $response = (object)[];

        foreach ($list->get() as $item) {
            if (!isset($response->{$item->ssu_group}))
                $response->{$item->ssu_group} = (object)[
                    'name' => $item->group_name,
                    'type' => $item->type,
                    'list' => [],
                ];

            $response->{$item->ssu_group}->list[] = $item;
        }


        return $response;
    }

}
