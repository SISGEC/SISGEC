<?php
 
namespace App\Http\Controllers;

use App\Study;
use App\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Intervention\Image\Facades\Image;
 
class StudiesController extends Controller
{
 
    private $photos_path;
 
    public function __construct()
    {
        $this->photos_path = public_path('/studies');
    }
 
    /**
     * Display all of the images.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('uploaded-images');
    }
 
    /**
     * Show the form for creating uploading new images.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('upload');
    }
 
    /**
     * Saving images uploaded through XHR Request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $photos = $request->file('file');

        if(config("app.demo_mode")) {
            return Response::json([
                'message' => 'Demo mode is enabled, please disable this mode to allow uploading files to the server.',
                'studies' => []
            ], 401);
        }

        if($request->has("patient_id")) {
            $patient = Patient::find($request->query("patient_id"));
        }
 
        if (!is_array($photos)) {
            $photos = [$photos];
        }
 
        if (!is_dir($this->photos_path)) {
            mkdir($this->photos_path, 0777);
        }

        $resp = [
            'message' => 'Image saved Successfully',
            'studies' => []
        ];
 
        for ($i = 0; $i < count($photos); $i++) {
            $photo = $photos[$i];
            $name = sha1(date('YmdHis') . str_random(30));
            $save_name = $name . '.' . $photo->getClientOriginalExtension();
 
            $photo->move($this->photos_path, $save_name);
 
            $upload = new Study();
            $upload->filename = $save_name;
            $upload->original_name = basename($photo->getClientOriginalName());
            $upload->type = $photo->getClientMimeType();
            $upload->save();

            $arr_study = ['id' => $upload->id, 'template' => ''];

            if($request->has("patient_id")) {
                $patient->initial_clinical_history->studies()->saveMany([$upload]);
                $template = '<div class="col-12 col-sm-3 mb-3">
                                <div class="bd bgc-white study study-%s type-%s">
                                    <img src="%s">
                                    <h3>%s</h3>
                                    <p class="mb-0">%s</p>
                                    <a href="%s" target="_blank"></a>
                                    <a href="%s" class="btn btn-danger delete-study remove_this"><i class="fas fa-fw fa-trash-alt"></i></a>
                                </div>
                            </div>';
                $out = sprintf($template, $upload->id, str_slug($upload->type),
                    $upload->screenshot, $upload->original_name,
                    $upload->type_name, $upload->path, url("/attachments/delete/$upload->id"));
                $arr_study['template'] = $out;
            }

            $resp['studies'][] = $arr_study;
        }
        return Response::json($resp, 200);
    }
 
    /**
     * Remove the images from the storage.
     *
     * @param Request $request
     */
    public function destroy(Request $request, $id)
    {
        $uploaded_image = Study::find($id);
 
        if (empty($uploaded_image)) {
            return redirect()->back()->withErrors(['error', __("Sorry file does not exist")]);
        }
 
        $file_path = $this->photos_path . '/' . $uploaded_image->filename;
 
        if (file_exists($file_path)) {
            unlink($file_path);
        }
 
        if (!empty($uploaded_image)) {
            $uploaded_image->delete();
        }
 
        return redirect()->back();
    }

    public function show($filename) {
        $file = Study::where('filename', $filename)->first();
        return response()->file($file->real_path);
    }

    public function download($filename) {
        $file = Study::where('filename', $filename)->first();
        return response()->download($file->real_path);
    }
}