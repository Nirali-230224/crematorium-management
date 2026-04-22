<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeceasedController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::get('/deceased/index', [DeceasedController::class, 'index'])->name('deceased.index');
    Route::get('/deceased/add', [DeceasedController::class, 'add'])->name('deceased.add');
    Route::post('/deceased/store', [DeceasedController::class, 'store'])->name('deceased.store');
    Route::get('/deceased/edit/{id}', [DeceasedController::class, 'edit'])->name('deceased.edit');
    Route::post('/deceased/update/{id}', [DeceasedController::class, 'update'])->name('deceased.update');
    Route::post('/deceased/delete/{id}', [DeceasedController::class, 'delete'])->name('deceased.delete');

    Route::get('/donation/index', [DonationController::class, 'index'])->name('donation.index');
    Route::get('/donation/add', [DonationController::class, 'add'])->name('donation.add');
    Route::post('/donation/store', [DonationController::class, 'store'])->name('donation.store');
    Route::get('/donation/edit/{id}', [DonationController::class, 'edit'])->name('donation.edit');
    Route::post('/donation/update/{id}', [DonationController::class, 'update'])->name('donation.update');
    Route::post('/donation/delete/{id}', [DonationController::class, 'edit'])->name('donation.delete');
    Route::get('/donation/receipt/{id}', [DonationController::class, 'receipt'])->name('donation.receipt');

    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/add-users', [UserController::class, 'addusers'])->name('users.add');
        Route::post('/user/submit', [UserController::class, 'submitusers'])->name('user.submit');
        Route::post('/users/delete', [UserController::class, 'delete']);

        Route::get('/deceased/report', [ReportController::class, 'deceasedReport'])->name('deceased.report');
        Route::get('/deceased/report/excel', [ReportController::class, 'deceasedExcel'])->name('deceased.excel');
        Route::get('/deceased/report/pdf', [ReportController::class, 'deceasedPDF'])->name('deceased.pdf');
        Route::get('/donation/report', [ReportController::class, 'donationReport'])->name('donation.report');
        Route::get('/donation/report/excel', [ReportController::class, 'donationExcel'])->name('donation.excel');
        Route::get('/donation/report/pdf', [ReportController::class, 'donationPDF'])->name('donation.pdf');
    });
});
//Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
