<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\AboutController;
use App\Http\Controllers\GoalsController;
use App\Http\Controllers\HabitsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ToDoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Auth
Auth::routes(['verify' => true]);

// Root route, controls whether or not user gets sent to about or home
Route::get('/', [HomeController::class, 'index'])->name('root');

// Main about page
Route::get('about', [AboutController::class, 'index'])->name('about');

// Home route
Route::get('home', [HomeController::class, 'home'])->middleware('auth')->middleware('verified')->name('home');

// Goals
Route::prefix('goals')->group(function(){
    // Root
    Route::get('/', [ProfileController::class, 'index'])->name('goals');
});

// Habits
Route::prefix('habits')->group(function(){
    // Root
    Route::get('/', [ProfileController::class, 'index'])->name('habits');
});

// Journal
Route::prefix('journal')->group(function(){
    // Root
    Route::get('/', [ProfileController::class, 'index'])->name('journal');
});


// Profile
Route::prefix('profile')->group(function(){
    // Root
    Route::get('/', [ProfileController::class, 'index'])->name('profile');

    // Edit routes
    Route::prefix('edit')->group(function(){
        // Show edit settings page
        Route::get('settings', [ProfileController::class, 'editSettings'])->name('profile.edit.settings');

        // Show edit name page
        Route::get('name', [ProfileController::class, 'editName'])->name('profile.edit.name');

        // Show edit nutshell page
        Route::get('nutshell', [ProfileController::class, 'editNutshell'])->name('profile.edit.nutshell');

        // Show edit values page
        Route::get('values', [ProfileController::class, 'editValues'])->name('profile.edit.values');

        // Show manage memebership page
        Route::get('membership', [ProfileController::class, 'editMembership'])->name('profile.edit.membership');
    });

    // Update routes
    Route::prefix('update')->group(function(){
        // Update settings route
        Route::post('settings/{id}', [ProfileController::class, 'updateSettings'])->name('profile.update.settings');

        // Update routes for profile-picture, name, values, nutshell
    });

    // Delete route
    Route::prefix('delete')->group(function(){
        Route::post('value', [ProfileController::class, 'deleteValue'])->name('profile.delete.value');
    });
});

// To-Do routes
Route::prefix('todo')->group(function(){
    // Root
    Route::get('/', [ToDoController::class, 'index'])->name('todo.list');

    // Show the create to do item form
    Route::get('create', [ToDoController::class, 'create'])->name('todo.create');

    // Submit the create to do item form
    Route::post('store', [ToDoController::class, 'store'])->name('todo.store');

    // Show the edit to do item form
    Route::get('edit/{todo}', [ToDoController::class, 'edit'])->name('todo.edit');

    // Submit the edit to do item form
    Route::post('update/{todo}', [ToDoController::class, 'update'])->name('todo.update');

    // Delete a to do item
    Route::post('destroy/{todo}', [ToDoController::class, 'destroy'])->name('todo.destroy');

    // Toggle a to do item's completed status
    Route::post('toggle-completed/{todo}', [ToDoController::class, 'toggleCompleted'])->name('todo.toggle-completed');
});