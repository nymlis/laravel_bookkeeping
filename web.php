<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JournalController;
use App\Models\Journal;
use Illuminate\Routing\Route as RoutingRoute;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [JournalController::class, 'index'])
    ->name('journals.index');

Route::post('/journals/create', [JournalController::class, 'create'])
    ->name('journals.create');

Route::get('/journals/{journal}/edit', [JournalController::class, 'edit'])
    ->name('journals.edit')
    ->where('journal', '[0-9]+');

Route::patch('/journals/{journal}/update', [JournalController::class, 'update'])
    ->name('journals.update')
    ->where('journal', '[0-9]+');

Route::delete('/journals/{journal}/destroy', [JournalController::class, 'destroy'])
    ->name(('journals.destroy'))
    ->where('journal', '[0-9]+');

