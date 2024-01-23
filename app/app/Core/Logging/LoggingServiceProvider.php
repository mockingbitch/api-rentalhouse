<?php

namespace App\Core\Logging;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;

class LoggingServiceProvider extends ServiceProvider
{
    public function register()
    {
        $startTime = Carbon::now()->format('Y-m-d h:i:s');
        try {
            $rowId = 0;
//            if (Helper::isLogEnabled()) {
                $rowId = DB::table('logs')->insertGetId([
                    'route' => $_SERVER['REQUEST_URI'] ?? $_SERVER['argv'][1] ?? '',
                    'created_at' => $startTime,
                    'updated_at' => $startTime,
                ]);
//            }
            $this->app->bind(Log::class, function () use ($startTime, $rowId) {
                $driver = new AwsLambdaDriver(env('AWS_LAMBDA_ENDPOINT'), env('AWS_LAMBDA_X_API_KEY'));
                return new Log($driver, ['start_time' => $startTime], $rowId);
            });
        } catch (\Throwable $throwable) {
            \Illuminate\Support\Facades\Log::error($throwable->getMessage());
        }
    }

    public function boot()
    {
        $this->registerRoutes();
    }
    /**
     * Register the package routes.
     *
     * @return void
     */
    private function registerRoutes(): void
    {
//        Route::group($this->routeConfiguration(), function () {
//            $this->loadRoutesFrom(__DIR__.'/Http/routes.php');
//        });
    }
}
