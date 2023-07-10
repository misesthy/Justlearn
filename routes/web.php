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
    // Route::post('tickets/{id}/reply', [TicketController::class, 'replyToTicket'])->name('tickets.reply');
    Route::resource('tickets', TicketController::class);

    Route::resource('services', ServiceController::class);

    Route::post('/tickets/{id}/reply', 'TicketController@replyToTicket')->name('tickets.reply');
    // Route::post('feedbacks/{ticketId}/reply', [TicketController::class, 'replyToTicket'])->name('tickets.replyToTicket');
    Route::get('feedbacks/{id}/create', [FeedbackController::class, 'create'])->name('feedbacks.create');
    Route::get('feedbacks/index', [FeedbackController::class, 'index'])->name('feedbacks.index');
    Route::get('feedbacks/{id}/show', [FeedbackController::class, 'show'])->name('feedbacks.show');
    Route::post('feedbacks/{id}/store', [FeedbackController::class, 'store'])->name('feedbacks.store');
    Route::get('feedbacks/{id}/edit', [FeedbackController::class, 'edit'])->name('feedbacks.edit');
    Route::put('feedbacks/{id}/update', [FeedbackController::class, 'update'])->name('feedbacks.update');
    Route::delete('feedbacks/{id}/destroy', [FeedbackController::class, 'destroy'])->name('feedbacks.destroy');
    // Route::resource('feedbacks', FeedbackController::class);

    // Route::get('feedbacks', KnowledgeController::class);

    Route::get('knowledge/create', [KnowledgeController::class, 'create'])->name('knowledges.create');
    Route::get('knowledge/index', [KnowledgeController::class, 'index'])->name('knowledges.index');
    Route::get('knowledge/{id}/show', [KnowledgeController::class, 'show'])->name('knowledges.show');
    Route::post('knowledge/store', [KnowledgeController::class, 'store'])->name('knowledges.store');
    Route::get('knowledge/{id}/edit', [KnowledgeController::class, 'edit'])->name('knowledges.edit');
    Route::put('knowledge/{id}/update', [KnowledgeController::class, 'update'])->name('knowledges.update');
    Route::delete('knowledge/{id}/destroy', [KnowledgeController::class, 'destroy'])->name('knowledges.destroy');

    Route::get('modules', [ModuleController::class, 'index'])->name('modules.index');
    Route::get('module/create', [ModuleController::class, 'create'])->name('modules.create');
    Route::get('module/{id}/show', [ModuleController::class, 'show'])->name('modules.show');
    Route::post('module/store', [ModuleController::class, 'store'])->name('modules.store');
    Route::get('module/{id}/edit', [ModuleController::class, 'edit'])->name('modules.edit');
    Route::put('module/{id}/update', [ModuleController::class, 'update'])->name('modules.update');
    Route::delete('module/{id}/destroy', [ModuleController::class, 'destroy'])->name('modules.destroy');

    Route::get('domain/create', [DomainController::class, 'create'])->name('domains.create');
    Route::post('domain/store', [DomainController::class, 'store'])->name('domains.store');
    Route::get('domain/{id}/edit', [DomainController::class, 'edit'])->name('domains.edit');
    Route::put('domain/{id}/update', [DomainController::class, 'update'])->name('domains.update');
    Route::delete('domain/{id}/destroy', [DomainController::class, 'destroy'])->name('domains.destroy');
    Route::get('domain/{id}/show', [DomainController::class, 'show'])->name('domains.show');
    Route::get('domains', [DomainController::class, 'index'])->name('domains.index');

    Route::get('application/create', [ApplicationController::class, 'create'])->name('applications.create');
    Route::post('application/store', [ApplicationController::class, 'store'])->name('applications.store');
    Route::get('application/{id}/edit', [ApplicationController::class, 'edit'])->name('applications.edit');
    Route::put('application/{id}/update', [ApplicationController::class, 'update'])->name('applications.update');
    Route::delete('application/{id}/destroy', [ApplicationController::class, 'destroy'])->name('applications.destroy');
    Route::get('application/{id}/show', [ApplicationController::class, 'show'])->name('applications.show');
    Route::get('applications', [ApplicationController::class, 'index'])->name('applications.index');


    Route::middleware('role:admin')->group(function () {
        Route::resource('user', UserController::class)->except('show');
        
        

        

    });

});