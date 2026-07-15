<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiagnosisController;

// Dashboard / Landing Page Utama
Route::get('/', [DiagnosisController::class, 'dashboard'])->name('dashboard');

// Jalur 1: Diagnosis melalui Kamera AI (CNN)
Route::get('/diagnose/ai', [DiagnosisController::class, 'aiForm'])->name('diagnose.ai');
Route::post('/diagnose/ai', [DiagnosisController::class, 'storeAi'])->name('diagnose.store_ai');

// Jalur 2: Diagnosis melalui Tanya Jawab (Sistem Pakar)
Route::get('/diagnose/expert', [DiagnosisController::class, 'expertForm'])->name('diagnose.expert');
Route::post('/diagnose/expert', [DiagnosisController::class, 'storeExpert'])->name('diagnose.store_expert');

// Detail Diagnosis dan Resep Pemulihan Hara
Route::get('/diagnose/{id}', [DiagnosisController::class, 'show'])->name('diagnose.show');
Route::delete('/diagnose/{id}', [DiagnosisController::class, 'destroy'])->name('diagnose.destroy');

// Riwayat Diagnosis
Route::get('/diagnoses', [DiagnosisController::class, 'history'])->name('diagnose.history');

// Katalog Penyakit & Matriks Pemupukan
Route::get('/diseases', [DiagnosisController::class, 'catalog'])->name('diseases.catalog');
