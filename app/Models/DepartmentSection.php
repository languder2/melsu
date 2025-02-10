<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DepartmentSection extends Model
{
    use SoftDeletes;

    protected $table = 'department_sections';

    protected $fillable = [
        'id',
        'department',
        'name',
        'show_title',
        'text',
        'sort',
        'deleted_at'
    ];

    public static function AddInDepartment($id, $sections): void
    {
        if (!is_array($sections)) return;

        foreach ($sections as $key => $section)
            if (empty($section['name']))
                unset($sections[$key]);

        $list = self::where('department', $id)->get();

        foreach ($list as $record)
            if (!isset($sections[$record->id]))
                $record->delete();

        foreach ($sections as $key => $section) {

            $record = self::find($key);

            if (is_null($record))
                $record = new DepartmentSection();

            $record->fill($section);

            $record->department = $id;

            $record->sort = $record->sort ?? 1000;

            if (isset($section['hide']))
                $record->show_title = 'hide';
            else
                $record->show_title = 'show';

            $record->save();
        }
    }

}
