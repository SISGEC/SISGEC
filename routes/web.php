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

Route::get('/', 'HomeController@index')->name('home');

Route::get('/dashboard', function() {
    return view("doctor.desktop");
})->name("dashboard");

Route::get('/patients', function() {
    return view("doctor.patients");
})->name('patients');

Route::get('/patients/new', function() {
    return view("doctor.patients_new");
})->name('patients.new');

Route::get('/medical-appointments', function() {
    return "Citas";
})->name('medical_appointments');

Route::get('/medical-appointments/new', function() {
    return "Nueva Cita";
})->name('medical_appointments.new');