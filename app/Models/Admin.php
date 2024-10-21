<?php

namespace App\Models;


/*
Done by Tech Go Software Services

*/

use App\Utils\Files;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Admin  extends Authenticatable
{
    use  HasFactory, Notifiable;
    use HasRoles;

    protected $guarded = ['id'];
    protected $appends = ["image"];


    public function getImageAttribute()
    {
        $image = (new Files(self::class, 'first'))->get($this->id, "image");
        return !empty($image->url) ? asset($image->url) :  asset(Files::IMAGE_PATH);
    }

}
