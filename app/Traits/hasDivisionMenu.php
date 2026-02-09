<?php

namespace App\Traits;

use App\Enums\DivisionType;
use App\Models\Menu\Menu;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Blade;

trait hasDivisionMenu
{
    public function menu(): Collection
    {
        return match($this->type){
                DivisionType::Faculty       => $this->getFacultyMenu(),
                DivisionType::Department    => $this->getDepartmentMenu(),
                DivisionType::Institute     => $this->getInstituteMenu(),
                DivisionType::EducationLab, DivisionType::Lab
                                            => $this->getLabMenu(),
                default => collect(),
            };
    }

    public function getInstituteMenu(): Collection
    {
        $menu = collect();

        $menu->put('about',(object)[
            'name'      => __("menu.institute about"),
            'ico'       => Blade::render('<x-lucide-graduation-cap class="w-5" />'),
            'link'      => $this->link,
            'is_link'   => true
        ]);

//        $menu->put('dean office',(object)[
//            'name'      => __("menu.dean office"),
//            'ico'       => Blade::render('<x-lucide-university class="w-5" />'),
//            'link'      => $this->DeanOfficeLink,
//            'is_link'   => true
//        ]);

        $menu->put('employees',(object)[
            'name'      => __("menu.teaching staff"),
            'ico'       => Blade::render('<x-lucide-users class="w-5" />'),
            'link'      => $this->TeachingStaffLink,
            'is_link'   => true
        ]);

        $menu->put('departments',(object)[
            'name'      => __("menu.departments and labs"),
            'ico'       => Blade::render('<x-lucide-list-collapse class="w-5" />'),
            'link'      => $this->departmentslink,
            'is_link'   => true
        ]);

        $menu->put('specialities',(object)[
            'name'      => __("menu.specialities"),
            'ico'       => Blade::render('<x-lucide-move class="w-5" />'),
            'link'      => $this->specialitieslink,
            'is_link'   => true
        ]);

        $menu->put('sciences',(object)[
            'name'      => __("menu.sciences"),
            'ico'       => Blade::render('<x-lucide-microscope class="w-5" />'),
            'link'      => $this->sciencesLink,
            'is_link'   => false
        ]);

        $menu->put('partners',(object)[
            'name'      => __("menu.partners and graduations"),
            'ico'       => Blade::render('<x-lucide-handshake class="w-5" />'),
            'link'      => $this->partnersLink,
            'is_link'   => true
        ]);

        $menu->put('news',(object)[
            'name'      => __("menu.news"),
            'ico'       => Blade::render('<x-lucide-notebook-text class="w-5" />'),
            'link'      => '',
            'is_link'   => true,
            'onclick'   => "scrollToBlock('NewsIncludeBlock'); return false;"
        ]);

        $menu->put('incomingStudents',(object)[
            'name'      => __("menu.for incoming students"),
            'ico'       => Blade::render('<x-lucide-door-open class="w-5" />'),
            'link'      => 'https://abiturient.mgu-mlt.ru/',
            'is_link'   => true
        ]);

        $menu->put('news',(object)[
            'name'      => __("menu.documents"),
            'ico'       => Blade::render('<x-lucide-file-text class="w-5" />'),
            'link'      => $this->documentsLink,
            'is_link'   => true,
        ]);

        return $menu;
    }
    public function getFacultyMenu(): Collection
    {
        $menu = collect();

        $menu->put('about',(object)[
            'name'      => __("menu.{$this->type->value} about"),
            'ico'       => Blade::render('<x-lucide-graduation-cap class="w-5" />'),
            'link'      => $this->link,
            'is_link'   => true
        ]);

        $menu->put('dean office',(object)[
            'name'      => __("menu.dean office"),
            'ico'       => Blade::render('<x-lucide-university class="w-5" />'),
            'link'      => $this->DeanOfficeLink,
            'is_link'   => true
        ]);

        $menu->put('employees',(object)[
            'name'      => __("menu.teaching staff"),
            'ico'       => Blade::render('<x-lucide-users class="w-5" />'),
            'link'      => $this->TeachingStaffLink,
            'is_link'   => true
        ]);

        $menu->put('departments',(object)[
            'name'      => __("menu.departments and labs"),
            'ico'       => Blade::render('<x-lucide-list-collapse class="w-5" />'),
            'link'      => $this->departmentslink,
            'is_link'   => true
        ]);

        $menu->put('specialities',(object)[
            'name'      => __("menu.specialities"),
            'ico'       => Blade::render('<x-lucide-move class="w-5" />'),
            'link'      => $this->specialitieslink,
            'is_link'   => true
        ]);

        $menu->put('sciences',(object)[
            'name'      => __("menu.sciences"),
            'ico'       => Blade::render('<x-lucide-microscope class="w-5" />'),
            'link'      => $this->sciencesLink,
            'is_link'   => false
        ]);

        $menu->put('partners',(object)[
            'name'      => __("menu.partners and graduations"),
            'ico'       => Blade::render('<x-lucide-handshake class="w-5" />'),
            'link'      => $this->partnersLink,
            'is_link'   => true
        ]);

        $menu->put('news',(object)[
            'name'      => __("menu.news"),
            'ico'       => Blade::render('<x-lucide-notebook-text class="w-5" />'),
            'link'      => '',
            'is_link'   => true,
            'onclick'   => "scrollToBlock('NewsIncludeBlock'); return false;"
        ]);

        $menu->put('incomingStudents',(object)[
            'name'      => __("menu.for incoming students"),
            'ico'       => Blade::render('<x-lucide-door-open class="w-5" />'),
            'link'      => 'https://abiturient.mgu-mlt.ru/',
            'is_link'   => true
        ]);

        $menu->put('news',(object)[
            'name'      => __("menu.documents"),
            'ico'       => Blade::render('<x-lucide-file-text class="w-5" />'),
            'link'      => $this->documentsLink,
            'is_link'   => true,
        ]);

        return $menu;
    }

