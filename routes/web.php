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
    Route::post('/options/save', 'HomeController@options')->name('options.save');

    Route::prefix('settings')->group(function() {
        Route::get('/', 'DoctorController@settings')->name('doctor.settings');
        Route::post('/update', 'DoctorController@update')->name('doctor.update');
    });

    Route::get('/patients','PatientController@index')->name('patients');
    Route::get('/patients/new', 'PatientController@create')->name('patients.new');
    Route::get('/patients/edit/{id}', 'PatientController@edit')->name('patients.edit');
    Route::post('/patients/save', 'PatientController@store')->name('patients.save');
    Route::post('/patients/update', 'PatientController@update')->name('patients.update');
    Route::get('/patient/{id}', 'PatientController@show')->name('patient');
    Route::get('/patient/delete/{id}', 'PatientController@destroy')->name('patient.remove');

    Route::get('/patient/{id}/download', 'PatientController@download')->name('patient.download');

    Route::get('/assistants','AssistantController@index')->name('assistants');
    Route::get('/assistants/new', 'AssistantController@create')->name('assistants.new');
    Route::get('/assistants/edit/{id}', 'AssistantController@edit')->name('assistants.edit');
    Route::post('/assistants/save', 'AssistantController@store')->name('assistants.save');
    Route::post('/assistants/update', 'AssistantController@update')->name('assistants.update');
    Route::get('/assistant/{id}', 'AssistantController@show')->name('assistant');
    Route::get('/assistant/delete/{id}', 'AssistantController@destroy')->name('assistant.remove');

    Route::get('/medical-appointment/{id}', 'MedicalAppointmentController@show')->name('medical_appointment');
    Route::get('/medical-appointments', 'MedicalAppointmentController@index')->name('medical_appointments');
    Route::post('/medical-appointments/save', 'MedicalAppointmentController@store')->name('medical_appointments.save');
    Route::post('/medical-appointments/update', 'MedicalAppointmentController@update')->name('medical_appointments.update');
    Route::get('/medical-appointment/{id}/remove', 'MedicalAppointmentController@destroy')->name('medical_appointments.remove');

    Route::get('/evolution-note/new/{id?}', 'TracingController@create')->name('evolution_note.new');
    Route::post('/evolution-note/save', 'TracingController@store')->name('evolution_note.save');
    Route::get('/evolution-note/edit/{id}', 'TracingController@edit')->name('evolution_note.edit');
    Route::post('/evolution-note/update', 'TracingController@update')->name('evolution_note.update');
    Route::get('/evolution-note/remove/{id}', 'TracingController@destroy')->name('evolution_note.remove');
    Route::get('/evolution-note/{id}', 'TracingController@show')->name('evolution_note');

    Route::get('/evolution-note/{id}/download', 'TracingController@download')->name('evolution_note.download');

    Route::get('/attachments', 'StudiesController@create');
    Route::post('/attachments/save', 'StudiesController@store');
    Route::get('/attachments/delete/{id}', 'StudiesController@destroy');
    Route::get('/attachments/download/{filename}', 'StudiesController@download');

    Route::get('/prescription/new', 'PrescriptionController@create')->name('prescription.new');
    Route::post('/prescription/save', 'PrescriptionController@store')->name('prescription.save');
    Route::get('/prescription/edit/{id}', 'PrescriptionController@edit')->name('prescription.edit');
    Route::post('/prescription/update', 'PrescriptionController@update')->name('prescription.update');
    Route::get('/prescription/{id}', 'PrescriptionController@index')->name('prescription');
    Route::get('/prescription/remove/{id}', 'PrescriptionController@destroy')->name('prescription.remove');

    Route::get('/prescription/{id}/download', 'PrescriptionController@download')->name('prescription.download');

    Route::prefix('statistics')->group(function() {
        Route::get("/patients/{metric?}/{lapse?}", 'PatientController@statistics')->name('statistics.patients');
        Route::get("/appointments/{metric?}/{lapse?}", 'MedicalAppointmentController@statistics')->name('statistics.appointments');
        Route::get("/monthly_statistics/{lapse}", 'HomeController@monthly_statistics')->name("statistics.monthly_statistics");
    });
});

Route::get('/attachments/show/{filename}', 'StudiesController@show');
Route::get('/medical-appointments.json', 'MedicalAppointmentController@json')->name('medical_appointments.json');

/**
 * Test Routes
 **/

Route::get('/test', function() {
    return response("Ok", 200);
});