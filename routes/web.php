<?php

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

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/', 'HomeController@index')->name("dashboard");

    Route::get('/patients','PatientController@index')->name('patients');

    Route::get('/patients/new', 'PatientController@create')->name('patients.new');

    Route::get('/patients/edit/{id}', 'PatientController@edit')->name('patients.edit');
    
    Route::post('/patients/save', 'PatientController@store')->name('patients.save');

    Route::get('/patient/{id}', 'PatientController@show')->name('patient');

    Route::get('/medical-appointments', function() {
        return view("doctor.medical_appointments");
    })->name('medical_appointments');

    Route::get('/medical-appointments/new', function() {
        //return view("doctor.medical_appointments_new");
    })->name('medical_appointments.new');

    Route::get('/evolution-note/new', function() {
        return view("doctor.new_evolution_note");
    })->name('evolution_note.new');

    Route::post('/evolution-note/new', function() {
        return view("doctor.new_evolution_note");
    })->name('evolution_note.save');

    Route::get('/attachments', 'StudiesController@create');
    Route::post('/attachments/save', 'StudiesController@store');
    Route::post('/attachments/delete', 'StudiesController@destroy');
    Route::get('/attachments/show/{filename}', 'StudiesController@show');
    Route::get('/attachments/download/{filename}', 'StudiesController@index');

    Route::get('/prescription/new', 'PrescriptionController@create');
});

