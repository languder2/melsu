<?php

use App\Models\Education\Faculty;
use App\Models\Education\Speciality;
use App\Models\News\News;
use App\Models\Page;
use App\Models\Staff\Staff;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Главная', route('pages:main'));
});

Breadcrumbs::for('news', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Новости', route('news:show:all'));
});

Breadcrumbs::for('news-item', function (BreadcrumbTrail $trail, News $news) {
    $trail->parent('news');
    $trail->push($news->title??'Новость', route('news:show',[$news->id??null]));
});

Breadcrumbs::for('faculties', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Факультеты и филиалы', route('public:education:faculties'));
});

Breadcrumbs::for('faculty', function (BreadcrumbTrail $trail, Faculty $faculty) {
    $trail->parent('faculties');
    $trail->push($faculty->name??"", route('public:education:faculty', [$faculty->code ?? $faculty->id??null]));
});

Breadcrumbs::for('faculty-departments', function (BreadcrumbTrail $trail, Faculty $faculty) {
    $trail->parent('faculty',$faculty);
    $trail->push("Кафедры", route('public:education:departments', [$faculty->code ?? $faculty->id??null]));
});

//faculties/faculty_1


Breadcrumbs::for('specialities', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Направления подготовки', route('public:education:specialities:all'));
});

Breadcrumbs::for('speciality', function (BreadcrumbTrail $trail, Speciality $speciality) {
    $trail->push('Главная', route('pages:main'));

    if($speciality->faculty)
        $trail->push(
            $speciality->faculty->name,
            route('public:education:faculty', [$speciality->faculty->code ?? $speciality->faculty->id??null])
        );

    if($speciality->department)
        $trail->push(
            $speciality->department->name,
            route(
                'public:education:department',
                    [
                        $speciality->faculty->code ?? $speciality->faculty->id??null,
                        $speciality->department->code ?? $speciality->department->id??null
                    ]
            )
        );


    $trail->push('Направления подготовки', route('public:education:specialities:department',
        [
            $speciality->faculty->code ?? $speciality->faculty->id??"",
            $speciality->department->code ?? $speciality->department->id??""
        ]
    ));

    $trail->push($speciality->name??"-", route('public:education:speciality', [$speciality->code ?? $speciality->id??null]));
});


Breadcrumbs::for('pages', function (BreadcrumbTrail $trail, Page $page) {
    $trail->parent('home');

    Page::breadcrumbs($list,$page);

    foreach ($list as $item)
        $trail->push($item->title??"", $item->link);
});

Breadcrumbs::for('staffs', function (BreadcrumbTrail $trail) {
    $trail->parent('home');

    $trail->push("Кадровый состав", route('public:staff:list'));
});

Breadcrumbs::for('staff', function (BreadcrumbTrail $trail, ?Staff $staff) {
    $trail->parent('staffs');

    $trail->push($staff->full_name, route('public:staff:show',[$staff->id??null]));
});

Breadcrumbs::for('departments', function (BreadcrumbTrail $trail) {
    $trail->parent('home');

    $trail->push("Структура Университета", route('public:department:list'));
});


Breadcrumbs::for('department', function (BreadcrumbTrail $trail, \App\Models\Department\Department $department) {
    $trail->parent('departments');
    $trail->push($department->name??'отдел', $department->link);
});

Breadcrumbs::for('galleries', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push("Фотоальбом", route('public:gallery:list'));
});


Breadcrumbs::for('gallery', function (BreadcrumbTrail $trail,\App\Models\Gallery\Gallery $gallery) {
    $trail->parent('galleries');
    $trail->push($gallery->name, route('public:gallery:show',[$gallery->id??null]));
});


