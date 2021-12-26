<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Storage;
use App\Models\Category;
use App\Models\ProductImage;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $appends = ['image_path'];
    protected $fillable = [
        'name',
        'slug',
        'image',
        'category_id'
    ];
    public function getImagePathAttribute(){
        return Storage::disk('public')->url($this->attributes['image']);
    }
    public function category(){
        return $this->hasOne(Category::class,'id','category_id');
    }
    public function images(){
        return $this->hasMany(ProductImage::class,'product_id','id');
    }
}
