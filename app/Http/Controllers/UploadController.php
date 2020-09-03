<?php


namespace App\Http\Controllers;


use App\Models\ModuleVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{

    public function upload(Request $request)
    {

        $file = $request->file('file');

        $extension = $file->getClientOriginalExtension();
        $now = new Carbon();
        $path = 'uploads/' . $now->year . '/' . $now->month . '/' . $now->day . '/' . $now->timestamp . '.' . $extension;
        Storage::put($path, File::get($file));
        ModuleVideo::create([
            'title' => $file->getClientOriginalName(),
            'url' => $path,
            'modules_id' => $request->get('moduleId')
        ]);

        return response()->json([
            'success' => true,
        ]);
    }
}