<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\AccountController;
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
    ->name('index');

Route::get('/journals', [JournalController::class, 'view_journals'])
    ->name('journals');

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


Route::get('/general_ledger',[AccountController::class, 'view_ledger'])
    ->name('general_ledger');

Route::post('/general_ledger/show',[JournalController::class, 'ledger_show'])
    ->name('general_ledger.show');


Route::get('/balance_sheet',[JournalController::class, 'BS_show'])
    ->name('balance_sheet');


Route::get('/income_statement',[JournalController::class, 'PL_show'])
    ->name('income_statement');


Route::get('/accounts', [AccountController::class, 'view_accounts'])
    ->name('accounts');

Route::post('/accounts/create', [AccountController::class, 'create'])
    ->name('accounts.create');

Route::get('/accounts/{account}/edit', [AccountController::class, 'edit'])
    ->name('accounts.edit')
    ->where('account', '[0-9]+');

Route::patch('/accounts/{account}/update', [AccountController::class, 'update'])
    ->name('accounts.update')
    ->where('account', '[0-9]+');

Route::delete('/accounts/{account}/destroy', [AccountController::class, 'destroy'])
    ->name(('accounts.destroy'))
    ->where('account', '[0-9]+');
