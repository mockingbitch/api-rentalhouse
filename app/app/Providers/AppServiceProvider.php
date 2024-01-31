<?php

namespace App\Providers;

use App\Util\SystemConfigure;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;
use App\Providers\TelescopeServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //Passport Authentication
        Passport::ignoreRoutes();
        if ($this->app->isLocal()) {
            $this->app->register(TelescopeServiceProvider::class);
        }

        //Register Repository
        $pathRepository = glob(app_path('/Repositories') ."/*.php");

        foreach ($pathRepository as $path) {
            $arrPath = explode('/', $path);
            $fileNameRepository = end($arrPath);
            if ($fileNameRepository == 'BaseRepository.php') {
                continue;
            }
            $repoName = preg_replace('/.php$/', '', $fileNameRepository);
            $this->app->singleton(
                "App\Contracts\Repositories\\{$repoName}Interface",
                "App\Repositories\\{$repoName}"
            );
        }

        $this->app->register(\L5Swagger\L5SwaggerServiceProvider::class);
//        $this->app->singleton(SystemConfigure::class, function () {
//            try {
//                $configures = \App\Models\Configure::query()->select(['key', 'value'])->get()->pluck('value', 'key')->toArray();
//            } catch (\Throwable $throwable) {
//                \Illuminate\Support\Facades\Log::error($throwable->getMessage());
//                $configures = [];
//            }
//            $config = new SystemConfigure(
//                $configures
//            );
//            return $config->all();
//        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
