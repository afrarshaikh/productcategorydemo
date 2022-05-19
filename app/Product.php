<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $table = 'products';
    protected $fillable = ['name', 'product_code'];

    //We can reuse this code but for the Model pupose we have used here
    public static function getDropDown() {
        $getDropDown = self::all()->pluck('name', 'id')->prepend('Select','');
        return $getDropDown;
    }

    /**
     * The category that belong to the product.
     */
    public function category()
    {
        return $this->belongsToMany(Category::class,'product_category');
    }
}
