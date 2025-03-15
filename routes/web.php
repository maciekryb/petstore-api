<?php

use App\Http\Controllers\PetController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/pets');
});

//Main page
Route::get('/pets', [PetController::class, 'index'])->name('pets.index');
//Form to add new pet
Route::get('/pets/create', [PetController::class, 'create'])->name('pets.create');
//Form to save new pet
Route::post('/pets', [PetController::class, 'store'])->name('pets.store');
//Form to get pet by id
Route::get('/pets/{id}', [PetController::class, 'show'])->name('pets.show');
//Form to edit pet by id
Route::get('/pets/{id}/edit', [PetController::class, 'edit']);
//Form to update pet by id
Route::put('/pets/{id}', [PetController::class, 'update']);
//Form to delete pet by id
Route::delete('/pets/{id}', [PetController::class, 'destroy']);
//Clear session
Route::post('/pets/clear-session', [PetController::class, 'clearSession'])->name('pets.clearSession');
