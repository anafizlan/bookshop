<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
    View::composer('*', function ($view) {

        if (Auth::check()) {

            $notifications = DB::table('notifications')
                ->join('users', 'notifications.from_user_id', '=', 'users.id')
                ->where('notifications.user_id', Auth::id())
                ->orderBy('notifications.created_at', 'desc')
                ->select('notifications.*', 'users.name')
                ->get();

            $notifCount = DB::table('notifications')
                ->where('user_id', Auth::id())
                ->where('is_read', false)
                ->count();

        } else {
            $notifications = collect();
            $notifCount = 0;
        }

        $view->with([
            'notifications' => $notifications,
            'notifCount' => $notifCount
        ]);
    });
}
}
