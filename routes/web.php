<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\{
    CompanyController,
    LocationController,
    BranchController,
    ClientController,
};

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

    /**
     * Routes for Client area
     */
    Route::any('client/search', [ClientController::class, 'search'])->name('client.search');
    Route::resource('client', ClientController::class);

    /**
     * Routes for Branch area
     */
    Route::any('branch/search', [BranchController::class, 'search'])->name('branch.search');
    Route::resource('branch', BranchController::class);
    /**
     * Routes for Location area
     */
    Route::any('location/search', [LocationController::class, 'search'])->name('location.search');
    Route::resource('location', LocationController::class);

    /**
     * Routes for Company area
     */
    Route::any('company/search', [CompanyController::class, 'search'])->name('company.search');
    Route::resource('company', CompanyController::class);

    Route::get('/', function () {
        return view('welcome');
    })->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
