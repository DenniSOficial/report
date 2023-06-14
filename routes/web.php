<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\NormController;
use App\Http\Controllers\CommitmentController;
use App\Http\Controllers\ReportManagerController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ReportController;

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
    return view('admin.auth.login');
});

Route::get('/tables', function () {
    Artisan::call('migrate:fresh --seed');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');

    Route::get('/admin/changue-password', [AdminController::class, 'AdminChangePassword'])->name('admin.change-password');
    Route::post('/admin/update/password', [AdminController::class, 'AdminUpdatePassword'])->name('admin.update.password');

    Route::post('/find-cotizacion-ajax', [AdminController::class, 'findCotizacionAjax'])->name('admin.find.cotizacion.ajax');
    Route::post('/find-cliente-ajax', [AdminController::class, 'findClienteAjax'])->name('admin.find.cliente.ajax');
    
    // ROUTES MAINTENANCE
    Route::controller(ClientController::class)->group(function() {
        
        Route::get('/all/client', 'AllClient')->name('all.client');
        Route::get('/add/client', 'AddClient')->name('add.client');
        Route::post('/store/client', 'StoreClient')->name('store.client');
        Route::get('/edit/client/{id}', 'EditClient')->name('edit.client');
        Route::post('/update/client', 'UpdateClient')->name('update.client');
        Route::get('/delete/client/{id}', 'DeleteClient')->name('delete.client');
        Route::get('/enable-user/client/{id}', 'EnableUserClient')->name('enable-user.client');
        Route::get('/disable-user/client/{id}', 'DisableUserClient')->name('disable-user.client');

    });

    Route::controller(ReportManagerController::class)->group(function() {
        
        Route::get('/all/report-manager', 'AllReportManager')->name('all.report-manager');
        Route::get('/add/report-manager', 'AddReportManager')->name('add.report-manager');
        Route::post('/store/report-manager', 'StoreReportManager')->name('store.report-manager');
        Route::get('/edit/report-manager/{id}', 'EditReportManager')->name('edit.report-manager');
        Route::post('/update/report-manager', 'UpdateReportManager')->name('update.report-manager');
        Route::get('/delete/report-manager/{id}', 'DeleteReportManager')->name('delete.report-manager');
        Route::post('/import/report-manager', 'ImportReportManager')->name('import.report-manager');

    });

    Route::controller(NormController::class)->group(function() {
        
        Route::get('/all/norm', 'AllNorm')->name('all.norm');
        Route::get('/add/norm', 'AddNorm')->name('add.norm');
        Route::post('/store/norm', 'StoreNorm')->name('store.norm');
        Route::get('/edit/norm/{id}', 'EditNorm')->name('edit.norm');
        Route::post('/update/norm', 'UpdateNorm')->name('update.norm');
        Route::get('/delete/norm/{id}', 'DeleteNorm')->name('delete.norm');
        Route::post('/import/norm', 'ImportNorm')->name('import.norm');

    });

    Route::controller(CommitmentController::class)->group(function() {

        Route::get('/all/commitment', 'AllCommitment')->name('all.commitment');
        Route::get('/add/commitment', 'AddCommitment')->name('add.commitment');
        Route::post('/store/commitment', 'StoreCommitment')->name('store.commitment');
        Route::get('/edit/commitment/{id}', 'EditCommitment')->name('edit.commitment');
        Route::post('/update/commitment', 'UpdateCommitment')->name('update.commitment');
        Route::get('/delete/commitment/{id}', 'DeleteCommitment')->name('delete.commitment');
        Route::post('/import/commitment', 'ImportCommitment')->name('import.commitment');

    });

    // ROUTER REPORTS
    Route::controller(ReportController::class)->group(function() {

        Route::get('/all/report', 'AllReport')->name('all.report');
        Route::get('/add/report', 'AddReport')->name('add.report');
        Route::post('/store/report', 'StoreReport')->name('store.report');
        Route::get('/edit/report/{id}', 'EditReport')->name('edit.report');
        Route::post('/update/report', 'UpdateReport')->name('update.report');
        Route::get('/delete/report/{id}', 'DeleteReport')->name('delete.report');
        Route::post('/import/report', 'ImportReport')->name('import.report');

        Route::get('/report/{id}/commitments','CommitmentsReport')->name('commitments.report');

        Route::get('/report/{report}/commitments/upload', 'UploadDocument')->name('upload.report');
        Route::post('/report/{report}/commitments/uploadFiles', 'StoreuploadDocument')->name('store.upload.report');

        Route::get('/report/{document}/add-comment', 'AddComment')->name('add-comment.report');
        Route::post('/report/{document}/add-comment', 'StoreAddComment')->name('store.add-comment.report');

        Route::get('/report/{document}/tracking', 'TrackingComment')->name('trancking.document');

        Route::get('/report/{document}/close-comment', 'CloseComment')->name('close-comment.document');
    });

    //ROUTES ADMINISTRATION
    Route::controller(AdminController::class)->group(function() {
        
        Route::get('/all/user', 'AllUser')->name('all.user');
        Route::get('/add/user', 'AddUser')->name('add.user');
        Route::post('/store/user', 'StoreUser')->name('store.user');
        Route::get('/edit/user/{id}', 'EditUser')->name('edit.user');
        Route::post('/update/user', 'UpdateUser')->name('update.user');
        Route::get('/delete/user/{id}', 'DeleteUser')->name('delete.user');
        Route::post('/import/user', 'ImportUser')->name('import.user');

    });
});

require __DIR__.'/auth.php';
