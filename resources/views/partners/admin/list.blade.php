@props([
    'title'         => 'Admin panel',
    'entity'        => null,
    'instance'      => null,
    'list'          => collect(),
])

@extends("layouts.admin")

@section('title', $title )

@section('top-menu')
    @include('projects.admin.includes.admin-menu')
@endsection

@section('content-header')
    @component('admin.components.content-header')
        <div class="flex gap-3">
            @if($entity && $instance)
                <a
                    href="{{ $instance->admin }}"
                    class="link"
                >
                    {{ $entity->label() }}
                </a>

                <span>
                    {{ __('common.arrowR') }}
                </span>
            @endif

            @if($instance)
                <a href="{{ $instance->form }}" class="link">
                    {{ $instance->name }}
                </a>

                <a href="{{ $instance->link }}" target="_blank" class="flex-end hover:text-green-700">
                    <x-lucide-square-arrow-out-up-right class="w-6"/>
                </a>

                <span>
                    {{ __('common.arrowR') }}
                </span>
            @endif

            <span>
                {{ __('partners.Partners') }}
            </span>
        </div>

        @slot('link')
            {{ $instance->add_partner }}
        @endslot
    @endcomponent
@endsection

@section('content')
    {{ $instance->add_partner }}
    @foreach($list as $record)
        @php session()->put('rowCount',0) @endphp
        <h3 class="mt-8 first:mt-0 mb-3 font-semibold text-lg">
            {{$record->name}}
        </h3>
        <div class="bg-white rounded-md p-4 mb-4">
            <div
                class="
                grid items-center
                grid-cols-1
                md:grid-cols-[auto_3fr_auto]
            "
            >
                <div class="font-semibold p-4">
                    ID
                </div>

                <div class="font-semibold p-4">
                    Отдел
                </div>

                <div class="p-4"></div>
            </div>
        </div>
    @endforeach

@endsection
<div class="bg-neutral-200"></div>
