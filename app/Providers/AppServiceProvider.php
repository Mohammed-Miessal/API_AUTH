<?php

namespace App\Providers;

use App\Models\Permission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\SubcategoryRepositoryInterface;
use App\Repositories\Eloquent\EloquentCategoryRepository;
use App\Repositories\Eloquent\EloquentSubcategoryRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            CategoryRepositoryInterface::class,
            EloquentCategoryRepository::class
        );
        
        $this->app->bind(
            SubcategoryRepositoryInterface::class,
            EloquentSubcategoryRepository::class
        );
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        try {
            Permission::get()->map(function ($permission) {
                Gate::define($permission->name, function ($user) use ($permission) {
                    return $user->hasPermissionTo($permission);
                });
            });
        } catch (\Exception $e) {
            report($e);
        }

        Blade::directive('role', function ($role) {
            return "<?php if(auth()->check() && auth()->user()->hasRole({$role})) : ?>";
        });

        Blade::directive('endrole', function ($role) {
            return "<?php endif; ?>";
        });
    }
}
