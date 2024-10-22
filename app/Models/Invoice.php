<?php

namespace App\Models;

use App\Casts\UidCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $guarded = [
        'id'
    ];
    protected $casts = [
        'items'     => "array",
    ];
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

}
