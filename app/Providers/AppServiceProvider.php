<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::directive('formatDate', function ($expression) {
            return "<?php echo e(\App\Helpers\MyHelpers::formatDate($expression)); ?>";
        });

        Blade::directive('formatCurrency', function ($expression) {
            return "<?php echo e(\App\Helpers\MyHelpers::formatCurrency($expression)); ?>";
        });

        Blade::directive('formatAmount', function ($expression) {
            return "<?php echo e(\App\Helpers\MyHelpers::formatAmount($expression)); ?>";
        });

        Blade::directive('getBalancePositive', function($expression) {
            return "<?php echo e(\App\Helpers\MyHelpers::getBalancePositive($expression)); ?>";
        });

        Blade::directive('getBalanceNegative', function() {
            return "<?php echo e(\App\Helpers\MyHelpers::getBalanceNegative()); ?>";
        });

        Blade::directive('getBalance', function() {
            return "<?php echo e(\App\Helpers\MyHelpers::getBalance()); ?>";
        });
    }
}
