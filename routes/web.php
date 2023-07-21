<?php

use App\Http\Controllers\ListAnggotaController;
use App\Http\Controllers\MonitoringController;
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
    return view('home');
});
Route::get('list-anggota',[ListAnggotaController::class,'index'])->name('anggota.index');
Route::post('/import/excel', [ListAnggotaController::class, 'importExcel'])->name('import.excel');
Route::put('anggota/status/{status}',[ListAnggotaController::class,'update_status'])->name('update.status');
Route::get('monitoring/index',[MonitoringController::class,'index'])->name('monitoring.index');
Route::post('monitoring/select-majelis',[MonitoringController::class,'select_majelis'])->name('monitoring.majelis');
Route::post('monitoring/select-anggota',[MonitoringController::class,'select_anggota'])->name('monitoring.anggota');
Route::post('monitoring/store',[MonitoringController::class,'store'])->name('monitoring.store');
Route::get('monitoring/{monitoring}/edit_foto',[MonitoringController::class,'edit'])->name('monitoring.edit_foto');
Route::put('monitoring/update_foto/{monitoring}',[MonitoringController::class,'update_dokumentasi'])->name('monitoring.update_dokumentasi');
Route::get('/export', [MonitoringController::class,'exportData'])->name('export');
