@extends("layouts.admin")

@section('title', 'Админ панель: Пользователи')

@section('top-menu')
    @include('admin.users.menu')
@endsection

@section('content-header')
    @include('admin.users.header')
@endsection

@section('content')

    <div class="bg-white rounded-md p-4 mb-4">
        <div
            class="
                grid gap-4 items-center
                grid-cols-1
                md:grid-cols-[auto_auto_auto_auto_1fr_auto]
            "
        >
            <div class="font-semibold">
                ID
            </div>

            <div class="font-semibold">
                Login
            </div>

            <div class="font-semibold">
                Email
            </div>

            <div class="font-semibold">
                Role
            </div>

            <div class="font-semibold">
                ФИО
            </div>

            <div class="font-semibold">
            </div>

            @foreach($list as $record)
                <div>
                    {{ $record->id }}
                </div>

                <div>
                    <a href="{{route('admin:users:edit',$record->id)}}" class="underline">
                        {{ $record->name}}
                    </a>
                </div>

                <div>
                    <a href="{{route('admin:users:edit',$record->id)}}" class="underline">
                        {{ $record->email}}
                    </a>
                </div>

                <div>
                    {{ $record->role->getName()}}
                </div>

                <div>
                    <a href="{{route('admin:users:edit',$record->id)}}" class="underline">
                        {{ $record->full_name}}
                    </a>
                </div>

                <div>
                    <a
                        href="{{route('admin:users:delete',$record->id)}}"
                        class="
                            inline-block
                            bg-gray-100 p-3 rounded-lg
                            transition-all duration-200
                            hover:text-white hover:bg-red-700
                            hover:-mt-2px hover:mb-2px
                            hover:shadow-md hover:shadow-gray-400
                        "
                    >
                        <i class="fas fa-recycle"></i>
                    </a>
                </div>

                <hr class="md:col-span-6 last:hidden opacity-70">
            @endforeach
        </div>
    </div>
@endsection
<div class="bg-neutral-200"></div>
