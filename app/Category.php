<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $table = 'categories';
    protected $fillable = ['name', 'category_code','parent_category_id'];

    //We can reuse this code but for the Model pupose we have used here
    public static function getDropDown() {
        $getDropDown = self::all()->pluck('name', 'id')->prepend('Select','');
        return $getDropDown;
    }

    public function parentcat()
    {
        return $this->belongsTo(Category::class, 'parent_category_id');
    }
}
