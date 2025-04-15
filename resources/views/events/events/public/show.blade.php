@extends("layouts.page")
@section('title', "Мероприятие: {$event->title}")

@section('breadcrumbs')
    {!!Breadcrumbs::view("vendor.breadcrumbs.news-item",'events',$event)!!}
@endsection

@section('content')
        <section class="container">
            <div class="page-header mb-5">

                <h1 class="text-4xl font-bold block pb-2">
                    {!! @$event->title !!}
                </h1>
                <span class="text-[var(--primary-color)]">
                <i class="bi bi-calendar2-week"></i>
                    {{$event->PublicDate}}
            </span>
            </div>
        </section>

        <div class="container">
            <div class="content-news mb-3">
                {!! $event->news !!}
            </div>

        </div>
@endsection
