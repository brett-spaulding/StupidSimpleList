<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoListController;

Route::get('/', [TodoListController::class, 'index']);

Route::post('/saveItem',[TodoListController::class, 'saveItem'])->name('saveItem');

Route::post('/toggleCompleted/{id}',[TodoListController::class, 'toggleCompleted'])->name('toggleCompleted');

Route::post('/deleteItem/{id}',[TodoListController::class, 'deleteItem'])->name('deleteItem');

Route::post('/removeCompleted', [TodoListController::class, 'removeCompleted'])->name('removeCompleted');
