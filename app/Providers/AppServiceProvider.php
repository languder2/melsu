<?php

namespace App\Providers;

use App\Models\Page\Page;
use App\Models\Users\User;
use App\Policies\UserPolicy;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->usePublicPath(path: realpath(base_path('public_html')));
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        try {
            if (config('cache.default') === 'redis') {
                app('redis')->connection()->ping();
            }
        } catch (\Exception $e) {
            Log::error('Redis недоступен, переключение на file');
            config(['cache.default' => 'file']);
            config(['session.driver' => 'file']);
        }

        Gate::policy(User::class, UserPolicy::class);

        Gate::define('access-page', fn (User $user, Page $page) =>
            $user->isEditor() || $user->pages()->where('pages.id', $page->id)->exists()
        );

        Gate::define('access-instance', fn (User $user, $instance) =>
            $user->isEditor() || $instance->users()->find($user)
        );

        if (!Collection::hasMacro('paginate')) {
            Collection::macro('paginate', function ($perPage = 15, $page = null, $options = []) {
                $page = $page ?: (LengthAwarePaginator::resolveCurrentPage() ?: 1);

                return new LengthAwarePaginator(
                    $this->forPage($page, $perPage)->values(),
                    $this->count(),
                    $perPage,
                    $page,
                    [
                        'path' => LengthAwarePaginator::resolveCurrentPath(),
                        ...$options
                    ]
                );
            });
        }

    }


}


