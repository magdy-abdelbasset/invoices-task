<?php

use App\Utils\FileHandler;
use App\Utils\NotificationLogo;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\File as ModelsFile;
function setFile($dir, $file, $model = null, $type = "image",$from_url = false)
{

    $path =null;
    if (!empty($file)) {
        $model_ = ModelsFile::where('model_id', $model->id)->where("model_type", get_class($model))->where("type", $type)->first();
        $orginal_name = "";
        if($from_url){
            $path = save_url($dir,$file);
        }else{
            $m = (new FileHandler($dir, $file))->upload($from_url);
            $path = $m->getFullPath();
            $orginal_name = $m->getOrginalName();
        }
        unSetFile($model_);
        // Image
        ModelsFile::create([
            "type"          => $type,
            "url"           => $path,
            "model_id"      => $model->id,
            "model_type"    => get_class($model),
            "orignal_name" => $orginal_name
        ]);
    }
    return $path;
}

function setFileMulti($dir, $files, $model = null, $type = "image",$ids = [])
{
    $models = ModelsFile::whereNotIn("id",$ids)->
    where('model_id', $model->id)->where("model_type", get_class($model))->where("type", $type)->get();
    // foreach ($models ?? [] as $model_) {
    //     unSetFile($model_);
    // }
    foreach ($files ?? [] as $file) {
        if (!empty($file)) {
            // Image
            $m = (new FileHandler($dir, $file))->upload();
            $path = $m->getFullPath();
            $orginal_name = $m->getOrginalName();
            ModelsFile::create([
                "type"          => $type,
                "url"           => $path,
                "model_id"      => $model->id,
                "model_type"    => get_class($model),
                "orignal_name" => $orginal_name
            ]);
        }
    }
}

function unSetFile($file)
{
    if (!empty($file)) {
        File::delete($file->url);
        Storage::disk('public')->delete(str_replace("storage/", '', $file->url));
        $file->delete();
    }
}
function deleteFile($model,$type="image")
{
    $model_ = ModelsFile::where('model_id', $model->id)->where("model_type", get_class($model))->where("type", $type)->first();
    unSetFile($model_);
}

function sendJson($data, $message = null, $status = 200 ,$success = true)
{
    if($message == null){
        $message = __("messages.done success");
    }
    return response()->json([
        "success"   => $success,
        "message"   => $message,
        "data"      => $data
    ], $status);
}


function send_multi_fcm($tokens, $message, $data)
{
    if (!$data) {
        $data = ['type' => null, 'id' => null];
    }


    Http::acceptJson()->withToken(config('services.fcm.key'))->post(
        'https://fcm.googleapis.com/fcm/send',
        [
            'registration_ids' => $tokens,
            'notification' => [
                'title' => config('app.name'),
                "body" => $message
            ],
            'data' => $data
        ]
    );

}

function send_fcm($token,$id ,$message, $data)
{
    if (!$data) {
        $data = ['type' => null, 'id' => null];
    }
    // $data["logo"] = NotificationLogo::getLogoUrl($data["type"]);

   Http::acceptJson()->withToken(config('services.fcm.key'))->post(
        'https://fcm.googleapis.com/fcm/send',
        [
            'to' => $token,
            'notification' => [
                'title' => config('app.name'),
                "body" => $message
            ],
            'data' => $data
        ]
    );
    // Notification::create([
    //     "student_id"    => $id,
    //     "message"       => $message ,
    //     "model_type"          => $data["type"],
    //     "model_id"      => $data["id"]
    // ]);
}

// Make a function for convenience 

function fileSize_($path)
{
    return strlen( file_get_contents($path) );
}
function save_url($dir,$url)
{
    // Load the file contents into a variable.
    $originalExtension = pathinfo($url, PATHINFO_EXTENSION);
    $fileNameHash = time() . '_' . Str::random(30);
    $newName = $fileNameHash . '.' . $originalExtension;
    $path = storage_path('app/public/uploads/').$dir;
    File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);
    $contents = file_get_contents($url);
    file_put_contents($path.$newName,$contents);
    return 'storage/uploads/'. $dir. $newName;

}
function save($dir ,$file)
{
    $fileNameWithExtension = $file->getClientOriginalName();

    /** Get Filename Without Extension **/
    $originalName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);

    /** Set File Extension **/

    $originalExtension = $file->getClientOriginalExtension();
    $fileNameHash = time() . '_' . Str::random(30);
    $newName = $fileNameHash . '.' . $originalExtension;
    $path = storage_path('app/public/uploads/').$dir;
    File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);
    $file->storeAs('public/uploads/'. $dir, $newName);
    return 'storage/uploads/'. $dir. $newName;

}