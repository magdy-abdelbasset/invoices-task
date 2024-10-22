<?php

namespace App\Utils;

use App\Models\File;
use Exception;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Support\Facades\Storage;

class Files 
{
    /**
     * Cast the given value.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return array
     */
    private $class;
    private $get;
    private $type;
    const IMAGE_PATH = '';
    const VIDEO_PATH = '';

    public function __construct($class = "App/Models/File",$get = "get")
    {
        $this->class = $class;
        $this->get   = $get;
    }
    public static function get_files_url($files)
    {
        $files_url = [];
        foreach ($files as $file) {
            $files_url[] = !empty($file->url) ? asset($file->url) :  asset(Files::IMAGE_PATH);
        }
        return $files_url;

    }
    public function get($id,$type=null)
    {
        try {
            $get = $this->get;
            $files = File::query();
            if($get =="get"){
                $files = $files->select(["id","url"]);
            }
            $files = $files->where('model_id', $id)->where("model_type", $this->class);
            if(empty($type)){
                $files = $files->$get();
            }else{
                $files = $files->where("type",$type)->$get();
            }
            return $files;
        } catch (Exception $e) {
            return null;
        }
    }
}