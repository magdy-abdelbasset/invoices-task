<?php

namespace App\Casts;

/*
Done by Tech Go Software Services

*/


use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class UidCast implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return (string) $value;
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        do {
            // $v =  Str::random(40);
            $v = (string) random_int(1000000000,9999999999);
            $exists = $model->where($key,$v)->exists();
        } while ($exists);
        return $v;
    }
}
