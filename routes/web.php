<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

Route::get('/home', function () {
    $notifications = DB::table('notifications')->join('users', 'notifications.from_user_id', '=', 'users.id')->where('notifications.user_id', Auth::id())->orderBy('notifications.created_at', 'desc')->select('notifications.*', 'users.name')->get();

    $notifCount = DB::table('notifications')->where('user_id', Auth::id())->where('is_read', false)->count();

    return view('home', compact('notifications', 'notifCount'));
});
/*
|--------------------------------------------------------------------------
| LANDING PAGE (PUBLIC)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('landing');
})->name('landing');

/*
|--------------------------------------------------------------------------
| GUEST ROUTES (LOGIN / REGISTER / FORGOT PASSWORD)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');

    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');

    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');

    Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.update');
});

/*
|--------------------------------------------------------------------------
| AUTH ROUTES (ONLY LOGGED IN USER)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // Home
    Route::get('/home', function () {
        return view('home');
    })->name('home');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Users (friend system nanti)
    Route::post('/chat/{id}', [ChatController::class, 'send']);
    Route::get('/user/{id}', [FriendController::class, 'showProfile']);
    Route::get('/users', [FriendController::class, 'index']);
    Route::post('/add-friend/{id}', [FriendController::class, 'addFriend']);
    Route::get('/users/create', [UserController::class, 'create']);
    Route::post('/users', [UserController::class, 'store']);
    Route::get('/users/{id}/edit', [UserController::class, 'edit']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);
    Route::get('/chat/{id}', [ChatController::class, 'index'])->middleware('auth');
    Route::get('/notifications', [NotificationController::class, 'index']);
    Route::get('/notification/read/{id}', [NotificationController::class, 'read']);
    Route::get('/friend/accept/{id}', [FriendController::class, 'accept']);
    Route::get('/friend/reject/{id}', [FriendController::class, 'reject']);
    Route::post('/cancel-friend/{id}', [FriendController::class, 'cancelFriend']);
    Route::post('/unfriend/{id}', [FriendController::class, 'unfriend']);

    // Purchase / Payment
    Route::get('/purchase', [PurchaseController::class, 'index']);
    Route::post('/buy/{id}', [PurchaseController::class, 'buy'])->middleware('auth');
    Route::post('/purchase/{id}', [PurchaseController::class, 'store'])->middleware('auth');

    Route::get('/payment/{id}', [PurchaseController::class, 'payment'])->name('payment');

    Route::post('/confirm-payment/{id}', [PurchaseController::class, 'confirmPayment']);
});

Route::get('/notification/read/{id}', function ($id) {
    $notif = DB::table('notifications')->where('id', $id)->first();

    DB::table('notifications')->where('id', $id)->delete();

    if ($notif && $notif->type == 'message') {
        return redirect('/chat/' . $notif->from_user_id);
    }

    return back();
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/users', [UserController::class, 'index']);
    Route::get('/admin/users/{id}/edit', [UserController::class, 'edit']);
    Route::put('/admin/users/{id}', [UserController::class, 'update']);
    Route::delete('/admin/users/{id}', [UserController::class, 'destroy']);
});

Route::get('/books', [BookController::class, 'index']);

Route::middleware('auth')->group(function () {
    Route::get('/admin/users/edit/{id}', [UserController::class, 'edit']);
    Route::put('/admin/users/update/{id}', [UserController::class, 'update']);
    Route::delete('/admin/users/delete/{id}', [UserController::class, 'destroy']);

    Route::post('/books/hide/{id}', [BookController::class, 'hide']);
    Route::post('/books/show/{id}', [BookController::class, 'show']);
    Route::put('/admin/book/{id}', [PurchaseController::class, 'updateBook']);
    Route::get('/chat/messages/{id}', [ChatController::class, 'fetchMessages']);
    Route::post('/admin/book/add', [BookController::class, 'store']);
});

require __DIR__ . '/auth.php';
