<?php

use App\Models\Division\Division;
use App\Models\Education\Faculty;
use App\Models\Education\Speciality;
use App\Models\Events\Events;
use App\Models\Menu\Menu;
use App\Models\News\News;
use App\Models\Page\Page;
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

Breadcrumbs::for('events', function (BreadcrumbTrail $trail, ?Events $event) {
    $trail->parent('home');

    if($event){
        $trail->push('Мероприятия',route('public:events:calendar'));
        $trail->push($event->title,route('public:event:show',$event));

    }
});

Breadcrumbs::for('news-item', function (BreadcrumbTrail $trail, News $news) {
    $trail->parent('news');
    $trail->push($news->title??'Новость', route('news:show',[$news->id??null]));
});

Breadcrumbs::for('menu', function (BreadcrumbTrail $trail, ?Menu $menu) {
    $trail->parent('home');
    $trail->push($menu->name,$menu->link);
});

Breadcrumbs::for('institutes', function (BreadcrumbTrail $trail) {
    $trail->parent('menu',Menu::where('code','university')->first());

    $trail->push('Институты', route('public:education:institutes'));
});

Breadcrumbs::for('institute', function (BreadcrumbTrail $trail, ?Division $division) {
    $trail->parent('institutes');

    if($division)
        $trail->push($division->name, $division->link);
});

Breadcrumbs::for('faculties', function (BreadcrumbTrail $trail) {
    $trail->parent('menu',Menu::where('code','university')->first());

    $trail->push('Факультеты и филиалы', route('public:education:faculties'));
    $trail->push('Факультеты', route('public:education:faculties'));
});

Breadcrumbs::for('departments', function (BreadcrumbTrail $trail) {
    $trail->parent('menu',Menu::where('code','university')->first());

    $trail->push('Факультеты и филиалы', route('public:education:faculties'));
    $trail->push('Кафедры', route('public:education:departments:list'));
});

Breadcrumbs::for('branches', function (BreadcrumbTrail $trail) {
    $trail->parent('menu',Menu::where('code','university')->first());

    $trail->push('Факультеты и филиалы', route('public:education:faculties'));
    $trail->push('Филиалы', route('public:education:branch:list'));
});

Breadcrumbs::for('labs', function (BreadcrumbTrail $trail) {
    $trail->parent('menu',Menu::where('code','university')->first());

    $trail->push('Факультеты и филиалы', route('public:education:faculties'));
    $trail->push('Лаборатории', route('public:labs:list'));
});

Breadcrumbs::for('faculty', function (BreadcrumbTrail $trail, ?Division $division) {
    $trail->parent('faculties');
    $trail->push($division->name, $division->link);
});

Breadcrumbs::for('branch', function (BreadcrumbTrail $trail, ?Division $division) {
    $trail->parent('faculties');
    $trail->push($division->name, $division->link);
});

Breadcrumbs::for('department', function (BreadcrumbTrail $trail, ?Division $division) {

    if($division->parent && $division->parent->type)
        $trail->parent($division->parent->type->value,$division->parent);
    else
        $trail->parent('home');
    $trail->push($division->name, $division->link);
});

Breadcrumbs::for('lab', function (BreadcrumbTrail $trail, ?Division $division) {
    if($division->parent && $division->parent->type)
        $trail->parent($division->parent->type->value,$division->parent);
    else
        $trail->parent('home');

    $trail->push($division->name, $division->link);
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


Breadcrumbs::for('regiment', function (BreadcrumbTrail $trail, \App\Enums\RegimentType $type) {
    $trail->parent('home');
    $trail->push($type->getFullName());
});

Breadcrumbs::for('documents', function (BreadcrumbTrail $trail) {
    $trail->parent('menu',Menu::where('code','university')->first());

    $trail->push('Документы');
});

Breadcrumbs::for('clusters', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Флагманские проекты', route('clusters.list'));
});

Breadcrumbs::for('cluster', function (BreadcrumbTrail $trail, ?\App\Models\Projects\Cluster $cluster) {
    $trail->parent('clusters');
    $trail->push($cluster->name, $cluster->link);
});

Breadcrumbs::for('project', function (BreadcrumbTrail $trail, ?\App\Models\Projects\Project $project) {
    $trail->parent('clusters');

    if($project->cluster)
        $trail->push($project->cluster->name,$project->cluster->link);

    $trail->push($project->name, $project->link);
});

Breadcrumbs::for('education-programs:higher-education', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Образовательная инфраструктура', url('obrazovatelnaya-infrastruktura'));
    $trail->push('Образовательные программы высшего образования', route('education-programs:higher-education'));
});
