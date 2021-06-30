<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/csv-to-vcf', [\App\Http\Controllers\ConvertController::class, 'csvToVcfIndex'])->name('csv-to-vcf.index');
Route::post('/csv-to-vcf-convert', [\App\Http\Controllers\ConvertController::class, 'csvToVcfConvert'])->name('csv-to-vcf.convert');

Route::get('/mails-to-excel', [\App\Http\Controllers\ConvertController::class, 'mailsToExcelIndex'])->name('mails-to-excel.index');
Route::post('/mails-to-excel-convert', [\App\Http\Controllers\ConvertController::class, 'mailsToExcelConvert'])->name('mails-to-excel.convert');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home.index');

Auth::routes();


