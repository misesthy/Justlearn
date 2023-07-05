<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\KnowledgeController;
use App\Http\Controllers\ApplicationController;

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

Route::get('/', function () {
    return view('welcome');
});


// Route::post('/login', function () {
//     // Votre logique de traitement du formulaire de connexion
// })->middleware('AwsActiveDirectoryAuthMiddleware');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
Route::middleware('auth')->group(function () {
    Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::post('users/store', [UserController::class, 'test'])->name('users.store');
    Route::resource('users', UserController::class);
    // Route::get('users', UserController::class)->name('essai');

    // Route::get('/tickets/{user}', [TicketController::class, 'view'])->name('tickets.view');
    Route::get('tickets/ticket_receive', [TicketController::class, 'receive'])->name('tickets.ticket');
    Route::post('tickets/upload', [TicketController::class, 'upload'])->name('tickets.upload');
    Route::patch('tickets/{ticket}/close', [TicketController::class, 'close'])->name('tickets.close');
    Route::post('tickets/storage', [TicketController::class, 'storage'])->name('tickets.storage');
    Route::patch('tickets/{ticket}/reopen', [TicketController::class, 'reopen'])->name('tickets.reopen');
    Route::patch('tickets/{ticket}/archive', [TicketController::class, 'archive'])->name('tickets.archive');
    Route::post('tickets/{ticketId}/reply', [TicketController::class, 'replyToTicket'])->name('tickets.reply');
    Route::resource('tickets', TicketController::class);

    Route::resource('services', ServiceController::class);

    Route::get('feedbacks/create', [FeedbackController::class, 'create'])->name('feedbacks.create');
    Route::get('feedbacks/index', [FeedbackController::class, 'index'])->name('feedbacks.index');
    Route::get('feedbacks/{id}/show', [FeedbackController::class, 'show'])->name('feedbacks.show');
    Route::post('feedbacks/store', [FeedbackController::class, 'store'])->name('feedbacks.store');
    Route::get('feedbacks/{id}/edit', [FeedbackController::class, 'edit'])->name('feedbacks.edit');
    Route::put('feedbacks/{id}/update', [FeedbackController::class, 'update'])->name('feedbacks.update');
    Route::delete('feedbacks/{id}/destroy', [FeedbackController::class, 'destroy'])->name('feedbacks.destroy');
    Route::resource('feedbacks', FeedbackController::class);

    // Route::get('feedbacks', KnowledgeController::class);

    Route::get('knowledge/create', [KnowledgeController::class, 'create'])->name('knowledge.create');
    Route::get('knowledge/index', [KnowledgeController::class, 'index'])->name('knowledge.index');
    Route::get('knowledge/{id}/show', [KnowledgeController::class, 'show'])->name('knowledge.show');
    Route::post('knowledge/store', [KnowledgeController::class, 'store'])->name('knowledge.store');
    Route::get('knowledge/{id}/edit', [KnowledgeController::class, 'edit'])->name('knowledge.edit');
    Route::put('knowledge/{id}/update', [KnowledgeController::class, 'update'])->name('knowledge.update');
    Route::delete('knowledge/{id}/destroy', [KnowledgeController::class, 'destroy'])->name('knowledge.destroy');

    Route::get('modules', [ModuleController::class, 'index'])->name('module.index');
    Route::get('module/create', [ModuleController::class, 'create'])->name('module.create');
    Route::get('module/{id}/show', [ModuleController::class, 'show'])->name('module.show');
    Route::post('module/store', [ModuleController::class, 'store'])->name('module.store');
    Route::get('module/{id}/edit', [ModuleController::class, 'edit'])->name('module.edit');
    Route::put('module/{id}/update', [ModuleController::class, 'update'])->name('module.update');
    Route::delete('module/{id}/destroy', [ModuleController::class, 'destroy'])->name('module.destroy');

    Route::get('domain/create', [DomainController::class, 'create'])->name('domain.create');
    Route::post('domain/store', [DomainController::class, 'store'])->name('domain.store');
    Route::get('domain/{id}/edit', [DomainController::class, 'edit'])->name('domain.edit');
    Route::put('domain/{id}/update', [DomainController::class, 'update'])->name('domain.update');
    Route::delete('domain/{id}/destroy', [DomainController::class, 'destroy'])->name('domain.destroy');
    Route::get('domain/{id}/show', [DomainController::class, 'show'])->name('domain.show');
    Route::get('domains', [DomainController::class, 'index'])->name('domain.index');

    Route::get('application/create', [ApplicationController::class, 'create'])->name('application.create');
    Route::post('application/store', [ApplicationController::class, 'store'])->name('application.store');
    Route::get('application/{id}/edit', [ApplicationController::class, 'edit'])->name('application.edit');
    Route::put('application/{id}/update', [ApplicationController::class, 'update'])->name('application.update');
    Route::delete('application/{id}/destroy', [ApplicationController::class, 'destroy'])->name('application.destroy');
    Route::get('application/{id}/show', [ApplicationController::class, 'show'])->name('application.show');
    Route::get('applications', [ApplicationController::class, 'index'])->name('application.index');


    Route::middleware('role:admin')->group(function () {
        Route::resource('user', UserController::class)->except('show');
        
        

        

    });

});