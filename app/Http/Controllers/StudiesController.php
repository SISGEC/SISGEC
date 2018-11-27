<?php
 
namespace App\Http\Controllers;

use App\Study;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Intervention\Image\Facades\Image;
 
class StudiesController extends Controller
{
 
    private $photos_path;
 
    public function __construct()
    {
        $this->photos_path = public_path('/images/studies');
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
    public function store(Request $request)
    {
        $photos = $request->file('file');
 
        if (!is_array($photos)) {
            $photos = [$photos];
        }
 
        if (!is_dir($this->photos_path)) {
            mkdir($this->photos_path, 0777);
        }
 
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
        }
        return Response::json([
            'message' => 'Image saved Successfully',
            'study_id' => $upload->id
        ], 200);
    }
 
    /**
     * Remove the images from the storage.
     *
     * @param Request $request
     */
    public function destroy(Request $request)
    {
        $filename = $request->id;
        $uploaded_image = Study::where('original_name', basename($filename))->first();
 
        if (empty($uploaded_image)) {
            return Response::json(['message' => 'Sorry file does not exist'], 400);
        }
 
        $file_path = $this->photos_path . '/' . $uploaded_image->filename;
 
        if (file_exists($file_path)) {
            unlink($file_path);
        }
 
        if (!empty($uploaded_image)) {
            $uploaded_image->delete();
        }
 
        return Response::json(['message' => 'File successfully delete'], 200);
    }

    public function show($filename) {
        $file = Study::where('filename', $filename)->first();
        return response()->file(asset("images/studies/$file->filename"));
    }

    public function download($filename) {
        $file = Study::where('filename', $filename)->first();
        return response()->download(asset("images/studies/$file->filename"));
    }
}