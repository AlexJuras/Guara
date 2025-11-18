<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ContaController;

Route::inertia('/sobre', 'Sobre'); //Primeiro a url e depois o nome do componente
// Route::inertia('/', 'Home')->name('home'); //Primeiro a url e depois o nome do componente
Route::inertia('/clientes', 'Clientes/Index')->name('clientes'); //Primeiro a url e depois o nome do componente

// Rotas de Contas - CRUD completo
Route::get('/contas', [ContaController::class, 'index'])->name('contas.index'); // Listar todas as contas
Route::get('/contas/create', [ContaController::class, 'create'])->name('contas.create'); // Formulário para criar nova conta
Route::post('/contas', [ContaController::class, 'store'])->name('contas.store'); // Salvar nova conta
Route::get('/contas/{conta}', [ContaController::class, 'show'])->name('contas.show'); // Ver detalhes de uma conta
Route::get('/contas/{conta}/edit', [ContaController::class, 'edit'])->name('contas.edit'); // Formulário para editar conta
Route::put('/contas/{conta}', [ContaController::class, 'update'])->name('contas.update'); // Atualizar conta existente
Route::delete('/contas/{conta}', [ContaController::class, 'destroy'])->name('contas.destroy'); // Excluir conta

// Route::get('/', function () {
//     return Inertia::render('Home');
// })->name('home');