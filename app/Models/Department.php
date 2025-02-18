<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Staff\Staff;
class Department extends Model
{
    use SoftDeletes;

    public static $FormMessage = [
        'name.required' => 'Укажите название',
        'name.unique' => 'Название уже занято',
    ];
    protected $table = 'departments';
    protected $fillable = [
        'id',
        'name',
        'chief',
        'chief_post',
        'alias',
        'sort',
        'deleted_at'
    ];

    public static function FormRules($id)
    {
        return [
            'name' => "required|unique:departments,name,{$id},id,deleted_at,NULL",
            'alias' => "nullable|unique:departments,alias,{$id},id,deleted_at,NULL",
            'chief' => '',
            'chief_post' => '',
            'chief_name' => '',
            'sort' => '',
            'sections' => '',
            'staffs' => '',
            'documents' => '',
        ];
    }

    public static function AdminList()
    {
        return self::orderBy('name')
            ->join('staffs', 'departments.chief', '=', 'staffs.id', 'left')
            ->select('departments.*', 'staffs.firstname', 'staffs.lastname', 'staffs.middle_name')
            ->paginate(20);
    }

    public static function getByID($id): ?Department
    {
        $department = self::find($id);

        if (!is_null($department)) {

            $chief = Staff::find($department->chief);

            if (!is_null($chief))
                $department->chief_name = "{$chief->lastname} {$chief->firstname} {$chief->middle_name}";

            $department->sections = DepartmentSection::where('department', $department->id)->get();

            $department->staffs = DepartmentStaff::where('department', $department->id)
                ->join('staffs', 'department_staffs.staff', '=', 'staffs.id')
                ->select('department_staffs.*', 'staffs.firstname', 'staffs.lastname', 'staffs.middle_name')
                ->get();

            $department->docuiments = DepartmentDocument::where('department', $department->id)->get();
        }

        return $department;
    }



}
