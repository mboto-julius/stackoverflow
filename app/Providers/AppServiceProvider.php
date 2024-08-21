<?php

namespace App\Providers;

use App\Models\Question;
use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;


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
        Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();

        Gate::define('update-question', function (User $user, Question $question) {
            return $user->id === $question->user_id;
        });

        Gate::define('delete-question', function (User $user, Question $question) {
            return $user->id === $question->user_id;
        });
    }
}
