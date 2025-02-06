<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DepartmentStaff extends Model
{
    use SoftDeletes;

    protected $table        = 'department_staffs';

    protected $fillable     = [
        'id',
        'staff',
        'department',
        'post',
        'sort',
        'deleted_at'
    ];

    public static function AddInDepartment($id,$staffs):void
    {

        if(!is_array($staffs)) return;

        foreach ($staffs as $key=>$staff)
            if(empty($staff['staff']))
                unset($staffs[$key]);


        $list = self::where('department',$id)->get();

        foreach ($list as $record)
            if(!isset($staffs[$record->id]))
                $record->delete();

        foreach ($staffs as $key=>$staff){

            $record = self::find($key);

            if(is_null($record))
                $record = new DepartmentStaff();

            $record->department         = $id;

            $record->fill($staff);

            $record->post = $staff['post'];
            $record->sort = $staff['sort']??1000;

            $record->save();
        }


    }

}