    public function getDepartmentMenu(): Collection
    {
        $menu = collect();

        $menu->put('about',(object)[
            'name'      => __("menu.{$this->type->value} about"),
            'ico'       => Blade::render('<x-lucide-graduation-cap class="w-5" />'),
            'link'      => $this->link,
            'is_link'   => true
        ]);

        $menu->put('employees',(object)[
            'name'      => __("menu.teaching staff"),
            'ico'       => Blade::render('<x-lucide-users class="w-5" />'),
            'link'      => $this->TeachingStaffLink,
            'is_link'   => true
        ]);

        $menu->put('labs',(object)[
            'name'      => __("menu.labs"),
            'ico'       => Blade::render('<x-lucide-list-collapse class="w-5" />'),
            'link'      => $this->departmentslink,
            'is_link'   => true
        ]);

        $menu->put('specialities',(object)[
            'name'      => __("menu.specialities"),
            'ico'       => Blade::render('<x-lucide-move class="w-5" />'),
            'link'      => $this->specialitieslink,
            'is_link'   => true
        ]);

        $menu->put('sciences',(object)[
            'name'      => __("menu.sciences"),
            'ico'       => Blade::render('<x-lucide-microscope class="w-5" />'),
            'link'      => $this->sciencesLink,
            'is_link'   => false
        ]);

        $menu->put('partners',(object)[
            'name'      => __("menu.partners and graduations"),
            'ico'       => Blade::render('<x-lucide-handshake class="w-5" />'),
            'link'      => $this->partnersLink,
            'is_link'   => true
        ]);

        $menu->put('news',(object)[
            'name'      => __("menu.news"),
            'ico'       => Blade::render('<x-lucide-notebook-text class="w-5" />'),
            'link'      => '#',
            'is_link'   => true,
            'onclick'   => "scrollToBlock('NewsIncludeBlock');  return false;"
        ]);

        $menu->put('news',(object)[
            'name'      => __("menu.documents"),
            'ico'       => Blade::render('<x-lucide-file-text class="w-5" />'),
            'link'      => $this->documentsLink,
            'is_link'   => true,
        ]);

        $menu->put('incomingStudents',(object)[
            'name'      => __("menu.for incoming students"),
            'ico'       => Blade::render('<x-lucide-door-open class="w-5" />'),
            'link'      => 'https://abiturient.mgu-mlt.ru/',
            'is_link'   => true
        ]);

        return $menu;
    }
    public function getLabMenu(): Collection
    {
        $menu = collect();

        $menu->put('about',(object)[
            'name'      => __("menu.lab about"),
            'ico'       => Blade::render('<x-lucide-graduation-cap class="w-5" />'),
            'link'      => $this->link,
            'is_link'   => true
        ]);

        $menu->put('employees',(object)[
            'name'      => __("menu.teaching staff"),
            'ico'       => Blade::render('<x-lucide-users class="w-5" />'),
            'link'      => $this->TeachingStaffLink,
            'is_link'   => true
        ]);

        $menu->put('sciences',(object)[
            'name'      => __("menu.sciences"),
            'ico'       => Blade::render('<x-lucide-microscope class="w-5" />'),
            'link'      => $this->sciencesLink,
            'is_link'   => false
        ]);

        $menu->put('partners',(object)[
            'name'      => __("menu.partners and graduations"),
            'ico'       => Blade::render('<x-lucide-handshake class="w-5" />'),
            'link'      => $this->partnersLink,
            'is_link'   => true
        ]);

        $menu->put('news',(object)[
            'name'      => __("menu.news"),
            'ico'       => Blade::render('<x-lucide-notebook-text class="w-5" />'),
            'link'      => '#',
            'is_link'   => true,
            'onclick'   => "scrollToBlock('NewsIncludeBlock');  return false;"
        ]);

        $menu->put('news',(object)[
            'name'      => __("menu.documents"),
            'ico'       => Blade::render('<x-lucide-file-text class="w-5" />'),
            'link'      => $this->documentsLink,
            'is_link'   => true,
        ]);

        return $menu;
    }

}
