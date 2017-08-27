<?php
/**
 * User: Zhanybek Seitaliev
 * Email: zhandev312@gmail.com
 * Date: 24.08.17
 * Time: 18:49
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Product extends Model
{

    protected $fillable = [
        'id',
        'title',
        'handle',
        'shop_id',
        'created_at',
        'updated_at',
        'published_at',
        'variants',
        'images',
        'image',
        'tags',
        'product_type',
        'vendor'
    ];

    public function setImagesAttribute($value) {

        if(empty($value)) {
            $this->attributes['images'] = null;
        }else {
            $this->attributes['images'] = json_encode($value);
        }

    }

    public function setVariantsAttribute($value) {

        $this->attributes['variants'] = json_encode($value);

    }

    public function setTagsAttribute($value) {

        if(empty($value)) {
            $this->attributes['tags'] = null;
        }else {
            $this->attributes['tags'] = json_encode($value);
        }

    }

    public function setImageAttribute($value) {

        if(empty($value)) {
            $this->attributes['image'] = null;
        }else {
            $this->attributes['image'] = json_encode($value);
        }
    }

    public function setCreatedAtAttribute($value)
    {
        $this->attributes['created_at'] = Carbon::parse($value)->format('Y-m-d H:m:s');
    }

    public function setUpdatedAtAttribute($value)
    {
        $this->attributes['updated_at'] = Carbon::parse($value)->format('Y-m-d H:m:s');
    }

    public function setPublishedAtAttribute($value)
    {
        if(empty($value)) {
            $this->attributes['published_at'] = null;
        }else {
            $this->attributes['published_at'] = Carbon::parse($value)->format('Y-m-d H:m:s');
        }
    }

}