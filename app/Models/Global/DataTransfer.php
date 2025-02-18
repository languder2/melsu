<?php

namespace App\Models\Global;

use Illuminate\Database\Eloquent\Model;

class DataTransfer extends Model
{


    public static function DepartmentsStaff():void
    {

        try{
            $departments = \App\Models\Department\Department::all();

            foreach ($departments as $department) {

                if($department->chief){

                    if(!$department->chiefCard)
                        $department->chiefCard = $department->chiefCard()
                            ->create([
                                'type'      => 'chief',
                                'staff_id'  =>  $department->chief,
                                'post'      =>  $department->chief_post,
                            ])->save();

                }

                foreach ($department->old_staffs as $staff)
                    $department->staffs()->create([
                        'type'          => 'staff',
                        'staff_id'      => $staff->id,
                        'post'          => $staff->post,
                        'order'         => $staff->show,
                    ])->save();

            }
        }
        catch (\Exception $e){
            dump($e->getMessage());
        }
    }


    public static function DepartmentSections():void
    {
        try{
            $departments = \App\Models\Department\Department::all();

            foreach ($departments as $department) {
                foreach ($department->old_sections as $section) {
                    $department->sections()->create([
                        'title'         => $section->name,
                        'show_title'    =>  (bool)$section->show_title,
                        'content'       =>  $section->text,
                        'order'         => $section->sort,
                    ])->save();
                }
            }
        }
        catch (\Exception $e){
            dump($e->getMessage());
        }
    }


}
