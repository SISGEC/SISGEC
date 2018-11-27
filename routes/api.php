<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/fragments/{fragment}/list', function(Request $request, $fragment=false) {
    $query = $request->query('query', 'all');
    $resp = [
        'query' => $query,
        'suggestions' => []
    ];
    switch ($fragment) {
        case 'scholarships':
            $resp['suggestions'] = search_in_array($query, __("scholarships"));
            break;
        case 'occupations':
            $resp['suggestions'] = search_in_array($query, __("occupations"));
            break;
        case 'religions':
            $resp['suggestions'] = search_in_array($query, __("religions"));
            break;
        case 'civil-status':
            $resp['suggestions'] = search_in_array($query, __("civil_status"));
    }
    return response()->json($resp);
});