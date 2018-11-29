<?php

use App\Patient;
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
            $resp['suggestions'] = filter_array_by($query, __("scholarships"));
            break;
        case 'occupations':
            $resp['suggestions'] = filter_array_by($query, __("occupations"));
            break;
        case 'religions':
            $resp['suggestions'] = filter_array_by($query, __("religions"));
            break;
        case 'civil-status':
            $resp['suggestions'] = filter_array_by($query, __("civil_status"));
    }
    return response()->json($resp);
});

Route::get('/fragments/study/{id}/template', function(Request $request, $id) {
    $template = '<div class="col-12 col-sm-3">
                    <div class="bd bgc-white study study-%s type-%s">
                        <img src="%s">
                        <h3>%s</h3>
                        <p class="mb-0">%s</p>
                        <a href="%s" target="_blank"></a>
                        <a href="%s" class="btn btn-danger delete-study remove_this"><i class="fas fa-fw fa-trash-alt"></i></a>
                    </div>
                </div>';
    $study = App\Study::find($id);
    if(!is_null($study)) {
        $out = sprintf($template, $study->id, str_slug($study->type),
            get_screenshot(url("/attachments/show/$study->filename")),
            $study->original_name, $study->type, url("/attachments/download/$study->filename"),
            url("/attachments/delete/$study->id"));
        return response()->json(["template" => $out]);
    }
    return response()->json([]);
});

Route::get('/search', function(Request $request) {
    $query = $request->query('query', 'all');
    $resp = [
        'query' => $query,
        'suggestions' => []
    ];
    if($query === "all") {
        $resp['suggestions'] = Patient::all_in_suggestion_format();
    } else {
        $resp['suggestions'] = Patient::find_in_suggestion_format($query);
    }
    return response()->json($resp);
});