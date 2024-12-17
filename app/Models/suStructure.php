<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class suStructure extends Model
{
    protected $table = 'su_structure';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'ssu_group',
        'department',
        'fio',
        'post',
        'address',
        'email',
        'phone',
        'display',
    ];

    public static function CreateGroup(array $arr):void
    {
        foreach ($arr as $record)
            DB::table('su_structure_group')->insert($record);
    }

    public static function getGroups():array
    {
        return DB::table('su_structure_group')->orderBy('sort')->get(['id','name','sort'])->toArray();
    }

    public static function getListByGroups(?int $gid = null):object
    {
        $list = self::join('su_structure_group', 'su_structure_group.id', '=', 'su_structure.ssu_group')
            ->select('su_structure.*','su_structure_group.name as group_name')
            ->orderBy('su_structure_group.sort')
            ->orderBy('su_structure.sort')
        ;

        if(!is_null($gid))
            $list->where('su_structure_group.id', $gid);

        $response = (object)[];

        foreach ($list->get() as $item){
            if(!isset($response->{$item->ssu_group}))
                $response->{$item->ssu_group}  = (object)[
                    'name'      => $item->group_name,
                    'list'      => [],
                ];

            $response->{$item->ssu_group}->list[] = $item;
        }


        return $response;
    }

}
