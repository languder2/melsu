@extends("layouts.page")

@section('title', 'ФГБОУ ВО "МелГУ"')

@section('content')
    <livewire:test />
@endsection



tail -n 20 storage/logs/laravel.log
#40 /home/u/ucrtecrt/melsu.ru/vendor/laravel/framework/src/Illuminate/Foundation/Http/Middleware/TransformsRequest.php(21): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():184}:185}(Object(Illuminate\\Http\\Request))
#41 /home/u/ucrtecrt/melsu.ru/vendor/laravel/framework/src/Illuminate/Foundation/Http/Middleware/TrimStrings.php(51): Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest->handle(Object(Illuminate\\Http\\Request), Object(Closure))
#42 /home/u/ucrtecrt/melsu.ru/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(209): Illuminate\\Foundation\\Http\\Middleware\\TrimStrings->handle(Object(Illuminate\\Http\\Request), Object(Closure))
#43 /home/u/ucrtecrt/melsu.ru/vendor/laravel/framework/src/Illuminate/Http/Middleware/ValidatePostSize.php(27): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():184}:185}(Object(Illuminate\\Http\\Request))
#44 /home/u/ucrtecrt/melsu.ru/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(209): Illuminate\\Http\\Middleware\\ValidatePostSize->handle(Object(Illuminate\\Http\\Request), Object(Closure))
#45 /home/u/ucrtecrt/melsu.ru/vendor/laravel/framework/src/Illuminate/Foundation/Http/Middleware/PreventRequestsDuringMaintenance.php(110): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():184}:185}(Object(Illuminate\\Http\\Request))
#46 /home/u/ucrtecrt/melsu.ru/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(209): Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance->handle(Object(Illuminate\\Http\\Request), Object(Closure))
#47 /home/u/ucrtecrt/melsu.ru/vendor/laravel/framework/src/Illuminate/Http/Middleware/HandleCors.php(49): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():184}:185}(Object(Illuminate\\Http\\Request))
#48 /home/u/ucrtecrt/melsu.ru/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(209): Illuminate\\Http\\Middleware\\HandleCors->handle(Object(Illuminate\\Http\\Request), Object(Closure))
#49 /home/u/ucrtecrt/melsu.ru/vendor/laravel/framework/src/Illuminate/Http/Middleware/TrustProxies.php(58): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():184}:185}(Object(Illuminate\\Http\\Request))
#50 /home/u/ucrtecrt/melsu.ru/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(209): Illuminate\\Http\\Middleware\\TrustProxies->handle(Object(Illuminate\\Http\\Request), Object(Closure))
#51 /home/u/ucrtecrt/melsu.ru/vendor/laravel/framework/src/Illuminate/Foundation/Http/Middleware/InvokeDeferredCallbacks.php(22): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():184}:185}(Object(Illuminate\\Http\\Request))
#52 /home/u/ucrtecrt/melsu.ru/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(209): Illuminate\\Foundation\\Http\\Middleware\\InvokeDeferredCallbacks->handle(Object(Illuminate\\Http\\Request), Object(Closure))
#53 /home/u/ucrtecrt/melsu.ru/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(127): Illuminate\\Pipeline\\Pipeline->{closure:{closure:Illuminate\\Pipeline\\Pipeline::carry():184}:185}(Object(Illuminate\\Http\\Request))
#54 /home/u/ucrtecrt/melsu.ru/vendor/laravel/framework/src/Illuminate/Foundation/Http/Kernel.php(176): Illuminate\\Pipeline\\Pipeline->then(Object(Closure))
