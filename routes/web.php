<?php

use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrashNoteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('/notes', NoteController::class)->middleware(['auth', 'verified']);

// Route::get('/trashed', [TrashNoteController::class,'index'])->middleware(['auth', 'verified'])->name('trashed.index');
// Route::get('/trashed/{note}', [TrashNoteController::class,'show'])->withTrashed()->middleware(['auth', 'verified'])->name('trashed.show');
// Route::put('/trashed/{note}', [TrashNoteController::class,'update'])->withTrashed()->middleware(['auth', 'verified'])->name('trashed.update');
// Route::delete('/trashed/{note}', [TrashNoteController::class,'destroy'])->withTrashed()->middleware(['auth', 'verified'])->name('trashed.destroy');

Route::prefix('/trashed')->name('trashed.')->middleware(['auth', 'verified'])->group(function(){
    Route::get('/', [TrashNoteController::class,'index'])->name('index');
    Route::get('/{note}', [TrashNoteController::class,'show'])->name('show')->withTrashed();
    Route::put('/{note}', [TrashNoteController::class,'update'])->name('update')->withTrashed();
    Route::delete('/{note}', [TrashNoteController::class,'destroy'])->name('destroy')->withTrashed();
});


require __DIR__.'/auth.php';
