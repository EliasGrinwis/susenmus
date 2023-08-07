<?php

use App\Http\Livewire\Contact;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Homepage;
use App\Http\Livewire\ManageOrder;
use App\Http\Livewire\ManageProducts;
use App\Http\Livewire\ManageUsers;
use App\Http\Livewire\Shop;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', Homepage::class)->name('homepage');

Route::get('/contact', Contact::class)->name('contact');
Route::get('/shop', Shop::class)->name('shop');


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    Route::get('/dashboard/gebruikers', ManageUsers::class)->name('gebruikers');
    Route::get('/dashboard/bestellingen', ManageOrder::class)->name('bestellingen');
    Route::get("/dashboard/producten", ManageProducts::class)->name('producten');

});


Route::get('/symlink', function () {
    Artisan::call('storage:link');
});


/*Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('livewire.dashboard');
    })->name('dashboard');
});*/
