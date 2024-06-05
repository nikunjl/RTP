<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    public function getImgAttribute($value)
    {
        if(!empty($value)) {
	        return asset('slider/'.$value);
        }
    }
}
