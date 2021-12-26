<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Storage;

class ProductImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'path',
        'file_name',
        'product_id'
    ];
    protected $appends = ['image_path'];
    public function getImagePathAttribute(){
        return Storage::disk('public')->url($this->attributes['path']);
    }
}
