<?php

use App\Models\Education\Faculty;
use App\Models\Education\Speciality;
use App\Models\News\News;
use App\Models\Page;
use App\Models\Staff\Staff;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;
use App\Models\Division\Division;
use App\Enums\DivisionType;

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

Breadcrumbs::for('faculty', function (BreadcrumbTrail $trail, Division $faculty) {
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

Breadcrumbs::for('speciality', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push("Факультеты и филиалы", route('public:education:faculties'));
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

Breadcrumbs::for('divisions', function (BreadcrumbTrail $trail) {
    $trail->parent('home');

    $trail->push("Структура Университета", route('public:division:list'));
});


Breadcrumbs::for('division', function (BreadcrumbTrail $trail, Division $division) {
    $trail->parent('divisions');
    $trail->push($division->name??'отдел', $division->link);
});

Breadcrumbs::for('galleries', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push("Фотоальбом", route('public:gallery:list'));
});


Breadcrumbs::for('gallery', function (BreadcrumbTrail $trail,\App\Models\Gallery\Gallery $gallery) {
    $trail->parent('galleries');
    $trail->push($gallery->name, route('public:gallery:show',[$gallery->id??null]));
});


