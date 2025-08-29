<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::inertia('/sobre', 'Sobre'); //Primeiro a url e depois o nome do componente
Route::inertia('/', 'Home'); //Primeiro a url e depois o nome do componente