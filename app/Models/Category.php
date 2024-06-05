<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function getImgAttribute($value)
    {
        if(!empty($value)) {
	        return asset('category/'.$value);
        }
    }
}
