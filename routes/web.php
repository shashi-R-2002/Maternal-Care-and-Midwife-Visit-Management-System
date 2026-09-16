<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MotherController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MidwifeController;
use App\Http\Controllers\VisitController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\HealthRecordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ================= HOME =================

Route::get('/', function () {
    return view('home');
})->name('home');

// ================= AUTH =================

Route::post('/register', [AuthController::class, 'register'])
    ->name('midwife.register');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

// ================= MIDWIFE =================

Route::prefix('midwife')->group(function () {

    // Dashboard
   Route::get('/dashboard', [MidwifeController::class, 'dashboard'])
    ->name('midwife.dashboard');

   

    // Mother CRUD
    Route::get('/mothers', [MotherController::class, 'index'])
        ->name('mothers.index');

    Route::get('/add-mother', [MotherController::class, 'create'])
        ->name('mothers.create');

    Route::post('/add-mother', [MotherController::class, 'store'])
        ->name('mothers.store');

    Route::get('/mothers/{mother}', [MotherController::class, 'show'])
        ->name('mothers.show');

        // Edit Mother
Route::get('/mothers/{mother}/edit', [MotherController::class, 'edit'])
    ->name('mothers.edit');

Route::put('/mothers/{mother}', [MotherController::class, 'update'])
    ->name('mothers.update');

    // Visits
    Route::get('/visits', [VisitController::class, 'index'])
    ->name('midwife.visits');

Route::post('/visits', [VisitController::class, 'store'])
    ->name('visits.store');

    Route::get('/visits/{visit}/edit', [VisitController::class, 'edit'])
    ->name('visits.edit');

Route::put('/visits/{visit}', [VisitController::class, 'update'])
    ->name('visits.update');

Route::delete('/visits/{visit}', [VisitController::class, 'destroy'])
    ->name('visits.destroy');
   

    // Medicines
    
    Route::get('/medicines', [MedicineController::class, 'index'])
    ->name('midwife.medicines');

Route::post('/medicines', [MedicineController::class, 'store'])
    ->name('medicines.store');

Route::delete('/medicines/{medicine}', [MedicineController::class, 'destroy'])
    ->name('medicines.destroy');

    // Health Records
Route::get('/health-record', [HealthRecordController::class, 'index'])
    ->name('midwife.health-record');

Route::post('/health-record', [HealthRecordController::class, 'store'])
    ->name('health-record.store');

Route::delete('/health-record/{healthRecord}', [HealthRecordController::class, 'destroy'])
    ->name('health-record.destroy');

    

    // Reports
    Route::get('/reports', function () {
        return view('midwife.health-report');
    })->name('midwife.reports');

});


// ================= ADMIN =================

Route::prefix('admin')->group(function () {

   Route::get('/dashboard', [AdminController::class, 'dashboard'])
    ->name('admin.dashboard');

    Route::get('/mothers', function () {
        return view('admin.mothers');
    })->name('admin.mothers');

    Route::get('/midwives', [AdminController::class, 'midwives'])
    ->name('admin.midwives');

    Route::get('/reports', function () {
        return view('admin.reports');
    })->name('admin.reports');

    Route::post('/midwives/{midwife}/approve', [AdminController::class, 'approve'])
    ->name('admin.midwives.approve');

Route::post('/midwives/{midwife}/reject', [AdminController::class, 'reject'])
    ->name('admin.midwives.reject');

  
});


// ================= MOTHER =================

Route::prefix('mother')->group(function () {

    Route::get('/dashboard', [MotherController::class, 'dashboard'])
        ->name('mother.dashboard');

});
