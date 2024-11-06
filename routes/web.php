<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Livewire\Home::class);
Route::get('/detalle/{almacen}', \App\Livewire\Detail::class);
Route::get('/voluntarios', \App\Livewire\Voluntarios::class);
Route::get('/test', \App\Livewire\Test::class);
