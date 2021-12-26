<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Storage;

class Category extends Model
{
    use HasFactory, SoftDeletes;
    protected $appends = ['icon_path'];
    protected $fillable = [
        'name',
        'slug',
        'icon'
    ];
    public function getIconPathAttribute(){
        return Storage::disk('public')->url($this->attributes['icon']);
    }
}
