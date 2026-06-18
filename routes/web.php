<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::get('/empresas', function () {
    return view('empresas');
})->name('companies.index');

Route::get('/alunos', function() {
    return view('alunos');
})->name('students.index');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
