<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::get('/empresas', function () {
    return view('empresas');
})->name('companies.index');

Route::get('/alunos', function() {
    return view('alunos');
})->name('students.index');

Route::get('/vinculos', function() {
    return view('vinculos');
})->name('vinculos.index');

Route::get('/vinculos/novo', function () {
    return view('form-vinculo');
});

Route::get('/vinculos/editar/{id}', function ($id) {
    return view('form-vinculo', ['id'=> $id]);
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
