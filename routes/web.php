<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

// ROTAS PÚBLICAS (Acessíveis sem login)
Route::get('/', [LoginController::class, 'mostrarLogin'])->name('login');
Route::post('/login-post', [LoginController::class, 'logar'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ROTAS PROTEGIDAS (Só entra quem estiver autenticado)
Route::middleware(['auth'])->group(function () {

    // Painel Geral (Aponta para a sua view de relatórios)
    Route::get('/relatorios', function () {
        return view('relatorios');
    })->name('relatorios.index');

    // Gestão de Empresas
    Route::get('/empresas', function () {
        return view('empresas');
    })->name('companies.index');

    Route::get('/empresas/novo', function () {
        return view('form-empresa');
    })->name('companies.create');

    Route::get('/empresas/editar/{id}', function ($id) {
        return view('form-empresa', ['id' => $id]);
    })->name('companies.edit');

    // Gestão de Alunos
    Route::get('/alunos', function() {
        return view('alunos');
    })->name('students.index');

    Route::get('/alunos/novo', function () {
        return view('form-aluno');
    })->name('students.create');

    Route::get('/alunos/editar/{id}', function ($id) {
        return view('form-aluno', ['id' => $id]);
    })->name('students.edit');

    // Gestão de Vínculos (Estágios)
    Route::get('/vinculos', function() {
        return view('vinculos');
    })->name('vinculos.index');

    Route::get('/vinculos/novo', function () {
        return view('form-vinculo');
    })->name('vinculos.create');

    Route::get('/vinculos/editar/{id}', function ($id) {
        return view('form-vinculo', ['id'=> $id]);
    })->name('vinculos.edit');

    // Rota padrão de dashboard caso o Laravel busque por ela
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

// Mantém as configurações originais do seu projeto
require __DIR__.'/settings.php';